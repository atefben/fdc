<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\Soif;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

/**
 * FilmMedia
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FilmMedia
{
    use Time;
    use Soif;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=60)
     * @ORM\Id
     */
    private $id;
    
     /**
      * @var string
      *
      * @ORM\Column(type="string", length=255, nullable=true)
      * @Groups({
      *     "film_list",
      *     "film_show",
      *     "jury_list",
      *     "jury_show",
      *     "projection_list",
      *     "projection_show",
      *     "film_selection_section_show",
      *     "news_list",
      *     "award_list",
      *     "classics",
      *     "orange_studio"
      * })
      */
    private $contentType;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     * @Groups({
     *     "film_list",
     *     "film_show",
     *     "jury_list",
     *     "jury_show",
     *     "projection_list",
     *     "projection_show",
     *     "film_selection_section_show",
     *     "news_list",
     *     "award_list",
     *     "classics",
     *     "orange_studio"
     * })
     */
    private $noteVf;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     * @Groups({
     *     "film_list",
     *     "film_show",
     *     "jury_list",
     *     "jury_show",
     *     "projection_list",
     *     "projection_show",
     *     "film_selection_section_show",
     *     "news_list",
     *     "award_list",
     *     "classics",
     *     "orange_studio"
     * })
     */
    private $noteVa;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=80, nullable=true)
     * @Groups({
     *     "film_list",
     *     "film_show",
     *     "jury_list",
     *     "jury_show",
     *     "projection_list",
     *     "projection_show",
     *     "film_selection_section_show",
     *     "news_list",
     *     "award_list",
     *     "classics",
     *     "orange_studio"
     * })
     */
    private $copyright;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=80, nullable=true)
     * @Groups({
     *     "film_list",
     *     "film_show",
     *     "jury_list",
     *     "jury_show",
     *     "projection_list",
     *     "projection_show",
     *     "film_selection_section_show",
     *     "news_list",
     *     "award_list",
     *     "classics",
     *     "orange_studio"
     * })
     */
    private $credits;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({
     *     "film_list",
     *     "film_show",
     *     "jury_list",
     *     "jury_show",
     *     "projection_list",
     *     "projection_show",
     *     "film_selection_section_show",
     *     "news_list",
     *     "award_list",
     *     "classics",
     *     "orange_studio"
     * })
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     * @Groups({
     *     "film_list",
     *     "film_show",
     *     "jury_list",
     *     "jury_show",
     *     "projection_list",
     *     "projection_show",
     *     "film_selection_section_show",
     *     "classics",
     *     "orange_studio"
     * })
     */
    private $internet;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=80, nullable=true)
     * @Groups({
     *     "film_list",
     *     "film_show",
     *     "jury_list",
     *     "jury_show",
     *     "projection_list",
     *     "projection_show",
     *     "film_selection_section_show",
     *     "award_list",
     *     "classics",
     *     "orange_studio"
     * })
     */
    private $titleVf;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=80, nullable=true)
     * @Groups({
     *     "film_list",
     *     "film_show",
     *     "jury_list",
     *     "jury_show",
     *     "projection_list",
     *     "projection_show",
     *     "film_selection_section_show",
     *     "award_list",
     *     "classics",
     *     "orange_studio"
     * })
     */
    private $titleVa;

    /**
     * @ORM\ManyToOne(targetEntity="FilmFestival", inversedBy="medias")
     */
    private $festival;
    
    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", inversedBy="filmMedias")
     * @Groups({
     *     "film_list",
     *     "film_show",
     *     "jury_list",
     *     "jury_show",
     *     "projection_list",
     *     "projection_show",
     *     "film_selection_section_show",
     *     "news_list",
     *     "award_list",
     *     "classics",
     *     "orange_studio"
     * })
     */
    private $file;

    /**
     * @ORM\ManyToOne(targetEntity="FilmMediaCategory", inversedBy="medias")
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="FilmJury", inversedBy="medias")
     */
    private $jury;

    /**
     * @ORM\ManyToOne(targetEntity="FilmEvent", inversedBy="medias")
     */
    private $event;

    /**
     * @ORM\ManyToOne(targetEntity="FilmAtelier", inversedBy="medias")
     */
    private $filmAtelier;

    /**
     * @ORM\ManyToOne(targetEntity="CinefPerson", inversedBy="medias")
     */
    private $cinefPerson;

    /**
     * Set id
     *
     * @param integer $id
     * @return FilmMedia
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set noteVf
     *
     * @param string $noteVf
     * @return FilmMedia
     */
    public function setNoteVf($noteVf)
    {
        $this->noteVf = $noteVf;

        return $this;
    }

    /**
     * Get noteVf
     *
     * @return string 
     */
    public function getNoteVf()
    {
        return $this->noteVf;
    }

    /**
     * Set noteVa
     *
     * @param string $noteVa
     * @return FilmMedia
     */
    public function setNoteVa($noteVa)
    {
        $this->noteVa = $noteVa;

        return $this;
    }

    /**
     * Get noteVa
     *
     * @return string 
     */
    public function getNoteVa()
    {
        return $this->noteVa;
    }

    /**
     * Set copyright
     *
     * @param string $copyright
     * @return FilmMedia
     */
    public function setCopyright($copyright)
    {
        $this->copyright = $copyright;

        return $this;
    }

    /**
     * Get copyright
     *
     * @return string 
     */
    public function getCopyright()
    {
        return $this->copyright;
    }

    /**
     * Set credits
     *
     * @param string $credits
     * @return FilmMedia
     */
    public function setCredits($credits)
    {
        $this->credits = $credits;

        return $this;
    }

    /**
     * Get credits
     *
     * @return string 
     */
    public function getCredits()
    {
        return $this->credits;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return FilmMedia
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set internet
     *
     * @param string $internet
     * @return FilmMedia
     */
    public function setInternet($internet)
    {
        $this->internet = $internet;

        return $this;
    }

    /**
     * Get internet
     *
     * @return string 
     */
    public function getInternet()
    {
        return $this->internet;
    }

    /**
     * Set titleVf
     *
     * @param string $titleVf
     * @return FilmMedia
     */
    public function setTitleVf($titleVf)
    {
        $this->titleVf = $titleVf;

        return $this;
    }

    /**
     * Get titleVf
     *
     * @return string 
     */
    public function getTitleVf()
    {
        return $this->titleVf;
    }

    /**
     * Set titleVa
     *
     * @param string $titleVa
     * @return FilmMedia
     */
    public function setTitleVa($titleVa)
    {
        $this->titleVa = $titleVa;

        return $this;
    }

    /**
     * Get titleVa
     *
     * @return string 
     */
    public function getTitleVa()
    {
        return $this->titleVa;
    }

    /**
     * Set photoTypeId
     *
     * @param integer $photoTypeId
     * @return FilmMedia
     */
    public function setPhotoTypeId($photoTypeId)
    {
        $this->photoTypeId = $photoTypeId;

        return $this;
    }

    /**
     * Get photoTypeId
     *
     * @return integer 
     */
    public function getPhotoTypeId()
    {
        return $this->photoTypeId;
    }

    /**
     * Set person
     *
     * @param \Base\CoreBundle\Entity\FilmPerson $person
     * @return FilmMedia
     */
    public function setPerson(\Base\CoreBundle\Entity\FilmPerson $person = null)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return \Base\CoreBundle\Entity\FilmPerson
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Set jury
     *
     * @param \Base\CoreBundle\Entity\FilmJury $jury
     * @return FilmMedia
     */
    public function setJury(\Base\CoreBundle\Entity\FilmJury $jury = null)
    {
        $this->jury = $jury;

        return $this;
    }

    /**
     * Get jury
     *
     * @return \Base\CoreBundle\Entity\FilmJury
     */
    public function getJury()
    {
        return $this->jury;
    }

    /**
     * Set event
     *
     * @param \Base\CoreBundle\Entity\FilmEvent $event
     * @return FilmMedia
     */
    public function setEvent(\Base\CoreBundle\Entity\FilmEvent $event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return \Base\CoreBundle\Entity\FilmEvent
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set poster
     *
     * @param \Base\CoreBundle\Entity\FilmFestivalPoster $poster
     * @return FilmMedia
     */
    public function setPoster(\Base\CoreBundle\Entity\FilmFestivalPoster $poster = null)
    {
        $this->poster = $poster;

        return $this;
    }

    /**
     * Get poster
     *
     * @return \Base\CoreBundle\Entity\FilmFestivalPoster
     */
    public function getPoster()
    {
        return $this->poster;
    }

    /**
     * Set filmAtelier
     *
     * @param \Base\CoreBundle\Entity\FilmAtelier $filmAtelier
     * @return FilmMedia
     */
    public function setFilmAtelier(\Base\CoreBundle\Entity\FilmAtelier $filmAtelier = null)
    {
        $this->filmAtelier = $filmAtelier;

        return $this;
    }

    /**
     * Get filmAtelier
     *
     * @return \Base\CoreBundle\Entity\FilmAtelier
     */
    public function getFilmAtelier()
    {
        return $this->filmAtelier;
    }

    /**
     * Set cinefPerson
     *
     * @param \Base\CoreBundle\Entity\CinefPerson $cinefPerson
     * @return FilmMedia
     */
    public function setCinefPerson(\Base\CoreBundle\Entity\CinefPerson $cinefPerson = null)
    {
        $this->cinefPerson = $cinefPerson;

        return $this;
    }

    /**
     * Get cinefPerson
     *
     * @return \Base\CoreBundle\Entity\CinefPerson
     */
    public function getCinefPerson()
    {
        return $this->cinefPerson;
    }

    /**
     * Set festival
     *
     * @param \Base\CoreBundle\Entity\FilmFestival $festival
     * @return FilmMedia
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
     * Set contentType
     *
     * @param string $contentType
     * @return FilmMedia
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;

        return $this;
    }

    /**
     * Get contentType
     *
     * @return string 
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * Set category
     *
     * @param \Base\CoreBundle\Entity\FilmMediaCategory $category
     * @return FilmMedia
     */
    public function setCategory(\Base\CoreBundle\Entity\FilmMediaCategory $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Base\CoreBundle\Entity\FilmMediaCategory
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set file
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $file
     * @return FilmMedia
     */
    public function setFile(\Application\Sonata\MediaBundle\Entity\Media $file = null)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media 
     */
    public function getFile()
    {
        return $this->file;
    }
}
