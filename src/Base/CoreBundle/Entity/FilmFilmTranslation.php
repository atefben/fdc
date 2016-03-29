<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Doctrine\ORM\Mapping as ORM;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateChild;

use Gedmo\Mapping\Annotation as Gedmo;

use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;

/**
 * FilmFilmTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmFilmTranslation implements TranslateChildInterface
{
    use Time;
    use Translation;
    use TranslateChild;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Groups({
     *     "trailer_list",
     *     "trailer_show",
     *     "film_list",
     *     "film_show",
     *     "news_list",
     *     "news_show",
     *     "projection_list",
     *     "film_selection_section_show",
     *     "home",
     *     "news_list"
     * })
     */
    private $title;
    
    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     *
     * @Groups({
     *     "trailer_list",
     *     "trailer_show",
     *     "film_list",
     *     "film_show",
     *     "projection_list",
     *     "film_selection_section_show"
     * })
     */
    private $dialog;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     *
     * @Groups({
     *     "trailer_list",
     *     "trailer_show",
     *     "film_list",
     *     "film_show",
     *     "projection_list",
     *     "film_selection_section_show"
     * })
     */
    private $synopsis;
    
    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     *
     * @Groups({
     *     "trailer_list",
     *     "trailer_show",
     *     "film_list",
     *     "film_show",
     *     "projection_list"
     * })
     */
    private $programSection;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"title"}, updatable=false)
     * @ORM\Column(name="slug", type="string", length=255, unique=false, nullable=false)
     */
    private $slug;

    public function __construct()
    {
        $this->status = self::STATUS_PUBLISHED;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return FilmFilmTranslation
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set dialog
     *
     * @param string $dialog
     * @return FilmFilmTranslation
     */
    public function setDialog($dialog)
    {
        $this->dialog = $dialog;

        return $this;
    }

    /**
     * Get dialog
     *
     * @return string 
     */
    public function getDialog()
    {
        return $this->dialog;
    }

    /**
     * Set synopsis
     *
     * @param string $synopsis
     * @return FilmFilmTranslation
     */
    public function setSynopsis($synopsis)
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    /**
     * Get synopsis
     *
     * @return string 
     */
    public function getSynopsis()
    {
        return $this->synopsis;
    }

    /**
     * Set programSection
     *
     * @param string $programSection
     * @return FilmFilmTranslation
     */
    public function setProgramSection($programSection)
    {
        $this->programSection = $programSection;

        return $this;
    }

    /**
     * Get programSection
     *
     * @return string 
     */
    public function getProgramSection()
    {
        return $this->programSection;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return FilmFilmTranslation
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
