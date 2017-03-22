<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Base\CoreBundle\Entity\FilmSelectionSection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmShortFilmCompetitionTab
 * @ORM\Table(name="ccm_short_film_competition_tab")
 * @ORM\Entity
 */
class CcmShortFilmCompetitionTab
{
    use Translatable;

    const TYPE_SELECTION = 'competition_selection';
    const TYPE_JURY = 'competition_jury';
    const TYPE_PALMARES = 'competition_palmares';

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
     * @var CcmMediaImage
     *
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMediaImage")
     *
     */
    protected $image;

    /**
     * @var FilmSelectionSection
     *
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\FilmSelectionSection")
     */
    protected $selectionSection;

    /**
     * @var FilmSelectionSection
     *
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\FilmJuryType")
     */
    protected $juryType;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $date;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * CcmShortFilmCompetitionTab constructor.
     */
    public function __construct()
    {
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
     * @return CcmMediaImage
     */
    public function getImage()
    {
        return $this->image;
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
     * @return FilmSelectionSection
     */
    public function getSelectionSection()
    {
        return $this->selectionSection;
    }

    /**
     * @param $selectionSection
     *
     * @return $this
     */
    public function setSelectionSection($selectionSection)
    {
        $this->selectionSection = $selectionSection;

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
     * @return FilmSelectionSection
     */
    public function getJuryType()
    {
        return $this->juryType;
    }

    /**
     * @param FilmSelectionSection $juryType
     */
    public function setJuryType($juryType)
    {
        $this->juryType = $juryType;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }
}
