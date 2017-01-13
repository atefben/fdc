<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\SeoMain;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateMain;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Speakers
 * @ORM\Table(name="mdf_speakers")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class MdfSpeakers implements TranslateMainInterface
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
     * @var MdfTheme
     *
     * @ORM\ManyToOne(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfTheme")
     */
    private $theme;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="FDC\MarcheDuFilmBundle\Entity\MdfSpeakersChoicesCollection", mappedBy="speakersPage", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $speakersChoicesCollections;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->speakersChoicesCollections = new ArrayCollection();
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

    public function getSubTitle()
    {
        $translation = $this->findTranslationByLocale('fr');
        $string = '';

        if ($translation !== null) {
            $string = $translation->getSubTitle();
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
     * Add speakersChoicesCollection
     *
     * @param \FDC\MarcheDuFilmBundle\Entity\MdfSpeakersChoicesCollection $speakersChoicesCollection
     * @return Service
     */
    public function addSpeakersChoicesCollection(\FDC\MarcheDuFilmBundle\Entity\MdfSpeakersChoicesCollection $speakersChoicesCollection)
    {
        $speakersChoicesCollection->setSpeakersPage($this);
        $this->speakersChoicesCollections[] = $speakersChoicesCollection;

        return $this;
    }

    /**
     * Remove speakersChoicesCollection
     *
     * @param \FDC\MarcheDuFilmBundle\Entity\MdfSpeakersChoicesCollection $speakersChoicesCollection
     */
    public function removeSpeakersChoicesCollection(\FDC\MarcheDuFilmBundle\Entity\MdfSpeakersChoicesCollection $speakersChoicesCollection)
    {
        $this->speakersChoicesCollections->removeElement($speakersChoicesCollection);
    }

    /**
     * Get speakersChoicesCollection
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSpeakersChoicesCollections()
    {
        return $this->speakersChoicesCollections;
    }

    /**
     * Set theme
     *
     * @param \FDC\MarcheDuFilmBundle\Entity\MdfTheme $theme
     * @return MdfTheme
     */
    public function setTheme(\FDC\MarcheDuFilmBundle\Entity\MdfTheme $theme = null)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return \FDC\MarcheDuFilmBundle\Entity\MdfTheme
     */
    public function getTheme()
    {
        return $this->theme;
    }
}