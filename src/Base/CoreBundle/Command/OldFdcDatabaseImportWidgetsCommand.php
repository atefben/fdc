<?php

namespace Base\CoreBundle\Command;

use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassics;
use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidget;
use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidgetTextTranslation;
use Base\CoreBundle\Entity\InfoArticle;
use Base\CoreBundle\Entity\InfoFilmFilmAssociated;
use Base\CoreBundle\Entity\InfoInfoAssociated;
use Base\CoreBundle\Entity\InfoWidget;
use Base\CoreBundle\Entity\InfoWidgetAudio;
use Base\CoreBundle\Entity\InfoWidgetImage;
use Base\CoreBundle\Entity\InfoWidgetTextTranslation;
use Base\CoreBundle\Entity\InfoWidgetVideo;
use Base\CoreBundle\Entity\NewsArticle;
use Base\CoreBundle\Entity\NewsFilmFilmAssociated;
use Base\CoreBundle\Entity\NewsNewsAssociated;
use Base\CoreBundle\Entity\NewsWidgetAudio;
use Base\CoreBundle\Entity\NewsWidgetImage;
use Base\CoreBundle\Entity\NewsWidgetText;
use Base\CoreBundle\Entity\NewsWidgetTextTranslation;
use Base\CoreBundle\Entity\NewsWidgetVideo;
use Base\CoreBundle\Entity\StatementArticle;
use Base\CoreBundle\Entity\StatementFilmFilmAssociated;
use Base\CoreBundle\Entity\StatementStatementAssociated;
use Base\CoreBundle\Entity\StatementWidget;
use Base\CoreBundle\Entity\StatementWidgetAudio;
use Base\CoreBundle\Entity\StatementWidgetTextTranslation;
use Base\CoreBundle\Entity\StatementWidgetVideo;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class OldFdcDatabaseImportWidgetsCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('base:import:old_fdc_widgets')
            ->addOption('classics', null, InputOption::VALUE_NONE, 'Remove double widgets of classics')
            ->addOption('infos', null, InputOption::VALUE_NONE, 'Remove double widgets of infos')
            ->addOption('statements', null, InputOption::VALUE_NONE, 'Remove double widgets of statements')
            ->addOption('news', null, InputOption::VALUE_NONE, 'Remove double widgets of news')
            ->addOption('news-page', null, InputOption::VALUE_OPTIONAL, 'Pagination for news (50 items per page)')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($input->getOption('classics')) {
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
        }


        if ($input->getOption('infos')) {
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
                    $this->factorizeInfoWidgetAudio($item);
                    $this->factorizeInfoWidgetVideo($item);
                    $this->factorizeInfoWidgetFilms($item);
                }
            }

            $bar->finish();
            $output->writeln('');
        }


        if ($input->getOption('statements')) {
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
                    $this->factorizeStatementWidgetAudio($item);
                    $this->factorizeStatementWidgetVideo($item);
                    $this->factorizeStatementWidgetFilms($item);
                }
            }

            $bar->finish();
            $output->writeln('');
        }

        if ($input->getOption('news')) {
            // News
            $output->writeln('<info>news</info>');
            if ($input->getOption('news-page')) {
                $count = $this->getNewsCount($input->getOption('news-page'));
                $news = $this->getNews($input->getOption('news-page'));
                $bar = new ProgressBar($output, $count);
                $bar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
                $bar->start();
                foreach ($news as $item) {
                    $bar->advance();
                    $this->factorizeNewsWidgetText($item);
                    $this->factorizeNewsWidgetImage($item);
                    $this->factorizeNewsWidgetAudio($item);
                    $this->factorizeNewsWidgetVideo($item);
                    $this->factorizeNewsWidgetFilms($item);
                }
            } else {
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
                        $this->factorizeNewsWidgetAudio($item);
                        $this->factorizeNewsWidgetVideo($item);
                        $this->factorizeNewsWidgetFilms($item);
                    }
                }
                $bar->finish();
                $output->writeln('');
            }
        }
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

    protected function factorizeNewsWidgetAudio(NewsArticle $news)
    {
        $first = array();
        foreach ($news->getWidgets() as $widget) {
            if ($widget instanceof NewsWidgetAudio) {
                if (!array_key_exists($widget->getOldImportReference(), $first)) {
                    $first[$widget->getOldImportReference()] = $widget;
                    continue;
                }
                $widget->setFile(null);
                $this->getManager()->remove($widget);
            }
        }
        $this->getManager()->flush();
    }

    protected function factorizeNewsWidgetVideo(NewsArticle $news)
    {
        $first = array();
        foreach ($news->getWidgets() as $widget) {
            if ($widget instanceof NewsWidgetVideo) {
                if (!array_key_exists($widget->getOldImportReference(), $first)) {
                    $first[$widget->getOldImportReference()] = $widget;
                    continue;
                }
                $widget->setFile(null);
                $this->getManager()->remove($widget);
            }
        }
        $this->getManager()->flush();
    }

    protected function factorizeNewsWidgetFilms(NewsArticle $news)
    {
        $done = array();
        foreach ($news->getAssociatedFilms() as $associatedFilm) {
            if ($associatedFilm instanceof NewsFilmFilmAssociated) {
                if (!$associatedFilm->getAssociation()) {
                    $news->removeAssociatedFilm($associatedFilm);
                    $this->getManager()->remove($associatedFilm);
                } else if (in_array($associatedFilm->getAssociation()->getId(), $done)) {
                    $news->removeAssociatedFilm($associatedFilm);
                    $associatedFilm->setAssociation(null);
                    $this->getManager()->remove($associatedFilm);
                } else {
                    $done[] = $associatedFilm->getAssociation()->getId();
                }
            }
        }
        $this->getManager()->flush();
    }

    protected function factorizeNewsAssociated(NewsArticle $news)
    {
        $done = array();
        foreach ($news->getAssociatedNews() as $associatedNews) {
            if ($associatedNews instanceof NewsNewsAssociated) {
                if (!$associatedNews->getAssociation()) {
                    $news->removeAssociatedNew($associatedNews);
                    $this->getManager()->remove($associatedNews);
                } else if (in_array($associatedNews->getAssociation()->getId(), $done)) {
                    $news->removeAssociatedNew($associatedNews);
                    $associatedNews->setAssociation(null);
                    $this->getManager()->remove($associatedNews);
                } else {
                    $done[] = $associatedNews->getAssociation()->getId();
                }
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

    protected function factorizeInfoWidgetAudio(InfoArticle $info)
    {
        $first = array();
        foreach ($info->getWidgets() as $widget) {
            if ($widget instanceof InfoWidgetAudio) {
                if (!array_key_exists($widget->getOldImportReference(), $first)) {
                    $first[$widget->getOldImportReference()] = $widget;
                    continue;
                }
                $widget->setFile(null);
                $this->getManager()->remove($widget);
            }
        }
        $this->getManager()->flush();
    }

    protected function factorizeInfoWidgetVideo(InfoArticle $info)
    {
        $first = array();
        foreach ($info->getWidgets() as $widget) {
            if ($widget instanceof InfoWidgetVideo) {
                if (!array_key_exists($widget->getOldImportReference(), $first)) {
                    $first[$widget->getOldImportReference()] = $widget;
                    continue;
                }
                $widget->setFile(null);
                $this->getManager()->remove($widget);
            }
        }
        $this->getManager()->flush();
    }

    protected function factorizeInfoWidgetFilms(InfoArticle $info)
    {
        $done = array();
        foreach ($info->getAssociatedFilms() as $associatedFilm) {
            if ($associatedFilm instanceof InfoFilmFilmAssociated) {
                if (!$associatedFilm->getAssociation()) {
                    $info->removeAssociatedFilm($associatedFilm);
                    $this->getManager()->remove($associatedFilm);
                } else if (in_array($associatedFilm->getAssociation()->getId(), $done)) {
                    $info->removeAssociatedFilm($associatedFilm);
                    $associatedFilm->setAssociation(null);
                    $this->getManager()->remove($associatedFilm);
                } else {
                    $done[] = $associatedFilm->getAssociation()->getId();
                }
            }
        }
        $this->getManager()->flush();
    }

    protected function factorizeInfoAssociated(InfoArticle $info)
    {
        $done = array();
        foreach ($info->getAssociatedInfo() as $associatedInfo) {
            if ($associatedInfo instanceof InfoInfoAssociated) {
                if (!$associatedInfo->getAssociation()) {
                    $info->removeAssociatedInfo($associatedInfo);
                    $this->getManager()->remove($associatedInfo);
                } else if (in_array($associatedInfo->getAssociation()->getId(), $done)) {
                    $info->removeAssociatedInfo($associatedInfo);
                    $associatedInfo->setAssociation(null);
                    $this->getManager()->remove($associatedInfo);
                } else {
                    $done[] = $associatedInfo->getAssociation()->getId();
                }
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

    /**
     * @param FDCPageLaSelectionCannesClassics $classics
     */
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
     * @param StatementArticle $statement
     */
    protected function factorizeStatementWidgetAudio(StatementArticle $statement)
    {
        $first = array();
        foreach ($statement->getWidgets() as $widget) {
            if ($widget instanceof StatementWidgetAudio) {
                if (!array_key_exists($widget->getOldImportReference(), $first)) {
                    $first[$widget->getOldImportReference()] = $widget;
                    continue;
                }
                $widget->setFile(null);
                $this->getManager()->remove($widget);
            }
        }
        $this->getManager()->flush();
    }

    /**
     * @param StatementArticle $statement
     */
    protected function factorizeStatementWidgetVideo(StatementArticle $statement)
    {
        $first = array();
        foreach ($statement->getWidgets() as $widget) {
            if ($widget instanceof StatementWidgetVideo) {
                if (!array_key_exists($widget->getOldImportReference(), $first)) {
                    $first[$widget->getOldImportReference()] = $widget;
                    continue;
                }
                $widget->setFile(null);
                $this->getManager()->remove($widget);
            }
        }
        $this->getManager()->flush();
    }

    protected function factorizeStatementWidgetFilms(StatementArticle $statement)
    {
        $done = array();
        foreach ($statement->getAssociatedFilms() as $associatedFilm) {
            if ($associatedFilm instanceof StatementFilmFilmAssociated) {
                if (!$associatedFilm->getAssociation()) {
                    $statement->removeAssociatedFilm($associatedFilm);
                    $this->getManager()->remove($associatedFilm);
                } else if (in_array($associatedFilm->getAssociation()->getId(), $done)) {
                    $statement->removeAssociatedFilm($associatedFilm);
                    $associatedFilm->setAssociation(null);
                    $this->getManager()->remove($associatedFilm);
                } else {
                    $done[] = $associatedFilm->getAssociation()->getId();
                }
            }
        }
        $this->getManager()->flush();
    }

    protected function factorizeStatementAssociated(StatementArticle $statement)
    {
        $done = array();
        foreach ($statement->getAssociatedStatement() as $associatedStatement) {
            if ($associatedStatement instanceof StatementStatementAssociated) {
                if (!$associatedStatement->getAssociation()) {
                    $statement->removeAssociatedStatement($associatedStatement);
                    $this->getManager()->remove($associatedStatement);
                } else if (in_array($associatedStatement->getAssociation()->getId(), $done)) {
                    $statement->removeAssociatedStatement($associatedStatement);
                    $associatedStatement->setAssociation(null);
                    $this->getManager()->remove($associatedStatement);
                } else {
                    $done[] = $associatedStatement->getAssociation()->getId();
                }
            }
        }
        $this->getManager()->flush();
    }


    /**
     * @param $page
     * @return NewsArticle[]
     */
    protected function getNews($page)
    {
        return $this
            ->getManager()
            ->getRepository('BaseCoreBundle:News')
            ->createQueryBuilder('n')
            ->distinct()
            ->andWhere('n.oldNewsId is not null')
            ->setFirstResult(($page - 1) * 50)
            ->setMaxResults(50)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @param null $page
     * @return int
     */
    protected function getNewsCount($page = null)
    {
        $qb = $this
            ->getManager()
            ->getRepository('BaseCoreBundle:NewsArticle')
            ->createQueryBuilder('n')
            ->select('count(n)')
            ->distinct()
            ->andWhere('n.oldNewsId is not null')
        ;

        if ($page) {
            return count($qb
                ->select('n')
                ->setFirstResult(($page - 1) * 50)
                ->setMaxResults(50)
                ->getQuery()
                ->getResult());

        }

        return (int)$qb
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
        return (int)$this
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
        return (int)$this
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
        return (int)$this
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