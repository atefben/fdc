<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldCinefPersonne
 *
 * @ORM\Table(name="old_CINEF_PERSONNE")
 * @ORM\Entity
 */
class OldCinefPersonne
{
    /**
     * @var string
     *
     * @ORM\Column(name="IDPERSONNE", type="decimal", precision=10, scale=0, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpersonne;

    /**
     * @var string
     *
     * @ORM\Column(name="IDSESSION", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $idsession;

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
     * @ORM\Column(name="SEXE", type="string", length=20, nullable=true)
     */
    private $sexe;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMUSAGE", type="string", length=60, nullable=true)
     */
    private $nomusage;

    /**
     * @var string
     *
     * @ORM\Column(name="PRENOMUSAGE", type="string", length=60, nullable=true)
     */
    private $prenomusage;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATERECEPTION", type="datetime", nullable=true)
     */
    private $datereception;

    /**
     * @var string
     *
     * @ORM\Column(name="DUREE", type="decimal", precision=5, scale=2, nullable=true)
     */
    private $duree;

    /**
     * @var string
     *
     * @ORM\Column(name="INTERNET", type="string", length=1, nullable=true)
     */
    private $internet;

    /**
     * @var string
     *
     * @ORM\Column(name="SELECTION", type="string", length=1, nullable=true)
     */
    private $selection;

    /**
     * @var string
     *
     * @ORM\Column(name="BIO_FILMO_VF", type="string", length=1, nullable=true)
     */
    private $bioFilmoVf;

    /**
     * @var string
     *
     * @ORM\Column(name="BIO_FILMO_VA", type="string", length=1, nullable=true)
     */
    private $bioFilmoVa;



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
     * Set idsession
     *
     * @param string $idsession
     * @return OldCinefPersonne
     */
    public function setIdsession($idsession)
    {
        $this->idsession = $idsession;

        return $this;
    }

    /**
     * Get idsession
     *
     * @return string 
     */
    public function getIdsession()
    {
        return $this->idsession;
    }

    /**
     * Set datecreation
     *
     * @param \DateTime $datecreation
     * @return OldCinefPersonne
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
     * @return OldCinefPersonne
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
     * Set sexe
     *
     * @param string $sexe
     * @return OldCinefPersonne
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string 
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set nomusage
     *
     * @param string $nomusage
     * @return OldCinefPersonne
     */
    public function setNomusage($nomusage)
    {
        $this->nomusage = $nomusage;

        return $this;
    }

    /**
     * Get nomusage
     *
     * @return string 
     */
    public function getNomusage()
    {
        return $this->nomusage;
    }

    /**
     * Set prenomusage
     *
     * @param string $prenomusage
     * @return OldCinefPersonne
     */
    public function setPrenomusage($prenomusage)
    {
        $this->prenomusage = $prenomusage;

        return $this;
    }

    /**
     * Get prenomusage
     *
     * @return string 
     */
    public function getPrenomusage()
    {
        return $this->prenomusage;
    }

    /**
     * Set datereception
     *
     * @param \DateTime $datereception
     * @return OldCinefPersonne
     */
    public function setDatereception($datereception)
    {
        $this->datereception = $datereception;

        return $this;
    }

    /**
     * Get datereception
     *
     * @return \DateTime 
     */
    public function getDatereception()
    {
        return $this->datereception;
    }

    /**
     * Set duree
     *
     * @param string $duree
     * @return OldCinefPersonne
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
     * Set internet
     *
     * @param string $internet
     * @return OldCinefPersonne
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
     * @return OldCinefPersonne
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
     * Set bioFilmoVf
     *
     * @param string $bioFilmoVf
     * @return OldCinefPersonne
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
     * @return OldCinefPersonne
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
}
