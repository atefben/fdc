<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\TranslationByLocale;
use Base\CoreBundle\Util\Time;

/**
 * FilmAddress
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmAddress
{
    use Translatable;
    use TranslationByLocale;
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $postalCode;

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
    private $fax;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
     private $street;
     
     /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
     private $website;
     
     /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
     private $mobilePhone;
     
     /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
     private $phone;
     
     /**
      * @var string
      *
      * @ORM\Column(type="string", nullable=true)
      */
     private $city;

    /**
     * @var Country
     *
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="addresses")
     */
    private $country;

    /**
     * @ORM\OneToMany(targetEntity="FilmContact", mappedBy="address")
     */
    private $contacts;
    
    /**
     * @ORM\OneToMany(targetEntity="FilmPerson", mappedBy="address")
     */
    private $persons;
     
    /**
     * @ORM\OneToMany(targetEntity="FilmAddressSchool", mappedBy="address")
     */
    private $schoolsFilms;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->persons = new ArrayCollection();
        $this->schoolsFilms = new ArrayCollection();
        $this->contacts = new ArrayCollection();
        $this->translations = new ArrayCollection();
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
     * Set postalCode
     *
     * @param string $postalCode
     * @return FilmAddress
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return string 
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return FilmAddress
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
     * Set fax
     *
     * @param string $fax
     * @return FilmAddress
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string 
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set street
     *
     * @param string $street
     * @return FilmAddress
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string 
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set website
     *
     * @param string $website
     * @return FilmAddress
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set mobilePhone
     *
     * @param string $mobilePhone
     * @return FilmAddress
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
     * Set phone
     *
     * @param string $phone
     * @return FilmAddress
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return FilmAddress
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set country
     *
     * @param \Base\CoreBundle\Entity\Country $country
     * @return FilmAddress
     */
    public function setCountry(\Base\CoreBundle\Entity\Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \Base\CoreBundle\Entity\Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Add persons
     *
     * @param \Base\CoreBundle\Entity\FilmPerson $persons
     * @return FilmAddress
     */
    public function addPerson(\Base\CoreBundle\Entity\FilmPerson $persons)
    {
        $this->persons[] = $persons;

        return $this;
    }

    /**
     * Remove persons
     *
     * @param \Base\CoreBundle\Entity\FilmPerson $persons
     */
    public function removePerson(\Base\CoreBundle\Entity\FilmPerson $persons)
    {
        $this->persons->removeElement($persons);
    }

    /**
     * Get persons
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPersons()
    {
        return $this->persons;
    }

    /**
     * Add schoolsFilms
     *
     * @param \Base\CoreBundle\Entity\FilmAddressSchool $schoolsFilms
     * @return FilmAddress
     */
    public function addSchoolsFilm(\Base\CoreBundle\Entity\FilmAddressSchool $schoolsFilms)
    {
        if ($this->schoolsFilms->contains($schoolsFilms)) {
            return;
        }
        
        $this->schoolsFilms[] = $schoolsFilms;

        return $this;
    }

    /**
     * Remove schoolsFilms
     *
     * @param \Base\CoreBundle\Entity\FilmAddressSchool $schoolsFilms
     */
    public function removeSchoolsFilm(\Base\CoreBundle\Entity\FilmAddressSchool $schoolsFilms)
    {
        if (!$this->schoolsFilms->contains($schoolsFilms)) {
            return;
        }

        $this->schoolsFilms->removeElement($schoolsFilms);
    }

    /**
     * Get schoolsFilms
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSchoolsFilms()
    {
        return $this->schoolsFilms;
    }

    /**
     * Add contacts
     *
     * @param \Base\CoreBundle\Entity\FilmContact $contacts
     * @return FilmAddress
     */
    public function addContact(\Base\CoreBundle\Entity\FilmContact $contacts)
    {
        if ($this->contacts->contains($contacts)) {
            return;
        }

        $this->contacts[] = $contacts;

        return $this;
    }

    /**
     * Remove contacts
     *
     * @param \Base\CoreBundle\Entity\FilmFilm $contacts
     */
    public function removeContact(\Base\CoreBundle\Entity\FilmContact $contacts)
    {
        if (!$this->contacts->contains($contacts)) {
            return;
        }
        
        $this->contacts->removeElement($contacts);
    }

    /**
     * Get contacts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContacts()
    {
        return $this->contacts;
    }
}
