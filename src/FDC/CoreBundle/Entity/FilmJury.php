<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * FilmJury
 *
 * @ORM\Table(indexes={@ORM\Index(name="festival_year", columns={"festival_year"}), @ORM\Index(name="CLEDETRI", columns={"CLEDETRI"}), @ORM\Index(name="updated_at", columns={"updated_at"}) })
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmJury
{
    use Time;
    
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="integer", options={"unsigned": true})
     */
    private $festivalYear;

    /**
     * @var string
     *
     * @ORM\Column(name="CLEDETRI", type="decimal", precision=22, scale=0, nullable=true)
     */
    private $order;

    /**
     * @var string
     *
     * @ORM\Column(name="BIO_FILMO_VF", type="text", nullable=true)
     */
    private $bioFilmVf;

    /**
     * @var string
     *
     * @ORM\Column(name="BIO_FILMO_VA", type="text", nullable=true)
     */
    private $bioFilmVa;

    /**
     * @var string
     *
     * @ORM\Column(name="BIO_FILMO_VF2", type="text", nullable=true)
     */
    private $bioFilmVf2;

    /**
     * @var string
     *
     * @ORM\Column(name="BIO_FILMO_VA2", type="text", nullable=true)
     */
    private $bioFilmVa2;

    /**
     * @var Person
     *
     * @ORM\ManyToOne(targetEntity="FilmPerson", inversedBy="juries")
     */
    private $person;

    /**
     * @var FilmJuryType
     *
     * @ORM\ManyToOne(targetEntity="FilmJuryType", inversedBy="juries")
     */
    private $type;
    
    /**
     * @var FilmJuryType
     *
     * @ORM\ManyToOne(targetEntity="FilmJuryFunction", inversedBy="juries")
     */
    private $function;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FilmMedia", mappedBy="jury")
     */
    private $medias;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->medias = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return FilmJury
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
     * @return FilmJury
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
     * Set order
     *
     * @param string $order
     * @return FilmJury
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
     * Set bioFilmVf
     *
     * @param string $bioFilmVf
     * @return FilmJury
     */
    public function setBioFilmVf($bioFilmVf)
    {
        $this->bioFilmVf = $bioFilmVf;

        return $this;
    }

    /**
     * Get bioFilmVf
     *
     * @return string 
     */
    public function getBioFilmVf()
    {
        return $this->bioFilmVf;
    }

    /**
     * Set bioFilmVa
     *
     * @param string $bioFilmVa
     * @return FilmJury
     */
    public function setBioFilmVa($bioFilmVa)
    {
        $this->bioFilmVa = $bioFilmVa;

        return $this;
    }

    /**
     * Get bioFilmVa
     *
     * @return string 
     */
    public function getBioFilmVa()
    {
        return $this->bioFilmVa;
    }

    /**
     * Set bioFilmVf2
     *
     * @param string $bioFilmVf2
     * @return FilmJury
     */
    public function setBioFilmVf2($bioFilmVf2)
    {
        $this->bioFilmVf2 = $bioFilmVf2;

        return $this;
    }

    /**
     * Get bioFilmVf2
     *
     * @return string 
     */
    public function getBioFilmVf2()
    {
        return $this->bioFilmVf2;
    }

    /**
     * Set bioFilmVa2
     *
     * @param string $bioFilmVa2
     * @return FilmJury
     */
    public function setBioFilmVa2($bioFilmVa2)
    {
        $this->bioFilmVa2 = $bioFilmVa2;

        return $this;
    }

    /**
     * Get bioFilmVa2
     *
     * @return string 
     */
    public function getBioFilmVa2()
    {
        return $this->bioFilmVa2;
    }

    /**
     * Set person
     *
     * @param \FDC\CoreBundle\Entity\FilmPerson $person
     * @return FilmJury
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
     * Set type
     *
     * @param \FDC\CoreBundle\Entity\FilmJuryType $type
     * @return FilmJury
     */
    public function setType(\FDC\CoreBundle\Entity\FilmJuryType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \FDC\CoreBundle\Entity\FilmJuryType 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set function
     *
     * @param \FDC\CoreBundle\Entity\FilmJuryFunction $function
     * @return FilmJury
     */
    public function setFunction(\FDC\CoreBundle\Entity\FilmJuryFunction $function = null)
    {
        $this->function = $function;

        return $this;
    }

    /**
     * Get function
     *
     * @return \FDC\CoreBundle\Entity\FilmJuryFunction 
     */
    public function getFunction()
    {
        return $this->function;
    }

    /**
     * Add medias
     *
     * @param \FDC\CoreBundle\Entity\FilmMedia $medias
     * @return FilmJury
     */
    public function addMedia(\FDC\CoreBundle\Entity\FilmMedia $medias)
    {
        $this->medias[] = $medias;

        return $this;
    }

    /**
     * Remove medias
     *
     * @param \FDC\CoreBundle\Entity\FilmMedia $medias
     */
    public function removeMedia(\FDC\CoreBundle\Entity\FilmMedia $medias)
    {
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
}
