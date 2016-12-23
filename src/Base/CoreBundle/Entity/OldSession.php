<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldSession
 *
 * @ORM\Table(name="old_session")
 * @ORM\Entity
 */
class OldSession
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
     * @ORM\Column(name="numsession", type="integer", nullable=false)
     */
    protected $numsession;

    /**
     * @var integer
     *
     * @ORM\Column(name="annee", type="integer", nullable=false)
     */
    protected $annee;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_deb", type="datetime", nullable=true)
     */
    protected $dateDeb;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="datetime", nullable=true)
     */
    protected $dateFin;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_online", type="boolean", nullable=true)
     */
    protected $isOnline;

    /**
     * @var string
     *
     * @ORM\Column(name="president", type="string", length=255, nullable=true)
     */
    protected $president;



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
     * Set numsession
     *
     * @param integer $numsession
     * @return OldSession
     */
    public function setNumsession($numsession)
    {
        $this->numsession = $numsession;

        return $this;
    }

    /**
     * Get numsession
     *
     * @return integer 
     */
    public function getNumsession()
    {
        return $this->numsession;
    }

    /**
     * Set annee
     *
     * @param integer $annee
     * @return OldSession
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Get annee
     *
     * @return integer 
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Set dateDeb
     *
     * @param \DateTime $dateDeb
     * @return OldSession
     */
    public function setDateDeb($dateDeb)
    {
        $this->dateDeb = $dateDeb;

        return $this;
    }

    /**
     * Get dateDeb
     *
     * @return \DateTime 
     */
    public function getDateDeb()
    {
        return $this->dateDeb;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     * @return OldSession
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime 
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set isOnline
     *
     * @param boolean $isOnline
     * @return OldSession
     */
    public function setIsOnline($isOnline)
    {
        $this->isOnline = $isOnline;

        return $this;
    }

    /**
     * Get isOnline
     *
     * @return boolean 
     */
    public function getIsOnline()
    {
        return $this->isOnline;
    }

    /**
     * Set president
     *
     * @param string $president
     * @return OldSession
     */
    public function setPresident($president)
    {
        $this->president = $president;

        return $this;
    }

    /**
     * Get president
     *
     * @return string 
     */
    public function getPresident()
    {
        return $this->president;
    }
}
