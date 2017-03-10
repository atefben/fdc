<?php

namespace FDC\CourtMetrageBundle\Manager;

use FDC\CourtMetrageBundle\Entity\CcmFilmRegisterTranslation;
use FDC\CourtMetrageBundle\Entity\CcmLabelContentFilesWidget;
use FDC\CourtMetrageBundle\Entity\CcmLabelContentFilesWidgetCollection;
use FDC\CourtMetrageBundle\Entity\CcmLabelContentFilesWidgetTranslation;
use FDC\CourtMetrageBundle\Entity\CcmLabelFileCollection;
use FDC\CourtMetrageBundle\Entity\CcmLabelFileTranslation;
use FDC\CourtMetrageBundle\Entity\CcmLabelSectionContentOneColumnTranslation;
use FDC\CourtMetrageBundle\Entity\CcmLabelSectionContentTextTranslation;
use FDC\CourtMetrageBundle\Entity\CcmLabelSectionContentThreeColumnsTranslation;
use FDC\CourtMetrageBundle\Entity\CcmLabelSectionContentTwoColumnsTranslation;
use FDC\CourtMetrageBundle\Entity\CcmLabelSectionTranslation;
use FDC\CourtMetrageBundle\Entity\CcmLabelTranslation;
use FDC\CourtMetrageBundle\Entity\CcmModule;
use FDC\CourtMetrageBundle\Entity\CcmParticiperPageLayerTranslation;
use FDC\CourtMetrageBundle\Entity\CcmParticiperPageTranslation;
use FDC\CourtMetrageBundle\Entity\CcmRegisterProcedureTranslation;
use FDC\CourtMetrageBundle\Repository\CcmLabelSectionContentTextTranslationRepository;
use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\ORM\EntityManager;

class ParticipateManager
{
    protected $em;

    protected $requestStack;

    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;
    }

    public function getRegisterMoviePage()
    {
        return $this->em
            ->getRepository(CcmFilmRegisterTranslation::class)
            ->findOneBy([
                'locale' => $this->requestStack->getMasterRequest()->get('_locale')
            ]);
    }

    public function getRegisterProcedures($filmRegisterPage)
    {
        $procedures = $filmRegisterPage->getTranslatable()->getFilmRegisterProcedure();

        $registerProcedures = array();
        foreach ($procedures as $procedure) {
            $registerProcedure = $this->em
                ->getRepository(CcmRegisterProcedureTranslation::class)
                ->findProcedureByLocaleAndId($this->requestStack->getMasterRequest()->get('_locale'), $procedure->getProcedure()->getId());

            if ($registerProcedure->getStatus() == CcmRegisterProcedureTranslation::STATUS_PUBLISHED || $registerProcedure->getStatus() == CcmRegisterProcedureTranslation::STATUS_TRANSLATED) {
                $registerProcedures[] = $registerProcedure;
            }
        }

        return $registerProcedures;
    }

    public function getRegisterProcedure($slug)
    {
        return $this->em
            ->getRepository(CcmRegisterProcedureTranslation::class)
            ->findOneBy(array(
                'locale' => $this->requestStack->getMasterRequest()->get('_locale'),
                'slug' => $slug
            ));
    }

    public function getLabelPage()
    {
        return $this->em
            ->getRepository(CcmLabelTranslation::class)
            ->findOneBy([
                'locale' => $this->requestStack->getMasterRequest()->get('_locale')
            ]);
    }

    public function getLabelSections($labelPage)
    {
        $sections = $labelPage->getTranslatable()->getLabelSection();

        $labelSections = array();
        foreach ($sections as $section) {
            $labelSections[$section->getLabelSection()->getId()] = $this->em
                ->getRepository(CcmLabelSectionTranslation::class)
                ->getLabelSectionsBySectionIdAndLocale($section->getLabelSection()->getId(), $this->requestStack->getMasterRequest()->get('_locale'));

        }

        return $labelSections;
    }

    public function getLabelSectionsWidgets($labelPage)
    {
        $sections = $labelPage->getTranslatable()->getLabelSection();

        $labeSections = array();

        foreach ($sections as $section) {
            $labelSections[] = $section;
        }

        usort($labelSections, function ($a, $b) {
            return $a->getPosition() > $b->getPosition();
        });

        $labelSectionsWidgets = array();
        foreach ($labelSections as $section) {
            $textWidgets = $this->em
                ->getRepository(CcmLabelSectionContentTextTranslation::class)
                ->getLabelContentTextWidgetsByLocaleAndSectionId($this->requestStack->getMasterRequest()->get('_locale'), $section->getLabelSection()->getId());

            $oneColumnWidgets = $this->em
                ->getRepository(CcmLabelSectionContentOneColumnTranslation::class)
                ->getLabelContentOneColumnWidgetsByLocaleAndSectionId($this->requestStack->getMasterRequest()->get('_locale'), $section->getLabelSection()->getId());

            $twoColumnWidgets = $this->em
                ->getRepository(CcmLabelSectionContentTwoColumnsTranslation::class)
                ->getLabelContentTwoColumnWidgetsByLocaleAndSectionId($this->requestStack->getMasterRequest()->get('_locale'), $section->getLabelSection()->getId());

            $threeColumnWidgets = $this->em
                ->getRepository(CcmLabelSectionContentThreeColumnsTranslation::class)
                ->getLabelContentThreeColumnWidgetsByLocaleAndSectionId($this->requestStack->getMasterRequest()->get('_locale'), $section->getLabelSection()->getId());


            $widgets = array();
            $widgets = array_merge($widgets, $textWidgets, $oneColumnWidgets, $twoColumnWidgets, $threeColumnWidgets);

            usort($widgets, function ($a, $b) {
                return $a->getTranslatable()->getPosition() > $b->getTranslatable()->getPosition();
            });

            $labelSectionsWidgets[$section->getLabelSection()->getId()] = $widgets;
        }

        return $labelSectionsWidgets;
    }

    public function getParticipatePage($slug)
    {
        return $this->em->getRepository(CcmParticiperPageTranslation::class)
            ->getPageBySlugAndLocale($slug, $this->requestStack->getMasterRequest()->getLocale());
    }

    public function getPageLayers($page)
    {
        if ($page) {

            return $this->em->getRepository(CcmParticiperPageLayerTranslation::class)
                ->getByPageAndLocale($page->getSlug(), $this->requestStack->getMasterRequest()->getLocale());
        }

        return null;
    }

    public function getLayerModules($layers)
    {
        if ($layers) {
            $modulesCollection = [];
            $modules = [];

            foreach ($layers as $key => $layer) {
                $modulesCollection = $this->em->getRepository(CcmModule::class)
                    ->findBy(
                        array(
                            'pageLayer' => $layer->getTranslatable()->getId()
                        )
                    );

                if ($modulesCollection) {
                    $modules[$key] = $modulesCollection;
                }
            }

            return $modules;
        }

        return null;
    }

    public function hasPF($layers)
    {
        $hasPF = false;

        foreach ($layers as $modules) {
            if ($hasPF)
                break;
            foreach ($modules as $module) {
                if ($module->getType() == 'pf') {
                    $hasPF = true;
                    break;
                }
            }
        }

        return $hasPF;
    }

    public function getFilesSectionTabs($section)
    {
        if ($section) {
            $labelContentFilesWidgetCollectionRepo = $this->em->getRepository(CcmLabelContentFilesWidgetCollection::class);
            $labelContentFilesWidgetRepo = $this->em->getRepository(CcmLabelContentFilesWidgetTranslation::class);

            $labelContentFilesWidgetCollection = $labelContentFilesWidgetCollectionRepo
                ->findBy(
                    array(
                        'labelContentFiles' => $section->getId()
                    )
                );


            if ($labelContentFilesWidgetCollection) {
                $filesWidgets = [];
                foreach ($labelContentFilesWidgetCollection as $widget) {
                    $fileWidget = $labelContentFilesWidgetRepo
                        ->getFilesWidgetsByLocaleAndWidgetId(
                            $this->requestStack->getMasterRequest()->get('_locale'), $widget->getLabelContentFileWidget()
                        );

                    if ($fileWidget) {
                        $filesWidgets[] = $fileWidget;
                    }
                }
                return $filesWidgets;
            }
            return [];
        }
        return [];
    }

    public function getFilesList($widgets)
    {
        if ($widgets) {
            $filesList = [];
            $labelFileCollectionRepo = $this->em->getRepository(CcmLabelFileCollection::class);
            $labelFileRepo = $this->em->getRepository(CcmLabelFileTranslation::class);

            foreach ($widgets as $widget) {
                $translatableId = $widget->getTranslatable()->getId();
                $labelFileCollection = $labelFileCollectionRepo
                    ->findBy(
                        array(
                            'contentFilesWidget' => $translatableId
                        )
                    );

                if ($labelFileCollection) {
                    $filesList[$translatableId] = [];

                    foreach ($labelFileCollection as $item) {
                        $file = $labelFileRepo
                            ->getLabelFileByLocaleAndLabelFileId(
                                $this->requestStack->getMasterRequest()->get('_locale'),
                                $item->getLabelFile()
                            );

                        if ($file) {
                            $filesList[$translatableId][] = $file;
                        }
                    }
                }
            }
            return $filesList;
        }
        return [];
    }

    public function getFilesWidgetsList($labelSectionsWidgets)
    {
        $oneColumnTabs = array();
        $oneColumnFiles = array();

        $twoColumnsTabs = array();
        $twoColumnsFiles = array();

        $threeColumnsTabs = array();
        $threeColumnsFiles = array();
        foreach($labelSectionsWidgets as $sectionWidgets) {
            foreach ($sectionWidgets as $widget) {

                if ($widget->getTranslatable()->isWidgetOneColumn()) {
                    if($widget->getTranslatable()->getLabelContentFiles()){
                        $tabs = $this->getFilesSectionTabs($widget->getTranslatable()->getLabelContentFiles());
                        $files = $this->getFilesList($tabs);

                        $oneColumnTabs[$widget->getTranslatable()->getId()][1] = $tabs;
                        $oneColumnFiles = $oneColumnFiles + $files;
                    }
                }

                if ($widget->getTranslatable()->isWidgetTwoColumns()) {
                    if($widget->getTranslatable()->getLabelContentFiles()){
                        $tabs = $this->getFilesSectionTabs($widget->getTranslatable()->getLabelContentFiles());
                        $files = $this->getFilesList($tabs);

                        $twoColumnsTabs[$widget->getTranslatable()->getId()][1] = $tabs;
                        $twoColumnsFiles = $twoColumnsFiles + $files;
                    }

                    if($widget->getTranslatable()->getLabelContentFiles2()) {
                        $tabs = $this->getFilesSectionTabs($widget->getTranslatable()->getLabelContentFiles2());
                        $files = $this->getFilesList($tabs);

                        $twoColumnsTabs[$widget->getTranslatable()->getId()][2] = $tabs;
                        $twoColumnsFiles = $twoColumnsFiles + $files;

                    }
                }

                if ($widget->getTranslatable()->isWidgetThreeColumns()) {
                    if($widget->getTranslatable()->getLabelContentFiles()){
                        $tabs = $this->getFilesSectionTabs($widget->getTranslatable()->getLabelContentFiles());
                        $files = $this->getFilesList($tabs);

                        $threeColumnsTabs[$widget->getTranslatable()->getId()][1] = $tabs;
                        $threeColumnsFiles = $threeColumnsFiles + $files;
                    }

                    if($widget->getTranslatable()->getLabelContentFiles2()) {
                        $tabs = $this->getFilesSectionTabs($widget->getTranslatable()->getLabelContentFiles2());
                        $files = $this->getFilesList($tabs);

                        $threeColumnsTabs[$widget->getTranslatable()->getId()][2] = $tabs;
                        $threeColumnsFiles = $threeColumnsFiles + $files;
                    }

                    if($widget->getTranslatable()->getLabelContentFiles3()) {
                        $tabs = $this->getFilesSectionTabs($widget->getTranslatable()->getLabelContentFiles3());
                        $files = $this->getFilesList($tabs);

                        $threeColumnsTabs[$widget->getTranslatable()->getId()][3] = $tabs;
                        $threeColumnsFiles = $threeColumnsFiles + $files;
                    }
                }
            }
        }

        return array(
            'threeColumnsTabs' => $threeColumnsTabs,
            'threeColumnsFiles' => $threeColumnsFiles,
            'twoColumnsTabs' => $twoColumnsTabs,
            'twoColumnsFiles' => $twoColumnsFiles,
            'oneColumnTabs' => $oneColumnTabs,
            'oneColumnFiles' => $oneColumnFiles,
        );
    }
}
