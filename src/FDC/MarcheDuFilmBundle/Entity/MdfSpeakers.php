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

    const TYPE_PRODUCERS_WORKSHOP = 'producers-workshop';
    const TYPE_PRODUCERS_NETWORK = 'producers-network';
    const TYPE_DOC_CORNER = 'doc-corner';
    const TYPE_NEXT = 'next';
    const TYPE_MIXERS = 'mixers';
    const TYPE_GOES_TO_CANNES = 'goes-to-cannes';

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
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     */
    protected $type;

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
     * @param MdfSpeakersChoicesCollection $speakersChoicesCollection
     *
     * @return $this
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
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
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
}