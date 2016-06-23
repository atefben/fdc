<?php

namespace Base\AdminBundle\Command;

use Base\CoreBundle\Entity\MediaPdf;
use Base\CoreBundle\Entity\MediaPdfTranslation;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportPdfToNewSystemCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('admin:import_pdf')
            ->setDescription('Import pdf to the new system (Media Pdf)')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $fdcPagePrepare = $this->getDoctrineManager()->getRepository('BaseCoreBundle:FDCPagePrepare')->findAll();
        $settings = $this->getDoctrineManager()->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            die('Festival year settings not set'."\r\n");
        }

        foreach ($fdcPagePrepare as $entity) {
            if ($entity->getMeetingFile() && $entity->getMeetingPdf() == null) {
                $mediaPdf = new MediaPdf();
                $mediaPdf->setFestival($settings->getFestival());
                $mediaPdfTranslation = new MediaPdfTranslation();
                $mediaPdfTranslation->setLocale('fr');
                $mediaPdfTranslation->setFile($entity->getMeetingFile());
                $mediaPdf->addTranslation($mediaPdfTranslation);
                $entity->setMeetingPdf($mediaPdf);
            }

            if (count($entity->getInformationWidgets()) > 0) {
                foreach ($entity->getInformationWidgets() as $widget) {
                    if (strpos(get_class($widget), 'FDCPagePrepareWidgetColumn') !== false && $widget->getFile()) {
                        $mediaPdf = new MediaPdf();
                        $mediaPdf->setFestival($settings->getFestival());
                        $mediaPdfTranslation = new MediaPdfTranslation();
                        $mediaPdfTranslation->setLocale('fr');
                        $mediaPdfTranslation->setFile($widget->getFile());
                        $mediaPdf->addTranslation($mediaPdfTranslation);
                       $widget->setPdf($mediaPdf);
                    }
                }
            }
        }

        $pressAccreditProcedure = $this->getDoctrineManager()->getRepository('BaseCoreBundle:PressAccreditProcedure')->findAll();

        foreach ($pressAccreditProcedure as $entity) {
            if ($entity->getPdf() == null) {
                $mediaPdf = new MediaPdf();
                $mediaPdf->setFestival($settings->getFestival());
                if ($entity->getProcedureFile() != null) {
                    $mediaPdfTranslation = new MediaPdfTranslation();
                    $mediaPdfTranslation->setLocale('fr');
                    $mediaPdfTranslation->setFile($entity->getProcedureFile());
                    $mediaPdf->addTranslation($mediaPdfTranslation);
                    $entity->setPdf($mediaPdf);
                }

                if ($entity->getProcedureFile() != null) {
                    $mediaPdfTranslation = new MediaPdfTranslation();
                    $mediaPdfTranslation->setLocale('en');
                    $mediaPdfTranslation->setFile($entity->getProcedureSecondFile());
                    $mediaPdf->addTranslation($mediaPdfTranslation);
                    $entity->setPdf($mediaPdf);
                }
            }
        }

        $this->getDoctrineManager()->flush();
    }

    /**
     * @return ObjectManager
     */
    public function getDoctrineManager()
    {
        return $this->getContainer()->get('doctrine')->getManager();
    }

}