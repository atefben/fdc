<?php

namespace Base\CoreBundle\Command;

use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassics;
use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidget;
use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidgetTextTranslation;
use Base\CoreBundle\Entity\InfoArticle;
use Base\CoreBundle\Entity\InfoWidget;
use Base\CoreBundle\Entity\InfoWidgetImage;
use Base\CoreBundle\Entity\InfoWidgetTextTranslation;
use Base\CoreBundle\Entity\NewsArticle;
use Base\CoreBundle\Entity\NewsWidgetImage;
use Base\CoreBundle\Entity\NewsWidgetText;
use Base\CoreBundle\Entity\NewsWidgetTextTranslation;
use Base\CoreBundle\Entity\StatementArticle;
use Base\CoreBundle\Entity\StatementWidget;
use Base\CoreBundle\Entity\StatementWidgetTextTranslation;
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
        // Classics
        $output->writeln('<info>classics</info>');
        $count = $this->getClassicsCount();
        $pages = ceil($count / 50);

        $bar = new ProgressBar($output, $count);
        $bar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
        $bar->start();

        for ($page = 1; $page <= $pages; $page++) {
            $infos = $this->getClassics($page);
            foreach ($infos as $item) {
                $bar->advance();
                $this->factorizeClassicsWidgetText($item);
                $this->factorizeClassicsWidgetImage($item);
            }
        }

        $bar->finish();
        $output->writeln('');


        // Infos
        $output->writeln('<info>infos</info>');
        $count = $this->getInfosCount();
        $pages = ceil($count / 50);

        $bar = new ProgressBar($output, $count);
        $bar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
        $bar->start();

        for ($page = 1; $page <= $pages; $page++) {
            $infos = $this->getInfos($page);
            foreach ($infos as $item) {
                $bar->advance();
                $this->factorizeInfoWidgetText($item);
                $this->factorizeInfoWidgetImage($item);
            }
        }

        $bar->finish();
        $output->writeln('');


        // Statement
        $output->writeln('<info>statements</info>');
        $count = $this->getStatementsCount();
        $pages = ceil($count / 50);

        $bar = new ProgressBar($output, $count);
        $bar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
        $bar->start();

        for ($page = 1; $page <= $pages; $page++) {
            $statements = $this->getStatements($page);
            foreach ($statements as $item) {
                $bar->advance();
                $this->factorizeStatementWidgetText($item);
                $this->factorizeStatementWidgetImage($item);
            }
        }

        $bar->finish();
        $output->writeln('');


        // News
        $output->writeln('<info>news</info>');
        $count = $this->getNewsCount();
        $pages = ceil($count / 50);

        $bar = new ProgressBar($output, $count);
        $bar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
        $bar->start();

        for ($page = 1; $page <= $pages; $page++) {
            $news = $this->getNews($page);
            foreach ($news as $item) {
                $bar->advance();
                $this->factorizeNewsWidgetText($item);
                $this->factorizeNewsWidgetImage($item);
            }
        }

        $bar->finish();
        $output->writeln('');
    }

    protected function factorizeNewsWidgetText(NewsArticle $news)
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

    protected function factorizeNewsWidgetImage(NewsArticle $news)
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

    protected function factorizeInfoWidgetText(InfoArticle $info)
    {
        /**
         * @var NewsWidgetText
         */
        $first = null;
        $langs = array('fr', 'en', 'es', 'zh');
        $done = [];
        foreach ($info->getWidgets() as $widget) {
            if ($widget instanceof InfoWidget && $widget->getOldImportReference() == 'body') {
                if ($first == null) {
                    $first = $widget;
                    continue;
                }
                foreach ($langs as $lang) {
                    $referenceTrans = $first->findTranslationByLocale($lang);
                    $trans = $widget->findTranslationByLocale($lang);
                    if ($trans instanceof InfoWidgetTextTranslation && $trans->getContent()) {
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

    protected function factorizeInfoWidgetImage(InfoArticle $info)
    {
        $first = array();
        foreach ($info->getWidgets() as $widget) {
            if ($widget instanceof InfoWidgetImage) {
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

    protected function factorizeStatementWidgetText(StatementArticle $info)
    {
        /**
         * @var NewsWidgetText
         */
        $first = null;
        $langs = array('fr', 'en', 'es', 'zh');
        $done = [];
        foreach ($info->getWidgets() as $widget) {
            if ($widget instanceof StatementWidget && $widget->getOldImportReference() == 'body') {
                if ($first == null) {
                    $first = $widget;
                    continue;
                }
                foreach ($langs as $lang) {
                    $referenceTrans = $first->findTranslationByLocale($lang);
                    $trans = $widget->findTranslationByLocale($lang);
                    if ($trans instanceof StatementWidgetTextTranslation && $trans->getContent()) {
                        if (!$referenceTrans) {
                            if (!in_array($lang, $done)) {
                                $trans->setTranslatable($first);
                                $widget->removeTranslation($trans);
                                $done[] = $lang;
                            }

                        } elseif ($referenceTrans instanceof StatementWidgetTextTranslation && !$referenceTrans->getContent()) {
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

    protected function factorizeStatementWidgetImage(StatementArticle $statement)
    {
        $first = array();
        foreach ($statement->getWidgets() as $widget) {
            if ($widget instanceof InfoWidgetImage) {
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

    protected function factorizeClassicsWidgetText(FDCPageLaSelectionCannesClassics $info)
    {
        /**
         * @var NewsWidgetText
         */
        $first = null;
        $langs = array('fr', 'en', 'es', 'zh');
        $done = [];
        foreach ($info->getWidgets() as $widget) {
            if ($widget instanceof FDCPageLaSelectionCannesClassicsWidget && $widget->getOldImportReference() == 'body') {
                if ($first == null) {
                    $first = $widget;
                    continue;
                }
                foreach ($langs as $lang) {
                    $referenceTrans = $first->findTranslationByLocale($lang);
                    $trans = $widget->findTranslationByLocale($lang);
                    if ($trans instanceof StatementWidgetTextTranslation && $trans->getContent()) {
                        if (!$referenceTrans) {
                            if (!in_array($lang, $done)) {
                                $trans->setTranslatable($first);
                                $widget->removeTranslation($trans);
                                $done[] = $lang;
                            }

                        } elseif ($referenceTrans instanceof FDCPageLaSelectionCannesClassicsWidgetTextTranslation && !$referenceTrans->getContent()) {
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

    protected function factorizeClassicsWidgetImage(FDCPageLaSelectionCannesClassics $classics)
    {
        $first = array();
        foreach ($classics->getWidgets() as $widget) {
            if ($widget instanceof InfoWidgetImage) {
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
     * @return int
     */
    protected function getNewsCount()
    {
        return (int) $this
            ->getManager()
            ->getRepository('BaseCoreBundle:NewsArticle')
            ->createQueryBuilder('n')
            ->select('count(n)')
            ->distinct()
            ->andWhere('n.oldNewsId is not null')
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }

    /**
     * @return InfoArticle[]
     */
    protected function getInfos($offset)
    {
        return $this
            ->getManager()
            ->getRepository('BaseCoreBundle:InfoArticle')
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
     * @return int
     */
    protected function getInfosCount()
    {
        return (int) $this
            ->getManager()
            ->getRepository('BaseCoreBundle:InfoArticle')
            ->createQueryBuilder('n')
            ->select('count(n)')
            ->distinct()
            ->andWhere('n.oldNewsId is not null')
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }

    /**
     * @return StatementArticle[]
     */
    protected function getStatements($offset)
    {
        return $this
            ->getManager()
            ->getRepository('BaseCoreBundle:StatementArticle')
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
     * @return int
     */
    protected function getStatementsCount()
    {
        return (int) $this
            ->getManager()
            ->getRepository('BaseCoreBundle:StatementArticle')
            ->createQueryBuilder('n')
            ->select('count(n)')
            ->distinct()
            ->andWhere('n.oldNewsId is not null')
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }

    /**
     * @return FDCPageLaSelectionCannesClassics[]
     */
    protected function getClassics($offset)
    {
        return $this
            ->getManager()
            ->getRepository('BaseCoreBundle:FDCPageLaSelectionCannesClassics')
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
     * @return int
     */
    protected function getClassicsCount()
    {
        return (int) $this
            ->getManager()
            ->getRepository('BaseCoreBundle:FDCPageLaSelectionCannesClassics')
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