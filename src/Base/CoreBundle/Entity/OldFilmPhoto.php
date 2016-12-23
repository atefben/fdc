<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldFilmPhoto
 *
 * @ORM\Table(name="old_FILM_PHOTO", indexes={@ORM\Index(name="INDFPIDPERS", columns={"IDPERSONNE"}), @ORM\Index(name="FILM_PHOTO_FI_3", columns={"IDGENERIQUE"}), @ORM\Index(name="FILM_PHOTO_FI_4", columns={"IDJURY"}), @ORM\Index(name="FILM_PHOTO_FI_5", columns={"IDEVENEMENT"}), @ORM\Index(name="IDFILM", columns={"IDFILM"}), @ORM\Index(name="IDFESTIVAL", columns={"IDFESTIVAL"}), @ORM\Index(name="INTERNET", columns={"INTERNET"}), @ORM\Index(name="DATEMODIFICATION", columns={"DATEMODIFICATION"}), @ORM\Index(name="TITRE", columns={"TITRE"}), @ORM\Index(name="TITRE_VA", columns={"TITRE_VA"}), @ORM\Index(name="TYPE", columns={"TYPE"}), @ORM\Index(name="FICHIER", columns={"FICHIER"}), @ORM\Index(name="IDX_81E862413A195133", columns={"IDGENERIQUEATELIER"}), @ORM\Index(name="IDX_81E8624193F7B0E0", columns={"IDFILMATELIER"}), @ORM\Index(name="IDX_81E86241793FAD3", columns={"IDPERSONNECINEF"})})
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\OldFilmPhotoRepository")
 */
class OldFilmPhoto
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPHOTO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idphoto;

    /**
     * @var string
     *
     * @ORM\Column(name="IDFILM", type="string", length=36, nullable=true)
     */
    protected $idfilm;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDPERSONNE", type="integer", nullable=true)
     */
    protected $idpersonne;

    /**
     * @var string
     *
     * @ORM\Column(name="IDGENERIQUE", type="decimal", precision=22, scale=0, nullable=true)
     */
    protected $idgenerique;

    /**
     * @var string
     *
     * @ORM\Column(name="IDFESTIVAL", type="decimal", precision=22, scale=0, nullable=true)
     */
    protected $idfestival;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDJURY", type="integer", nullable=true)
     */
    protected $idjury;

    /**
     * @var string
     *
     * @ORM\Column(name="IDEVENEMENT", type="decimal", precision=22, scale=0, nullable=true)
     */
    protected $idevenement;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDPOSTER", type="integer", nullable=true)
     */
    protected $idposter;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDGENERIQUEATELIER", type="integer", nullable=true)
     */
    protected $idgeneriqueatelier;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFILMATELIER", type="integer", nullable=true)
     */
    protected $idfilmatelier;

    /**
     * @var string
     *
     * @ORM\Column(name="FICHIER", type="string", length=80, nullable=true)
     */
    protected $fichier;

    /**
     * @var string
     *
     * @ORM\Column(name="NOTE", type="text", nullable=true)
     */
    protected $note;

    /**
     * @var string
     *
     * @ORM\Column(name="NOTE_VA", type="text", nullable=true)
     */
    protected $noteVa;

    /**
     * @var string
     *
     * @ORM\Column(name="COPYRIGHT", type="string", length=80, nullable=true)
     */
    protected $copyright;

    /**
     * @var string
     *
     * @ORM\Column(name="CREDITS", type="string", length=80, nullable=true)
     */
    protected $credits;

    /**
     * @var string
     *
     * @ORM\Column(name="TYPE", type="string", length=1, nullable=true)
     */
    protected $type;

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
     * @ORM\Column(name="INTERNET", type="string", length=1, nullable=true)
     */
    protected $internet;

    /**
     * @var string
     *
     * @ORM\Column(name="TITRE", type="string", length=80, nullable=true)
     */
    protected $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="TITRE_VA", type="string", length=80, nullable=true)
     */
    protected $titreVa;

    /**
     * @var string
     *
     * @ORM\Column(name="IDPERSONNECINEF", type="decimal", precision=22, scale=0, nullable=true)
     */
    protected $idpersonnecinef;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDTYPEPHOTO", type="integer", nullable=true)
     */
    protected $idtypephoto;



    /**
     * Get idphoto
     *
     * @return integer 
     */
    public function getIdphoto()
    {
        return $this->idphoto;
    }

    /**
     * Set idfilm
     *
     * @param string $idfilm
     * @return OldFilmPhoto
     */
    public function setIdfilm($idfilm)
    {
        $this->idfilm = $idfilm;

        return $this;
    }

    /**
     * Get idfilm
     *
     * @return string 
     */
    public function getIdfilm()
    {
        return $this->idfilm;
    }

    /**
     * Set idpersonne
     *
     * @param integer $idpersonne
     * @return OldFilmPhoto
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
     * Set idgenerique
     *
     * @param string $idgenerique
     * @return OldFilmPhoto
     */
    public function setIdgenerique($idgenerique)
    {
        $this->idgenerique = $idgenerique;

        return $this;
    }

    /**
     * Get idgenerique
     *
     * @return string 
     */
    public function getIdgenerique()
    {
        return $this->idgenerique;
    }

    /**
     * Set idfestival
     *
     * @param string $idfestival
     * @return OldFilmPhoto
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
     * Set idjury
     *
     * @param integer $idjury
     * @return OldFilmPhoto
     */
    public function setIdjury($idjury)
    {
        $this->idjury = $idjury;

        return $this;
    }

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
     * Set idevenement
     *
     * @param string $idevenement
     * @return OldFilmPhoto
     */
    public function setIdevenement($idevenement)
    {
        $this->idevenement = $idevenement;

        return $this;
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
     * Set idposter
     *
     * @param integer $idposter
     * @return OldFilmPhoto
     */
    public function setIdposter($idposter)
    {
        $this->idposter = $idposter;

        return $this;
    }

    /**
     * Get idposter
     *
     * @return integer 
     */
    public function getIdposter()
    {
        return $this->idposter;
    }

    /**
     * Set idgeneriqueatelier
     *
     * @param integer $idgeneriqueatelier
     * @return OldFilmPhoto
     */
    public function setIdgeneriqueatelier($idgeneriqueatelier)
    {
        $this->idgeneriqueatelier = $idgeneriqueatelier;

        return $this;
    }

    /**
     * Get idgeneriqueatelier
     *
     * @return integer 
     */
    public function getIdgeneriqueatelier()
    {
        return $this->idgeneriqueatelier;
    }

    /**
     * Set idfilmatelier
     *
     * @param integer $idfilmatelier
     * @return OldFilmPhoto
     */
    public function setIdfilmatelier($idfilmatelier)
    {
        $this->idfilmatelier = $idfilmatelier;

        return $this;
    }

    /**
     * Get idfilmatelier
     *
     * @return integer 
     */
    public function getIdfilmatelier()
    {
        return $this->idfilmatelier;
    }

    /**
     * Set fichier
     *
     * @param string $fichier
     * @return OldFilmPhoto
     */
    public function setFichier($fichier)
    {
        $this->fichier = $fichier;

        return $this;
    }

    /**
     * Get fichier
     *
     * @return string 
     */
    public function getFichier()
    {
        return $this->fichier;
    }

    /**
     * Set note
     *
     * @param string $note
     * @return OldFilmPhoto
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string 
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set noteVa
     *
     * @param string $noteVa
     * @return OldFilmPhoto
     */
    public function setNoteVa($noteVa)
    {
        $this->noteVa = $noteVa;

        return $this;
    }

    /**
     * Get noteVa
     *
     * @return string 
     */
    public function getNoteVa()
    {
        return $this->noteVa;
    }

    /**
     * Set copyright
     *
     * @param string $copyright
     * @return OldFilmPhoto
     */
    public function setCopyright($copyright)
    {
        $this->copyright = $copyright;

        return $this;
    }

    /**
     * Get copyright
     *
     * @return string 
     */
    public function getCopyright()
    {
        return $this->copyright;
    }

    /**
     * Set credits
     *
     * @param string $credits
     * @return OldFilmPhoto
     */
    public function setCredits($credits)
    {
        $this->credits = $credits;

        return $this;
    }

    /**
     * Get credits
     *
     * @return string 
     */
    public function getCredits()
    {
        return $this->credits;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return OldFilmPhoto
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set datecreation
     *
     * @param \DateTime $datecreation
     * @return OldFilmPhoto
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
     * @return OldFilmPhoto
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
     * Set internet
     *
     * @param string $internet
     * @return OldFilmPhoto
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
     * Set titre
     *
     * @param string $titre
     * @return OldFilmPhoto
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set titreVa
     *
     * @param string $titreVa
     * @return OldFilmPhoto
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
     * Set idpersonnecinef
     *
     * @param string $idpersonnecinef
     * @return OldFilmPhoto
     */
    public function setIdpersonnecinef($idpersonnecinef)
    {
        $this->idpersonnecinef = $idpersonnecinef;

        return $this;
    }

    /**
     * Get idpersonnecinef
     *
     * @return string 
     */
    public function getIdpersonnecinef()
    {
        return $this->idpersonnecinef;
    }

    /**
     * Set idtypephoto
     *
     * @param integer $idtypephoto
     * @return OldFilmPhoto
     */
    public function setIdtypephoto($idtypephoto)
    {
        $this->idtypephoto = $idtypephoto;

        return $this;
    }

    /**
     * Get idtypephoto
     *
     * @return integer 
     */
    public function getIdtypephoto()
    {
        return $this->idtypephoto;
    }
}
