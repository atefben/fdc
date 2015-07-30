<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * FilmAward
 *
 * @ORM\Table(indexes={@ORM\Index(name="person_id", columns={"person_id"}), @ORM\Index(name="prize_id", columns={"prize_id"}), @ORM\Index(name="festival_year", columns={"festival_year"}), @ORM\Index(name="importance", columns={"importance"}), @ORM\Index(name="updated_at", columns={"updated_at"})})
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
     * @ORM\Column(type="integer", options={"unsigned": true})
     */
    private $festivalYear;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=22, scale=0, nullable=true)
     */
    private $importance;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $exAequo;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $unanimity;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $comments;

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
     * @var FilmFilm
     *
     * @ORM\ManyToOne(targetEntity="FilmFilm", inversedBy="awards")
     */
    private $film;

    /**
     * @ORM\ManyToOne(targetEntity="FilmPerson", inversedBy="awards")
     */
    private $person;

    /**
     * @ORM\ManyToOne(targetEntity="FilmPrice", inversedBy="awards")
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
     * Set festivalYear
     *
     * @param integer $festivalYear
     * @return FilmAward
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
     * Set importance
     *
     * @param string $importance
     * @return FilmAward
     */
    public function setImportance($importance)
    {
        $this->importance = $importance;

        return $this;
    }

    /**
     * Get importance
     *
     * @return string 
     */
    public function getImportance()
    {
        return $this->importance;
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
     * Set comments
     *
     * @param string $comments
     * @return FilmAward
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
     * @param \FDC\CoreBundle\Entity\FilmPrice $prize
     * @return FilmAward
     */
    public function setPrize(\FDC\CoreBundle\Entity\FilmPrice $prize = null)
    {
        $this->prize = $prize;

        return $this;
    }

    /**
     * Get prize
     *
     * @return \FDC\CoreBundle\Entity\FilmPrice 
     */
    public function getPrize()
    {
        return $this->prize;
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
