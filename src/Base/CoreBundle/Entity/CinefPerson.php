<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * CinefPersonne
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class CinefPerson
{
    
    use Time;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FilmPerson", inversedBy="cinefPersons")
     */
    private $person;
    
    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="CinefSession", inversedBy="cinefPersons")
     */
    private $session;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $firstName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $receptionDate;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=5, scale=2, nullable=true)
     */
    private $duration;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $internet;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $selection;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $bioFilmVf;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $bioFilmVa;
    
    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FilmMedia", mappedBy="cinefPerson")
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set gender
     *
     * @param string $gender
     * @return CinefPerson
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string 
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return CinefPerson
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return CinefPerson
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set receptionDate
     *
     * @param \DateTime $receptionDate
     * @return CinefPerson
     */
    public function setReceptionDate($receptionDate)
    {
        $this->receptionDate = $receptionDate;

        return $this;
    }

    /**
     * Get receptionDate
     *
     * @return \DateTime 
     */
    public function getReceptionDate()
    {
        return $this->receptionDate;
    }

    /**
     * Set duration
     *
     * @param string $duration
     * @return CinefPerson
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return string 
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set internet
     *
     * @param string $internet
     * @return CinefPerson
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
     * Set selection
     *
     * @param string $selection
     * @return CinefPerson
     */
    public function setSelection($selection)
    {
        $this->selection = $selection;

        return $this;
    }

    /**
     * Get selection
     *
     * @return string 
     */
    public function getSelection()
    {
        return $this->selection;
    }

    /**
     * Set bioFilmVf
     *
     * @param string $bioFilmVf
     * @return CinefPerson
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
     * @return CinefPerson
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
     * Set person
     *
     * @param \Base\CoreBundle\Entity\FilmPerson $person
     * @return CinefPerson
     */
    public function setPerson(\Base\CoreBundle\Entity\FilmPerson $person = null)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return \Base\CoreBundle\Entity\FilmPerson
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Set session
     *
     * @param \Base\CoreBundle\Entity\CinefSession $session
     * @return CinefPerson
     */
    public function setSession(\Base\CoreBundle\Entity\CinefSession $session = null)
    {
        $this->session = $session;

        return $this;
    }

    /**
     * Get session
     *
     * @return \Base\CoreBundle\Entity\CinefSession
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Add medias
     *
     * @param \Base\CoreBundle\Entity\FilmMedia $medias
     * @return CinefPerson
     */
    public function addMedia(\Base\CoreBundle\Entity\FilmMedia $medias)
    {
        $this->medias[] = $medias;

        return $this;
    }

    /**
     * Remove medias
     *
     * @param \Base\CoreBundle\Entity\FilmMedia $medias
     */
    public function removeMedia(\Base\CoreBundle\Entity\FilmMedia $medias)
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
