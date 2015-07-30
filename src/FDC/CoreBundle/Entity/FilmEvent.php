<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * FilmEvent
 *
 * @ORM\Table(indexes={@ORM\Index(name="festival_year", columns={"festival_year"}), @ORM\Index(name="person_id", columns={"person_id"}), @ORM\Index(name="event_type_id", columns={"event_type_id"}), @ORM\Index(name="order", columns={"order"}), @ORM\Index(name="internet", columns={"internet"}), @ORM\Index(name="updated_at", columns={"updated_at"}), @ORM\Index(name="pm_dateevent", columns={"starts_at", "order"})})
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
    private $id;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $startsAt;

    /**
     * @var string
     *
     * @ORM\Column(type="integer", options={"unsigned": true})
     */
    private $festivalYear;

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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $personId;

    /**
     * @var FilmAddress
     *
     * @ORM\ManyToOne(targetEntity="FilmEventType")
     */
    private $eventType;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionVf;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionVa;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionVf2;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionVa2;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionVf3;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionVa3;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionVf4;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionVa4;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var decimal
     *
     * @ORM\Column(type="decimal", precision=22, scale=0, nullable=true)
     */
    private $order;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $internet;
    
    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FilmPhoto", mappedBy="event")
     */
    private $photos;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->photos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return FilmEvent
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
     * @return FilmEvent
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
     * Set order
     *
     * @param string $order
     * @return FilmEvent
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return string 
     */
    public function getOrder()
    {
        return $this->order;
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
     * @param \FDC\CoreBundle\Entity\FilmEventType $eventType
     * @return FilmEvent
     */
    public function setEventType(\FDC\CoreBundle\Entity\FilmEventType $eventType = null)
    {
        $this->eventType = $eventType;

        return $this;
    }

    /**
     * Get eventType
     *
     * @return \FDC\CoreBundle\Entity\FilmEventType 
     */
    public function getEventType()
    {
        return $this->eventType;
    }

    /**
     * Add photos
     *
     * @param \FDC\CoreBundle\Entity\FilmPhoto $photos
     * @return FilmEvent
     */
    public function addPhoto(\FDC\CoreBundle\Entity\FilmPhoto $photos)
    {
        $this->photos[] = $photos;

        return $this;
    }

    /**
     * Remove photos
     *
     * @param \FDC\CoreBundle\Entity\FilmPhoto $photos
     */
    public function removePhoto(\FDC\CoreBundle\Entity\FilmPhoto $photos)
    {
        $this->photos->removeElement($photos);
    }

    /**
     * Get photos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPhotos()
    {
        return $this->photos;
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
