<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;
use FDC\CoreBundle\Util\Soif;

/**
 * FilmMedia
 *
 * @ORM\Table(indexes={@ORM\Index(name="person_id", columns={"person_id"}), @ORM\Index(name="generic_id", columns={"generic_id"}), @ORM\Index(name="jury_id", columns={"jury_id"}), @ORM\Index(name="film_id", columns={"film_id"}), @ORM\Index(name="festival_id", columns={"festival_id"}), @ORM\Index(name="internet", columns={"internet"}), @ORM\Index(name="updated_at", columns={"updated_at"}), @ORM\Index(name="title_vf", columns={"title_vf"}), @ORM\Index(name="title_va", columns={"title_va"}), @ORM\Index(name="type", columns={"type"}), @ORM\Index(name="file_d", columns={"file_id"})})
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
     */
    private $contentType;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $noteVf;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $noteVa;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $copyright;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $credits;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $internet;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $titleVf;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $titleVa;

    /**
     * @ORM\ManyToOne(targetEntity="FilmFestival", inversedBy="medias")
     */
    private $festival;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $photoTypeId;
    
    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", inversedBy="filmMedias")
     */
    private $file;

    /**
     * @ORM\ManyToOne(targetEntity="FilmMediaCategory", inversedBy="medias")
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="FilmFilm", inversedBy="medias")
     */
    private $film;

    /**
     * @ORM\ManyToOne(targetEntity="FilmPerson", inversedBy="medias")
     */
    private $person;

    /**
     * @ORM\ManyToOne(targetEntity="FilmGeneric", inversedBy="medias")
     */
    private $generic;

    /**
     * @ORM\ManyToOne(targetEntity="FilmJury", inversedBy="medias")
     */
    private $jury;

    /**
     * @ORM\ManyToOne(targetEntity="FilmEvent", inversedBy="medias")
     */
    private $event;

    /**
     * @ORM\ManyToOne(targetEntity="FilmFestivalPoster", inversedBy="medias")
     */
    private $poster;

    /**
     * @ORM\ManyToOne(targetEntity="FilmAtelierGeneric", inversedBy="medias")
     */
    private $filmAtelierGeneric;

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
     * Set film
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $film
     * @return FilmMedia
     */
    public function setFilm(\FDC\CoreBundle\Entity\FilmFilm $film = null)
    {
        $this->film = $film;

        return $this;
    }

    /**
     * Get film
     *
     * @return \FDC\CoreBundle\Entity\FilmFilm 
     */
    public function getFilm()
    {
        return $this->film;
    }

    /**
     * Set person
     *
     * @param \FDC\CoreBundle\Entity\FilmPerson $person
     * @return FilmMedia
     */
    public function setPerson(\FDC\CoreBundle\Entity\FilmPerson $person = null)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return \FDC\CoreBundle\Entity\FilmPerson 
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Set generic
     *
     * @param \FDC\CoreBundle\Entity\FilmGeneric $generic
     * @return FilmMedia
     */
    public function setGeneric(\FDC\CoreBundle\Entity\FilmGeneric $generic = null)
    {
        $this->generic = $generic;

        return $this;
    }

    /**
     * Get generic
     *
     * @return \FDC\CoreBundle\Entity\FilmGeneric 
     */
    public function getGeneric()
    {
        return $this->generic;
    }

    /**
     * Set jury
     *
     * @param \FDC\CoreBundle\Entity\FilmJury $jury
     * @return FilmMedia
     */
    public function setJury(\FDC\CoreBundle\Entity\FilmJury $jury = null)
    {
        $this->jury = $jury;

        return $this;
    }

    /**
     * Get jury
     *
     * @return \FDC\CoreBundle\Entity\FilmJury 
     */
    public function getJury()
    {
        return $this->jury;
    }

    /**
     * Set event
     *
     * @param \FDC\CoreBundle\Entity\FilmEvent $event
     * @return FilmMedia
     */
    public function setEvent(\FDC\CoreBundle\Entity\FilmEvent $event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return \FDC\CoreBundle\Entity\FilmEvent 
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set poster
     *
     * @param \FDC\CoreBundle\Entity\FilmFestivalPoster $poster
     * @return FilmMedia
     */
    public function setPoster(\FDC\CoreBundle\Entity\FilmFestivalPoster $poster = null)
    {
        $this->poster = $poster;

        return $this;
    }

    /**
     * Get poster
     *
     * @return \FDC\CoreBundle\Entity\FilmFestivalPoster 
     */
    public function getPoster()
    {
        return $this->poster;
    }

    /**
     * Set filmAtelierGeneric
     *
     * @param \FDC\CoreBundle\Entity\FilmAtelierGeneric $filmAtelierGeneric
     * @return FilmMedia
     */
    public function setFilmAtelierGeneric(\FDC\CoreBundle\Entity\FilmAtelierGeneric $filmAtelierGeneric = null)
    {
        $this->filmAtelierGeneric = $filmAtelierGeneric;

        return $this;
    }

    /**
     * Get filmAtelierGeneric
     *
     * @return \FDC\CoreBundle\Entity\FilmAtelierGeneric 
     */
    public function getFilmAtelierGeneric()
    {
        return $this->filmAtelierGeneric;
    }

    /**
     * Set filmAtelier
     *
     * @param \FDC\CoreBundle\Entity\FilmAtelier $filmAtelier
     * @return FilmMedia
     */
    public function setFilmAtelier(\FDC\CoreBundle\Entity\FilmAtelier $filmAtelier = null)
    {
        $this->filmAtelier = $filmAtelier;

        return $this;
    }

    /**
     * Get filmAtelier
     *
     * @return \FDC\CoreBundle\Entity\FilmAtelier 
     */
    public function getFilmAtelier()
    {
        return $this->filmAtelier;
    }

    /**
     * Set cinefPerson
     *
     * @param \FDC\CoreBundle\Entity\CinefPerson $cinefPerson
     * @return FilmMedia
     */
    public function setCinefPerson(\FDC\CoreBundle\Entity\CinefPerson $cinefPerson = null)
    {
        $this->cinefPerson = $cinefPerson;

        return $this;
    }

    /**
     * Get cinefPerson
     *
     * @return \FDC\CoreBundle\Entity\CinefPerson 
     */
    public function getCinefPerson()
    {
        return $this->cinefPerson;
    }

    /**
     * Set festival
     *
     * @param \FDC\CoreBundle\Entity\FilmFestival $festival
     * @return FilmMedia
     */
    public function setFestival(\FDC\CoreBundle\Entity\FilmFestival $festival = null)
    {
        $this->festival = $festival;

        return $this;
    }

    /**
     * Get festival
     *
     * @return \FDC\CoreBundle\Entity\FilmFestival 
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
     * @param \FDC\CoreBundle\Entity\FilmMediaCategory $category
     * @return FilmMedia
     */
    public function setCategory(\FDC\CoreBundle\Entity\FilmMediaCategory $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \FDC\CoreBundle\Entity\FilmMediaCategory 
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
