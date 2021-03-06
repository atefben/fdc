<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * FilmEvent
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmEvent
{
    use Time;

    /**
     * @var string
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $startsAt;

    /**
     * @var string
     *
     * @ORM\Column(type="integer", options={"unsigned": true})
     */
    protected $festivalYear;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    protected $titleVf;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    protected $titleVa;

    /**
     * @var string
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $personId;

    /**
     * @var FilmAddress
     *
     * @ORM\ManyToOne(targetEntity="FilmEventType")
     */
    protected $eventType;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $descriptionVf;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $descriptionVa;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $descriptionVf2;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $descriptionVa2;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $descriptionVf3;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $descriptionVa3;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $descriptionVf4;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $descriptionVa4;

    /**
     * @var decimal
     *
     * @ORM\Column(type="decimal", precision=22, scale=0, nullable=true)
     */
    protected $position;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    protected $internet;
    
    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FilmMedia", mappedBy="event")
     */
    protected $medias;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->medias = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set startsAt
     *
     * @param \DateTime $startsAt
     * @return FilmEvent
     */
    public function setStartsAt($startsAt)
    {
        $this->startsAt = $startsAt;

        return $this;
    }

    /**
     * Get startsAt
     *
     * @return \DateTime 
     */
    public function getStartsAt()
    {
        return $this->startsAt;
    }

    /**
     * Set festivalYear
     *
     * @param integer $festivalYear
     * @return FilmEvent
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
     * Set titleVf
     *
     * @param string $titleVf
     * @return FilmEvent
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
     * @return FilmEvent
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
     * Set personId
     *
     * @param integer $personId
     * @return FilmEvent
     */
    public function setPersonId($personId)
    {
        $this->personId = $personId;

        return $this;
    }

    /**
     * Get personId
     *
     * @return integer 
     */
    public function getPersonId()
    {
        return $this->personId;
    }

    /**
     * Set descriptionVf
     *
     * @param string $descriptionVf
     * @return FilmEvent
     */
    public function setDescriptionVf($descriptionVf)
    {
        $this->descriptionVf = $descriptionVf;

        return $this;
    }

    /**
     * Get descriptionVf
     *
     * @return string 
     */
    public function getDescriptionVf()
    {
        return $this->descriptionVf;
    }

    /**
     * Set descriptionVa
     *
     * @param string $descriptionVa
     * @return FilmEvent
     */
    public function setDescriptionVa($descriptionVa)
    {
        $this->descriptionVa = $descriptionVa;

        return $this;
    }

    /**
     * Get descriptionVa
     *
     * @return string 
     */
    public function getDescriptionVa()
    {
        return $this->descriptionVa;
    }

    /**
     * Set descriptionVf2
     *
     * @param string $descriptionVf2
     * @return FilmEvent
     */
    public function setDescriptionVf2($descriptionVf2)
    {
        $this->descriptionVf2 = $descriptionVf2;

        return $this;
    }

    /**
     * Get descriptionVf2
     *
     * @return string 
     */
    public function getDescriptionVf2()
    {
        return $this->descriptionVf2;
    }

    /**
     * Set descriptionVa2
     *
     * @param string $descriptionVa2
     * @return FilmEvent
     */
    public function setDescriptionVa2($descriptionVa2)
    {
        $this->descriptionVa2 = $descriptionVa2;

        return $this;
    }

    /**
     * Get descriptionVa2
     *
     * @return string 
     */
    public function getDescriptionVa2()
    {
        return $this->descriptionVa2;
    }

    /**
     * Set descriptionVf3
     *
     * @param string $descriptionVf3
     * @return FilmEvent
     */
    public function setDescriptionVf3($descriptionVf3)
    {
        $this->descriptionVf3 = $descriptionVf3;

        return $this;
    }

    /**
     * Get descriptionVf3
     *
     * @return string 
     */
    public function getDescriptionVf3()
    {
        return $this->descriptionVf3;
    }

    /**
     * Set descriptionVa3
     *
     * @param string $descriptionVa3
     * @return FilmEvent
     */
    public function setDescriptionVa3($descriptionVa3)
    {
        $this->descriptionVa3 = $descriptionVa3;

        return $this;
    }

    /**
     * Get descriptionVa3
     *
     * @return string 
     */
    public function getDescriptionVa3()
    {
        return $this->descriptionVa3;
    }

    /**
     * Set descriptionVf4
     *
     * @param string $descriptionVf4
     * @return FilmEvent
     */
    public function setDescriptionVf4($descriptionVf4)
    {
        $this->descriptionVf4 = $descriptionVf4;

        return $this;
    }

    /**
     * Get descriptionVf4
     *
     * @return string 
     */
    public function getDescriptionVf4()
    {
        return $this->descriptionVf4;
    }

    /**
     * Set descriptionVa4
     *
     * @param string $descriptionVa4
     * @return FilmEvent
     */
    public function setDescriptionVa4($descriptionVa4)
    {
        $this->descriptionVa4 = $descriptionVa4;

        return $this;
    }

    /**
     * Get descriptionVa4
     *
     * @return string 
     */
    public function getDescriptionVa4()
    {
        return $this->descriptionVa4;
    }

    /**
     * Set internet
     *
     * @param string $internet
     * @return FilmEvent
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
     * Set eventType
     *
     * @param \Base\CoreBundle\Entity\FilmEventType $eventType
     * @return FilmEvent
     */
    public function setEventType(\Base\CoreBundle\Entity\FilmEventType $eventType = null)
    {
        $this->eventType = $eventType;

        return $this;
    }

    /**
     * Get eventType
     *
     * @return \Base\CoreBundle\Entity\FilmEventType
     */
    public function getEventType()
    {
        return $this->eventType;
    }

    /**
     * Add medias
     *
     * @param \Base\CoreBundle\Entity\FilmMedia $medias
     * @return FilmEvent
     */
    public function addMedia(\Base\CoreBundle\Entity\FilmMedia $medias)
    {
        if ($this->medias->contains($medias)) {
            return;
        }
        
        $this->medias[] = $medias;

        return $this;
    }

    /**
     * Remove medias
     *
     * @param \Base\CoreBundle\Entity\FilmMedia $medias
     */
    public function removeMedia(\Base\CoreBundle\Entity\FilmMedia $medias)
    {
        if (!$this->medias->contains($medias)) {
            return;
        }
        
        $this->medias->removeElement($medias);
    }

    /**
     * Get medias
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMedias()
    {
        return $this->medias;
    }

    /**
     * Set position
     *
     * @param string $position
     * @return FilmEvent
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return string 
     */
    public function getPosition()
    {
        return $this->position;
    }
}
