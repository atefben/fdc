<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldFilmFifPersonne
 *
 * @ORM\Table(name="old_FILM_FIF_PERSONNE", indexes={@ORM\Index(name="INDFNOMPRENOM", columns={"NOM", "PRENOM"}), @ORM\Index(name="FILM_PERSONNE_FI_1", columns={"NATIONALITE"}), @ORM\Index(name="FILM_PERSONNE_FI_2", columns={"NATIONALITE2"}), @ORM\Index(name="FILM_PERSONNE_FI_3", columns={"IDADRESSE"}), @ORM\Index(name="IDPROFESSION", columns={"IDPROFESSION"}), @ORM\Index(name="DATEMODIFICATION", columns={"DATEMODIFICATION"}), @ORM\Index(name="INTERNET", columns={"INTERNET"}), @ORM\Index(name="pm_profession_va", columns={"PROFESSION_VA"}), @ORM\Index(name="pm_profession_vf", columns={"PROFESSION_VF"})})
 * @ORM\Entity
 */
class OldFilmFifPersonne
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPERSONNE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpersonne;

    /**
     * @var string
     *
     * @ORM\Column(name="CIVILITE", type="string", length=10, nullable=true)
     */
    private $civilite;

    /**
     * @var string
     *
     * @ORM\Column(name="NOM", type="string", length=40, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="PRENOM", type="string", length=40, nullable=true)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="NATIONALITE", type="string", length=3, nullable=true)
     */
    private $nationalite;

    /**
     * @var string
     *
     * @ORM\Column(name="NATIONALITE2", type="string", length=3, nullable=true)
     */
    private $nationalite2;

    /**
     * @var string
     *
     * @ORM\Column(name="PROFESSION_VF", type="string", length=80, nullable=true)
     */
    private $professionVf;

    /**
     * @var string
     *
     * @ORM\Column(name="PROFESSION_VA", type="string", length=80, nullable=true)
     */
    private $professionVa;

    /**
     * @var string
     *
     * @ORM\Column(name="QUALIFICATION", type="string", length=10, nullable=true)
     */
    private $qualification;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATECREATION", type="datetime", nullable=true)
     */
    private $datecreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATEMODIFICATION", type="datetime", nullable=true)
     */
    private $datemodification;

    /**
     * @var string
     *
     * @ORM\Column(name="LIEUNAISSANCE", type="string", length=80, nullable=true)
     */
    private $lieunaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="BIO_FILMO_VF", type="text", nullable=true)
     */
    private $bioFilmoVf;

    /**
     * @var string
     *
     * @ORM\Column(name="BIO_FILMO_VA", type="text", nullable=true)
     */
    private $bioFilmoVa;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATENAISSANCE", type="datetime", nullable=true)
     */
    private $datenaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="INVERSIONNOM", type="string", length=1, nullable=true)
     */
    private $inversionnom;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDADRESSE", type="integer", nullable=true)
     */
    private $idadresse;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDPROFESSION", type="integer", nullable=true)
     */
    private $idprofession;

    /**
     * @var string
     *
     * @ORM\Column(name="INTERNET", type="string", length=1, nullable=false)
     */
    private $internet;



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
     * Set civilite
     *
     * @param string $civilite
     * @return OldFilmFifPersonne
     */
    public function setCivilite($civilite)
    {
        $this->civilite = $civilite;

        return $this;
    }

    /**
     * Get civilite
     *
     * @return string 
     */
    public function getCivilite()
    {
        return $this->civilite;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return OldFilmFifPersonne
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return OldFilmFifPersonne
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set nationalite
     *
     * @param string $nationalite
     * @return OldFilmFifPersonne
     */
    public function setNationalite($nationalite)
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    /**
     * Get nationalite
     *
     * @return string 
     */
    public function getNationalite()
    {
        return $this->nationalite;
    }

    /**
     * Set nationalite2
     *
     * @param string $nationalite2
     * @return OldFilmFifPersonne
     */
    public function setNationalite2($nationalite2)
    {
        $this->nationalite2 = $nationalite2;

        return $this;
    }

    /**
     * Get nationalite2
     *
     * @return string 
     */
    public function getNationalite2()
    {
        return $this->nationalite2;
    }

    /**
     * Set professionVf
     *
     * @param string $professionVf
     * @return OldFilmFifPersonne
     */
    public function setProfessionVf($professionVf)
    {
        $this->professionVf = $professionVf;

        return $this;
    }

    /**
     * Get professionVf
     *
     * @return string 
     */
    public function getProfessionVf()
    {
        return $this->professionVf;
    }

    /**
     * Set professionVa
     *
     * @param string $professionVa
     * @return OldFilmFifPersonne
     */
    public function setProfessionVa($professionVa)
    {
        $this->professionVa = $professionVa;

        return $this;
    }

    /**
     * Get professionVa
     *
     * @return string 
     */
    public function getProfessionVa()
    {
        return $this->professionVa;
    }

    /**
     * Set qualification
     *
     * @param string $qualification
     * @return OldFilmFifPersonne
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
     * Set datecreation
     *
     * @param \DateTime $datecreation
     * @return OldFilmFifPersonne
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
     * @return OldFilmFifPersonne
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
     * Set lieunaissance
     *
     * @param string $lieunaissance
     * @return OldFilmFifPersonne
     */
    public function setLieunaissance($lieunaissance)
    {
        $this->lieunaissance = $lieunaissance;

        return $this;
    }

    /**
     * Get lieunaissance
     *
     * @return string 
     */
    public function getLieunaissance()
    {
        return $this->lieunaissance;
    }

    /**
     * Set bioFilmoVf
     *
     * @param string $bioFilmoVf
     * @return OldFilmFifPersonne
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
     * @return OldFilmFifPersonne
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
     * Set datenaissance
     *
     * @param \DateTime $datenaissance
     * @return OldFilmFifPersonne
     */
    public function setDatenaissance($datenaissance)
    {
        $this->datenaissance = $datenaissance;

        return $this;
    }

    /**
     * Get datenaissance
     *
     * @return \DateTime 
     */
    public function getDatenaissance()
    {
        return $this->datenaissance;
    }

    /**
     * Set inversionnom
     *
     * @param string $inversionnom
     * @return OldFilmFifPersonne
     */
    public function setInversionnom($inversionnom)
    {
        $this->inversionnom = $inversionnom;

        return $this;
    }

    /**
     * Get inversionnom
     *
     * @return string 
     */
    public function getInversionnom()
    {
        return $this->inversionnom;
    }

    /**
     * Set idadresse
     *
     * @param integer $idadresse
     * @return OldFilmFifPersonne
     */
    public function setIdadresse($idadresse)
    {
        $this->idadresse = $idadresse;

        return $this;
    }

    /**
     * Get idadresse
     *
     * @return integer 
     */
    public function getIdadresse()
    {
        return $this->idadresse;
    }

    /**
     * Set idprofession
     *
     * @param integer $idprofession
     * @return OldFilmFifPersonne
     */
    public function setIdprofession($idprofession)
    {
        $this->idprofession = $idprofession;

        return $this;
    }

    /**
     * Get idprofession
     *
     * @return integer 
     */
    public function getIdprofession()
    {
        return $this->idprofession;
    }

    /**
     * Set internet
     *
     * @param string $internet
     * @return OldFilmFifPersonne
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
