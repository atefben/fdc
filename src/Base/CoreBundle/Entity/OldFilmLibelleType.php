<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldFilmLibelleType
 *
 * @ORM\Table(name="old_FILM_LIBELLE_TYPE")
 * @ORM\Entity
 */
class OldFilmLibelleType
{
    /**
     * @var string
     *
     * @ORM\Column(name="IDTYPE", type="decimal", precision=10, scale=0, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtype;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATEMODIFICATION", type="datetime", nullable=true)
     */
    private $datemodification;

    /**
     * @var string
     *
     * @ORM\Column(name="LIBELLE", type="string", length=200, nullable=false)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="TABLEDEST", type="string", length=50, nullable=true)
     */
    private $tabledest;

    /**
     * @var string
     *
     * @ORM\Column(name="TABLEORIG", type="string", length=50, nullable=true)
     */
    private $tableorig;

    /**
     * @var string
     *
     * @ORM\Column(name="TABLECLE", type="string", length=50, nullable=true)
     */
    private $tablecle;

    /**
     * @var string
     *
     * @ORM\Column(name="TABLECOLUMN", type="string", length=50, nullable=false)
     */
    private $tablecolumn;



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
     * Set datemodification
     *
     * @param \DateTime $datemodification
     * @return OldFilmLibelleType
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
     * Set libelle
     *
     * @param string $libelle
     * @return OldFilmLibelleType
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
     * Set tabledest
     *
     * @param string $tabledest
     * @return OldFilmLibelleType
     */
    public function setTabledest($tabledest)
    {
        $this->tabledest = $tabledest;

        return $this;
    }

    /**
     * Get tabledest
     *
     * @return string 
     */
    public function getTabledest()
    {
        return $this->tabledest;
    }

    /**
     * Set tableorig
     *
     * @param string $tableorig
     * @return OldFilmLibelleType
     */
    public function setTableorig($tableorig)
    {
        $this->tableorig = $tableorig;

        return $this;
    }

    /**
     * Get tableorig
     *
     * @return string 
     */
    public function getTableorig()
    {
        return $this->tableorig;
    }

    /**
     * Set tablecle
     *
     * @param string $tablecle
     * @return OldFilmLibelleType
     */
    public function setTablecle($tablecle)
    {
        $this->tablecle = $tablecle;

        return $this;
    }

    /**
     * Get tablecle
     *
     * @return string 
     */
    public function getTablecle()
    {
        return $this->tablecle;
    }

    /**
     * Set tablecolumn
     *
     * @param string $tablecolumn
     * @return OldFilmLibelleType
     */
    public function setTablecolumn($tablecolumn)
    {
        $this->tablecolumn = $tablecolumn;

        return $this;
    }

    /**
     * Get tablecolumn
     *
     * @return string 
     */
    public function getTablecolumn()
    {
        return $this->tablecolumn;
    }
}
