<?php

namespace Base\CoreBundle\Twig\Extension;

use Base\CoreBundle\Entity\FDCPageAward;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Twig_Extension;

/**
 * Class PageAwardExtension
 * @package Base\CoreBundle\Twig\Extension
 */
class PageAwardExtension extends Twig_Extension
{

    /**
     * @var Registry
     */
    private $doctrine;

    /**
     * @param Registry $doctrine
     */
    public function setDoctrine(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager|object
     */
    public function getDoctrineManager()
    {
        return $this->doctrine->getManager();
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('page_award_is_available', array($this, 'pageAwardIsAvailable')),
        );
    }

    /**
     * @param FDCPageAward $page
     * @param $festival
     * @return bool
     */
    public function pageAwardIsAvailable(FDCPageAward $page, $festival)
    {
        $category = $page->getCategory();
        if ($page->getSelectionCourtsMetrages()) {
            $selectionSection = $page->getSelectionCourtsMetrages()->getId();
            $awards = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:FilmAwardAssociation')
                ->getByCategoryWithAward($festival, $category, $selectionSection)
            ;
            if ($awards) {
                return true;
            }
        }
        if ($page->getSelectionLongsMetrages()){
            $selectionSection = $page->getSelectionLongsMetrages()->getId();
            $awards = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:FilmAwardAssociation')
                ->getByCategoryWithAward($festival, $category, $selectionSection)
            ;
            if ($awards) {
                return true;
            }
        }
        foreach ($page->getOtherSelectionSectionsAssociated() as $section) {
            $selectionSection = $section->getId();
            $awards = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:FilmAwardAssociation')
                ->getByCategoryWithAward($festival, $category, $selectionSection)
            ;
            if ($awards) {
                return true;
            }
        }
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'page_award_extension';
    }
}