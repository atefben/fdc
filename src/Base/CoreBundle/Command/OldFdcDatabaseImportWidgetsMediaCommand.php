<?php

namespace Base\CoreBundle\Command;

use Base\CoreBundle\Entity\News;
use Base\CoreBundle\Entity\NewsArticle;
use Base\CoreBundle\Entity\NewsWidgetImage;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class OldFdcDatabaseImportWidgetsMediaCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('base:import:old_fdc_widgets_media');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
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
        $first = array();
        foreach ($news->getWidgets() as $widget) {
            if ($widget instanceof NewsWidgetImage) {
                if (!array_key_exists($widget->getOldImportReference(), $first)) {
                    $first[$widget->getOldImportReference()] = $widget;
                    continue;
                }
                foreach ($widget->getGallery()->getMedias() as $media) {
                    $this->getManager()->remove($media);
                }
                $this->getManager()->remove($widget->getGallery());
                $this->getManager()->remove($widget);
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