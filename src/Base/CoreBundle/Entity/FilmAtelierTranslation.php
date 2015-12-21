<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateChild;

use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

/**
 * FilmAtelierTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmAtelierTranslation implements TranslateChildInterface
{
    use Time;
    use Translation;
    use TranslateChild;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     *
     * @Groups({"film_atelier_list", "film_atelier_show"})
     */
    private $title;
    
    /**
     * @var text
     *
     * @ORM\Column(type="text", nullable=true)
     *
     * @Groups({"film_atelier_list", "film_atelier_show"})
     */
    private $synopsis;
    
    /**
     * @var text
     *
     * @ORM\Column(type="text", nullable=true)
     *
     * @Groups({"film_atelier_list", "film_atelier_show"})
     */
    private $applicantNote;

    public function __construct()
    {
        $this->status = self::STATUS_PUBLISHED;
    }

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
