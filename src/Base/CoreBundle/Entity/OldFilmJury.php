<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldFilmJury
 *
 * @ORM\Table(name="old_FILM_JURY", indexes={@ORM\Index(name="INDFJURYIDPERSONNE", columns={"IDPERSONNE"}), @ORM\Index(name="IDFESTIVAL", columns={"IDFESTIVAL"}), @ORM\Index(name="TYPEJURY", columns={"TYPEJURY"}), @ORM\Index(name="FONCTION_VF", columns={"FONCTION_VF"}), @ORM\Index(name="FONCTION_VA", columns={"FONCTION_VA"}), @ORM\Index(name="CLEDETRI", columns={"CLEDETRI"}), @ORM\Index(name="DATEMODIFICATION", columns={"DATEMODIFICATION"}), @ORM\Index(name="IDTYPEJURY", columns={"IDTYPEJURY"}), @ORM\Index(name="IDFONCTIONJURY", columns={"IDFONCTIONJURY"})})
 * @ORM\Entity
 */
class OldFilmJury
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDJURY", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idjury;

    /**
     * @var string
     *
     * @ORM\Column(name="IDFESTIVAL", type="decimal", precision=22, scale=0, nullable=true)
     */
    protected $idfestival;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDPERSONNE", type="integer", nullable=true)
     */
    protected $idpersonne;

    /**
     * @var string
     *
     * @ORM\Column(name="TYPEJURY", type="string", length=30, nullable=true)
     */
    protected $typejury;

    /**
     * @var string
     *
     * @ORM\Column(name="FONCTION_VF", type="string", length=50, nullable=true)
     */
    protected $fonctionVf;

    /**
     * @var string
     *
     * @ORM\Column(name="FONCTION_VA", type="string", length=50, nullable=true)
     */
    protected $fonctionVa;

    /**
     * @var string
     *
     * @ORM\Column(name="CLEDETRI", type="decimal", precision=22, scale=0, nullable=true)
     */
    protected $cledetri;

    /**
     * @var string
     *
     * @ORM\Column(name="BIO_FILMO_VF", type="text", nullable=true)
     */
    protected $bioFilmoVf;

    /**
     * @var string
     *
     * @ORM\Column(name="BIO_FILMO_VA", type="text", nullable=true)
     */
    protected $bioFilmoVa;

    /**
     * @var string
     *
     * @ORM\Column(name="BIO_FILMO_VF2", type="text", nullable=true)
     */
    protected $bioFilmoVf2;

    /**
     * @var string
     *
     * @ORM\Column(name="BIO_FILMO_VA2", type="text", nullable=true)
     */
    protected $bioFilmoVa2;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATECREATION", type="datetime", nullable=true)
     */
    protected $datecreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATEMODIFICATION", type="datetime", nullable=true)
     */
    protected $datemodification;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDTYPEJURY", type="integer", nullable=true)
     */
    protected $idtypejury;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFONCTIONJURY", type="integer", nullable=true)
     */
    protected $idfonctionjury;



    /**
     * Get idjury
     *
     * @return integer 
     */
    public function getIdjury()
    {
        return $this->idjury;
    }

    /**
     * Set idfestival
     *
     * @param string $idfestival
     * @return OldFilmJury
     */
    public function setIdfestival($idfestival)
    {
        $this->idfestival = $idfestival;

        return $this;
    }

    /**
     * Get idfestival
     *
     * @return string 
     */
    public function getIdfestival()
    {
        return $this->idfestival;
    }

    /**
     * Set idpersonne
     *
     * @param integer $idpersonne
     * @return OldFilmJury
     */
    public function setIdpersonne($idpersonne)
    {
        $this->idpersonne = $idpersonne;

        return $this;
    }

    /**
     * Get idpersonne
     *
     * @return integer 
     */
    public function getIdpersonne()
    {
        return $this->idpersonne;
    }

    /**
     * Set typejury
     *
     * @param string $typejury
     * @return OldFilmJury
     */
    public function setTypejury($typejury)
    {
        $this->typejury = $typejury;

        return $this;
    }

    /**
     * Get typejury
     *
     * @return string 
     */
    public function getTypejury()
    {
        return $this->typejury;
    }

    /**
     * Set fonctionVf
     *
     * @param string $fonctionVf
     * @return OldFilmJury
     */
    public function setFonctionVf($fonctionVf)
    {
        $this->fonctionVf = $fonctionVf;

        return $this;
    }

    /**
     * Get fonctionVf
     *
     * @return string 
     */
    public function getFonctionVf()
    {
        return $this->fonctionVf;
    }

    /**
     * Set fonctionVa
     *
     * @param string $fonctionVa
     * @return OldFilmJury
     */
    public function setFonctionVa($fonctionVa)
    {
        $this->fonctionVa = $fonctionVa;

        return $this;
    }

    /**
     * Get fonctionVa
     *
     * @return string 
     */
    public function getFonctionVa()
    {
        return $this->fonctionVa;
    }

    /**
     * Set cledetri
     *
     * @param string $cledetri
     * @return OldFilmJury
     */
    public function setCledetri($cledetri)
    {
        $this->cledetri = $cledetri;

        return $this;
    }

    /**
     * Get cledetri
     *
     * @return string 
     */
    public function getCledetri()
    {
        return $this->cledetri;
    }

    /**
     * Set bioFilmoVf
     *
     * @param string $bioFilmoVf
     * @return OldFilmJury
     */
    public function setBioFilmoVf($bioFilmoVf)
    {
        $this->bioFilmoVf = $bioFilmoVf;

        return $this;
    }

    /**
     * Get bioFilmoVf
     *
     * @return string 
     */
    public function getBioFilmoVf()
    {
        return $this->bioFilmoVf;
    }

    /**
     * Set bioFilmoVa
     *
     * @param string $bioFilmoVa
     * @return OldFilmJury
     */
    public function setBioFilmoVa($bioFilmoVa)
    {
        $this->bioFilmoVa = $bioFilmoVa;

        return $this;
    }

    /**
     * Get bioFilmoVa
     *
     * @return string 
     */
    public function getBioFilmoVa()
    {
        return $this->bioFilmoVa;
    }

    /**
     * Set bioFilmoVf2
     *
     * @param string $bioFilmoVf2
     * @return OldFilmJury
     */
    public function setBioFilmoVf2($bioFilmoVf2)
    {
        $this->bioFilmoVf2 = $bioFilmoVf2;

        return $this;
    }

    /**
     * Get bioFilmoVf2
     *
     * @return string 
     */
    public function getBioFilmoVf2()
    {
        return $this->bioFilmoVf2;
    }

    /**
     * Set bioFilmoVa2
     *
     * @param string $bioFilmoVa2
     * @return OldFilmJury
     */
    public function setBioFilmoVa2($bioFilmoVa2)
    {
        $this->bioFilmoVa2 = $bioFilmoVa2;

        return $this;
    }

    /**
     * Get bioFilmoVa2
     *
     * @return string 
     */
    public function getBioFilmoVa2()
    {
        return $this->bioFilmoVa2;
    }

    /**
     * Set datecreation
     *
     * @param \DateTime $datecreation
     * @return OldFilmJury
     */
    public function setDatecreation($datecreation)
    {
        $this->datecreation = $datecreation;

        return $this;
    }

    /**
     * Get datecreation
     *
     * @return \DateTime 
     */
    public function getDatecreation()
    {
        return $this->datecreation;
    }

    /**
     * Set datemodification
     *
     * @param \DateTime $datemodification
     * @return OldFilmJury
     */
    public function setDatemodification($datemodification)
    {
        $this->datemodification = $datemodification;

        return $this;
    }

    /**
     * Get datemodification
     *
     * @return \DateTime 
     */
    public function getDatemodification()
    {
        return $this->datemodification;
    }

    /**
     * Set idtypejury
     *
     * @param integer $idtypejury
     * @return OldFilmJury
     */
    public function setIdtypejury($idtypejury)
    {
        $this->idtypejury = $idtypejury;

        return $this;
    }

    /**
     * Get idtypejury
     *
     * @return integer 
     */
    public function getIdtypejury()
    {
        return $this->idtypejury;
    }

    /**
     * Set idfonctionjury
     *
     * @param integer $idfonctionjury
     * @return OldFilmJury
     */
    public function setIdfonctionjury($idfonctionjury)
    {
        $this->idfonctionjury = $idfonctionjury;

        return $this;
    }

    /**
     * Get idfonctionjury
     *
     * @return integer 
     */
    public function getIdfonctionjury()
    {
        return $this->idfonctionjury;
    }
}
