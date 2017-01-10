<?php

namespace Base\CoreBundle\Command;

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
        $widgets = $this->getWidgetsImage();
        $progress = new ProgressBar($output, count($widgets));
        $progress->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
        $progress->start();
        foreach ($widgets as $widget) {
            $progress->advance();
            if ($widget->getGallery()) {
                $translation = $this->getOldArticleI18nById($widget->getNews()->getOldNewsId());
                if ($translation->getMosaiqueTitle()) {
                    $widget->getGallery()->setName($translation->getMosaiqueTitle());
                } else {
                    $id = $widget->getNews()->getId();
                    if ($widget->getNews()->findTranslationByLocale('fr')) {
                        $title = $widget->getNews()->findTranslationByLocale('fr')->getTitle();
                    }
                    else if ($widget->getNews()->findTranslationByLocale('en')) {
                        $title = $widget->getNews()->findTranslationByLocale('en')->getTitle();
                    }
                    else {
                        $title = $widget->getNews()->getTranslations()[0]->getTitle();
                    }
                    $widget->getGallery()->setName("Gallerie - {$title} - $id");
                }
                $this->getManager()->flush();
            }
        }
        $progress->finish();
        $output->writeln('');
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
    private function getWidgetsImage()
    {
        return $this
            ->getManager()
            ->getRepository('BaseCoreBundle:NewsWidgetImage')
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