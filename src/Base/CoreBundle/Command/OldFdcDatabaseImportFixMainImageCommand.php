<?php

namespace Base\CoreBundle\Command;

use Base\CoreBundle\Entity\Event;
use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassics;
use Base\CoreBundle\Entity\InfoArticle;
use Base\CoreBundle\Entity\MediaImage;
use Base\CoreBundle\Entity\MediaImageTranslation;
use Base\CoreBundle\Entity\NewsArticle;
use Base\CoreBundle\Entity\OldArticleI18n;
use Base\CoreBundle\Entity\StatementArticle;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class OldFdcDatabaseImportFixMainImageCommand extends ContainerAwareCommand
{

    protected $langs = array('fr', 'en', 'es', 'zh');
    protected $oldLangs = array('fr', 'en', 'es', 'cn');

    /**
     * @var InputInterface
     */
    private $input;
    /**
     * @var OutputInterface
     */
    private $output;

    protected function configure()
    {
        $this
            ->setName('base:import:fix-main-image')
            ->addArgument('entity', InputArgument::REQUIRED, 'Values accepted : news, info, statement, event, classics')
            ->addOption('count', null, InputOption::VALUE_NONE, 'Show count object')
            ->addOption('id', null, InputOption::VALUE_OPTIONAL, 'Update item by id')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;

        $function = $input->getOption('count') ? 'countItems' : 'processItems';

        switch ($input->getArgument('entity')) {
            case 'news':
                $this->$function(NewsArticle::class, 'header');
                break;
            case 'info':
                $this->$function(InfoArticle::class, 'header');
                break;
            case 'statement':
                $this->$function(StatementArticle::class, 'header');
                break;
            case 'event':
                $this->$function(Event::class, 'header');
                break;
            case 'classics':
                $this->$function(FDCPageLaSelectionCannesClassics::class, 'image');
                break;
            default:
                $output->writeln('<error>Values accepted for entity : news, info, statement, event, classics</error>');
        }
    }

    protected function processItems($class, $field)
    {
        if ($this->input->getOption('id')) {
            $items = $this
                ->getDoctrineManager()
                ->getRepository($class)
                ->createQueryBuilder('o')
                ->andWhere("o.oldNewsId is not null")
                ->andWhere("o.{$field} is not null")
                ->andWHere('o.id = :id')
                ->setParameter(':id', $this->input->getOption('id'))
                ->getQuery()
                ->getResult()
            ;
        }
        else {
            $items = $this
                ->getDoctrineManager()
                ->getRepository($class)
                ->createQueryBuilder('o')
                ->andWhere("o.oldNewsId is not null")
                ->andWhere("o.{$field} is not null")
                ->getQuery()
                ->getResult()
            ;
        }
        $bar = new ProgressBar($this->output, count($items));
        $bar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
        $bar->start();

        $getter = 'get' . ucfirst($field);

        foreach ($items as $item) {
            $bar->advance();
            $mediaImage = $item->$getter();
            if ($mediaImage instanceof MediaImage) {
                $olds = $this->getOldArticlesI18n($item->getOldNewsId());
                foreach ($olds as $lang => $old) {
                    $miTrans = $mediaImage->findTranslationByLocale($lang);
                    if ($miTrans instanceof MediaImageTranslation) {
                        $miTrans->setLegend($old->getTitleImageResume());
                    }
                }
                $this->getDoctrineManager()->flush();
            }
        }
        $bar->finish();

        $this->output->writeln('');
    }

    /**
     * @param $id
     * @return OldArticleI18n[]
     */
    protected function getOldArticlesI18n($id)
    {
        $output = array();
        $translations =  $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:OldArticleI18n')
            ->findBy(['id' => $id, 'culture' => $this->oldLangs])
        ;

        foreach ($translations as $translation) {
            if (in_array($translation->getCulture(), $this->oldLangs)) {
                $key = $translation->getCulture() == 'cn' ? 'zh' : $translation->getCulture();
                $output[$key] = $translation;
            }
        }

        return $output;
    }

    protected function countItems($class, $field)
    {
        $count = $this
            ->getDoctrineManager()
            ->getRepository($class)
            ->createQueryBuilder('o')
            ->select('count(o)')
            ->andWhere("o.oldNewsId is not null")
            ->andWhere("o.{$field} is not null")
            ->getQuery()
            ->getOneOrNullResult()
        ;
        $this->output->writeln("<info>$count items </info>");
    }

    /**
     * @return ObjectManager
     */
    private function getDoctrineManager()
    {
        return $this->getContainer()->get('doctrine')->getManager();
    }
}