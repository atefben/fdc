<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldFilmLibelleFilm
 *
 * @ORM\Table(name="old_FILM_LIBELLE_FILM")
 * @ORM\Entity
 */
class OldFilmLibelleFilm
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATEMODIFICATION", type="date", nullable=true)
     */
    protected $datemodification;

    /**
     * @var string
     *
     * @ORM\Column(name="LANGUE", type="string", length=3, nullable=true)
     */
    protected $langue;

    /**
     * @var string
     *
     * @ORM\Column(name="IDTYPE", type="decimal", precision=10, scale=0, nullable=true)
     */
    protected $idtype;

    /**
     * @var string
     *
     * @ORM\Column(name="IDENREG", type="string", length=36, nullable=true)
     */
    protected $idenreg;

    /**
     * @var string
     *
     * @ORM\Column(name="LIBELLE", type="string", length=4000, nullable=false)
     */
    protected $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="IDUTILISATEUR", type="decimal", precision=10, scale=0, nullable=true)
     */
    protected $idutilisateur;



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
     * @return OldFilmLibelleFilm
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
     * @return OldFilmLibelleFilm
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
     * Set idtype
     *
     * @param string $idtype
     * @return OldFilmLibelleFilm
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
     * @return OldFilmLibelleFilm
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
     * @return OldFilmLibelleFilm
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
     * Set idutilisateur
     *
     * @param string $idutilisateur
     * @return OldFilmLibelleFilm
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
}
