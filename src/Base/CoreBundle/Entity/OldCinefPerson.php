<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldCinefPerson
 *
 * @ORM\Table(name="old_cinef_person", indexes={@ORM\Index(name="IDX_905D60B5217BBB47", columns={"person_id"}), @ORM\Index(name="IDX_905D60B5613FECDF", columns={"session_id"})})
 * @ORM\Entity
 */
class OldCinefPerson
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="person_id", type="integer", nullable=true)
     */
    protected $personId;

    /**
     * @var integer
     *
     * @ORM\Column(name="session_id", type="integer", nullable=true)
     */
    protected $sessionId;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=20, nullable=true)
     */
    protected $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=60, nullable=true)
     */
    protected $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=60, nullable=true)
     */
    protected $firstName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="reception_date", type="datetime", nullable=true)
     */
    protected $receptionDate;

    /**
     * @var string
     *
     * @ORM\Column(name="duration", type="decimal", precision=5, scale=2, nullable=true)
     */
    protected $duration;

    /**
     * @var string
     *
     * @ORM\Column(name="internet", type="string", length=1, nullable=true)
     */
    protected $internet;

    /**
     * @var string
     *
     * @ORM\Column(name="selection", type="string", length=1, nullable=true)
     */
    protected $selection;

    /**
     * @var string
     *
     * @ORM\Column(name="bio_film_vf", type="string", length=1, nullable=true)
     */
    protected $bioFilmVf;

    /**
     * @var string
     *
     * @ORM\Column(name="bio_film_va", type="string", length=1, nullable=true)
     */
    protected $bioFilmVa;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    protected $updatedAt;



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
     * Set personId
     *
     * @param integer $personId
     * @return OldCinefPerson
     */
    public function setPersonId($personId)
    {
        $this->personId = $personId;

        return $this;
    }

    /**
     * Get personId
     *
     * @return integer 
     */
    public function getPersonId()
    {
        return $this->personId;
    }

    /**
     * Set sessionId
     *
     * @param integer $sessionId
     * @return OldCinefPerson
     */
    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;

        return $this;
    }

    /**
     * Get sessionId
     *
     * @return integer 
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * Set gender
     *
     * @param string $gender
     * @return OldCinefPerson
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
     * @return OldCinefPerson
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
     * @return OldCinefPerson
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
     * @return OldCinefPerson
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
     * @return OldCinefPerson
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
     * @return OldCinefPerson
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
     * @return OldCinefPerson
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
     * @return OldCinefPerson
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
     * @return OldCinefPerson
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return OldCinefPerson
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
     * @return OldCinefPerson
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
}
