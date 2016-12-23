<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldFilmEvenement
 *
 * @ORM\Table(name="old_FILM_EVENEMENT", indexes={@ORM\Index(name="IDFESTIVAL", columns={"IDFESTIVAL"}), @ORM\Index(name="IDPERSONNE", columns={"IDPERSONNE"}), @ORM\Index(name="TYPEEVENEMENT", columns={"TYPEEVENEMENT"}), @ORM\Index(name="ORDRE", columns={"ORDRE"}), @ORM\Index(name="INTERNET", columns={"INTERNET"}), @ORM\Index(name="DATEMODIFICATION", columns={"DATEMODIFICATION"}), @ORM\Index(name="pm_dateevent", columns={"DATEEVENT", "ORDRE"})})
 * @ORM\Entity
 */
class OldFilmEvenement
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATEEVENT", type="datetime", nullable=true)
     */
    protected $dateevent;

    /**
     * @var string
     *
     * @ORM\Column(name="IDEVENEMENT", type="decimal", precision=10, scale=0, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idevenement;

    /**
     * @var string
     *
     * @ORM\Column(name="IDFESTIVAL", type="decimal", precision=22, scale=0, nullable=true)
     */
    protected $idfestival;

    /**
     * @var string
     *
     * @ORM\Column(name="TITRE_VF", type="string", length=80, nullable=true)
     */
    protected $titreVf;

    /**
     * @var string
     *
     * @ORM\Column(name="TITRE_VA", type="string", length=80, nullable=true)
     */
    protected $titreVa;

    /**
     * @var string
     *
     * @ORM\Column(name="IDPERSONNE", type="decimal", precision=22, scale=0, nullable=true)
     */
    protected $idpersonne;

    /**
     * @var string
     *
     * @ORM\Column(name="TYPEEVENEMENT", type="decimal", precision=22, scale=0, nullable=true)
     */
    protected $typeevenement;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPTION_VF", type="text", nullable=true)
     */
    protected $descriptionVf;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPTION_VA", type="text", nullable=true)
     */
    protected $descriptionVa;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPTION_VF2", type="text", nullable=true)
     */
    protected $descriptionVf2;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPTION_VA2", type="text", nullable=true)
     */
    protected $descriptionVa2;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPTION_VF3", type="text", nullable=true)
     */
    protected $descriptionVf3;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPTION_VA3", type="text", nullable=true)
     */
    protected $descriptionVa3;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPTION_VF4", type="text", nullable=true)
     */
    protected $descriptionVf4;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPTION_VA4", type="text", nullable=true)
     */
    protected $descriptionVa4;

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
     * @var string
     *
     * @ORM\Column(name="ORDRE", type="decimal", precision=22, scale=0, nullable=true)
     */
    protected $ordre;

    /**
     * @var string
     *
     * @ORM\Column(name="INTERNET", type="string", length=1, nullable=true)
     */
    protected $internet;



    /**
     * Set dateevent
     *
     * @param \DateTime $dateevent
     * @return OldFilmEvenement
     */
    public function setDateevent($dateevent)
    {
        $this->dateevent = $dateevent;

        return $this;
    }

    /**
     * Get dateevent
     *
     * @return \DateTime 
     */
    public function getDateevent()
    {
        return $this->dateevent;
    }

    /**
     * Get idevenement
     *
     * @return string 
     */
    public function getIdevenement()
    {
        return $this->idevenement;
    }

    /**
     * Set idfestival
     *
     * @param string $idfestival
     * @return OldFilmEvenement
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
     * Set titreVf
     *
     * @param string $titreVf
     * @return OldFilmEvenement
     */
    public function setTitreVf($titreVf)
    {
        $this->titreVf = $titreVf;

        return $this;
    }

    /**
     * Get titreVf
     *
     * @return string 
     */
    public function getTitreVf()
    {
        return $this->titreVf;
    }

    /**
     * Set titreVa
     *
     * @param string $titreVa
     * @return OldFilmEvenement
     */
    public function setTitreVa($titreVa)
    {
        $this->titreVa = $titreVa;

        return $this;
    }

    /**
     * Get titreVa
     *
     * @return string 
     */
    public function getTitreVa()
    {
        return $this->titreVa;
    }

    /**
     * Set idpersonne
     *
     * @param string $idpersonne
     * @return OldFilmEvenement
     */
    public function setIdpersonne($idpersonne)
    {
        $this->idpersonne = $idpersonne;

        return $this;
    }

    /**
     * Get idpersonne
     *
     * @return string 
     */
    public function getIdpersonne()
    {
        return $this->idpersonne;
    }

    /**
     * Set typeevenement
     *
     * @param string $typeevenement
     * @return OldFilmEvenement
     */
    public function setTypeevenement($typeevenement)
    {
        $this->typeevenement = $typeevenement;

        return $this;
    }

    /**
     * Get typeevenement
     *
     * @return string 
     */
    public function getTypeevenement()
    {
        return $this->typeevenement;
    }

    /**
     * Set descriptionVf
     *
     * @param string $descriptionVf
     * @return OldFilmEvenement
     */
    public function setDescriptionVf($descriptionVf)
    {
        $this->descriptionVf = $descriptionVf;

        return $this;
    }

    /**
     * Get descriptionVf
     *
     * @return string 
     */
    public function getDescriptionVf()
    {
        return $this->descriptionVf;
    }

    /**
     * Set descriptionVa
     *
     * @param string $descriptionVa
     * @return OldFilmEvenement
     */
    public function setDescriptionVa($descriptionVa)
    {
        $this->descriptionVa = $descriptionVa;

        return $this;
    }

    /**
     * Get descriptionVa
     *
     * @return string 
     */
    public function getDescriptionVa()
    {
        return $this->descriptionVa;
    }

    /**
     * Set descriptionVf2
     *
     * @param string $descriptionVf2
     * @return OldFilmEvenement
     */
    public function setDescriptionVf2($descriptionVf2)
    {
        $this->descriptionVf2 = $descriptionVf2;

        return $this;
    }

    /**
     * Get descriptionVf2
     *
     * @return string 
     */
    public function getDescriptionVf2()
    {
        return $this->descriptionVf2;
    }

    /**
     * Set descriptionVa2
     *
     * @param string $descriptionVa2
     * @return OldFilmEvenement
     */
    public function setDescriptionVa2($descriptionVa2)
    {
        $this->descriptionVa2 = $descriptionVa2;

        return $this;
    }

    /**
     * Get descriptionVa2
     *
     * @return string 
     */
    public function getDescriptionVa2()
    {
        return $this->descriptionVa2;
    }

    /**
     * Set descriptionVf3
     *
     * @param string $descriptionVf3
     * @return OldFilmEvenement
     */
    public function setDescriptionVf3($descriptionVf3)
    {
        $this->descriptionVf3 = $descriptionVf3;

        return $this;
    }

    /**
     * Get descriptionVf3
     *
     * @return string 
     */
    public function getDescriptionVf3()
    {
        return $this->descriptionVf3;
    }

    /**
     * Set descriptionVa3
     *
     * @param string $descriptionVa3
     * @return OldFilmEvenement
     */
    public function setDescriptionVa3($descriptionVa3)
    {
        $this->descriptionVa3 = $descriptionVa3;

        return $this;
    }

    /**
     * Get descriptionVa3
     *
     * @return string 
     */
    public function getDescriptionVa3()
    {
        return $this->descriptionVa3;
    }

    /**
     * Set descriptionVf4
     *
     * @param string $descriptionVf4
     * @return OldFilmEvenement
     */
    public function setDescriptionVf4($descriptionVf4)
    {
        $this->descriptionVf4 = $descriptionVf4;

        return $this;
    }

    /**
     * Get descriptionVf4
     *
     * @return string 
     */
    public function getDescriptionVf4()
    {
        return $this->descriptionVf4;
    }

    /**
     * Set descriptionVa4
     *
     * @param string $descriptionVa4
     * @return OldFilmEvenement
     */
    public function setDescriptionVa4($descriptionVa4)
    {
        $this->descriptionVa4 = $descriptionVa4;

        return $this;
    }

    /**
     * Get descriptionVa4
     *
     * @return string 
     */
    public function getDescriptionVa4()
    {
        return $this->descriptionVa4;
    }

    /**
     * Set datecreation
     *
     * @param \DateTime $datecreation
     * @return OldFilmEvenement
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
     * @return OldFilmEvenement
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
     * Set ordre
     *
     * @param string $ordre
     * @return OldFilmEvenement
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * Get ordre
     *
     * @return string 
     */
    public function getOrdre()
    {
        return $this->ordre;
    }

    /**
     * Set internet
     *
     * @param string $internet
     * @return OldFilmEvenement
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
}
