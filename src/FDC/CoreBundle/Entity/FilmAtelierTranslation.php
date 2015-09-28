<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use FDC\CoreBundle\Util\Time;

/**
 * FilmAtelierTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmAtelierTranslation
{
    use Time;
    use Translation;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $title;
    
    /**
     * @var text
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $synopsis;
    
    /**
     * @var text
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $applicantNote;

    /**
     * Set title
     *
     * @param string $title
     * @return FilmAtelierTranslation
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
     * Set synopsis
     *
     * @param string $synopsis
     * @return FilmAtelierTranslation
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
     * Set applicantNote
     *
     * @param string $applicantNote
     * @return FilmAtelierTranslation
     */
    public function setApplicantNote($applicantNote)
    {
        $this->applicantNote = $applicantNote;

        return $this;
    }

    /**
     * Get applicantNote
     *
     * @return string 
     */
    public function getApplicantNote()
    {
        return $this->applicantNote;
    }
}
