<?php

namespace FDC\CorporateBundle\Controller;

use Base\CoreBundle\Entity\CorpoWhoAreWe;
use Base\CoreBundle\Entity\GraphicalCharterButtonFile;
use Base\CoreBundle\Entity\GraphicalCharterButtonFileCollection;
use Base\CoreBundle\Entity\GraphicalCharterButtonFileTranslation;
use Base\CoreBundle\Entity\GraphicalCharterButtonGroup;
use Base\CoreBundle\Entity\GraphicalCharterButtonGroupSectionCollection;
use Base\CoreBundle\Entity\GraphicalCharterButtonSection;
use Base\CoreBundle\Entity\GraphicalCharterButtonSectionTranslation;
use Base\CoreBundle\Entity\GraphicalCharterSectionTranslation;
use Base\CoreBundle\Entity\GraphicalCharterSectionWidgetOneColumn;
use Base\CoreBundle\Entity\GraphicalCharterSectionWidgetOneColumnTranslation;
use Base\CoreBundle\Entity\GraphicalCharterSectionWidgetText;
use Base\CoreBundle\Entity\GraphicalCharterSectionWidgetTextTranslation;
use Base\CoreBundle\Entity\GraphicalCharterSectionWidgetThreeColumns;
use Base\CoreBundle\Entity\GraphicalCharterSectionWidgetThreeColumnsTranslation;
use Base\CoreBundle\Entity\GraphicalCharterSectionWidgetTwoColumns;
use Base\CoreBundle\Entity\GraphicalCharterSectionWidgetTwoColumnsTranslation;
use FDC\EventBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/qui-sommes-nous")
 */
class WhoAreWeController extends Controller
{

    /**
     * @Route("/equipe")
     * @param Request $request
     * @return Response
     */
    public function equipeAction(Request $request)
    {
        $equipes = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:CorpoTeam')
            ->findOneById(1)
        ;

        if (!$equipes) {
            throw $this->createNotFoundException('There is not available Team.');
        }

        if ($equipes->findTranslationByLocale('fr')->getStatus() == 1) {
            return $this->render('FDCCorporateBundle:WhoAreWe:equipe.html.twig', [
                'datas' => $equipes,
            ]);
        } else {
            throw $this->createNotFoundException('There is not available Team.');
        }

    }

    /**
     * @Route("/charte-graphique")
     * @param Request $request
     * @return Response
     */
    public function graphicalCharterAction(Request $request)
    {
        $locale = $request->getLocale();

        $graphicalCharter = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:GraphicalCharter')
            ->getPage($locale)
        ;

        $corpoTeam = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:CorpoTeam')
            ->findOneById(1)
        ;

        if (!$graphicalCharter) {
            throw $this->createNotFoundException('There is not available Team.');
        }

        if ($graphicalCharter->findTranslationByLocale('fr')->getStatus() == 1) {
            return $this->render('FDCCorporateBundle:WhoAreWe:graphical-charter.html.twig', [
                'graphicalCharter' => $graphicalCharter,
                'sections'         => $this->getSections($locale),
                'corpoTeam'         => $corpoTeam,
            ]);
        } else {
            throw $this->createNotFoundException('There is not available Team.');
        }
    }

    /**
     * @param $locale
     * @return array
     */
    private function getSections($locale)
    {
        $sections = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:GraphicalCharterSection')
            ->getAvailables($locale)
        ;

        $items = [];
        foreach ($sections as $section) {
            $item = [];

            $sectionTrans = $this->getTranslation($section, $locale);
            if ($sectionTrans instanceof GraphicalCharterSectionTranslation) {
                $item['name'] = $sectionTrans->getName();
            }

            $item['widgets'] = [];
            foreach ($section->getGraphicalCharterSectionsWidgets() as $widget) {
                $widgetTrans = $this->getTranslation($widget, $locale);
                $itemWidget = [];

                if ($widget instanceof GraphicalCharterSectionWidgetText) {
                    $itemWidget['type'] = 'text';

                    if ($widgetTrans instanceof GraphicalCharterSectionWidgetTextTranslation) {
                        $itemWidget['text'] = $widgetTrans->getText();
                    }
                } elseif ($widget instanceof GraphicalCharterSectionWidgetOneColumn) {
                    $itemWidget['type'] = 'one-column';
                    if ($widget->getImage()) {
                        $itemWidget['image'] = $widget->getImage();
                    }
                    if ($widgetTrans instanceof GraphicalCharterSectionWidgetOneColumnTranslation) {
                        $itemWidget['title'] = $widgetTrans->getTitle();
                        $itemWidget['legend'] = $widgetTrans->getLegend();
                        $itemWidget['subLegend'] = $widgetTrans->getSubLegend();
                        $itemWidget['technicalConstraints'] = $widgetTrans->getTechnicalConstraints();
                        $itemWidget['technicalConstraintsPopupActive'] = $widgetTrans->getIsTechnicalConstraintsPopupActive();
                    }

                    if ($widget->getGraphicalCharterButtonGroup()) {
                        $itemWidget['buttonGroup'] = $this->getButtonGroup($widget->getGraphicalCharterButtonGroup(), $locale);
                    }
                } elseif ($widget instanceof GraphicalCharterSectionWidgetTwoColumns) {
                    $itemWidget['type'] = 'two-columns';
                    if ($widget->getImage()) {
                        $itemWidget['image'][] = $widget->getImage();
                    }
                    if ($widget->getImage2()) {
                        $itemWidget['image2'][] = $widget->getImage2();
                    }
                    if ($widgetTrans instanceof GraphicalCharterSectionWidgetTwoColumnsTranslation) {
                        $itemWidget['title'] = $widgetTrans->getTitle();
                        $itemWidget['title2'] = $widgetTrans->getTitle2();
                        $itemWidget['legend'] = $widgetTrans->getLegend();
                        $itemWidget['legend2'] = $widgetTrans->getLegend2();
//                        $itemWidget['subLegend'] = $widgetTrans->getSubLegend();
                        $itemWidget['technicalConstraints2'] = $widgetTrans->getTechnicalConstraints2();
                        $itemWidget['technicalConstraintsPopupActive2'] = $widgetTrans->getIsTechnicalConstraintsPopupActive2();
                    }
                    if ($widget->getGraphicalCharterButtonGroup()) {
                        $itemWidget['buttonGroup'] = $this->getButtonGroup($widget->getGraphicalCharterButtonGroup(), $locale);
                    }
                    if ($widget->getGraphicalCharterButtonGroup2()) {
                        $itemWidget['buttonGroup2'] = $this->getButtonGroup($widget->getGraphicalCharterButtonGroup2(), $locale);
                    }
                } elseif ($widget instanceof GraphicalCharterSectionWidgetThreeColumns) {
                    $itemWidget['type'] = 'three-columns';
                    if ($widget->getImage()) {
                        $itemWidget['image'][] = $widget->getImage();
                    }
                    if ($widget->getImage2()) {
                        $itemWidget['image2'][] = $widget->getImage2();
                    }
                    if ($widget->getImage3()) {
                        $itemWidget['image3'][] = $widget->getImage3();
                    }
                    if ($widgetTrans instanceof GraphicalCharterSectionWidgetThreeColumnsTranslation) {
                        $itemWidget['title'] = $widgetTrans->getTitle();
                        $itemWidget['title2'] = $widgetTrans->getTitle2();
                        $itemWidget['title3'] = $widgetTrans->getTitle3();
                        $itemWidget['legend'] = $widgetTrans->getLegend();
                        $itemWidget['legend2'] = $widgetTrans->getLegend2();
                        $itemWidget['legend3'] = $widgetTrans->getLegend3();
//                        $itemWidget['subLegend'] = $widgetTrans->getSubLegend();
                        $itemWidget['technicalConstraints'] = $widgetTrans->getTechnicalConstraints();
                        $itemWidget['technicalConstraints2'] = $widgetTrans->getTechnicalConstraints2();
                        $itemWidget['technicalConstraints3'] = $widgetTrans->getTechnicalConstraints3();
                        $itemWidget['technicalConstraintsPopupActive'] = $widgetTrans->getIsTechnicalConstraintsPopupActive();
                        $itemWidget['technicalConstraintsPopupActive2'] = $widgetTrans->getIsTechnicalConstraintsPopupActive2();
                        $itemWidget['technicalConstraintsPopupActive3'] = $widgetTrans->getIsTechnicalConstraintsPopupActive3();
                    }
                    if ($widget->getGraphicalCharterButtonGroup()) {
                        $itemWidget['buttonGroup'] = $this->getButtonGroup($widget->getGraphicalCharterButtonGroup(), $locale);
                    }
                    if ($widget->getGraphicalCharterButtonGroup2()) {
                        $itemWidget['buttonGroup2'] = $this->getButtonGroup($widget->getGraphicalCharterButtonGroup2(), $locale);
                    }
                    if ($widget->getGraphicalCharterButtonGroup3()) {
                        $itemWidget['buttonGroup3'] = $this->getButtonGroup($widget->getGraphicalCharterButtonGroup3(), $locale);
                    }
                }
                if ($itemWidget) {
                    $item['widgets'][] = $itemWidget;
                }
            }
            if ($item) {
                $items[] = $item;
            }
        }

        return $items;
    }

    private function getButtonGroup(GraphicalCharterButtonGroup $group, $locale)
    {
        $buttonGroup = [];

        foreach ($group->getGraphicalCharterButtonGroupSectionCollection() as $collection) {
            if ($collection instanceof GraphicalCharterButtonGroupSectionCollection) {
                $section = $collection->getGraphicalCharterButtonSection();
                if ($section instanceof GraphicalCharterButtonSection) {
                    $buttonGroupSection = [];
                    $sectionTrans = $this->getTranslation($section, $locale);
                    if ($sectionTrans instanceof GraphicalCharterButtonSectionTranslation) {
                        $buttonGroupSection['title'] = $sectionTrans->getButtonsSectionTitle();
                    }
                    $buttonGroupSection['files'] = [];
                    foreach ($section->getGraphicalCharterButtonFileCollection() as $fileCollection) {
                        if ($fileCollection instanceof GraphicalCharterButtonFileCollection) {
                            $buttonFile = $fileCollection->getGraphicalCharterButtonFile();
                            if ($buttonFile instanceof GraphicalCharterButtonFile) {
                                $button = [];
                                $buttonFileTrans = $this->getTranslation($buttonFile, $locale);
                                if ($buttonFileTrans instanceof GraphicalCharterButtonFileTranslation) {
                                    $button['title'] = $buttonFileTrans->getFileTitle();
                                    $button['file'] = $buttonFileTrans->getFile();
                                }
                                $buttonGroupSection['files'][] = $button;
                            }
                        }
                    }
                    $buttonGroup[] = $buttonGroupSection;
                }
            }
        }

        return $buttonGroup;
    }

    /**
     * @Route("/nav")
     * @param Request $request
     * @param null $slug
     * @return Response
     */
    public function navAction(Request $request, $slug = null)
    {
        $locale = $request->getLocale();
        $nav = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:CorpoWhoAreWe')
            ->findBy([], ['weight' => 'asc'])
        ;

        $pages = [];
        foreach ($nav as $n) {
            if ($n->findTranslationByLocale('fr')->getStatus() == 1) {
                $pages[] = $n;
            }
        }

        $graphicalCharter = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:GraphicalCharter')
            ->getPage($locale)
        ;

        return $this->render('FDCCorporateBundle:WhoAreWe:nav.html.twig', [
            'pages' => $pages,
            'slug'  => $slug,
            'graphicalCharter'  => $graphicalCharter,
        ]);
    }

    /**
     * @Route("/{slug}")
     * @param Request $request
     * @return Response
     */
    public function showAction(Request $request, $slug = null)
    {
        $locale = $request->getLocale();

        $pages = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:CorpoWhoAreWe')
            ->findAll()
        ;
        if ($slug === null) {
            foreach ($pages as $page) {
                if ($page instanceof CorpoWhoAreWe) {
                    if ($page->findTranslationByLocale($locale)) {
                        $slug = $page->findTranslationByLocale($locale)->getSlug();
                    }
                    if ($slug) {
                        return $this->redirectToRoute('fdc_corporate_whoarewe_show', ['slug' => $slug]);
                    }
                }
            }
            throw $this->createNotFoundException('There is not available selection.');
        }

        $page = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:CorpoWhoAreWe')
            ->getPageBySlug($locale, $slug)
        ;

        return $this->render('FDCCorporateBundle:WhoAreWe:index.html.twig', [
            'pages'       => $pages,
            'currentPage' => $page
        ]);
    }

}


