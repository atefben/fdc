<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\SeoMain;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateMain;
use Doctrine\Common\Collections\ArrayCollection;
use Base\CoreBundle\Entity\MediaImageSimple;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmProsDetail
 * @ORM\Table(name="ccm_pros_detail")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmProsDetail implements TranslateMainInterface
{

    use Time;
    use SeoMain;
    use Translatable;
    use TranslateMain;

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaImageSimple")
     */
    protected $image;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isShortFilmCorner", type="boolean", nullable=true)
     */
    protected $isShortFilmCorner = false;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="FDC\CourtMetrageBundle\Entity\CcmProsActivityCollection", mappedBy="prosDetail", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $activitiesCollection;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="FDC\CourtMetrageBundle\Entity\CcmProsContactCollection", mappedBy="prosDetail", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $contactsCollection;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="FDC\CourtMetrageBundle\Entity\CcmProsDescription", mappedBy="prosDetail", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $description;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->activitiesCollection = new ArrayCollection();
        $this->contactsCollection = new ArrayCollection();
        $this->description = new ArrayCollection();
    }

    public function __toString()
    {
        $translation = $this->findTranslationByLocale('fr');

        if ($translation !== null) {
            $string = $translation->getName();
        } else {
            $string = strval($this->getId());
        }
        return (string) $string;
    }

    public function getName()
    {
        $translation = $this->findTranslationByLocale('fr');
        $string = '';

        if ($translation !== null) {
            $string = $translation->getName();
        }

        return $string;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param CcmProsActivityCollection $activityCollection
     * @return $this
     */
    public function addActivitiesCollection(\FDC\CourtMetrageBundle\Entity\CcmProsActivityCollection $activityCollection)
    {
        $activityCollection->setProsDetail($this);
        $this->activitiesCollection[] = $activityCollection;

        return $this;
    }

    /**
     * @param CcmProsActivityCollection $activityCollection
     */
    public function removeActivitiesCollection(\FDC\CourtMetrageBundle\Entity\CcmProsActivityCollection $activityCollection)
    {
        $this->activitiesCollection->removeElement($activityCollection);
    }

    /**
     * @return ArrayCollection
     */
    public function getActivitiesCollection()
    {
        return $this->activitiesCollection;
    }

    /**
     * @param CcmProsContactCollection $contactsCollection
     * @return $this
     */
    public function addContactsCollection(\FDC\CourtMetrageBundle\Entity\CcmProsContactCollection $contactsCollection)
    {
        $contactsCollection->setProsDetail($this);
        $this->contactsCollection[] = $contactsCollection;

        return $this;
    }

    /**
     * @param CcmProsContactCollection $contactsCollection
     */
    public function removeContactsCollection(\FDC\CourtMetrageBundle\Entity\CcmProsContactCollection $contactsCollection)
    {
        $this->contactsCollection->removeElement($contactsCollection);
    }

    /**
     * @return ArrayCollection
     */
    public function getContactsCollection()
    {
        return $this->contactsCollection;
    }

    /**
     * @return ArrayCollection
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * @param ArrayCollection $translations
     */
    public function setTranslations($translations)
    {
        $this->translations = $translations;
    }

    /**
     * @return MediaImageSimple
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param MediaImageSimple $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return boolean
     */
    public function isIsShortFilmCorner()
    {
        return $this->isShortFilmCorner;
    }

    /**
     * @param boolean $isShortFilmCorner
     */
    public function setIsShortFilmCorner($isShortFilmCorner)
    {
        $this->isShortFilmCorner = $isShortFilmCorner;
    }


    /**
     * @param CcmProsDescription $prosDescription
     * @return $this
     */
    public function addDescription(\FDC\CourtMetrageBundle\Entity\CcmProsDescription $prosDescription)
    {
        $prosDescription->setProsDetail($this);
        $this->description[] = $prosDescription;

        return $this;
    }

    /**
     * @param CcmProsDescription $prosDescription
     */
    public function removeDescription(\FDC\CourtMetrageBundle\Entity\CcmProsDescription $prosDescription)
    {
        $this->description->removeElement($prosDescription);
    }

    /**
     * @return ArrayCollection
     */
    public function getDescription()
    {
        return $this->description;
    }
}