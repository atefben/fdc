<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldCannesSurvey
 *
 * @ORM\Table(name="old_cannes_survey", uniqueConstraints={@ORM\UniqueConstraint(name="md5", columns={"md5"})})
 * @ORM\Entity
 */
class OldCannesSurvey
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="md5", type="string", length=250, nullable=false)
     */
    private $md5;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=250, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="init_language", type="string", length=50, nullable=false)
     */
    private $initLanguage;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=250, nullable=true)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=250, nullable=true)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="req_language", type="string", length=50, nullable=true)
     */
    private $reqLanguage;

    /**
     * @var boolean
     *
     * @ORM\Column(name="pro_accredite", type="boolean", nullable=false)
     */
    private $proAccredite;

    /**
     * @var string
     *
     * @ORM\Column(name="pro_profile", type="string", length=250, nullable=true)
     */
    private $proProfile;

    /**
     * @var boolean
     *
     * @ORM\Column(name="pro_is_present", type="boolean", nullable=false)
     */
    private $proIsPresent;

    /**
     * @var string
     *
     * @ORM\Column(name="pro_nbdays", type="string", length=250, nullable=true)
     */
    private $proNbdays;

    /**
     * @var boolean
     *
     * @ORM\Column(name="pro_cinema", type="boolean", nullable=true)
     */
    private $proCinema;

    /**
     * @var string
     *
     * @ORM\Column(name="company", type="string", length=250, nullable=true)
     */
    private $company;

    /**
     * @var boolean
     *
     * @ORM\Column(name="smartphone_owner", type="boolean", nullable=true)
     */
    private $smartphoneOwner;

    /**
     * @var string
     *
     * @ORM\Column(name="smartphone", type="string", length=250, nullable=true)
     */
    private $smartphone;

    /**
     * @var boolean
     *
     * @ORM\Column(name="mobile_newsletter", type="boolean", nullable=true)
     */
    private $mobileNewsletter;

    /**
     * @var boolean
     *
     * @ORM\Column(name="mobile_pushmail", type="boolean", nullable=true)
     */
    private $mobilePushmail;

    /**
     * @var string
     *
     * @ORM\Column(name="mobile_howmanypush", type="string", length=5, nullable=true)
     */
    private $mobileHowmanypush;

    /**
     * @var string
     *
     * @ORM\Column(name="mobile_pushtype", type="string", length=250, nullable=true)
     */
    private $mobilePushtype;

    /**
     * @var string
     *
     * @ORM\Column(name="mobile_number", type="string", length=50, nullable=true)
     */
    private $mobileNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="read_festival_content", type="string", length=10, nullable=true)
     */
    private $readFestivalContent;

    /**
     * @var boolean
     *
     * @ORM\Column(name="read_off_content", type="boolean", nullable=true)
     */
    private $readOffContent;

    /**
     * @var string
     *
     * @ORM\Column(name="read_contenttype", type="string", length=250, nullable=true)
     */
    private $readContenttype;

    /**
     * @var string
     *
     * @ORM\Column(name="wishes", type="string", length=250, nullable=true)
     */
    private $wishes;



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
     * Set md5
     *
     * @param string $md5
     * @return OldCannesSurvey
     */
    public function setMd5($md5)
    {
        $this->md5 = $md5;

        return $this;
    }

    /**
     * Get md5
     *
     * @return string 
     */
    public function getMd5()
    {
        return $this->md5;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return OldCannesSurvey
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
     * Set initLanguage
     *
     * @param string $initLanguage
     * @return OldCannesSurvey
     */
    public function setInitLanguage($initLanguage)
    {
        $this->initLanguage = $initLanguage;

        return $this;
    }

    /**
     * Get initLanguage
     *
     * @return string 
     */
    public function getInitLanguage()
    {
        return $this->initLanguage;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return OldCannesSurvey
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
     * @return OldCannesSurvey
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
     * Set reqLanguage
     *
     * @param string $reqLanguage
     * @return OldCannesSurvey
     */
    public function setReqLanguage($reqLanguage)
    {
        $this->reqLanguage = $reqLanguage;

        return $this;
    }

    /**
     * Get reqLanguage
     *
     * @return string 
     */
    public function getReqLanguage()
    {
        return $this->reqLanguage;
    }

    /**
     * Set proAccredite
     *
     * @param boolean $proAccredite
     * @return OldCannesSurvey
     */
    public function setProAccredite($proAccredite)
    {
        $this->proAccredite = $proAccredite;

        return $this;
    }

    /**
     * Get proAccredite
     *
     * @return boolean 
     */
    public function getProAccredite()
    {
        return $this->proAccredite;
    }

    /**
     * Set proProfile
     *
     * @param string $proProfile
     * @return OldCannesSurvey
     */
    public function setProProfile($proProfile)
    {
        $this->proProfile = $proProfile;

        return $this;
    }

    /**
     * Get proProfile
     *
     * @return string 
     */
    public function getProProfile()
    {
        return $this->proProfile;
    }

    /**
     * Set proIsPresent
     *
     * @param boolean $proIsPresent
     * @return OldCannesSurvey
     */
    public function setProIsPresent($proIsPresent)
    {
        $this->proIsPresent = $proIsPresent;

        return $this;
    }

    /**
     * Get proIsPresent
     *
     * @return boolean 
     */
    public function getProIsPresent()
    {
        return $this->proIsPresent;
    }

    /**
     * Set proNbdays
     *
     * @param string $proNbdays
     * @return OldCannesSurvey
     */
    public function setProNbdays($proNbdays)
    {
        $this->proNbdays = $proNbdays;

        return $this;
    }

    /**
     * Get proNbdays
     *
     * @return string 
     */
    public function getProNbdays()
    {
        return $this->proNbdays;
    }

    /**
     * Set proCinema
     *
     * @param boolean $proCinema
     * @return OldCannesSurvey
     */
    public function setProCinema($proCinema)
    {
        $this->proCinema = $proCinema;

        return $this;
    }

    /**
     * Get proCinema
     *
     * @return boolean 
     */
    public function getProCinema()
    {
        return $this->proCinema;
    }

    /**
     * Set company
     *
     * @param string $company
     * @return OldCannesSurvey
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string 
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set smartphoneOwner
     *
     * @param boolean $smartphoneOwner
     * @return OldCannesSurvey
     */
    public function setSmartphoneOwner($smartphoneOwner)
    {
        $this->smartphoneOwner = $smartphoneOwner;

        return $this;
    }

    /**
     * Get smartphoneOwner
     *
     * @return boolean 
     */
    public function getSmartphoneOwner()
    {
        return $this->smartphoneOwner;
    }

    /**
     * Set smartphone
     *
     * @param string $smartphone
     * @return OldCannesSurvey
     */
    public function setSmartphone($smartphone)
    {
        $this->smartphone = $smartphone;

        return $this;
    }

    /**
     * Get smartphone
     *
     * @return string 
     */
    public function getSmartphone()
    {
        return $this->smartphone;
    }

    /**
     * Set mobileNewsletter
     *
     * @param boolean $mobileNewsletter
     * @return OldCannesSurvey
     */
    public function setMobileNewsletter($mobileNewsletter)
    {
        $this->mobileNewsletter = $mobileNewsletter;

        return $this;
    }

    /**
     * Get mobileNewsletter
     *
     * @return boolean 
     */
    public function getMobileNewsletter()
    {
        return $this->mobileNewsletter;
    }

    /**
     * Set mobilePushmail
     *
     * @param boolean $mobilePushmail
     * @return OldCannesSurvey
     */
    public function setMobilePushmail($mobilePushmail)
    {
        $this->mobilePushmail = $mobilePushmail;

        return $this;
    }

    /**
     * Get mobilePushmail
     *
     * @return boolean 
     */
    public function getMobilePushmail()
    {
        return $this->mobilePushmail;
    }

    /**
     * Set mobileHowmanypush
     *
     * @param string $mobileHowmanypush
     * @return OldCannesSurvey
     */
    public function setMobileHowmanypush($mobileHowmanypush)
    {
        $this->mobileHowmanypush = $mobileHowmanypush;

        return $this;
    }

    /**
     * Get mobileHowmanypush
     *
     * @return string 
     */
    public function getMobileHowmanypush()
    {
        return $this->mobileHowmanypush;
    }

    /**
     * Set mobilePushtype
     *
     * @param string $mobilePushtype
     * @return OldCannesSurvey
     */
    public function setMobilePushtype($mobilePushtype)
    {
        $this->mobilePushtype = $mobilePushtype;

        return $this;
    }

    /**
     * Get mobilePushtype
     *
     * @return string 
     */
    public function getMobilePushtype()
    {
        return $this->mobilePushtype;
    }

    /**
     * Set mobileNumber
     *
     * @param string $mobileNumber
     * @return OldCannesSurvey
     */
    public function setMobileNumber($mobileNumber)
    {
        $this->mobileNumber = $mobileNumber;

        return $this;
    }

    /**
     * Get mobileNumber
     *
     * @return string 
     */
    public function getMobileNumber()
    {
        return $this->mobileNumber;
    }

    /**
     * Set readFestivalContent
     *
     * @param string $readFestivalContent
     * @return OldCannesSurvey
     */
    public function setReadFestivalContent($readFestivalContent)
    {
        $this->readFestivalContent = $readFestivalContent;

        return $this;
    }

    /**
     * Get readFestivalContent
     *
     * @return string 
     */
    public function getReadFestivalContent()
    {
        return $this->readFestivalContent;
    }

    /**
     * Set readOffContent
     *
     * @param boolean $readOffContent
     * @return OldCannesSurvey
     */
    public function setReadOffContent($readOffContent)
    {
        $this->readOffContent = $readOffContent;

        return $this;
    }

    /**
     * Get readOffContent
     *
     * @return boolean 
     */
    public function getReadOffContent()
    {
        return $this->readOffContent;
    }

    /**
     * Set readContenttype
     *
     * @param string $readContenttype
     * @return OldCannesSurvey
     */
    public function setReadContenttype($readContenttype)
    {
        $this->readContenttype = $readContenttype;

        return $this;
    }

    /**
     * Get readContenttype
     *
     * @return string 
     */
    public function getReadContenttype()
    {
        return $this->readContenttype;
    }

    /**
     * Set wishes
     *
     * @param string $wishes
     * @return OldCannesSurvey
     */
    public function setWishes($wishes)
    {
        $this->wishes = $wishes;

        return $this;
    }

    /**
     * Get wishes
     *
     * @return string 
     */
    public function getWishes()
    {
        return $this->wishes;
    }
}
