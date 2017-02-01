<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\SeoMain;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Base\CoreBundle\Util\TranslateMain;

/**
 * MdfSpeakersChoices
 * @ORM\Table(name="mdf_speakers_choices")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class MdfSpeakersChoices
{
    use Time;
    use Translatable;
    use SeoMain;

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
     * @ORM\OneToMany(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfSpeakersDetailsCollection", mappedBy="speakersChoiceTab", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $speakersDetailsCollections;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfSpeakersChoicesCollection", mappedBy="speakersChoice")
     */
    protected $speakersChoicesCollection;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->speakersDetailsCollections = new ArrayCollection();
        $this->speakersChoicesCollection = new ArrayCollection();
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
     * Get id
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add speakersDetailsCollection
     *
     * @param \FDC\MarcheDuFilmBundle\Entity\MdfSpeakersDetailsCollection $speakersDetailsCollection
     * @return ServiceWidget
     */
    public function addSpeakersDetailsCollection(\FDC\MarcheDuFilmBundle\Entity\MdfSpeakersDetailsCollection $speakersDetailsCollection)
    {
        $speakersDetailsCollection->setSpeakersChoiceTab($this);
        $this->speakersDetailsCollections[] = $speakersDetailsCollection;

        return $this;
    }

    /**
     * Remove speakersDetailsCollection
     *
     * @param \FDC\MarcheDuFilmBundle\Entity\MdfSpeakersDetailsCollection $speakersDetailsCollection
     */
    public function removeSpeakersDetailsCollection(\FDC\MarcheDuFilmBundle\Entity\MdfSpeakersDetailsCollection $speakersDetailsCollection)
    {
        $this->speakersDetailsCollections->removeElement($speakersDetailsCollection);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSpeakersDetailsCollections()
    {
        return $this->speakersDetailsCollections;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return ServiceWidget
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param MdfSpeakersChoicesCollection $speakersChoicesCollection
     * @return $this
     * 
     */
    public function addSpeakersChoicesCollection(\FDC\MarcheDuFilmBundle\Entity\MdfSpeakersChoicesCollection $speakersChoicesCollection)
    {
        $speakersChoicesCollection->setSpeakersChoice($this);
        $this->speakersChoicesCollection[] = $speakersChoicesCollection;

        return $this;
    }

    /**
     * @param MdfSpeakersChoicesCollection $speakersChoicesCollection
     */
    public function removeSpeakersChoicesCollection(\FDC\MarcheDuFilmBundle\Entity\MdfSpeakersChoicesCollection $speakersChoicesCollection)
    {
        $this->speakersChoicesCollection->removeElement($speakersChoicesCollection);
    }

    /**
     * @return ArrayCollection
     */
    public function getSpeakersChoicesCollection()
    {
        return $this->speakersChoicesCollection;
    }
}
