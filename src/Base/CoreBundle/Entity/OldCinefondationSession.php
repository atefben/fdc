<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldCinefondationSession
 *
 * @ORM\Table(name="old_cinefondation_session", indexes={@ORM\Index(name="pm_numsession_annee", columns={"numsession", "annee"})})
 * @ORM\Entity
 */
class OldCinefondationSession
{
    /**
     * @var integer
     *
     * @ORM\Column(name="numsession", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $numsession;

    /**
     * @var integer
     *
     * @ORM\Column(name="annee", type="smallint", nullable=false)
     */
    protected $annee;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_deb", type="date", nullable=false)
     */
    protected $dateDeb;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date", nullable=false)
     */
    protected $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="president", type="string", length=255, nullable=false)
     */
    protected $president;

    /**
     * @var string
     *
     * @ORM\Column(name="content_vf", type="text", nullable=false)
     */
    protected $contentVf;

    /**
     * @var string
     *
     * @ORM\Column(name="content_va", type="text", nullable=false)
     */
    protected $contentVa;



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
     * @return OldCinefondationSession
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
     * @return OldCinefondationSession
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
     * @return OldCinefondationSession
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
     * Set president
     *
     * @param string $president
     * @return OldCinefondationSession
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

    /**
     * Set contentVf
     *
     * @param string $contentVf
     * @return OldCinefondationSession
     */
    public function setContentVf($contentVf)
    {
        $this->contentVf = $contentVf;

        return $this;
    }

    /**
     * Get contentVf
     *
     * @return string 
     */
    public function getContentVf()
    {
        return $this->contentVf;
    }

    /**
     * Set contentVa
     *
     * @param string $contentVa
     * @return OldCinefondationSession
     */
    public function setContentVa($contentVa)
    {
        $this->contentVa = $contentVa;

        return $this;
    }

    /**
     * Get contentVa
     *
     * @return string 
     */
    public function getContentVa()
    {
        return $this->contentVa;
    }
}
