<?php

namespace Base\CoreBundle\Command;

use Base\CoreBundle\Entity\Gallery;
use Base\CoreBundle\Entity\GalleryMedia;
use Base\CoreBundle\Entity\NewsWidgetImage;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class OldFdcDatabaseImportWidgetImportCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this->setName('base:import:old_fdc_widgets_image');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $items = [
            'Event' => 'getEvents',
            'Classics' => 'getFDCPageLaSelectionCannesClassics',
            'Info' => 'getInfo',
            'Statement' => 'getStatement',
            'News' => 'getNews',
        ];
        $translations = [
            'Event' => 'Événement',
            'Classics' => 'Cannes classics',
            'Info' => 'Info',
            'Statement' => 'Communiqué',
            'News' => 'Actualité',
        ];

        foreach ($items as $item => $getter) {
            $output->writeln("<info>$getter</info>");
            $getAll = 'get' . $item . 'WidgetsImage';
            $widgets = $this->$getAll();
            if (!$widgets) {
                $output->writeln("<comment>No item for $item</comment>");
                continue;
            }
            $progress = new ProgressBar($output, count($widgets));
            $progress->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
            $progress->start();
            foreach ($widgets as $widget) {
                $progress->advance();
                if ($widget->getGallery()) {
                    $translation = $this->getOldArticleI18nById($widget->$getter()->getOldNewsId());
                    $this->removeDuplicateImageFromGallery($widget->getGallery());
                    if ($translation->getMosaiqueTitle()) {
                        $widget->getGallery()->setName($translation->getMosaiqueTitle());
                    } else {
                        $id = $widget->$getter()->getId();
                        $title = '';
                        if ($widget->$getter()->findTranslationByLocale('fr')) {
                            $title = $widget->$getter()->findTranslationByLocale('fr')->getTitle();
                        }
                        if (!$title  && $widget->$getter()->findTranslationByLocale('en')) {
                            $title = $widget->$getter()->findTranslationByLocale('en')->getTitle();
                        }
                        if (!$title && $widget->$getter()->findTranslationByLocale('es')) {
                            $title = $widget->$getter()->findTranslationByLocale('es')->getTitle();
                        }
                        if (!$title && $widget->$getter()->findTranslationByLocale('zh')) {
                            $title = $widget->$getter()->findTranslationByLocale('zh')->getTitle();
                        }
                        $itemTranslation = $translations[$item];
                        $prefix = '';
                        if ($widget->getGallery()->getMedias()->count() > 1) {
                            $prefix = 'Gallerie - ';
                        }
                        $widget->getGallery()->setName("$prefix{$title} - {$itemTranslation} - {$id}");
                    }

                    $this->getManager()->flush();
                }
            }
            $progress->finish();
            $output->writeln('');
        }
    }

    private function removeDuplicateImageFromGallery(Gallery $gallery)
    {
        $done = [];
        foreach ($gallery->getMedias() as $galleryMedia) {
            if ($galleryMedia instanceof GalleryMedia) {
                if (in_array($galleryMedia->getMedia()->getId(), $done)) {
                    $galleryMedia
                        ->setGallery(null)
                        ->setMedia(null)
                    ;
                    $this->getManager()->remove($galleryMedia);
                } else {
                    $done[] = $galleryMedia->getMedia()->getId();
                }
            }
        }
    }

    /**
     * @param $id
     * @return \Base\CoreBundle\Entity\OldArticleI18n
     */
    private function getOldArticleI18nById($id)
    {
        return $this
            ->getManager()
            ->getRepository('BaseCoreBundle:OldArticleI18n')
            ->findOneBy(['id' => $id, 'culture' => 'fr'])
            ;
    }

    /**
     * @return \Base\CoreBundle\Entity\NewsWidgetImage[]
     */
    private function getNewsWidgetsImage()
    {
        return $this
            ->getManager()
            ->getRepository('BaseCoreBundle:NewsWidgetImage')
            ->getOldItems()
            ;
    }

    /**
     * @return \Base\CoreBundle\Entity\InfoWidgetImage[]
     */
    private function getInfoWidgetsImage()
    {
        return $this
            ->getManager()
            ->getRepository('BaseCoreBundle:InfoWidgetImage')
            ->getOldItems()
            ;
    }

    /**
     * @return \Base\CoreBundle\Entity\StatementWidgetImage[]
     */
    private function getStatementWidgetsImage()
    {
        return $this
            ->getManager()
            ->getRepository('BaseCoreBundle:StatementWidgetImage')
            ->getOldItems()
            ;
    }

    /**
     * @return \Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidgetImage[]
     */
    private function getClassicsWidgetsImage()
    {
        return $this
            ->getManager()
            ->getRepository('BaseCoreBundle:FDCPageLaSelectionCannesClassicsWidgetImage')
            ->getOldItems()
            ;
    }

    /**
     * @return \Base\CoreBundle\Entity\EventWidgetImage[]
     */
    private function getEventWidgetsImage()
    {
        return $this
            ->getManager()
            ->getRepository('BaseCoreBundle:EventWidgetImage')
            ->getOldItems()
            ;
    }


    /**
     * @return \Doctrine\Common\Persistence\ObjectManager
     */
    private function getManager()
    {
        return $this
            ->getContainer()
            ->get('doctrine')
            ->getManager()
            ;
    }

}