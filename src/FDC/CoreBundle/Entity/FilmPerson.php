<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * FilmPerson
 *
 * @ORM\Table(indexes={@ORM\Index(name="lastname_firstname", columns={"lastname", "firstname"}), @ORM\Index(name="FILM_PERSONNE_FI_1", columns={"nationality"}), @ORM\Index(name="FILM_PERSONNE_FI_2", columns={"nationality2"}), @ORM\Index(name="updated_at", columns={"updated_at"}), @ORM\Index(name="INTERNET", columns={"internet"}), @ORM\Index(name="pm_profession_va", columns={"job_va"}), @ORM\Index(name="pm_profession_vf", columns={"job_vf"})})
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class FilmPerson
{
    use Time;

    /**
     * @var string
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $civility;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $nationality;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $nationality2;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $jobVf;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $jobVa;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $qualification;

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
     * @var string
     *
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $birthLocation;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $bioFilmVf;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $bioFilmVa;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $birthDate;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $inversionName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=false)
     */
    private $internet;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FilmFunction", inversedBy="persons")
     */
    private $function;
    
    /**
     * @ORM\ManyToOne(targetEntity="FilmAddress", inversedBy="persons")
     */
    private $address;
    
    /**
     * @var FilmAtelierGeneric
     *
     * @ORM\OneToMany(targetEntity="FilmAtelierGeneric", mappedBy="person")
     */
    private $filmAtelierGenerics;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FilmGeneric", mappedBy="person")
     */
    private $filmGenerics;

    /**
     * @ORM\OneToMany(targetEntity="FilmJury", mappedBy="person")
     */
    private $juries;

    /**
     * @ORM\OneToMany(targetEntity="FilmAward", mappedBy="person")
     */
    private $awards;

    /**
     * @ORM\OneToMany(targetEntity="FilmMedia", mappedBy="person")
     */
    private $medias;
    
    /**
     * @ORM\OneToMany(targetEntity="CinefPerson", mappedBy="person")
     */
    private $cinefPersons;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->filmAtelierGenerics = new \Doctrine\Common\Collections\ArrayCollection();
        $this->filmGenerics = new \Doctrine\Common\Collections\ArrayCollection();
        $this->juries = new \Doctrine\Common\Collections\ArrayCollection();
        $this->awards = new \Doctrine\Common\Collections\ArrayCollection();
        $this->medias = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cinefPersons = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return FilmPerson
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
     * Set civility
     *
     * @param string $civility
     * @return FilmPerson
     */
    public function setCivility($civility)
    {
        $this->civility = $civility;

        return $this;
    }

    /**
     * Get civility
     *
     * @return string 
     */
    public function getCivility()
    {
        return $this->civility;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return FilmPerson
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
     * Set firstname
     *
     * @param string $firstname
     * @return FilmPerson
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
     * Set nationality
     *
     * @param string $nationality
     * @return FilmPerson
     */
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * Get nationality
     *
     * @return string 
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * Set nationality2
     *
     * @param string $nationality2
     * @return FilmPerson
     */
    public function setNationality2($nationality2)
    {
        $this->nationality2 = $nationality2;

        return $this;
    }

    /**
     * Get nationality2
     *
     * @return string 
     */
    public function getNationality2()
    {
        return $this->nationality2;
    }

    /**
     * Set jobVf
     *
     * @param string $jobVf
     * @return FilmPerson
     */
    public function setJobVf($jobVf)
    {
        $this->jobVf = $jobVf;

        return $this;
    }

    /**
     * Get jobVf
     *
     * @return string 
     */
    public function getJobVf()
    {
        return $this->jobVf;
    }

    /**
     * Set jobVa
     *
     * @param string $jobVa
     * @return FilmPerson
     */
    public function setJobVa($jobVa)
    {
        $this->jobVa = $jobVa;

        return $this;
    }

    /**
     * Get jobVa
     *
     * @return string 
     */
    public function getJobVa()
    {
        return $this->jobVa;
    }

    /**
     * Set qualification
     *
     * @param string $qualification
     * @return FilmPerson
     */
    public function setQualification($qualification)
    {
        $this->qualification = $qualification;

        return $this;
    }

    /**
     * Get qualification
     *
     * @return string 
     */
    public function getQualification()
    {
        return $this->qualification;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return FilmPerson
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
     * @return FilmPerson
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
     * Set birthLocation
     *
     * @param string $birthLocation
     * @return FilmPerson
     */
    public function setBirthLocation($birthLocation)
    {
        $this->birthLocation = $birthLocation;

        return $this;
    }

    /**
     * Get birthLocation
     *
     * @return string 
     */
    public function getBirthLocation()
    {
        return $this->birthLocation;
    }

    /**
     * Set bioFilmVf
     *
     * @param string $bioFilmVf
     * @return FilmPerson
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
     * @return FilmPerson
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
     * Set birthDate
     *
     * @param \DateTime $birthDate
     * @return FilmPerson
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate
     *
     * @return \DateTime 
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set inversionName
     *
     * @param string $inversionName
     * @return FilmPerson
     */
    public function setInversionName($inversionName)
    {
        $this->inversionName = $inversionName;

        return $this;
    }

    /**
     * Get inversionName
     *
     * @return string 
     */
    public function getInversionName()
    {
        return $this->inversionName;
    }

    /**
     * Set internet
     *
     * @param string $internet
     * @return FilmPerson
     */
    public function setInternet($internet)
    {
        $this->internet = $internet;

        return $this;
    }

    /**
     * Get internet
     *
     * @return string 
     */
    public function getInternet()
    {
        return $this->internet;
    }

    /**
     * Set function
     *
     * @param \FDC\CoreBundle\Entity\FilmFunction $function
     * @return FilmPerson
     */
    public function setFunction(\FDC\CoreBundle\Entity\FilmFunction $function = null)
    {
        $this->function = $function;

        return $this;
    }

    /**
     * Get function
     *
     * @return \FDC\CoreBundle\Entity\FilmFunction 
     */
    public function getFunction()
    {
        return $this->function;
    }

    /**
     * Set address
     *
     * @param \FDC\CoreBundle\Entity\FilmAddress $address
     * @return FilmPerson
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
     * Add filmAtelierGenerics
     *
     * @param \FDC\CoreBundle\Entity\FilmAtelierGeneric $filmAtelierGenerics
     * @return FilmPerson
     */
    public function addFilmAtelierGeneric(\FDC\CoreBundle\Entity\FilmAtelierGeneric $filmAtelierGenerics)
    {
        $this->filmAtelierGenerics[] = $filmAtelierGenerics;

        return $this;
    }

    /**
     * Remove filmAtelierGenerics
     *
     * @param \FDC\CoreBundle\Entity\FilmAtelierGeneric $filmAtelierGenerics
     */
    public function removeFilmAtelierGeneric(\FDC\CoreBundle\Entity\FilmAtelierGeneric $filmAtelierGenerics)
    {
        $this->filmAtelierGenerics->removeElement($filmAtelierGenerics);
    }

    /**
     * Get filmAtelierGenerics
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFilmAtelierGenerics()
    {
        return $this->filmAtelierGenerics;
    }

    /**
     * Add filmGenerics
     *
     * @param \FDC\CoreBundle\Entity\FilmGeneric $filmGenerics
     * @return FilmPerson
     */
    public function addFilmGeneric(\FDC\CoreBundle\Entity\FilmGeneric $filmGenerics)
    {
        $this->filmGenerics[] = $filmGenerics;

        return $this;
    }

    /**
     * Remove filmGenerics
     *
     * @param \FDC\CoreBundle\Entity\FilmGeneric $filmGenerics
     */
    public function removeFilmGeneric(\FDC\CoreBundle\Entity\FilmGeneric $filmGenerics)
    {
        $this->filmGenerics->removeElement($filmGenerics);
    }

    /**
     * Get filmGenerics
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFilmGenerics()
    {
        return $this->filmGenerics;
    }

    /**
     * Add juries
     *
     * @param \FDC\CoreBundle\Entity\FilmJury $juries
     * @return FilmPerson
     */
    public function addJury(\FDC\CoreBundle\Entity\FilmJury $juries)
    {
        $this->juries[] = $juries;

        return $this;
    }

    /**
     * Remove juries
     *
     * @param \FDC\CoreBundle\Entity\FilmJury $juries
     */
    public function removeJury(\FDC\CoreBundle\Entity\FilmJury $juries)
    {
        $this->juries->removeElement($juries);
    }

    /**
     * Get juries
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getJuries()
    {
        return $this->juries;
    }

    /**
     * Add awards
     *
     * @param \FDC\CoreBundle\Entity\FilmAward $awards
     * @return FilmPerson
     */
    public function addAward(\FDC\CoreBundle\Entity\FilmAward $awards)
    {
        $this->awards[] = $awards;

        return $this;
    }

    /**
     * Remove awards
     *
     * @param \FDC\CoreBundle\Entity\FilmAward $awards
     */
    public function removeAward(\FDC\CoreBundle\Entity\FilmAward $awards)
    {
        $this->awards->removeElement($awards);
    }

    /**
     * Get awards
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAwards()
    {
        return $this->awards;
    }

    /**
     * Add cinefPersons
     *
     * @param \FDC\CoreBundle\Entity\CinefPerson $cinefPersons
     * @return FilmPerson
     */
    public function addCinefPerson(\FDC\CoreBundle\Entity\CinefPerson $cinefPersons)
    {
        $this->cinefPersons[] = $cinefPersons;

        return $this;
    }

    /**
     * Remove cinefPersons
     *
     * @param \FDC\CoreBundle\Entity\CinefPerson $cinefPersons
     */
    public function removeCinefPerson(\FDC\CoreBundle\Entity\CinefPerson $cinefPersons)
    {
        $this->cinefPersons->removeElement($cinefPersons);
    }

    /**
     * Get cinefPersons
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCinefPersons()
    {
        return $this->cinefPersons;
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

    /**
     * Add medias
     *
     * @param \FDC\CoreBundle\Entity\FilmMedia $medias
     * @return FilmPerson
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
