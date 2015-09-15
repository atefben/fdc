<?php

namespace FDC\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Translation;
use FDC\CoreBundle\Util\Time;

/**
 * FilmAddress
 *
 * @ORM\Table(indexes={@ORM\Index(name="updated_at", columns={"updated_at"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmAddress
{
    use Translatable;
    use Translation;
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
     * @ORM\OneToMany(targetEntity="FilmFilm", mappedBy="directorAddress")
     */
    private $directorFilms;
    
    /**
     * @ORM\OneToMany(targetEntity="FilmAddressSchool", mappedBy="address")
     */
    private $schoolsFilms;

    /**
     * @ORM\OneToMany(targetEntity="FilmFilm", mappedBy="eventAddress")
     */
    private $eventFilms;

    /**
     * @ORM\OneToMany(targetEntity="FilmFilm", mappedBy="pressInternatAddress")
     */
    private $pressInternatFilms;

    /**
     * @ORM\OneToMany(targetEntity="FilmFilm", mappedBy="pressAddress")
     */
    private $pressFilms;

    /**
     * @ORM\OneToMany(targetEntity="FilmFilm", mappedBy="distributionAddress")
     */
    private $distributionFilms;

    /**
     * @ORM\OneToMany(targetEntity="FilmFilm", mappedBy="productionAddress")
     */
    private $productionFilms;

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
        $this->directorFilms = new ArrayCollection();
        $this->schoolsFilms = new ArrayCollection();
        $this->eventFilms = new ArrayCollection();
        $this->pressInternatFilms = new ArrayCollection();
        $this->pressFilms = new ArrayCollection();
        $this->distributionFilms = new ArrayCollection();
        $this->productionFilms = new ArrayCollection();
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
     * @param \FDC\CoreBundle\Entity\Country $country
     * @return FilmAddress
     */
    public function setCountry(\FDC\CoreBundle\Entity\Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \FDC\CoreBundle\Entity\Country 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Add persons
     *
     * @param \FDC\CoreBundle\Entity\FilmPerson $persons
     * @return FilmAddress
     */
    public function addPerson(\FDC\CoreBundle\Entity\FilmPerson $persons)
    {
        $this->persons[] = $persons;

        return $this;
    }

    /**
     * Remove persons
     *
     * @param \FDC\CoreBundle\Entity\FilmPerson $persons
     */
    public function removePerson(\FDC\CoreBundle\Entity\FilmPerson $persons)
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
     * Add directorFilms
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $directorFilms
     * @return FilmAddress
     */
    public function addDirectorFilm(\FDC\CoreBundle\Entity\FilmFilm $directorFilms)
    {
        $this->directorFilms[] = $directorFilms;

        return $this;
    }

    /**
     * Remove directorFilms
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $directorFilms
     */
    public function removeDirectorFilm(\FDC\CoreBundle\Entity\FilmFilm $directorFilms)
    {
        $this->directorFilms->removeElement($directorFilms);
    }

    /**
     * Get directorFilms
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDirectorFilms()
    {
        return $this->directorFilms;
    }

    /**
     * Add schoolsFilms
     *
     * @param \FDC\CoreBundle\Entity\FilmAddressSchool $schoolsFilms
     * @return FilmAddress
     */
    public function addSchoolsFilm(\FDC\CoreBundle\Entity\FilmAddressSchool $schoolsFilms)
    {
        $this->schoolsFilms[] = $schoolsFilms;

        return $this;
    }

    /**
     * Remove schoolsFilms
     *
     * @param \FDC\CoreBundle\Entity\FilmAddressSchool $schoolsFilms
     */
    public function removeSchoolsFilm(\FDC\CoreBundle\Entity\FilmAddressSchool $schoolsFilms)
    {
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
     * Add eventFilms
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $eventFilms
     * @return FilmAddress
     */
    public function addEventFilm(\FDC\CoreBundle\Entity\FilmFilm $eventFilms)
    {
        $this->eventFilms[] = $eventFilms;

        return $this;
    }

    /**
     * Remove eventFilms
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $eventFilms
     */
    public function removeEventFilm(\FDC\CoreBundle\Entity\FilmFilm $eventFilms)
    {
        $this->eventFilms->removeElement($eventFilms);
    }

    /**
     * Get eventFilms
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEventFilms()
    {
        return $this->eventFilms;
    }

    /**
     * Add pressInternatFilms
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $pressInternatFilms
     * @return FilmAddress
     */
    public function addPressInternatFilm(\FDC\CoreBundle\Entity\FilmFilm $pressInternatFilms)
    {
        $this->pressInternatFilms[] = $pressInternatFilms;

        return $this;
    }

    /**
     * Remove pressInternatFilms
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $pressInternatFilms
     */
    public function removePressInternatFilm(\FDC\CoreBundle\Entity\FilmFilm $pressInternatFilms)
    {
        $this->pressInternatFilms->removeElement($pressInternatFilms);
    }

    /**
     * Get pressInternatFilms
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPressInternatFilms()
    {
        return $this->pressInternatFilms;
    }

    /**
     * Add pressFilms
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $pressFilms
     * @return FilmAddress
     */
    public function addPressFilm(\FDC\CoreBundle\Entity\FilmFilm $pressFilms)
    {
        $this->pressFilms[] = $pressFilms;

        return $this;
    }

    /**
     * Remove pressFilms
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $pressFilms
     */
    public function removePressFilm(\FDC\CoreBundle\Entity\FilmFilm $pressFilms)
    {
        $this->pressFilms->removeElement($pressFilms);
    }

    /**
     * Get pressFilms
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPressFilms()
    {
        return $this->pressFilms;
    }

    /**
     * Add distributionFilms
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $distributionFilms
     * @return FilmAddress
     */
    public function addDistributionFilm(\FDC\CoreBundle\Entity\FilmFilm $distributionFilms)
    {
        $this->distributionFilms[] = $distributionFilms;

        return $this;
    }

    /**
     * Remove distributionFilms
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $distributionFilms
     */
    public function removeDistributionFilm(\FDC\CoreBundle\Entity\FilmFilm $distributionFilms)
    {
        $this->distributionFilms->removeElement($distributionFilms);
    }

    /**
     * Get distributionFilms
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDistributionFilms()
    {
        return $this->distributionFilms;
    }

    /**
     * Add productionFilms
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $productionFilms
     * @return FilmAddress
     */
    public function addProductionFilm(\FDC\CoreBundle\Entity\FilmFilm $productionFilms)
    {
        $this->productionFilms[] = $productionFilms;

        return $this;
    }

    /**
     * Remove productionFilms
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $productionFilms
     */
    public function removeProductionFilm(\FDC\CoreBundle\Entity\FilmFilm $productionFilms)
    {
        $this->productionFilms->removeElement($productionFilms);
    }

    /**
     * Get productionFilms
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProductionFilms()
    {
        return $this->productionFilms;
    }

    /**
     * Add contacts
     *
     * @param \FDC\CoreBundle\Entity\FilmContact $contact
     * @return FilmAddress
     */
    public function addContact(\FDC\CoreBundle\Entity\FilmContact $contact)
    {
        $this->contacts[] = $contact;

        return $this;
    }

    /**
     * Remove contacts
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $contact
     */
    public function removeContact(\FDC\CoreBundle\Entity\FilmContact $contact)
    {
        $this->contacts->removeElement($contact);
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
