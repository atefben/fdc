<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * MdfConferencePartner
 * @ORM\Table(name="mdf_conference_partner")
 * @ORM\Entity
 */
class MdfConferencePartner
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
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     */
    protected $type;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $isActive = false;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfConferencePartnerTabCollection", mappedBy="conferencePartner", cascade={"persist", "remove"},orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $partnerTabCollection;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * MdfConferencePartner constructor.
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    /**
     * @return boolean
     */
    public function isIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param $isActive
     *
     * @return $this
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @param MdfConferencePartnerTabCollection $item
     *
     * @return $this
     */
    public function addPartnerTabCollection(\FDC\MarcheDuFilmBundle\Entity\MdfConferencePartnerTabCollection $item)
    {
        $item->setConferencePartner($this);
        $this->partnerTabCollection[] = $item;

        return $this;
    }

    /**
     * @param MdfConferencePartnerTabCollection $item
     */
    public function removePartnerTabCollection(\FDC\MarcheDuFilmBundle\Entity\MdfConferencePartnerTabCollection $item)
    {
        $this->partnerTabCollection->removeElement($item);
    }

    /**
     * @return ArrayCollection
     */
    public function getPartnerTabCollection()
    {
        return $this->partnerTabCollection;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
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

    public function __toString()
    {
        $translation = $this->findTranslationByLocale('fr');

        if ($translation !== null) {
            $string = $translation->getSubTitle();
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
            $string = $translation->getSubTitle();
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
}
