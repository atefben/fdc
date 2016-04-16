<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Util\Time;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * FilmAtelierProductionCompanyAddress
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmAtelierProductionCompanyAddress implements TranslateMainInterface
{
    use Translatable;
    use TranslateMain;
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
     * @ORM\ManyToOne(targetEntity="Country")
     */
    private $country;

    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * Constructor
     */
    public function __construct()
    {
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
     * @return FilmAtelierProductionCompanyAddress
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
     * @return FilmAtelierProductionCompanyAddress
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
     * @return FilmAtelierProductionCompanyAddress
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
     * @return FilmAtelierProductionCompanyAddress
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
     * @return FilmAtelierProductionCompanyAddress
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
     * @return FilmAtelierProductionCompanyAddress
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
     * @return FilmAtelierProductionCompanyAddress
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
     * @return FilmAtelierProductionCompanyAddress
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
     * @return FilmAtelierProductionCompanyAddress
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
}
