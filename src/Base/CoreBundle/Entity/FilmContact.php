<?php

namespace Base\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

use JMS\Serializer\Annotation\Groups;

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
     * @Groups({"film_show"})
     */
    private $companyName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"film_show"})
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"film_show"})
     */
    private $position;

    /**
     * @var FilmAddress
     * @ORM\ManyToOne(targetEntity="FilmAddress", inversedBy="contacts", cascade={"persist"})
     * @Groups({"film_show"})
     */
    private $address;

    /**
     * @var FilmContactPerson
     *
     * @ORM\ManyToOne(targetEntity="FilmContactPerson", cascade={"persist"})
     * @Groups({"film_show"})
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
     * @Groups({"film_show"})
     * @ORM\OrderBy({"position"="asc"})
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
     * @param \Base\CoreBundle\Entity\FilmAddress $address
     * @return FilmContact
     */
    public function setAddress(\Base\CoreBundle\Entity\FilmAddress $address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return \Base\CoreBundle\Entity\FilmAddress
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set person
     *
     * @param \Base\CoreBundle\Entity\FilmContactPerson $person
     * @return FilmContact
     */
    public function setPerson(\Base\CoreBundle\Entity\FilmContactPerson $person = null)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return \Base\CoreBundle\Entity\FilmContactPerson
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Add subordinates
     *
     * @param \Base\CoreBundle\Entity\FilmContact $subordinates
     * @return FilmContact
     */
    public function addSubordinate(\Base\CoreBundle\Entity\FilmContact $subordinates)
    {
        if ($this->subordinates->contains($subordinates)) {
            return;
        }
        
        $this->subordinates[] = $subordinates;

        return $this;
    }

    /**
     * Remove subordinates
     *
     * @param \Base\CoreBundle\Entity\FilmContact $subordinates
     */
    public function removeSubordinate(\Base\CoreBundle\Entity\FilmContact $subordinates)
    {
        if (!$this->subordinates->contains($subordinates)) {
            return;
        }
        
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
     * @param \Base\CoreBundle\Entity\FilmFilm $films
     * @return FilmContact
     */
    public function addFilm(\Base\CoreBundle\Entity\FilmFilm $films)
    {
        if ($this->films->contains($films)) {
            return;
        }

        $this->films[] = $films;

        return $this;
    }

    /**
     * Remove films
     *
     * @param \Base\CoreBundle\Entity\FilmFilm $films
     */
    public function removeFilm(\Base\CoreBundle\Entity\FilmFilm $films)
    {
        if (!$this->films->contains($films)) {
            return;
        }

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
     * Set position
     *
     * @param integer $position
     * @return FilmContact
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
}
