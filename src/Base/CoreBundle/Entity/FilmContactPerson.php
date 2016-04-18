<?php

namespace Base\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

use JMS\Serializer\Annotation\Groups;

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
     * @Groups({"film_show"})
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"film_show"})
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"film_show"})
     */
    private $lastname;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"film_show"})
     */
    private $mobilePhone;
    
    /**
     * @ORM\ManyToMany(targetEntity="FilmContactPerson", cascade={"persist"})
     * @Groups({"film_show"})
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
     * @param \Base\CoreBundle\Entity\FilmContactPerson $subordinates
     * @return FilmContactPerson
     */
    public function addSubordinate(\Base\CoreBundle\Entity\FilmContactPerson $subordinates)
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
     * @param \Base\CoreBundle\Entity\FilmContactPerson $subordinates
     */
    public function removeSubordinate(\Base\CoreBundle\Entity\FilmContactPerson $subordinates)
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
}
