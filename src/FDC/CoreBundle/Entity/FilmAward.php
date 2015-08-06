<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * FilmAward
 *
 * @ORM\Table(indexes={@ORM\Index(name="person_id", columns={"person_id"}), @ORM\Index(name="prize_id", columns={"prize_id"}), @ORM\Index(name="festival_id", columns={"festival_id"}), @ORM\Index(name="position", columns={"position"}), @ORM\Index(name="updated_at", columns={"updated_at"})})
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class FilmAward
{
    use Time;
    
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $position;
    
    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $filmMutual;
    
    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $personMutual;

    /**
     * @var string
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $exAequo;

    /**
     * @var string
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $unanimity;

    /**
     * @var text
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $comment;

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
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $soifUpdatedAt;

    /**
     * @var FilmFestival
     *
     * @ORM\ManyToOne(targetEntity="FilmFestival", inversedBy="awards")
     */
    private $festival;

    /**
     * @var FilmFilm
     *
     * @ORM\ManyToOne(targetEntity="FilmFilm", inversedBy="awards")
     */
    private $film;

    /**
     * @var FilmPerson
     *
     * @ORM\ManyToOne(targetEntity="FilmPerson", inversedBy="awards")
     */
    private $person;

    /**
     * @var FilmPrize
     *
     * @ORM\ManyToOne(targetEntity="FilmPrize", inversedBy="awards")
     */
    private $prize;
    

    /**
     * Set id
     *
     * @param integer $id
     * @return FilmAward
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
     * Set position
     *
     * @param integer $position
     * @return FilmAward
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set filmMutual
     *
     * @param boolean $filmMutual
     * @return FilmAward
     */
    public function setFilmMutual($filmMutual)
    {
        $this->filmMutual = $filmMutual;

        return $this;
    }

    /**
     * Get filmMutual
     *
     * @return boolean 
     */
    public function getFilmMutual()
    {
        return $this->filmMutual;
    }

    /**
     * Set personMutual
     *
     * @param boolean $personMutual
     * @return FilmAward
     */
    public function setPersonMutual($personMutual)
    {
        $this->personMutual = $personMutual;

        return $this;
    }

    /**
     * Get personMutual
     *
     * @return boolean 
     */
    public function getPersonMutual()
    {
        return $this->personMutual;
    }

    /**
     * Set exAequo
     *
     * @param string $exAequo
     * @return FilmAward
     */
    public function setExAequo($exAequo)
    {
        $this->exAequo = $exAequo;

        return $this;
    }

    /**
     * Get exAequo
     *
     * @return string 
     */
    public function getExAequo()
    {
        return $this->exAequo;
    }

    /**
     * Set unanimity
     *
     * @param string $unanimity
     * @return FilmAward
     */
    public function setUnanimity($unanimity)
    {
        $this->unanimity = $unanimity;

        return $this;
    }

    /**
     * Get unanimity
     *
     * @return string 
     */
    public function getUnanimity()
    {
        return $this->unanimity;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return FilmAward
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return FilmAward
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
     * @return FilmAward
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
     * Set festival
     *
     * @param \FDC\CoreBundle\Entity\FilmFestival $festival
     * @return FilmAward
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
     * Set film
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $film
     * @return FilmAward
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
     * @return FilmAward
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
     * Set prize
     *
     * @param \FDC\CoreBundle\Entity\FilmPrize $prize
     * @return FilmAward
     */
    public function setPrize(\FDC\CoreBundle\Entity\FilmPrize $prize = null)
    {
        $this->prize = $prize;

        return $this;
    }

    /**
     * Get prize
     *
     * @return \FDC\CoreBundle\Entity\FilmPrize 
     */
    public function getPrize()
    {
        return $this->prize;
    }

    /**
     * Set soifUpdatedAt
     *
     * @param \DateTime $soifUpdatedAt
     * @return FilmAward
     */
    public function setSoifUpdatedAt($soifUpdatedAt)
    {
        $this->soifUpdatedAt = $soifUpdatedAt;

        return $this;
    }

    /**
     * Get soifUpdatedAt
     *
     * @return \DateTime 
     */
    public function getSoifUpdatedAt()
    {
        return $this->soifUpdatedAt;
    }
    /**
     * @ORM\PrePersist
     */
    public function prePersistTime()
    {
        // Add your code here
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdateTime()
    {
        // Add your code here
    }
}
