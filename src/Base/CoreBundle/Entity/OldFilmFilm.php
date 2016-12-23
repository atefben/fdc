<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldFilmFilm
 *
 * @ORM\Table(name="old_FILM_FILM", indexes={@ORM\Index(name="FILM_FILM_FI_4", columns={"PAYS1"}), @ORM\Index(name="FILM_FILM_FI_5", columns={"PAYS2"}), @ORM\Index(name="FILM_FILM_FI_6", columns={"PAYS3"}), @ORM\Index(name="FILM_FILM_FI_7", columns={"PAYS4"}), @ORM\Index(name="FILM_FILM_FI_8", columns={"PAYS5"}), @ORM\Index(name="FILM_FILM_FI_12", columns={"IDADRESSEPRODUCTION"}), @ORM\Index(name="FILM_FILM_FI_13", columns={"IDADRESSEDISTRIBUTION"}), @ORM\Index(name="FILM_FILM_FI_14", columns={"IDPRESSEFRANCAISE"}), @ORM\Index(name="FILM_FILM_FI_15", columns={"IDPRESSEINTERNAT"}), @ORM\Index(name="FILM_FILM_FI_16", columns={"IDADRESSEVENTE"}), @ORM\Index(name="FILM_FILM_FI_17", columns={"IDECOLE1"}), @ORM\Index(name="INTERNET", columns={"INTERNET"}), @ORM\Index(name="DATEMODIFICATION", columns={"DATEMODIFICATION"}), @ORM\Index(name="IDFESTIVAL", columns={"IDFESTIVAL"})})
 * @ORM\Entity
 */
class OldFilmFilm
{
    /**
     * @var string
     *
     * @ORM\Column(name="IDFILM", type="string", length=36, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idfilm;

    /**
     * @var string
     *
     * @ORM\Column(name="IDFESTIVAL", type="decimal", precision=22, scale=0, nullable=true)
     */
    protected $idfestival;

    /**
     * @var string
     *
     * @ORM\Column(name="TITRE_VO", type="string", length=100, nullable=true)
     */
    protected $titreVo;

    /**
     * @var string
     *
     * @ORM\Column(name="TITRE_VF", type="string", length=100, nullable=true)
     */
    protected $titreVf;

    /**
     * @var string
     *
     * @ORM\Column(name="TITRE_VA", type="string", length=100, nullable=true)
     */
    protected $titreVa;

    /**
     * @var string
     *
     * @ORM\Column(name="COURTLONG", type="string", length=30, nullable=false)
     */
    protected $courtlong;

    /**
     * @var string
     *
     * @ORM\Column(name="DUREE", type="decimal", precision=22, scale=2, nullable=true)
     */
    protected $duree;

    /**
     * @var string
     *
     * @ORM\Column(name="PAYS1", type="string", length=3, nullable=true)
     */
    protected $pays1;

    /**
     * @var string
     *
     * @ORM\Column(name="PAYS2", type="string", length=3, nullable=true)
     */
    protected $pays2;

    /**
     * @var string
     *
     * @ORM\Column(name="PAYS3", type="string", length=3, nullable=true)
     */
    protected $pays3;

    /**
     * @var string
     *
     * @ORM\Column(name="PAYS4", type="string", length=3, nullable=true)
     */
    protected $pays4;

    /**
     * @var string
     *
     * @ORM\Column(name="PAYS5", type="string", length=3, nullable=true)
     */
    protected $pays5;

    /**
     * @var string
     *
     * @ORM\Column(name="LANGUE1", type="string", length=3, nullable=true)
     */
    protected $langue1;

    /**
     * @var string
     *
     * @ORM\Column(name="LANGUE2", type="string", length=3, nullable=true)
     */
    protected $langue2;

    /**
     * @var string
     *
     * @ORM\Column(name="LANGUE3", type="string", length=3, nullable=true)
     */
    protected $langue3;

    /**
     * @var string
     *
     * @ORM\Column(name="PREMIERFILM", type="string", length=1, nullable=true)
     */
    protected $premierfilm;

    /**
     * @var string
     *
     * @ORM\Column(name="PREMIEREMONDIALE", type="string", length=1, nullable=true)
     */
    protected $premieremondiale;

    /**
     * @var string
     *
     * @ORM\Column(name="ANNEEPRODUCTION", type="string", length=4, nullable=true)
     */
    protected $anneeproduction;

    /**
     * @var string
     *
     * @ORM\Column(name="CATEGORIE", type="string", length=50, nullable=true)
     */
    protected $categorie;

    /**
     * @var string
     *
     * @ORM\Column(name="GENRE", type="string", length=50, nullable=true)
     */
    protected $genre;

    /**
     * @var string
     *
     * @ORM\Column(name="SECTION", type="string", length=50, nullable=true)
     */
    protected $section;

    /**
     * @var string
     *
     * @ORM\Column(name="SYNOPSIS_VF", type="text", nullable=true)
     */
    protected $synopsisVf;

    /**
     * @var string
     *
     * @ORM\Column(name="SYNOPSIS_VA", type="text", nullable=true)
     */
    protected $synopsisVa;

    /**
     * @var string
     *
     * @ORM\Column(name="DIALOGUE_VF", type="text", nullable=true)
     */
    protected $dialogueVf;

    /**
     * @var string
     *
     * @ORM\Column(name="DIALOGUE_VA", type="text", nullable=true)
     */
    protected $dialogueVa;

    /**
     * @var string
     *
     * @ORM\Column(name="PREVIOUSEVENT", type="string", length=250, nullable=true)
     */
    protected $previousevent;

    /**
     * @var string
     *
     * @ORM\Column(name="PAYSEXPLOITATION", type="string", length=200, nullable=true)
     */
    protected $paysexploitation;

    /**
     * @var string
     *
     * @ORM\Column(name="INTERNETDIFFUSION", type="string", length=1, nullable=true)
     */
    protected $internetdiffusion;

    /**
     * @var string
     *
     * @ORM\Column(name="INTERNET", type="string", length=1, nullable=true)
     */
    protected $internet;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDADRESSEPRODUCTION", type="integer", nullable=true)
     */
    protected $idadresseproduction;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDADRESSEDISTRIBUTION", type="integer", nullable=true)
     */
    protected $idadressedistribution;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDPRESSEFRANCAISE", type="integer", nullable=true)
     */
    protected $idpressefrancaise;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDPRESSEINTERNAT", type="integer", nullable=true)
     */
    protected $idpresseinternat;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDADRESSEVENTE", type="integer", nullable=true)
     */
    protected $idadressevente;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDECOLE1", type="integer", nullable=true)
     */
    protected $idecole1;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDECOLE2", type="integer", nullable=true)
     */
    protected $idecole2;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDECOLE3", type="integer", nullable=true)
     */
    protected $idecole3;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDADRESSEREALISATEUR", type="integer", nullable=true)
     */
    protected $idadresserealisateur;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDPRODUCTIONMINORITAIRE1", type="integer", nullable=true)
     */
    protected $idproductionminoritaire1;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDPRODUCTIONMINORITAIRE2", type="integer", nullable=true)
     */
    protected $idproductionminoritaire2;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDPRODUCTIONMINORITAIRE3", type="integer", nullable=true)
     */
    protected $idproductionminoritaire3;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDPRODUCTIONMINORITAIRE4", type="integer", nullable=true)
     */
    protected $idproductionminoritaire4;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDPRODUCTIONMINORITAIRE5", type="integer", nullable=true)
     */
    protected $idproductionminoritaire5;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDPRODUCTIONMINORITAIRE6", type="integer", nullable=true)
     */
    protected $idproductionminoritaire6;

    /**
     * @var string
     *
     * @ORM\Column(name="LANGUESOUSTITRE", type="string", length=3, nullable=true)
     */
    protected $languesoustitre;

    /**
     * @var string
     *
     * @ORM\Column(name="RESTAURATEUR", type="text", nullable=true)
     */
    protected $restaurateur;

    /**
     * @var string
     *
     * @ORM\Column(name="TYPERESTAURATION", type="string", length=40, nullable=true)
     */
    protected $typerestauration;

    /**
     * @var string
     *
     * @ORM\Column(name="SANSDIALOGUE", type="string", length=1, nullable=true)
     */
    protected $sansdialogue;

    /**
     * @var string
     *
     * @ORM\Column(name="COULEUR", type="string", length=10, nullable=true)
     */
    protected $couleur;

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
     * @ORM\Column(name="IDCATEGORIE", type="integer", nullable=true)
     */
    protected $idcategorie;

    /**
     * @var string
     *
     * @ORM\Column(name="WEBSITE1", type="string", length=100, nullable=true)
     */
    protected $website1;

    /**
     * @var string
     *
     * @ORM\Column(name="GALA", type="string", length=50, nullable=true)
     */
    protected $gala;

    /**
     * @var string
     *
     * @ORM\Column(name="SOUSSELECTION_VF", type="string", length=255, nullable=true)
     */
    protected $sousselectionVf;

    /**
     * @var string
     *
     * @ORM\Column(name="SOUSSELECTION_VA", type="string", length=255, nullable=true)
     */
    protected $sousselectionVa;



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
     * Set idfestival
     *
     * @param string $idfestival
     * @return OldFilmFilm
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
     * Set titreVo
     *
     * @param string $titreVo
     * @return OldFilmFilm
     */
    public function setTitreVo($titreVo)
    {
        $this->titreVo = $titreVo;

        return $this;
    }

    /**
     * Get titreVo
     *
     * @return string 
     */
    public function getTitreVo()
    {
        return $this->titreVo;
    }

    /**
     * Set titreVf
     *
     * @param string $titreVf
     * @return OldFilmFilm
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
     * @return OldFilmFilm
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
     * Set courtlong
     *
     * @param string $courtlong
     * @return OldFilmFilm
     */
    public function setCourtlong($courtlong)
    {
        $this->courtlong = $courtlong;

        return $this;
    }

    /**
     * Get courtlong
     *
     * @return string 
     */
    public function getCourtlong()
    {
        return $this->courtlong;
    }

    /**
     * Set duree
     *
     * @param string $duree
     * @return OldFilmFilm
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree
     *
     * @return string 
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set pays1
     *
     * @param string $pays1
     * @return OldFilmFilm
     */
    public function setPays1($pays1)
    {
        $this->pays1 = $pays1;

        return $this;
    }

    /**
     * Get pays1
     *
     * @return string 
     */
    public function getPays1()
    {
        return $this->pays1;
    }

    /**
     * Set pays2
     *
     * @param string $pays2
     * @return OldFilmFilm
     */
    public function setPays2($pays2)
    {
        $this->pays2 = $pays2;

        return $this;
    }

    /**
     * Get pays2
     *
     * @return string 
     */
    public function getPays2()
    {
        return $this->pays2;
    }

    /**
     * Set pays3
     *
     * @param string $pays3
     * @return OldFilmFilm
     */
    public function setPays3($pays3)
    {
        $this->pays3 = $pays3;

        return $this;
    }

    /**
     * Get pays3
     *
     * @return string 
     */
    public function getPays3()
    {
        return $this->pays3;
    }

    /**
     * Set pays4
     *
     * @param string $pays4
     * @return OldFilmFilm
     */
    public function setPays4($pays4)
    {
        $this->pays4 = $pays4;

        return $this;
    }

    /**
     * Get pays4
     *
     * @return string 
     */
    public function getPays4()
    {
        return $this->pays4;
    }

    /**
     * Set pays5
     *
     * @param string $pays5
     * @return OldFilmFilm
     */
    public function setPays5($pays5)
    {
        $this->pays5 = $pays5;

        return $this;
    }

    /**
     * Get pays5
     *
     * @return string 
     */
    public function getPays5()
    {
        return $this->pays5;
    }

    /**
     * Set langue1
     *
     * @param string $langue1
     * @return OldFilmFilm
     */
    public function setLangue1($langue1)
    {
        $this->langue1 = $langue1;

        return $this;
    }

    /**
     * Get langue1
     *
     * @return string 
     */
    public function getLangue1()
    {
        return $this->langue1;
    }

    /**
     * Set langue2
     *
     * @param string $langue2
     * @return OldFilmFilm
     */
    public function setLangue2($langue2)
    {
        $this->langue2 = $langue2;

        return $this;
    }

    /**
     * Get langue2
     *
     * @return string 
     */
    public function getLangue2()
    {
        return $this->langue2;
    }

    /**
     * Set langue3
     *
     * @param string $langue3
     * @return OldFilmFilm
     */
    public function setLangue3($langue3)
    {
        $this->langue3 = $langue3;

        return $this;
    }

    /**
     * Get langue3
     *
     * @return string 
     */
    public function getLangue3()
    {
        return $this->langue3;
    }

    /**
     * Set premierfilm
     *
     * @param string $premierfilm
     * @return OldFilmFilm
     */
    public function setPremierfilm($premierfilm)
    {
        $this->premierfilm = $premierfilm;

        return $this;
    }

    /**
     * Get premierfilm
     *
     * @return string 
     */
    public function getPremierfilm()
    {
        return $this->premierfilm;
    }

    /**
     * Set premieremondiale
     *
     * @param string $premieremondiale
     * @return OldFilmFilm
     */
    public function setPremieremondiale($premieremondiale)
    {
        $this->premieremondiale = $premieremondiale;

        return $this;
    }

    /**
     * Get premieremondiale
     *
     * @return string 
     */
    public function getPremieremondiale()
    {
        return $this->premieremondiale;
    }

    /**
     * Set anneeproduction
     *
     * @param string $anneeproduction
     * @return OldFilmFilm
     */
    public function setAnneeproduction($anneeproduction)
    {
        $this->anneeproduction = $anneeproduction;

        return $this;
    }

    /**
     * Get anneeproduction
     *
     * @return string 
     */
    public function getAnneeproduction()
    {
        return $this->anneeproduction;
    }

    /**
     * Set categorie
     *
     * @param string $categorie
     * @return OldFilmFilm
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set genre
     *
     * @param string $genre
     * @return OldFilmFilm
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return string 
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set section
     *
     * @param string $section
     * @return OldFilmFilm
     */
    public function setSection($section)
    {
        $this->section = $section;

        return $this;
    }

    /**
     * Get section
     *
     * @return string 
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * Set synopsisVf
     *
     * @param string $synopsisVf
     * @return OldFilmFilm
     */
    public function setSynopsisVf($synopsisVf)
    {
        $this->synopsisVf = $synopsisVf;

        return $this;
    }

    /**
     * Get synopsisVf
     *
     * @return string 
     */
    public function getSynopsisVf()
    {
        return $this->synopsisVf;
    }

    /**
     * Set synopsisVa
     *
     * @param string $synopsisVa
     * @return OldFilmFilm
     */
    public function setSynopsisVa($synopsisVa)
    {
        $this->synopsisVa = $synopsisVa;

        return $this;
    }

    /**
     * Get synopsisVa
     *
     * @return string 
     */
    public function getSynopsisVa()
    {
        return $this->synopsisVa;
    }

    /**
     * Set dialogueVf
     *
     * @param string $dialogueVf
     * @return OldFilmFilm
     */
    public function setDialogueVf($dialogueVf)
    {
        $this->dialogueVf = $dialogueVf;

        return $this;
    }

    /**
     * Get dialogueVf
     *
     * @return string 
     */
    public function getDialogueVf()
    {
        return $this->dialogueVf;
    }

    /**
     * Set dialogueVa
     *
     * @param string $dialogueVa
     * @return OldFilmFilm
     */
    public function setDialogueVa($dialogueVa)
    {
        $this->dialogueVa = $dialogueVa;

        return $this;
    }

    /**
     * Get dialogueVa
     *
     * @return string 
     */
    public function getDialogueVa()
    {
        return $this->dialogueVa;
    }

    /**
     * Set previousevent
     *
     * @param string $previousevent
     * @return OldFilmFilm
     */
    public function setPreviousevent($previousevent)
    {
        $this->previousevent = $previousevent;

        return $this;
    }

    /**
     * Get previousevent
     *
     * @return string 
     */
    public function getPreviousevent()
    {
        return $this->previousevent;
    }

    /**
     * Set paysexploitation
     *
     * @param string $paysexploitation
     * @return OldFilmFilm
     */
    public function setPaysexploitation($paysexploitation)
    {
        $this->paysexploitation = $paysexploitation;

        return $this;
    }

    /**
     * Get paysexploitation
     *
     * @return string 
     */
    public function getPaysexploitation()
    {
        return $this->paysexploitation;
    }

    /**
     * Set internetdiffusion
     *
     * @param string $internetdiffusion
     * @return OldFilmFilm
     */
    public function setInternetdiffusion($internetdiffusion)
    {
        $this->internetdiffusion = $internetdiffusion;

        return $this;
    }

    /**
     * Get internetdiffusion
     *
     * @return string 
     */
    public function getInternetdiffusion()
    {
        return $this->internetdiffusion;
    }

    /**
     * Set internet
     *
     * @param string $internet
     * @return OldFilmFilm
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
     * Set idadresseproduction
     *
     * @param integer $idadresseproduction
     * @return OldFilmFilm
     */
    public function setIdadresseproduction($idadresseproduction)
    {
        $this->idadresseproduction = $idadresseproduction;

        return $this;
    }

    /**
     * Get idadresseproduction
     *
     * @return integer 
     */
    public function getIdadresseproduction()
    {
        return $this->idadresseproduction;
    }

    /**
     * Set idadressedistribution
     *
     * @param integer $idadressedistribution
     * @return OldFilmFilm
     */
    public function setIdadressedistribution($idadressedistribution)
    {
        $this->idadressedistribution = $idadressedistribution;

        return $this;
    }

    /**
     * Get idadressedistribution
     *
     * @return integer 
     */
    public function getIdadressedistribution()
    {
        return $this->idadressedistribution;
    }

    /**
     * Set idpressefrancaise
     *
     * @param integer $idpressefrancaise
     * @return OldFilmFilm
     */
    public function setIdpressefrancaise($idpressefrancaise)
    {
        $this->idpressefrancaise = $idpressefrancaise;

        return $this;
    }

    /**
     * Get idpressefrancaise
     *
     * @return integer 
     */
    public function getIdpressefrancaise()
    {
        return $this->idpressefrancaise;
    }

    /**
     * Set idpresseinternat
     *
     * @param integer $idpresseinternat
     * @return OldFilmFilm
     */
    public function setIdpresseinternat($idpresseinternat)
    {
        $this->idpresseinternat = $idpresseinternat;

        return $this;
    }

    /**
     * Get idpresseinternat
     *
     * @return integer 
     */
    public function getIdpresseinternat()
    {
        return $this->idpresseinternat;
    }

    /**
     * Set idadressevente
     *
     * @param integer $idadressevente
     * @return OldFilmFilm
     */
    public function setIdadressevente($idadressevente)
    {
        $this->idadressevente = $idadressevente;

        return $this;
    }

    /**
     * Get idadressevente
     *
     * @return integer 
     */
    public function getIdadressevente()
    {
        return $this->idadressevente;
    }

    /**
     * Set idecole1
     *
     * @param integer $idecole1
     * @return OldFilmFilm
     */
    public function setIdecole1($idecole1)
    {
        $this->idecole1 = $idecole1;

        return $this;
    }

    /**
     * Get idecole1
     *
     * @return integer 
     */
    public function getIdecole1()
    {
        return $this->idecole1;
    }

    /**
     * Set idecole2
     *
     * @param integer $idecole2
     * @return OldFilmFilm
     */
    public function setIdecole2($idecole2)
    {
        $this->idecole2 = $idecole2;

        return $this;
    }

    /**
     * Get idecole2
     *
     * @return integer 
     */
    public function getIdecole2()
    {
        return $this->idecole2;
    }

    /**
     * Set idecole3
     *
     * @param integer $idecole3
     * @return OldFilmFilm
     */
    public function setIdecole3($idecole3)
    {
        $this->idecole3 = $idecole3;

        return $this;
    }

    /**
     * Get idecole3
     *
     * @return integer 
     */
    public function getIdecole3()
    {
        return $this->idecole3;
    }

    /**
     * Set idadresserealisateur
     *
     * @param integer $idadresserealisateur
     * @return OldFilmFilm
     */
    public function setIdadresserealisateur($idadresserealisateur)
    {
        $this->idadresserealisateur = $idadresserealisateur;

        return $this;
    }

    /**
     * Get idadresserealisateur
     *
     * @return integer 
     */
    public function getIdadresserealisateur()
    {
        return $this->idadresserealisateur;
    }

    /**
     * Set idproductionminoritaire1
     *
     * @param integer $idproductionminoritaire1
     * @return OldFilmFilm
     */
    public function setIdproductionminoritaire1($idproductionminoritaire1)
    {
        $this->idproductionminoritaire1 = $idproductionminoritaire1;

        return $this;
    }

    /**
     * Get idproductionminoritaire1
     *
     * @return integer 
     */
    public function getIdproductionminoritaire1()
    {
        return $this->idproductionminoritaire1;
    }

    /**
     * Set idproductionminoritaire2
     *
     * @param integer $idproductionminoritaire2
     * @return OldFilmFilm
     */
    public function setIdproductionminoritaire2($idproductionminoritaire2)
    {
        $this->idproductionminoritaire2 = $idproductionminoritaire2;

        return $this;
    }

    /**
     * Get idproductionminoritaire2
     *
     * @return integer 
     */
    public function getIdproductionminoritaire2()
    {
        return $this->idproductionminoritaire2;
    }

    /**
     * Set idproductionminoritaire3
     *
     * @param integer $idproductionminoritaire3
     * @return OldFilmFilm
     */
    public function setIdproductionminoritaire3($idproductionminoritaire3)
    {
        $this->idproductionminoritaire3 = $idproductionminoritaire3;

        return $this;
    }

    /**
     * Get idproductionminoritaire3
     *
     * @return integer 
     */
    public function getIdproductionminoritaire3()
    {
        return $this->idproductionminoritaire3;
    }

    /**
     * Set idproductionminoritaire4
     *
     * @param integer $idproductionminoritaire4
     * @return OldFilmFilm
     */
    public function setIdproductionminoritaire4($idproductionminoritaire4)
    {
        $this->idproductionminoritaire4 = $idproductionminoritaire4;

        return $this;
    }

    /**
     * Get idproductionminoritaire4
     *
     * @return integer 
     */
    public function getIdproductionminoritaire4()
    {
        return $this->idproductionminoritaire4;
    }

    /**
     * Set idproductionminoritaire5
     *
     * @param integer $idproductionminoritaire5
     * @return OldFilmFilm
     */
    public function setIdproductionminoritaire5($idproductionminoritaire5)
    {
        $this->idproductionminoritaire5 = $idproductionminoritaire5;

        return $this;
    }

    /**
     * Get idproductionminoritaire5
     *
     * @return integer 
     */
    public function getIdproductionminoritaire5()
    {
        return $this->idproductionminoritaire5;
    }

    /**
     * Set idproductionminoritaire6
     *
     * @param integer $idproductionminoritaire6
     * @return OldFilmFilm
     */
    public function setIdproductionminoritaire6($idproductionminoritaire6)
    {
        $this->idproductionminoritaire6 = $idproductionminoritaire6;

        return $this;
    }

    /**
     * Get idproductionminoritaire6
     *
     * @return integer 
     */
    public function getIdproductionminoritaire6()
    {
        return $this->idproductionminoritaire6;
    }

    /**
     * Set languesoustitre
     *
     * @param string $languesoustitre
     * @return OldFilmFilm
     */
    public function setLanguesoustitre($languesoustitre)
    {
        $this->languesoustitre = $languesoustitre;

        return $this;
    }

    /**
     * Get languesoustitre
     *
     * @return string 
     */
    public function getLanguesoustitre()
    {
        return $this->languesoustitre;
    }

    /**
     * Set restaurateur
     *
     * @param string $restaurateur
     * @return OldFilmFilm
     */
    public function setRestaurateur($restaurateur)
    {
        $this->restaurateur = $restaurateur;

        return $this;
    }

    /**
     * Get restaurateur
     *
     * @return string 
     */
    public function getRestaurateur()
    {
        return $this->restaurateur;
    }

    /**
     * Set typerestauration
     *
     * @param string $typerestauration
     * @return OldFilmFilm
     */
    public function setTyperestauration($typerestauration)
    {
        $this->typerestauration = $typerestauration;

        return $this;
    }

    /**
     * Get typerestauration
     *
     * @return string 
     */
    public function getTyperestauration()
    {
        return $this->typerestauration;
    }

    /**
     * Set sansdialogue
     *
     * @param string $sansdialogue
     * @return OldFilmFilm
     */
    public function setSansdialogue($sansdialogue)
    {
        $this->sansdialogue = $sansdialogue;

        return $this;
    }

    /**
     * Get sansdialogue
     *
     * @return string 
     */
    public function getSansdialogue()
    {
        return $this->sansdialogue;
    }

    /**
     * Set couleur
     *
     * @param string $couleur
     * @return OldFilmFilm
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * Get couleur
     *
     * @return string 
     */
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * Set datecreation
     *
     * @param \DateTime $datecreation
     * @return OldFilmFilm
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
     * @return OldFilmFilm
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
     * Set idcategorie
     *
     * @param integer $idcategorie
     * @return OldFilmFilm
     */
    public function setIdcategorie($idcategorie)
    {
        $this->idcategorie = $idcategorie;

        return $this;
    }

    /**
     * Get idcategorie
     *
     * @return integer 
     */
    public function getIdcategorie()
    {
        return $this->idcategorie;
    }

    /**
     * Set website1
     *
     * @param string $website1
     * @return OldFilmFilm
     */
    public function setWebsite1($website1)
    {
        $this->website1 = $website1;

        return $this;
    }

    /**
     * Get website1
     *
     * @return string 
     */
    public function getWebsite1()
    {
        return $this->website1;
    }

    /**
     * Set gala
     *
     * @param string $gala
     * @return OldFilmFilm
     */
    public function setGala($gala)
    {
        $this->gala = $gala;

        return $this;
    }

    /**
     * Get gala
     *
     * @return string 
     */
    public function getGala()
    {
        return $this->gala;
    }

    /**
     * Set sousselectionVf
     *
     * @param string $sousselectionVf
     * @return OldFilmFilm
     */
    public function setSousselectionVf($sousselectionVf)
    {
        $this->sousselectionVf = $sousselectionVf;

        return $this;
    }

    /**
     * Get sousselectionVf
     *
     * @return string 
     */
    public function getSousselectionVf()
    {
        return $this->sousselectionVf;
    }

    /**
     * Set sousselectionVa
     *
     * @param string $sousselectionVa
     * @return OldFilmFilm
     */
    public function setSousselectionVa($sousselectionVa)
    {
        $this->sousselectionVa = $sousselectionVa;

        return $this;
    }

    /**
     * Get sousselectionVa
     *
     * @return string 
     */
    public function getSousselectionVa()
    {
        return $this->sousselectionVa;
    }
}
