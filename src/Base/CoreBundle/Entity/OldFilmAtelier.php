<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldFilmAtelier
 *
 * @ORM\Table(name="old_FILM_ATELIER", indexes={@ORM\Index(name="INDFIDFESTTITRE", columns={"IDFESTIVAL", "TITRE_VO"}), @ORM\Index(name="FILM_FILM_FI_4", columns={"PAYS1"}), @ORM\Index(name="FILM_FILM_FI_5", columns={"PAYS2"}), @ORM\Index(name="FILM_FILM_FI_6", columns={"PAYS3"}), @ORM\Index(name="FILM_FILM_FI_7", columns={"PAYS4"}), @ORM\Index(name="FILM_FILM_FI_8", columns={"PAYS5"}), @ORM\Index(name="FILM_FILM_FI_12", columns={"IDADRESSEPRODUCTION"}), @ORM\Index(name="FILM_FILM_FI_13", columns={"IDADRESSEDISTRIBUTION"}), @ORM\Index(name="FILM_FILM_FI_14", columns={"IDPRESSEFRANCAISE"}), @ORM\Index(name="FILM_FILM_FI_15", columns={"IDPRESSEINTERNAT"}), @ORM\Index(name="FILM_FILM_FI_16", columns={"IDADRESSEVENTE"}), @ORM\Index(name="INTERNET", columns={"INTERNET"})})
 * @ORM\Entity
 */
class OldFilmAtelier
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDFILM", type="integer", nullable=false)
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
     * @ORM\Column(name="COURTLONG", type="string", length=30, nullable=true)
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
     * @ORM\Column(name="SYNOPSIS_VF2", type="text", nullable=true)
     */
    protected $synopsisVf2;

    /**
     * @var string
     *
     * @ORM\Column(name="SYNOPSIS_VF3", type="text", nullable=true)
     */
    protected $synopsisVf3;

    /**
     * @var string
     *
     * @ORM\Column(name="SYNOPSIS_VA", type="text", nullable=true)
     */
    protected $synopsisVa;

    /**
     * @var string
     *
     * @ORM\Column(name="SYNOPSIS_VA2", type="text", nullable=true)
     */
    protected $synopsisVa2;

    /**
     * @var string
     *
     * @ORM\Column(name="SYNOPSIS_VA3", type="text", nullable=true)
     */
    protected $synopsisVa3;

    /**
     * @var string
     *
     * @ORM\Column(name="DIALOGUE_VF", type="text", nullable=true)
     */
    protected $dialogueVf;

    /**
     * @var string
     *
     * @ORM\Column(name="DIALOGUE_VF2", type="text", nullable=true)
     */
    protected $dialogueVf2;

    /**
     * @var string
     *
     * @ORM\Column(name="DIALOGUE_VF3", type="text", nullable=true)
     */
    protected $dialogueVf3;

    /**
     * @var string
     *
     * @ORM\Column(name="DIALOGUE_VA", type="text", nullable=true)
     */
    protected $dialogueVa;

    /**
     * @var string
     *
     * @ORM\Column(name="DIALOGUE_VA2", type="text", nullable=true)
     */
    protected $dialogueVa2;

    /**
     * @var string
     *
     * @ORM\Column(name="DIALOGUE_VA3", type="text", nullable=true)
     */
    protected $dialogueVa3;

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
     * @ORM\Column(name="GALA", type="string", length=10, nullable=true)
     */
    protected $gala;

    /**
     * @var string
     *
     * @ORM\Column(name="TRANSITAIREDEPART", type="string", length=100, nullable=true)
     */
    protected $transitairedepart;

    /**
     * @var string
     *
     * @ORM\Column(name="TRANSITAIREARRIVEE", type="string", length=100, nullable=true)
     */
    protected $transitairearrivee;

    /**
     * @var string
     *
     * @ORM\Column(name="URL_CINANDO", type="string", length=255, nullable=true)
     */
    protected $urlCinando;

    /**
     * @var string
     *
     * @ORM\Column(name="PRODUCTION_INFOS", type="text", nullable=true)
     */
    protected $productionInfos;



    /**
     * Get idfilm
     *
     * @return integer 
     */
    public function getIdfilm()
    {
        return $this->idfilm;
    }

    /**
     * Set idfestival
     *
     * @param string $idfestival
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * Set synopsisVf2
     *
     * @param string $synopsisVf2
     * @return OldFilmAtelier
     */
    public function setSynopsisVf2($synopsisVf2)
    {
        $this->synopsisVf2 = $synopsisVf2;

        return $this;
    }

    /**
     * Get synopsisVf2
     *
     * @return string 
     */
    public function getSynopsisVf2()
    {
        return $this->synopsisVf2;
    }

    /**
     * Set synopsisVf3
     *
     * @param string $synopsisVf3
     * @return OldFilmAtelier
     */
    public function setSynopsisVf3($synopsisVf3)
    {
        $this->synopsisVf3 = $synopsisVf3;

        return $this;
    }

    /**
     * Get synopsisVf3
     *
     * @return string 
     */
    public function getSynopsisVf3()
    {
        return $this->synopsisVf3;
    }

    /**
     * Set synopsisVa
     *
     * @param string $synopsisVa
     * @return OldFilmAtelier
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
     * Set synopsisVa2
     *
     * @param string $synopsisVa2
     * @return OldFilmAtelier
     */
    public function setSynopsisVa2($synopsisVa2)
    {
        $this->synopsisVa2 = $synopsisVa2;

        return $this;
    }

    /**
     * Get synopsisVa2
     *
     * @return string 
     */
    public function getSynopsisVa2()
    {
        return $this->synopsisVa2;
    }

    /**
     * Set synopsisVa3
     *
     * @param string $synopsisVa3
     * @return OldFilmAtelier
     */
    public function setSynopsisVa3($synopsisVa3)
    {
        $this->synopsisVa3 = $synopsisVa3;

        return $this;
    }

    /**
     * Get synopsisVa3
     *
     * @return string 
     */
    public function getSynopsisVa3()
    {
        return $this->synopsisVa3;
    }

    /**
     * Set dialogueVf
     *
     * @param string $dialogueVf
     * @return OldFilmAtelier
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
     * Set dialogueVf2
     *
     * @param string $dialogueVf2
     * @return OldFilmAtelier
     */
    public function setDialogueVf2($dialogueVf2)
    {
        $this->dialogueVf2 = $dialogueVf2;

        return $this;
    }

    /**
     * Get dialogueVf2
     *
     * @return string 
     */
    public function getDialogueVf2()
    {
        return $this->dialogueVf2;
    }

    /**
     * Set dialogueVf3
     *
     * @param string $dialogueVf3
     * @return OldFilmAtelier
     */
    public function setDialogueVf3($dialogueVf3)
    {
        $this->dialogueVf3 = $dialogueVf3;

        return $this;
    }

    /**
     * Get dialogueVf3
     *
     * @return string 
     */
    public function getDialogueVf3()
    {
        return $this->dialogueVf3;
    }

    /**
     * Set dialogueVa
     *
     * @param string $dialogueVa
     * @return OldFilmAtelier
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
     * Set dialogueVa2
     *
     * @param string $dialogueVa2
     * @return OldFilmAtelier
     */
    public function setDialogueVa2($dialogueVa2)
    {
        $this->dialogueVa2 = $dialogueVa2;

        return $this;
    }

    /**
     * Get dialogueVa2
     *
     * @return string 
     */
    public function getDialogueVa2()
    {
        return $this->dialogueVa2;
    }

    /**
     * Set dialogueVa3
     *
     * @param string $dialogueVa3
     * @return OldFilmAtelier
     */
    public function setDialogueVa3($dialogueVa3)
    {
        $this->dialogueVa3 = $dialogueVa3;

        return $this;
    }

    /**
     * Get dialogueVa3
     *
     * @return string 
     */
    public function getDialogueVa3()
    {
        return $this->dialogueVa3;
    }

    /**
     * Set previousevent
     *
     * @param string $previousevent
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * @return OldFilmAtelier
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
     * Set gala
     *
     * @param string $gala
     * @return OldFilmAtelier
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
     * Set transitairedepart
     *
     * @param string $transitairedepart
     * @return OldFilmAtelier
     */
    public function setTransitairedepart($transitairedepart)
    {
        $this->transitairedepart = $transitairedepart;

        return $this;
    }

    /**
     * Get transitairedepart
     *
     * @return string 
     */
    public function getTransitairedepart()
    {
        return $this->transitairedepart;
    }

    /**
     * Set transitairearrivee
     *
     * @param string $transitairearrivee
     * @return OldFilmAtelier
     */
    public function setTransitairearrivee($transitairearrivee)
    {
        $this->transitairearrivee = $transitairearrivee;

        return $this;
    }

    /**
     * Get transitairearrivee
     *
     * @return string 
     */
    public function getTransitairearrivee()
    {
        return $this->transitairearrivee;
    }

    /**
     * Set urlCinando
     *
     * @param string $urlCinando
     * @return OldFilmAtelier
     */
    public function setUrlCinando($urlCinando)
    {
        $this->urlCinando = $urlCinando;

        return $this;
    }

    /**
     * Get urlCinando
     *
     * @return string 
     */
    public function getUrlCinando()
    {
        return $this->urlCinando;
    }

    /**
     * Set productionInfos
     *
     * @param string $productionInfos
     * @return OldFilmAtelier
     */
    public function setProductionInfos($productionInfos)
    {
        $this->productionInfos = $productionInfos;

        return $this;
    }

    /**
     * Get productionInfos
     *
     * @return string 
     */
    public function getProductionInfos()
    {
        return $this->productionInfos;
    }
}
