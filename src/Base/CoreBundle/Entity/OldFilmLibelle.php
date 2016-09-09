<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldFilmLibelle
 *
 * @ORM\Table(name="old_FILM_LIBELLE")
 * @ORM\Entity
 */
class OldFilmLibelle
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATEMODIFICATION", type="date", nullable=true)
     */
    private $datemodification;

    /**
     * @var string
     *
     * @ORM\Column(name="LANGUE", type="string", length=3, nullable=true)
     */
    private $langue;

    /**
     * @var string
     *
     * @ORM\Column(name="IDUTILISATEUR", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $idutilisateur;

    /**
     * @var string
     *
     * @ORM\Column(name="IDTYPE", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $idtype;

    /**
     * @var string
     *
     * @ORM\Column(name="IDENREG", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $idenreg;

    /**
     * @var string
     *
     * @ORM\Column(name="LIBELLE", type="string", length=2000, nullable=false)
     */
    private $libelle;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set datemodification
     *
     * @param \DateTime $datemodification
     * @return OldFilmLibelle
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
     * Set langue
     *
     * @param string $langue
     * @return OldFilmLibelle
     */
    public function setLangue($langue)
    {
        $this->langue = $langue;

        return $this;
    }

    /**
     * Get langue
     *
     * @return string 
     */
    public function getLangue()
    {
        return $this->langue;
    }

    /**
     * Set idutilisateur
     *
     * @param string $idutilisateur
     * @return OldFilmLibelle
     */
    public function setIdutilisateur($idutilisateur)
    {
        $this->idutilisateur = $idutilisateur;

        return $this;
    }

    /**
     * Get idutilisateur
     *
     * @return string 
     */
    public function getIdutilisateur()
    {
        return $this->idutilisateur;
    }

    /**
     * Set idtype
     *
     * @param string $idtype
     * @return OldFilmLibelle
     */
    public function setIdtype($idtype)
    {
        $this->idtype = $idtype;

        return $this;
    }

    /**
     * Get idtype
     *
     * @return string 
     */
    public function getIdtype()
    {
        return $this->idtype;
    }

    /**
     * Set idenreg
     *
     * @param string $idenreg
     * @return OldFilmLibelle
     */
    public function setIdenreg($idenreg)
    {
        $this->idenreg = $idenreg;

        return $this;
    }

    /**
     * Get idenreg
     *
     * @return string 
     */
    public function getIdenreg()
    {
        return $this->idenreg;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return OldFilmLibelle
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
}
