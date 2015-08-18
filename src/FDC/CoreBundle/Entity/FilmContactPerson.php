<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * FilmContactPerson
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmContactPerson
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
     * @ORM\Column(type="string", nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $lastname;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $mobilePhone;
    
    /**
     * @ORM\ManyToMany(targetEntity="FilmContactPerson", cascade={"persist"})
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
     * @return FilmContactPerson
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
     * Set email
     *
     * @param string $email
     * @return FilmContactPerson
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return FilmContactPerson
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return FilmContactPerson
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set mobilePhone
     *
     * @param string $mobilePhone
     * @return FilmContactPerson
     */
    public function setMobilePhone($mobilePhone)
    {
        $this->mobilePhone = $mobilePhone;

        return $this;
    }

    /**
     * Get mobilePhone
     *
     * @return string 
     */
    public function getMobilePhone()
    {
        return $this->mobilePhone;
    }

    /**
     * Add subordinates
     *
     * @param \FDC\CoreBundle\Entity\FilmContactPerson $subordinates
     * @return FilmContactPerson
     */
    public function addSubordinate(\FDC\CoreBundle\Entity\FilmContactPerson $subordinates)
    {
        $this->subordinates[] = $subordinates;

        return $this;
    }

    /**
     * Remove subordinates
     *
     * @param \FDC\CoreBundle\Entity\FilmContactPerson $subordinates
     */
    public function removeSubordinate(\FDC\CoreBundle\Entity\FilmContactPerson $subordinates)
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
}
