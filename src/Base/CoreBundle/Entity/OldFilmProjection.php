<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldFilmProjection
 *
 * @ORM\Table(name="old_FILM_PROJECTION", indexes={@ORM\Index(name="INDFPRIDFILM", columns={"IDFILM"}), @ORM\Index(name="DATEPROJECTION", columns={"DATEPROJECTION"}), @ORM\Index(name="IDSALLE", columns={"IDSALLE"}), @ORM\Index(name="DATEMODIFICATION", columns={"DATEMODIFICATION"}), @ORM\Index(name="SECTIONPROGRAMMATION_VF", columns={"SECTIONPROGRAMMATION_VF"}), @ORM\Index(name="SECTIONPROGRAMMATION_VA", columns={"SECTIONPROGRAMMATION_VA"})})
 * @ORM\Entity
 */
class OldFilmProjection
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPROJECTION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idprojection;

    /**
     * @var string
     *
     * @ORM\Column(name="IDFESTIVAL", type="decimal", precision=22, scale=0, nullable=true)
     */
    private $idfestival;

    /**
     * @var string
     *
     * @ORM\Column(name="IDFILM", type="string", length=36, nullable=true)
     */
    private $idfilm;

    /**
     * @var string
     *
     * @ORM\Column(name="COMMENTAIRES", type="string", length=250, nullable=true)
     */
    private $commentaires;

    /**
     * @var string
     *
     * @ORM\Column(name="NUMERO", type="decimal", precision=2, scale=0, nullable=true)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="CODEJOUR", type="string", length=2, nullable=true)
     */
    private $codejour;

    /**
     * @var string
     *
     * @ORM\Column(name="LIBELLEHORRAIRE", type="string", length=50, nullable=true)
     */
    private $libellehorraire;

    /**
     * @var string
     *
     * @ORM\Column(name="FICHIER", type="string", length=40, nullable=true)
     */
    private $fichier;

    /**
     * @var string
     *
     * @ORM\Column(name="BLOQUE", type="string", length=1, nullable=true)
     */
    private $bloque;

    /**
     * @var string
     *
     * @ORM\Column(name="IDMODELE", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $idmodele;

    /**
     * @var string
     *
     * @ORM\Column(name="CONTROLINFO", type="string", length=1, nullable=true)
     */
    private $controlinfo;

    /**
     * @var string
     *
     * @ORM\Column(name="POINT", type="decimal", precision=3, scale=0, nullable=true)
     */
    private $point;

    /**
     * @var string
     *
     * @ORM\Column(name="ADMIN", type="string", length=1, nullable=true)
     */
    private $admin;

    /**
     * @var string
     *
     * @ORM\Column(name="LISTEATTENTE", type="decimal", precision=3, scale=0, nullable=true)
     */
    private $listeattente;

    /**
     * @var string
     *
     * @ORM\Column(name="PRESENCEEQUIPE", type="string", length=1, nullable=true)
     */
    private $presenceequipe;

    /**
     * @var string
     *
     * @ORM\Column(name="LIBELLE", type="string", length=40, nullable=true)
     */
    private $libelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATEPROJECTION", type="datetime", nullable=true)
     */
    private $dateprojection;

    /**
     * @var string
     *
     * @ORM\Column(name="DEBUT", type="string", length=5, nullable=true)
     */
    private $debut;

    /**
     * @var string
     *
     * @ORM\Column(name="FIN", type="string", length=5, nullable=true)
     */
    private $fin;

    /**
     * @var string
     *
     * @ORM\Column(name="IDSALLE", type="decimal", precision=22, scale=0, nullable=true)
     */
    private $idsalle;

    /**
     * @var string
     *
     * @ORM\Column(name="TYPEPROJ", type="string", length=40, nullable=true)
     */
    private $typeproj;

    /**
     * @var string
     *
     * @ORM\Column(name="AVERTISSEMENT", type="string", length=1, nullable=true)
     */
    private $avertissement;

    /**
     * @var string
     *
     * @ORM\Column(name="SPECIALE", type="string", length=1, nullable=true)
     */
    private $speciale;

    /**
     * @var string
     *
     * @ORM\Column(name="TENU", type="string", length=25, nullable=true)
     */
    private $tenu;

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
     * @ORM\Column(name="AGENDA", type="string", length=50, nullable=true)
     */
    private $agenda;

    /**
     * @var string
     *
     * @ORM\Column(name="SECTIONPROGRAMMATION_VF", type="string", length=255, nullable=true)
     */
    private $sectionprogrammationVf;

    /**
     * @var string
     *
     * @ORM\Column(name="SECTIONPROGRAMMATION_VA", type="string", length=255, nullable=true)
     */
    private $sectionprogrammationVa;



    /**
     * Get idprojection
     *
     * @return integer 
     */
    public function getIdprojection()
    {
        return $this->idprojection;
    }

    /**
     * Set idfestival
     *
     * @param string $idfestival
     * @return OldFilmProjection
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
     * Set idfilm
     *
     * @param string $idfilm
     * @return OldFilmProjection
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
     * Set commentaires
     *
     * @param string $commentaires
     * @return OldFilmProjection
     */
    public function setCommentaires($commentaires)
    {
        $this->commentaires = $commentaires;

        return $this;
    }

    /**
     * Get commentaires
     *
     * @return string 
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * Set numero
     *
     * @param string $numero
     * @return OldFilmProjection
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set codejour
     *
     * @param string $codejour
     * @return OldFilmProjection
     */
    public function setCodejour($codejour)
    {
        $this->codejour = $codejour;

        return $this;
    }

    /**
     * Get codejour
     *
     * @return string 
     */
    public function getCodejour()
    {
        return $this->codejour;
    }

    /**
     * Set libellehorraire
     *
     * @param string $libellehorraire
     * @return OldFilmProjection
     */
    public function setLibellehorraire($libellehorraire)
    {
        $this->libellehorraire = $libellehorraire;

        return $this;
    }

    /**
     * Get libellehorraire
     *
     * @return string 
     */
    public function getLibellehorraire()
    {
        return $this->libellehorraire;
    }

    /**
     * Set fichier
     *
     * @param string $fichier
     * @return OldFilmProjection
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
     * Set bloque
     *
     * @param string $bloque
     * @return OldFilmProjection
     */
    public function setBloque($bloque)
    {
        $this->bloque = $bloque;

        return $this;
    }

    /**
     * Get bloque
     *
     * @return string 
     */
    public function getBloque()
    {
        return $this->bloque;
    }

    /**
     * Set idmodele
     *
     * @param string $idmodele
     * @return OldFilmProjection
     */
    public function setIdmodele($idmodele)
    {
        $this->idmodele = $idmodele;

        return $this;
    }

    /**
     * Get idmodele
     *
     * @return string 
     */
    public function getIdmodele()
    {
        return $this->idmodele;
    }

    /**
     * Set controlinfo
     *
     * @param string $controlinfo
     * @return OldFilmProjection
     */
    public function setControlinfo($controlinfo)
    {
        $this->controlinfo = $controlinfo;

        return $this;
    }

    /**
     * Get controlinfo
     *
     * @return string 
     */
    public function getControlinfo()
    {
        return $this->controlinfo;
    }

    /**
     * Set point
     *
     * @param string $point
     * @return OldFilmProjection
     */
    public function setPoint($point)
    {
        $this->point = $point;

        return $this;
    }

    /**
     * Get point
     *
     * @return string 
     */
    public function getPoint()
    {
        return $this->point;
    }

    /**
     * Set admin
     *
     * @param string $admin
     * @return OldFilmProjection
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;

        return $this;
    }

    /**
     * Get admin
     *
     * @return string 
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * Set listeattente
     *
     * @param string $listeattente
     * @return OldFilmProjection
     */
    public function setListeattente($listeattente)
    {
        $this->listeattente = $listeattente;

        return $this;
    }

    /**
     * Get listeattente
     *
     * @return string 
     */
    public function getListeattente()
    {
        return $this->listeattente;
    }

    /**
     * Set presenceequipe
     *
     * @param string $presenceequipe
     * @return OldFilmProjection
     */
    public function setPresenceequipe($presenceequipe)
    {
        $this->presenceequipe = $presenceequipe;

        return $this;
    }

    /**
     * Get presenceequipe
     *
     * @return string 
     */
    public function getPresenceequipe()
    {
        return $this->presenceequipe;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return OldFilmProjection
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set dateprojection
     *
     * @param \DateTime $dateprojection
     * @return OldFilmProjection
     */
    public function setDateprojection($dateprojection)
    {
        $this->dateprojection = $dateprojection;

        return $this;
    }

    /**
     * Get dateprojection
     *
     * @return \DateTime 
     */
    public function getDateprojection()
    {
        return $this->dateprojection;
    }

    /**
     * Set debut
     *
     * @param string $debut
     * @return OldFilmProjection
     */
    public function setDebut($debut)
    {
        $this->debut = $debut;

        return $this;
    }

    /**
     * Get debut
     *
     * @return string 
     */
    public function getDebut()
    {
        return $this->debut;
    }

    /**
     * Set fin
     *
     * @param string $fin
     * @return OldFilmProjection
     */
    public function setFin($fin)
    {
        $this->fin = $fin;

        return $this;
    }

    /**
     * Get fin
     *
     * @return string 
     */
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * Set idsalle
     *
     * @param string $idsalle
     * @return OldFilmProjection
     */
    public function setIdsalle($idsalle)
    {
        $this->idsalle = $idsalle;

        return $this;
    }

    /**
     * Get idsalle
     *
     * @return string 
     */
    public function getIdsalle()
    {
        return $this->idsalle;
    }

    /**
     * Set typeproj
     *
     * @param string $typeproj
     * @return OldFilmProjection
     */
    public function setTypeproj($typeproj)
    {
        $this->typeproj = $typeproj;

        return $this;
    }

    /**
     * Get typeproj
     *
     * @return string 
     */
    public function getTypeproj()
    {
        return $this->typeproj;
    }

    /**
     * Set avertissement
     *
     * @param string $avertissement
     * @return OldFilmProjection
     */
    public function setAvertissement($avertissement)
    {
        $this->avertissement = $avertissement;

        return $this;
    }

    /**
     * Get avertissement
     *
     * @return string 
     */
    public function getAvertissement()
    {
        return $this->avertissement;
    }

    /**
     * Set speciale
     *
     * @param string $speciale
     * @return OldFilmProjection
     */
    public function setSpeciale($speciale)
    {
        $this->speciale = $speciale;

        return $this;
    }

    /**
     * Get speciale
     *
     * @return string 
     */
    public function getSpeciale()
    {
        return $this->speciale;
    }

    /**
     * Set tenu
     *
     * @param string $tenu
     * @return OldFilmProjection
     */
    public function setTenu($tenu)
    {
        $this->tenu = $tenu;

        return $this;
    }

    /**
     * Get tenu
     *
     * @return string 
     */
    public function getTenu()
    {
        return $this->tenu;
    }

    /**
     * Set datecreation
     *
     * @param \DateTime $datecreation
     * @return OldFilmProjection
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
     * @return OldFilmProjection
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
     * Set agenda
     *
     * @param string $agenda
     * @return OldFilmProjection
     */
    public function setAgenda($agenda)
    {
        $this->agenda = $agenda;

        return $this;
    }

    /**
     * Get agenda
     *
     * @return string 
     */
    public function getAgenda()
    {
        return $this->agenda;
    }

    /**
     * Set sectionprogrammationVf
     *
     * @param string $sectionprogrammationVf
     * @return OldFilmProjection
     */
    public function setSectionprogrammationVf($sectionprogrammationVf)
    {
        $this->sectionprogrammationVf = $sectionprogrammationVf;

        return $this;
    }

    /**
     * Get sectionprogrammationVf
     *
     * @return string 
     */
    public function getSectionprogrammationVf()
    {
        return $this->sectionprogrammationVf;
    }

    /**
     * Set sectionprogrammationVa
     *
     * @param string $sectionprogrammationVa
     * @return OldFilmProjection
     */
    public function setSectionprogrammationVa($sectionprogrammationVa)
    {
        $this->sectionprogrammationVa = $sectionprogrammationVa;

        return $this;
    }

    /**
     * Get sectionprogrammationVa
     *
     * @return string 
     */
    public function getSectionprogrammationVa()
    {
        return $this->sectionprogrammationVa;
    }
}
