<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Util\Time;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

/**
 * FilmSelectionSection
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\FilmSelectionSectionRepository")
 * @ORM\HasLifecycleCallbacks
 */
class FilmSelectionSection implements TranslateMainInterface, FilmSelectionSectionInterface
{
    use Time;
    use Translatable;
    use TranslateMain;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     * @ORM\Id
     *
     * @Groups({
     *     "film_show",
     *     "film_list",
     *     "film_selection_list",
     *     "film_selection_section_list",
     *     "film_selection_section_show",
     *     "news_list",
     *     "news_show",
     *     "home",
     *     "orange_studio"
     * })
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="integer", nullable=true)
     *
     * @Groups({
     *     "film_show",
     *     "film_list",
     *     "film_selection_list",
     *     "film_selection_section_list",
     *     "film_selection_section_show",
     *     "news_list",
     *     "news_show",
     *     "home",
     *     "orange_studio"
     * })
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FilmFestival")
     */
    private $festival;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FilmSelection", inversedBy="sections", cascade={"persist"})
     */
    private $selection;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="FilmFilm", mappedBy="selectionSection")
     * @Groups({
     *     "film_selection_section_show"
     * })
     */
    private $films;

    /**
     * @var ArrayCollection
     *
     * @Groups({
     *     "film_show",
     *     "film_list",
     *     "film_selection_list",
     *     "film_selection_section_list",
     *     "film_selection_section_show",
     *     "news_list",
     *     "news_show",
     *     "home",
     *     "orange_studio"
     * })
     */
    protected $translations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->films = new ArrayCollection();
    }

    /**
     * Set code
     *
     * @param string $code
     * @return FilmSelectionSection
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return FilmSelectionSection
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
     * Set festival
     *
     * @param \Base\CoreBundle\Entity\FilmFestival $festival
     * @return FilmSelectionSection
     */
    public function setFestival(\Base\CoreBundle\Entity\FilmFestival $festival = null)
    {
        $this->festival = $festival;

        return $this;
    }

    /**
     * Get festival
     *
     * @return \Base\CoreBundle\Entity\FilmFestival
     */
    public function getFestival()
    {
        return $this->festival;
    }

    /**
     * Set selection
     *
     * @param \Base\CoreBundle\Entity\FilmSelection $selection
     * @return FilmSelectionSection
     */
    public function setSelection(\Base\CoreBundle\Entity\FilmSelection $selection = null)
    {
        $this->selection = $selection;

        return $this;
    }

    /**
     * Get selection
     *
     * @return \Base\CoreBundle\Entity\FilmSelection
     */
    public function getSelection()
    {
        return $this->selection;
    }

    /**
     * Set id
     *
     * @param string $id
     * @return FilmSelectionSection
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return string 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add films
     *
     * @param \Base\CoreBundle\Entity\FilmFilm $films
     * @return FilmSelectionSection
     */
    public function addFilm(\Base\CoreBundle\Entity\FilmFilm $films)
    {
        $this->films[] = $films;

        return $this;
    }

    /**
     * Remove films
     *
     * @param \Base\CoreBundle\Entity\FilmFilm $films
     */
    public function removeFilm(\Base\CoreBundle\Entity\FilmFilm $films)
    {
        $this->films->removeElement($films);
    }

    /**
     * Get films
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFilms()
    {
        return $this->films;
    }

    /**
     * @param ArrayCollection $films
     * @return $this
     */
    public function setFilms(ArrayCollection $films)
    {
        $this->films = $films;

        return $this;
    }


    public function __toString()
    {
        if ($this->findTranslationByLocale('fr')) {
            return (string) $this->findTranslationByLocale('fr')->getName();
        }
    }
}
