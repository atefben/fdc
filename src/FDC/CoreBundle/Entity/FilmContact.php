<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * FilmContact
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmContact implements FilmContactInterface
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
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $companyName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="FilmAddress", inversedBy="contacts", cascade={"persist"})
     */
    private $address;

    /**
     * @var Film
     *
     * @ORM\ManyToOne(targetEntity="FilmContactPerson", inversedBy="contacts", cascade={"persist"})
     */
    private $person;
    
    /**
     * @var FilmFilm
     *
     * @ORM\ManyToMany(targetEntity="FilmFilm", mappedBy="contacts")
     */ 
    private $films;
    
    /**
     * @ORM\ManyToMany(targetEntity="FilmContact")
     */
    private $subordinates;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->subordinates = new ArrayCollection();
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return FilmContact
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
     * Set companyName
     *
     * @param string $companyName
     * @return FilmContact
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * Get companyName
     *
     * @return string 
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return FilmContact
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
     * Set address
     *
     * @param \FDC\CoreBundle\Entity\FilmAddress $address
     * @return FilmContact
     */
    public function setAddress(\FDC\CoreBundle\Entity\FilmAddress $address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return \FDC\CoreBundle\Entity\FilmAddress 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set person
     *
     * @param \FDC\CoreBundle\Entity\FilmContactPerson $person
     * @return FilmContact
     */
    public function setPerson(\FDC\CoreBundle\Entity\FilmContactPerson $person = null)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return \FDC\CoreBundle\Entity\FilmContactPerson 
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Add subordinates
     *
     * @param \FDC\CoreBundle\Entity\FilmFilmContact $subordinates
     * @return FilmContact
     */
    public function addSubordinate(\FDC\CoreBundle\Entity\FilmFilmContact $subordinates)
    {
        $this->subordinates[] = $subordinates;

        return $this;
    }

    /**
     * Remove subordinates
     *
     * @param \FDC\CoreBundle\Entity\FilmFilmContact $subordinates
     */
    public function removeSubordinate(\FDC\CoreBundle\Entity\FilmFilmContact $subordinates)
    {
        $this->subordinates->removeElement($subordinates);
    }

    /**
     * Get subordinates
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSubordinates()
    {
        return $this->subordinates;
    }

    /**
     * Add films
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $films
     * @return FilmContact
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
}
