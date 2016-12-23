<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldFilmAtelierGenerique
 *
 * @ORM\Table(name="old_FILM_ATELIER_GENERIQUE", indexes={@ORM\Index(name="INDFGENIDPERSONNE", columns={"IDPERSONNE"}), @ORM\Index(name="INDFIDFILMORDRE", columns={"IDFILM", "ORDRE"}), @ORM\Index(name="ORDRE", columns={"ORDRE"}), @ORM\Index(name="IDFONCTION", columns={"IDFONCTION"})})
 * @ORM\Entity
 */
class OldFilmAtelierGenerique
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDGENERIQUE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idgenerique;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDPERSONNE", type="integer", nullable=true)
     */
    protected $idpersonne;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFILM", type="integer", nullable=true)
     */
    protected $idfilm;

    /**
     * @var string
     *
     * @ORM\Column(name="FONCTION_VF", type="string", length=40, nullable=true)
     */
    protected $fonctionVf;

    /**
     * @var string
     *
     * @ORM\Column(name="FONCTION_VA", type="string", length=40, nullable=true)
     */
    protected $fonctionVa;

    /**
     * @var string
     *
     * @ORM\Column(name="ROLE_VF", type="string", length=50, nullable=true)
     */
    protected $roleVf;

    /**
     * @var string
     *
     * @ORM\Column(name="ROLE_VA", type="string", length=50, nullable=true)
     */
    protected $roleVa;

    /**
     * @var string
     *
     * @ORM\Column(name="ORDRE", type="decimal", precision=22, scale=0, nullable=true)
     */
    protected $ordre;

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
     * @ORM\Column(name="IDFONCTION", type="integer", nullable=true)
     */
    protected $idfonction;



    /**
     * Get idgenerique
     *
     * @return integer 
     */
    public function getIdgenerique()
    {
        return $this->idgenerique;
    }

    /**
     * Set idpersonne
     *
     * @param integer $idpersonne
     * @return OldFilmAtelierGenerique
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
     * Set idfilm
     *
     * @param integer $idfilm
     * @return OldFilmAtelierGenerique
     */
    public function setIdfilm($idfilm)
    {
        $this->idfilm = $idfilm;

        return $this;
    }

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
     * Set fonctionVf
     *
     * @param string $fonctionVf
     * @return OldFilmAtelierGenerique
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
     * @return OldFilmAtelierGenerique
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
     * Set roleVf
     *
     * @param string $roleVf
     * @return OldFilmAtelierGenerique
     */
    public function setRoleVf($roleVf)
    {
        $this->roleVf = $roleVf;

        return $this;
    }

    /**
     * Get roleVf
     *
     * @return string 
     */
    public function getRoleVf()
    {
        return $this->roleVf;
    }

    /**
     * Set roleVa
     *
     * @param string $roleVa
     * @return OldFilmAtelierGenerique
     */
    public function setRoleVa($roleVa)
    {
        $this->roleVa = $roleVa;

        return $this;
    }

    /**
     * Get roleVa
     *
     * @return string 
     */
    public function getRoleVa()
    {
        return $this->roleVa;
    }

    /**
     * Set ordre
     *
     * @param string $ordre
     * @return OldFilmAtelierGenerique
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
     * Set datecreation
     *
     * @param \DateTime $datecreation
     * @return OldFilmAtelierGenerique
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
     * @return OldFilmAtelierGenerique
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
     * Set idfonction
     *
     * @param integer $idfonction
     * @return OldFilmAtelierGenerique
     */
    public function setIdfonction($idfonction)
    {
        $this->idfonction = $idfonction;

        return $this;
    }

    /**
     * Get idfonction
     *
     * @return integer 
     */
    public function getIdfonction()
    {
        return $this->idfonction;
    }
}
