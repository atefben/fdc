<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldFilmGenerique
 *
 * @ORM\Table(name="old_FILM_GENERIQUE", indexes={@ORM\Index(name="INDFGENIDPERSONNE", columns={"IDPERSONNE"}), @ORM\Index(name="IDFILM", columns={"IDFILM"}), @ORM\Index(name="FONCTION_VF", columns={"FONCTION_VF"}), @ORM\Index(name="FONCTION_VA", columns={"FONCTION_VA"}), @ORM\Index(name="ROLE_VF", columns={"ROLE_VF"}), @ORM\Index(name="ROLE_VA", columns={"ROLE_VA"}), @ORM\Index(name="ORDRE", columns={"ORDRE"}), @ORM\Index(name="DATEMODIFICATION", columns={"DATEMODIFICATION"}), @ORM\Index(name="IDFONCTION", columns={"IDFONCTION"})})
 * @ORM\Entity
 */
class OldFilmGenerique
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
     * @var string
     *
     * @ORM\Column(name="IDFILM", type="string", length=36, nullable=true)
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
     * @var string
     *
     * @ORM\Column(name="ROLE_VARE", type="string", length=255, nullable=true)
     */
    protected $roleVare;

    /**
     * @var string
     *
     * @ORM\Column(name="ROLE_VCHI", type="string", length=255, nullable=true)
     */
    protected $roleVchi;

    /**
     * @var string
     *
     * @ORM\Column(name="ROLE_VESP", type="string", length=255, nullable=true)
     */
    protected $roleVesp;

    /**
     * @var string
     *
     * @ORM\Column(name="ROLE_VJPN", type="string", length=255, nullable=true)
     */
    protected $roleVjpn;

    /**
     * @var string
     *
     * @ORM\Column(name="ROLE_VPRT", type="string", length=255, nullable=true)
     */
    protected $roleVprt;

    /**
     * @var string
     *
     * @ORM\Column(name="ROLE_VRUS", type="string", length=255, nullable=true)
     */
    protected $roleVrus;



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
     * @return OldFilmGenerique
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
     * @param string $idfilm
     * @return OldFilmGenerique
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
     * Set fonctionVf
     *
     * @param string $fonctionVf
     * @return OldFilmGenerique
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
     * @return OldFilmGenerique
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
     * @return OldFilmGenerique
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
     * @return OldFilmGenerique
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
     * @return OldFilmGenerique
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
     * @return OldFilmGenerique
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
     * @return OldFilmGenerique
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
     * @return OldFilmGenerique
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

    /**
     * Set roleVare
     *
     * @param string $roleVare
     * @return OldFilmGenerique
     */
    public function setRoleVare($roleVare)
    {
        $this->roleVare = $roleVare;

        return $this;
    }

    /**
     * Get roleVare
     *
     * @return string 
     */
    public function getRoleVare()
    {
        return $this->roleVare;
    }

    /**
     * Set roleVchi
     *
     * @param string $roleVchi
     * @return OldFilmGenerique
     */
    public function setRoleVchi($roleVchi)
    {
        $this->roleVchi = $roleVchi;

        return $this;
    }

    /**
     * Get roleVchi
     *
     * @return string 
     */
    public function getRoleVchi()
    {
        return $this->roleVchi;
    }

    /**
     * Set roleVesp
     *
     * @param string $roleVesp
     * @return OldFilmGenerique
     */
    public function setRoleVesp($roleVesp)
    {
        $this->roleVesp = $roleVesp;

        return $this;
    }

    /**
     * Get roleVesp
     *
     * @return string 
     */
    public function getRoleVesp()
    {
        return $this->roleVesp;
    }

    /**
     * Set roleVjpn
     *
     * @param string $roleVjpn
     * @return OldFilmGenerique
     */
    public function setRoleVjpn($roleVjpn)
    {
        $this->roleVjpn = $roleVjpn;

        return $this;
    }

    /**
     * Get roleVjpn
     *
     * @return string 
     */
    public function getRoleVjpn()
    {
        return $this->roleVjpn;
    }

    /**
     * Set roleVprt
     *
     * @param string $roleVprt
     * @return OldFilmGenerique
     */
    public function setRoleVprt($roleVprt)
    {
        $this->roleVprt = $roleVprt;

        return $this;
    }

    /**
     * Get roleVprt
     *
     * @return string 
     */
    public function getRoleVprt()
    {
        return $this->roleVprt;
    }

    /**
     * Set roleVrus
     *
     * @param string $roleVrus
     * @return OldFilmGenerique
     */
    public function setRoleVrus($roleVrus)
    {
        $this->roleVrus = $roleVrus;

        return $this;
    }

    /**
     * Get roleVrus
     *
     * @return string 
     */
    public function getRoleVrus()
    {
        return $this->roleVrus;
    }
}
