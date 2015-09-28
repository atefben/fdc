<?php

namespace FDC\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

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
class FilmFilmTranslation
{
    use Time;
    use Translation;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Groups({"film_list"})
     */
    private $title;
    
    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     *
     * @Groups({"film_list", "film_show"})
     */
    private $dialog;
    
    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     *
     * @Groups({"film_list", "film_show"})
     */
    private $synopsis;
    
    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     *
     * @Groups({"film_list", "film_show"})
     */
    private $programSection;

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
}
