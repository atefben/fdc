<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * MdfConferencePartnerTab
 * @ORM\Table(name="mdf_conference_partner_tab")
 * @ORM\Entity
 */
class MdfConferencePartnerTab
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
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $position;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfConferencePartnerLogoCollection", mappedBy="conferencePartnerTab", cascade={"persist", "remove"},orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $partnerLogoCollection;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfConferencePartnerTabCollection", cascade={"persist", "remove"}, orphanRemoval=true, mappedBy="conferencePartnerTab",)
     */
    protected $conferencePartnerTabCollection;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * MdfConferencePartnerTab constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->partnerLogoCollection = new ArrayCollection();
        $this->conferencePartnerTabCollection = new ArrayCollection();
    }

    /**
     * @param MdfConferencePartnerLogoCollection $item
     *
     * @return $this
     */
    public function addPartnerLogoCollection(\FDC\MarcheDuFilmBundle\Entity\MdfConferencePartnerLogoCollection $item)
    {
        $item->setConferencePartnerTab($this);
        $this->partnerLogoCollection[] = $item;

        return $this;
    }

    /**
     * @param MdfConferencePartnerLogoCollection $item
     */
    public function removePartnerLogoCollection(\FDC\MarcheDuFilmBundle\Entity\MdfConferencePartnerLogoCollection $item)
    {
        $this->partnerLogoCollection->removeElement($item);
    }

    /**
     * @return ArrayCollection
     */
    public function getPartnerLogoCollection()
    {
        return $this->partnerLogoCollection;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return ArrayCollection
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * @param $translations
     *
     * @return $this
     */
    public function setTranslations($translations)
    {
        $this->translations = $translations;

        return $this;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param $position
     *
     * @return $this
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    public function __toString()
    {
        $translation = $this->findTranslationByLocale('fr');

        if ($translation !== null) {
            $string = $translation->getTitle();
        } else {
            $string = strval($this->getId());
        }
        return (string) $string;
    }

    public function getTitle()
    {
        $translation = $this->findTranslationByLocale('fr');
        $string = '';

        if ($translation !== null) {
            $string = $translation->getTitle();
        }

        return $string;
    }

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
     * @param MdfConferencePartnerTabCollection $conferencePartnerTabCollection
     * @return $this
     */
    public function addConferencePartnerTabCollection(\FDC\MarcheDuFilmBundle\Entity\MdfConferencePartnerTabCollection $conferencePartnerTabCollection)
    {
        $conferencePartnerTabCollection->setConferencePartnerTab($this);
        $this->conferencePartnerTabCollection[] = $conferencePartnerTabCollection;

        return $this;
    }

    /**
     * @param MdfConferencePartnerTabCollection $conferencePartnerTabCollection
     */
    public function removeConferencePartnerTabCollection(\FDC\MarcheDuFilmBundle\Entity\MdfConferencePartnerTabCollection $conferencePartnerTabCollection)
    {
        $this->conferencePartnerTabCollection->removeElement($conferencePartnerTabCollection);
    }

    /**
     * @return ArrayCollection
     */
    public function getConferencePartnerTabCollection()
    {
        return $this->conferencePartnerTabCollection;
    }
}
