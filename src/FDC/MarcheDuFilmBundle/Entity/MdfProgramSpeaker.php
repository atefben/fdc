<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\ORM\Mapping as ORM;

/**
 * MdfProgramSpeaker
 * @ORM\Table(name="mdf_program_speakers")
 * @ORM\Entity
 */
class MdfProgramSpeaker
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
     * @var MediaMdf
     * @ORM\ManyToOne(targetEntity="FDC\MarcheDuFilmBundle\Entity\MediaMdfImage", inversedBy="programSpeaker")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $image;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $position;

    /**
     * @ORM\OneToMany(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfProgramSpeakerCollection", cascade={"persist", "remove"}, orphanRemoval=true, mappedBy="programSpeakers")
     */
    protected $programSpeakerCollection;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    public function __construct() {
        $this->translations = new ArrayCollection();
        $this->programSpeakerCollection = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
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

    /**
     * @return MediaMdf
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param $image
     *
     * @return $this
     */
    public function setImage($image)
    {
        $this->image = $image;

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
            $string = $translation->getName();
        } else {
            $string = strval($this->getId());
        }

        if (!$string) {
            $string = $this->image->findTranslationByLocale('fr')->getLegend();
        }
        
        return (string) $string;
    }

    public function getName()
    {
        $translation = $this->findTranslationByLocale('fr');
        $string = '';

        if ($translation !== null) {
            $string = $translation->getName();
            if (!$string) {
                $string = $this->image->findTranslationByLocale('fr')->getLegend();
            }
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
     * @param MdfProgramSpeakerCollection $programSpeakerCollection
     * @return $this
     */
    public function addProgramSpeakerCollection(\FDC\MarcheDuFilmBundle\Entity\MdfProgramSpeakerCollection $programSpeakerCollection)
    {
        $programSpeakerCollection->setProgramSpeakers($this);
        $this->programSpeakerCollection[] = $programSpeakerCollection;

        return $this;
    }

    /**
     * @param MdfProgramSpeakerCollection $programSpeakerCollection
     */
    public function removeProgramSpeakerCollection(\FDC\MarcheDuFilmBundle\Entity\MdfProgramSpeakerCollection $programSpeakerCollection)
    {
        $this->programSpeakerCollection->removeElement($programSpeakerCollection);
    }

    /**
     * @return ArrayCollection
     */
    public function getProgramSpeakerCollection()
    {
        return $this->programSpeakerCollection;
    }
}
