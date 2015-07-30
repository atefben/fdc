<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * FilmPhoto
 *
 * @ORM\Table(indexes={@ORM\Index(name="person_id", columns={"person_id"}), @ORM\Index(name="generic_id", columns={"generic_id"}), @ORM\Index(name="jury_id", columns={"jury_id"}), @ORM\Index(name="film_id", columns={"film_id"}), @ORM\Index(name="festival_year", columns={"festival_year"}), @ORM\Index(name="internet", columns={"internet"}), @ORM\Index(name="updated_at", columns={"updated_at"}), @ORM\Index(name="title_vf", columns={"title_vf"}), @ORM\Index(name="title_va", columns={"title_va"}), @ORM\Index(name="type", columns={"type"}), @ORM\Index(name="file", columns={"file"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmPhoto
{
    use Time;

    /**
     * @var string
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     */
    private $id;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $file;

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
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

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
     * @var string
     *
     * @ORM\Column(type="integer", options={"unsigned": true})
     */
    private $festivalYear;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $photoTypeId;

    /**
     * @ORM\ManyToOne(targetEntity="FilmFilm", inversedBy="photos")
     */
    private $film;

    /**
     * @ORM\ManyToOne(targetEntity="FilmPerson", inversedBy="photos")
     */
    private $person;

    /**
     * @ORM\ManyToOne(targetEntity="FilmGeneric", inversedBy="photos")
     */
    private $generic;

    /**
     * @ORM\ManyToOne(targetEntity="FilmJury", inversedBy="photos")
     */
    private $jury;

    /**
     * @ORM\ManyToOne(targetEntity="FilmEvent", inversedBy="photos")
     */
    private $event;

    /**
     * @ORM\ManyToOne(targetEntity="FilmFestivalPoster", inversedBy="photos")
     */
    private $poster;

    /**
     * @ORM\ManyToOne(targetEntity="FilmAtelierGeneric", inversedBy="photos")
     */
    private $filmAtelierGeneric;

    /**
     * @ORM\ManyToOne(targetEntity="FilmAtelier", inversedBy="photos")
     */
    private $filmAtelier;

    /**
     * @ORM\ManyToOne(targetEntity="CinefPerson", inversedBy="photos")
     */
    private $cinefPerson;

    /**
     * Set id
     *
     * @param integer $id
     * @return FilmPhoto
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
     * Set file
     *
     * @param string $file
     * @return FilmPhoto
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return string 
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set noteVf
     *
     * @param string $noteVf
     * @return FilmPhoto
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
     * @return FilmPhoto
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
     * @return FilmPhoto
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
     * @return FilmPhoto
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
     * @return FilmPhoto
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return FilmPhoto
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return FilmPhoto
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set internet
     *
     * @param string $internet
     * @return FilmPhoto
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
     * @return FilmPhoto
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
     * @return FilmPhoto
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
     * Set festivalYear
     *
     * @param integer $festivalYear
     * @return FilmPhoto
     */
    public function setFestivalYear($festivalYear)
    {
        $this->festivalYear = $festivalYear;

        return $this;
    }

    /**
     * Get festivalYear
     *
     * @return integer 
     */
    public function getFestivalYear()
    {
        return $this->festivalYear;
    }

    /**
     * Set photoTypeId
     *
     * @param integer $photoTypeId
     * @return FilmPhoto
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
     * @return FilmPhoto
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
     * @return FilmPhoto
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
     * @return FilmPhoto
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
     * @return FilmPhoto
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
     * @return FilmPhoto
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
     * @return FilmPhoto
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
     * @return FilmPhoto
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
     * @return FilmPhoto
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
     * @return FilmPhoto
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
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        // Add your code here
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        // Add your code here
    }
}
