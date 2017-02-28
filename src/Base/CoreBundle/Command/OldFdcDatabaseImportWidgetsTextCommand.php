<?php

namespace Base\CoreBundle\Command;

use Base\CoreBundle\Entity\FilmFilm;
use Base\CoreBundle\Entity\FilmFilmTranslation;
use Base\CoreBundle\Entity\NewsArticle;
use Base\CoreBundle\Entity\NewsWidgetTextTranslation;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class OldFdcDatabaseImportWidgetsTextCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('base:import:old_fdc_widgets_text');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $domain = $this->getContainer()->getParameter('fdc_corporate_domain');
        $scheme = $this->getContainer()->getParameter('fdc_event_scheme');
        if (!$domain) {
            $domain = $this->getContainer()->getParameter('fdc_event_domain');
        }

        $prefixMovie = "$scheme://$domain/[lang]/corporate/films/[slug]";

        $nwts = $this->getNewsWidgetTextTranslations();

        $bar = new ProgressBar($output, count($nwts));
        $bar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
        $bar->start();

        foreach ($nwts as $nwt) {
            $lang = $nwt->getLocale();
            $bar->advance();
            $pattern = '/http:\/\/www\.festival-cannes\.com\/fr\/archives\/ficheFilm\/id\/([0-9]+)\/year\/([0-9]{4})\.html/';
            $matches = [];
            if (preg_match_all($pattern, $nwt->getContent(), $matches)) {
                foreach ($matches[0] as $key => $match) {
                    $id = $matches[1][$key];
                    $slug = $this->getSlug($lang, $id);
                    if ($slug) {
                        $urlSearch = 'http://www.festival-cannes.com/fr/archives/ficheFilm/id/' . $id . '/year/' . $matches[2][$key] . '.html';
                        $urlReplace = str_replace(['[lang]', '[slug]'], [$lang, $slug],   $prefixMovie);
                        $text = str_replace($urlSearch, $urlReplace, $nwt->getContent());
                        //$nwt->setContent($text);
                        //$this->getManager()->flush();
                    }
                }
            }
        }
        $bar->finish();
        $output->writeln('');
    }

    protected function replaceUrl(NewsArticle $news)
    {
        $this->getManager()->flush();
    }

    /**
     * @return NewsWidgetTextTranslation[]
     */
    protected function getNewsWidgetTextTranslations()
    {
        return $this
            ->getManager()
            ->getRepository('BaseCoreBundle:NewsWidgetTextTranslation')
            ->getOldItems()
            ;
    }

    protected function getManager()
    {
        return $this->getContainer()->get('doctrine')->getManager();
    }

    private function getSlug($lang, $selfkit)
    {
        $oldFilmassoc = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldFilmsassoc')
            ->findOneBy(['idselfkit' => $selfkit])
        ;
        if ($oldFilmassoc && $oldFilmassoc->getIdsoif()) {
            $movie = $this->getManager()->getRepository('BaseCoreBundle:FilmFilm')->find($oldFilmassoc->getIdsoif());
            if ($movie instanceof FilmFilm) {
                $trans = $movie->findTranslationByLocale($lang);
                if ($trans instanceof FilmFilmTranslation) {
                    return $trans->getSlug();
                }
            }
        }
    }

}