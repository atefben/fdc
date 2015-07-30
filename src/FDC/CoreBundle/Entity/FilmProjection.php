<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * FilmProjection
 *
 * @ORM\Table(indexes={@ORM\Index(name="displayed_at", columns={"displayed_at"}), @ORM\Index(name="room_id", columns={"room_id"}), @ORM\Index(name="section_programming_vf", columns={"section_programming_vf"}), @ORM\Index(name="section_programming_va", columns={"section_programming_va"}), @ORM\Index(name="updated_at", columns={"updated_at"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmProjection
{
    use Time;
    
    /**
     * @var string
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="integer", options={"unsigned": true})
     */
    private $festivalYear;

    /**
     * @var FilmAddress
     *
     * @ORM\ManyToOne(targetEntity="FilmFilm")
     */
    private $film;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=250, nullable=true)
     */
    private $comments;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=2, scale=0, nullable=true)
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=2, nullable=true)
     */
    private $dayCode;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $scheduleTitle;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $file;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $locked;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=10, scale=0, nullable=true)
     */
    private $modelId;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $controlinfo;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=3, scale=0, nullable=true)
     */
    private $point;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $admin;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=3, scale=0, nullable=true)
     */
    private $waitingList;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $teamPresence;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $displayedAt;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $start;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $end;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FilmRoom", inversedBy="projections")
     */
    private $room;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $projType;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $warning;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $special;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $given;

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
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $agenda;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $sectionProgrammingVf;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $sectionProgrammingVa;
    
    /**
     * @ORM\ManyToMany(targetEntity="FilmFilm", mappedBy="projections")
     */
    private $films;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->films = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set festivalYear
     *
     * @param integer $festivalYear
     * @return FilmProjection
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
     * Set comments
     *
     * @param string $comments
     * @return FilmProjection
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments
     *
     * @return string 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set number
     *
     * @param string $number
     * @return FilmProjection
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set dayCode
     *
     * @param string $dayCode
     * @return FilmProjection
     */
    public function setDayCode($dayCode)
    {
        $this->dayCode = $dayCode;

        return $this;
    }

    /**
     * Get dayCode
     *
     * @return string 
     */
    public function getDayCode()
    {
        return $this->dayCode;
    }

    /**
     * Set scheduleTitle
     *
     * @param string $scheduleTitle
     * @return FilmProjection
     */
    public function setScheduleTitle($scheduleTitle)
    {
        $this->scheduleTitle = $scheduleTitle;

        return $this;
    }

    /**
     * Get scheduleTitle
     *
     * @return string 
     */
    public function getScheduleTitle()
    {
        return $this->scheduleTitle;
    }

    /**
     * Set file
     *
     * @param string $file
     * @return FilmProjection
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
     * Set locked
     *
     * @param string $locked
     * @return FilmProjection
     */
    public function setLocked($locked)
    {
        $this->locked = $locked;

        return $this;
    }

    /**
     * Get locked
     *
     * @return string 
     */
    public function getLocked()
    {
        return $this->locked;
    }

    /**
     * Set modelId
     *
     * @param string $modelId
     * @return FilmProjection
     */
    public function setModelId($modelId)
    {
        $this->modelId = $modelId;

        return $this;
    }

    /**
     * Get modelId
     *
     * @return string 
     */
    public function getModelId()
    {
        return $this->modelId;
    }

    /**
     * Set controlinfo
     *
     * @param string $controlinfo
     * @return FilmProjection
     */
    public function setControlinfo($controlinfo)
    {
        $this->controlinfo = $controlinfo;

        return $this;
    }

    /**
     * Get controlinfo
     *
     * @return string 
     */
    public function getControlinfo()
    {
        return $this->controlinfo;
    }

    /**
     * Set point
     *
     * @param string $point
     * @return FilmProjection
     */
    public function setPoint($point)
    {
        $this->point = $point;

        return $this;
    }

    /**
     * Get point
     *
     * @return string 
     */
    public function getPoint()
    {
        return $this->point;
    }

    /**
     * Set admin
     *
     * @param string $admin
     * @return FilmProjection
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;

        return $this;
    }

    /**
     * Get admin
     *
     * @return string 
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * Set waitingList
     *
     * @param string $waitingList
     * @return FilmProjection
     */
    public function setWaitingList($waitingList)
    {
        $this->waitingList = $waitingList;

        return $this;
    }

    /**
     * Get waitingList
     *
     * @return string 
     */
    public function getWaitingList()
    {
        return $this->waitingList;
    }

    /**
     * Set teamPresence
     *
     * @param string $teamPresence
     * @return FilmProjection
     */
    public function setTeamPresence($teamPresence)
    {
        $this->teamPresence = $teamPresence;

        return $this;
    }

    /**
     * Get teamPresence
     *
     * @return string 
     */
    public function getTeamPresence()
    {
        return $this->teamPresence;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return FilmProjection
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
     * Set displayedAt
     *
     * @param \DateTime $displayedAt
     * @return FilmProjection
     */
    public function setDisplayedAt($displayedAt)
    {
        $this->displayedAt = $displayedAt;

        return $this;
    }

    /**
     * Get displayedAt
     *
     * @return \DateTime 
     */
    public function getDisplayedAt()
    {
        return $this->displayedAt;
    }

    /**
     * Set start
     *
     * @param string $start
     * @return FilmProjection
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return string 
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param string $end
     * @return FilmProjection
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return string 
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set projType
     *
     * @param string $projType
     * @return FilmProjection
     */
    public function setProjType($projType)
    {
        $this->projType = $projType;

        return $this;
    }

    /**
     * Get projType
     *
     * @return string 
     */
    public function getProjType()
    {
        return $this->projType;
    }

    /**
     * Set warning
     *
     * @param string $warning
     * @return FilmProjection
     */
    public function setWarning($warning)
    {
        $this->warning = $warning;

        return $this;
    }

    /**
     * Get warning
     *
     * @return string 
     */
    public function getWarning()
    {
        return $this->warning;
    }

    /**
     * Set special
     *
     * @param string $special
     * @return FilmProjection
     */
    public function setSpecial($special)
    {
        $this->special = $special;

        return $this;
    }

    /**
     * Get special
     *
     * @return string 
     */
    public function getSpecial()
    {
        return $this->special;
    }

    /**
     * Set given
     *
     * @param string $given
     * @return FilmProjection
     */
    public function setGiven($given)
    {
        $this->given = $given;

        return $this;
    }

    /**
     * Get given
     *
     * @return string 
     */
    public function getGiven()
    {
        return $this->given;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return FilmProjection
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
     * @return FilmProjection
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
     * Set agenda
     *
     * @param string $agenda
     * @return FilmProjection
     */
    public function setAgenda($agenda)
    {
        $this->agenda = $agenda;

        return $this;
    }

    /**
     * Get agenda
     *
     * @return string 
     */
    public function getAgenda()
    {
        return $this->agenda;
    }

    /**
     * Set sectionProgrammingVf
     *
     * @param string $sectionProgrammingVf
     * @return FilmProjection
     */
    public function setSectionProgrammingVf($sectionProgrammingVf)
    {
        $this->sectionProgrammingVf = $sectionProgrammingVf;

        return $this;
    }

    /**
     * Get sectionProgrammingVf
     *
     * @return string 
     */
    public function getSectionProgrammingVf()
    {
        return $this->sectionProgrammingVf;
    }

    /**
     * Set sectionProgrammingVa
     *
     * @param string $sectionProgrammingVa
     * @return FilmProjection
     */
    public function setSectionProgrammingVa($sectionProgrammingVa)
    {
        $this->sectionProgrammingVa = $sectionProgrammingVa;

        return $this;
    }

    /**
     * Get sectionProgrammingVa
     *
     * @return string 
     */
    public function getSectionProgrammingVa()
    {
        return $this->sectionProgrammingVa;
    }

    /**
     * Set film
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $film
     * @return FilmProjection
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
     * Set room
     *
     * @param \FDC\CoreBundle\Entity\FilmRoom $room
     * @return FilmProjection
     */
    public function setRoom(\FDC\CoreBundle\Entity\FilmRoom $room = null)
    {
        $this->room = $room;

        return $this;
    }

    /**
     * Get room
     *
     * @return \FDC\CoreBundle\Entity\FilmRoom 
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * Add films
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $films
     * @return FilmProjection
     */
    public function addFilm(\FDC\CoreBundle\Entity\FilmFilm $films)
    {
        $this->films[] = $films;

        return $this;
    }

    /**
     * Remove films
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $films
     */
    public function removeFilm(\FDC\CoreBundle\Entity\FilmFilm $films)
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
