<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * MdfConferenceInfoAndContact
 * @ORM\Table(name="mdf_conference_info_and_contact")
 * @ORM\Entity
 */
class MdfConferenceInfoAndContact
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
     * @ORM\OneToMany(targetEntity="MdfConferenceInfoAndContactWidget", mappedBy="conferenceInfoAndContact", cascade={"persist", "remove", "refresh"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $conferenceInfoAndContactWidgets;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $isActive = false;

    /**
     * HeaderFooter constructor.
     */
    public function __construct()
    {
        $this->conferenceInfoAndContactWidgets = new ArrayCollection();
        $this->translations = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
     * @return mixed
     */
    public function getConferenceInfoAndContactWidgets()
    {
        return $this->conferenceInfoAndContactWidgets;
    }

    /**
     * @param MdfConferenceInfoAndContactWidget $conferenceInfoAndContactWidget
     *
     * @return $this
     */
    public function addConferenceInfoAndContactWidget(MdfConferenceInfoAndContactWidget $conferenceInfoAndContactWidget)
    {
        if (!$this->conferenceInfoAndContactWidgets->contains($conferenceInfoAndContactWidget)) {
            $this->conferenceInfoAndContactWidgets->add($conferenceInfoAndContactWidget);
            $conferenceInfoAndContactWidget->setConferenceInfoAndContact($this);
        }

        return $this;
    }

    /**
     * @param MdfConferenceInfoAndContactWidget $conferenceInfoAndContactWidget
     *
     * @return $this
     */
    public function removeConferenceInfoAndContactWidget(MdfConferenceInfoAndContactWidget $conferenceInfoAndContactWidget)
    {
        if ($this->conferenceInfoAndContactWidgets->contains($conferenceInfoAndContactWidget)) {
            $this->conferenceInfoAndContactWidgets->removeElement($conferenceInfoAndContactWidget);
        }

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
}
