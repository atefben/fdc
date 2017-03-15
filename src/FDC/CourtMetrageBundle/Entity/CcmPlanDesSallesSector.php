<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CcmPlanDesSallesSector
 * @ORM\Table(name="ccm_plan_des_salles_sector")
 * @ORM\Entity()
 */
class CcmPlanDesSallesSector
{
    use Translatable;

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var CcmMediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMediaImageSimple")
     */
    protected $festivalZone;

    /**
     * @var CcmMediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMediaImageSimple")
     */
    protected $detailedPlan;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * @var CcmPlanDesSalles
     *
     * @ORM\OneToMany(targetEntity="FDC\CourtMetrageBundle\Entity\CcmPlanDesSallesSectorCollection", cascade={"persist", "remove"}, orphanRemoval=true, mappedBy="sector")
     */
    protected $planDesSallesCollection;

    /**
     * CcmPlanDesSallesSector constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->planDesSallesCollection = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getTitle();
    }
    
    public function getTitle()
    {
        /** @var CcmPlanDesSallesSectorTranslation $translation */
        $translation = $this->findTranslationByLocale('fr');

        if ($translation !== null) {
            $string = $translation->getTitle();
        } else {
            $string = strval($this->getId());
        }

        return (string) $string;
    }

    /**
     * findTranslationByLocale function.
     *
     * @access public
     * @param mixed $locale
     * @return array
     */
    public function findTranslationByLocale($locale)
    {
        foreach ($this->getTranslations() as $translation) {
            if ($translation->getLocale() == $locale) {
                return $translation;
            }
        }

        return null;
    }
    
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return CcmMediaImageSimple
     */
    public function getDetailedPlan()
    {
        return $this->detailedPlan;
    }

    /**
     * @param CcmMediaImageSimple $detailedPlan
     *
     * @return $this
     */
    public function setDetailedPlan($detailedPlan)
    {
        $this->detailedPlan = $detailedPlan;

        return $this;
    }

    /**
     * @return CcmMediaImageSimple
     */
    public function getFestivalZone()
    {
        return $this->festivalZone;
    }

    /**
     * @param CcmMediaImageSimple $festivalZone
     *
     * @return $this
     */
    public function setFestivalZone($festivalZone)
    {
        $this->festivalZone = $festivalZone;

        return $this;
    }

    /**
     * @param CcmPlanDesSallesSectorCollection $planDesSallesCollection
     * @return $this
     */
    public function addContactSubjectsCollection(CcmPlanDesSallesSectorCollection $planDesSallesCollection)
    {
        $planDesSallesCollection->setSector($this);
        $this->planDesSallesCollection[] = $planDesSallesCollection;

        return $this;
    }

    /**
     * @param CcmPlanDesSallesSectorCollection $planDesSallesCollection
     */
    public function removeContactSubjectsCollection(CcmPlanDesSallesSectorCollection $planDesSallesCollection)
    {
        $this->planDesSallesCollection->removeElement($planDesSallesCollection);
    }

    /**
     * @return ArrayCollection
     */
    public function getContactSubjectsCollection()
    {
        return $this->planDesSallesCollection;
    }
}
