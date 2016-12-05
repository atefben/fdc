<?php

namespace Base\CoreBundle\Command;

use Base\CoreBundle\Entity\News;
use Base\CoreBundle\Entity\NewsArticle;
use Base\CoreBundle\Entity\NewsWidgetText;
use Base\CoreBundle\Entity\NewsWidgetTextTranslation;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class OldFdcDatabaseImportWidgetsCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('base:import:old_fdc_widgets');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->factorizeWidgetText($this->getManager()->getRepository('BaseCoreBundle:NewsArticle')->find(2085));
die;
        $count = $this->getNewsCount();
        $pages = ceil($count / 50);

        $bar = new ProgressBar($output, $count);
        $bar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
        $bar->start();

        for ($page = 1; $page <= $pages; $page++) {
            $news = $this->getNews($page);
            foreach ($news as $item) {
                $bar->advance();
                $this->factorizeWidgetText($item);
            }
        }
        $bar->finish();
        $output->writeln('');
    }

    protected function factorizeWidgetText(NewsArticle $news)
    {
        /**
         * @var NewsWidgetText
         */
        $first = null;
        $langs = array('fr', 'en', 'es', 'zh');
        $done = [];
        foreach ($news->getWidgets() as $widget) {
            if ($widget instanceof NewsWidgetText && $widget->getOldImportReference() == 'body') {
                if ($first == null) {
                    $first = $widget;
                    dump($first->getId());
                    continue;
                }
                foreach ($langs as $lang) {
                    $referenceTrans = $first->findTranslationByLocale($lang);
                    $trans = $widget->findTranslationByLocale($lang);
                    if ($trans instanceof NewsWidgetTextTranslation && $trans->getContent()) {
                        if (!$referenceTrans) {
                            if (!in_array($lang, $done)) {
                                $trans->setTranslatable($first);
                                $widget->removeTranslation($trans);
                                $done[] = $lang;
                            }

                        } elseif ($referenceTrans instanceof NewsWidgetTextTranslation && !$referenceTrans->getContent()) {
                            $referenceTrans->setContent($trans->getContent());
                        }
                    }
                }
                $this->getManager()->flush();
                $this->getManager()->remove($widget);
                $this->getManager()->flush();
            }
        }
        $this->getManager()->flush();
    }

    /**
     * @return NewsArticle[]
     */
    protected function getNews($offset)
    {
        return $this
            ->getManager()
            ->getRepository('BaseCoreBundle:News')
            ->createQueryBuilder('n')
            ->distinct()
            ->andWhere('n.oldNewsId is not null')
            ->setFirstResult(($offset - 1) * 50)
            ->setMaxResults(50)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return News[]
     */
    protected function getNewsCount()
    {
        return $this
            ->getManager()
            ->getRepository('BaseCoreBundle:News')
            ->createQueryBuilder('n')
            ->select('count(n)')
            ->distinct()
            ->andWhere('n.oldNewsId is not null')
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }

    protected function getManager()
    {
        return $this->getContainer()->get('doctrine')->getManager();
    }

}