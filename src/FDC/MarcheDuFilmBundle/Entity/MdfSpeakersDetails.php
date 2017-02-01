<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use FDC\MarcheDuFilmBundle\Entity\MediaMdfImage;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\SecurityExtraBundle\Tests\Fixtures\A;

/**
 * MdfSpeakersDetails
 *
 * @ORM\Table(name="mdf_speakers_details")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class MdfSpeakersDetails
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
     * @var MediaMdfImage
     * @ORM\ManyToOne(targetEntity="FDC\MarcheDuFilmBundle\Entity\MediaMdfImage", inversedBy="speakersDetails")
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
     * @var
     * @ORM\OneToMany(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfSpeakersDetailsCollection", mappedBy="speakersDetails")
     */
    protected $speakersDetailsCollection;

    /**
     * @var ArrayCollection
     *
     */
    protected $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->speakersDetailsCollection = new ArrayCollection();
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
     * @return MediaMdf
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param MediaMdf $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @param MdfSpeakersDetailsCollection $speakersDetailsCollection
     * @return $this
     */
    public function addSpeakersDetailsCollection(\FDC\MarcheDuFilmBundle\Entity\MdfSpeakersDetailsCollection $speakersDetailsCollection)
    {
        $speakersDetailsCollection->setSpeakersChoiceTab($this);
        $this->speakersDetailsCollection[] = $speakersDetailsCollection;

        return $this;
    }

    /**
     * @param MdfSpeakersDetailsCollection $speakersDetailsCollection
     */
    public function removeSpeakersDetailsCollection(\FDC\MarcheDuFilmBundle\Entity\MdfSpeakersDetailsCollection $speakersDetailsCollection)
    {
        $this->speakersDetailsCollection->removeElement($speakersDetailsCollection);
    }

    /**
     * @return ArrayCollection
     */
    public function getSpeakersDetailsCollection()
    {
        return $this->speakersDetailsCollection;
    }
}
