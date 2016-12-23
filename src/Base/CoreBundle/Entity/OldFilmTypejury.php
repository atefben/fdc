<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldFilmTypejury
 *
 * @ORM\Table(name="old_FILM_TYPEJURY", indexes={@ORM\Index(name="ORDRE", columns={"ORDRE"}), @ORM\Index(name="DATEMODIFICATION", columns={"DATEMODIFICATION"})})
 * @ORM\Entity
 */
class OldFilmTypejury
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDTYPEJURY", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idtypejury;

    /**
     * @var string
     *
     * @ORM\Column(name="TYPEJURY_VF", type="string", length=30, nullable=true)
     */
    protected $typejuryVf;

    /**
     * @var string
     *
     * @ORM\Column(name="TYPEJURY_VA", type="string", length=30, nullable=true)
     */
    protected $typejuryVa;

    /**
     * @var integer
     *
     * @ORM\Column(name="ORDRE", type="integer", nullable=true)
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
     * Get idtypejury
     *
     * @return integer 
     */
    public function getIdtypejury()
    {
        return $this->idtypejury;
    }

    /**
     * Set typejuryVf
     *
     * @param string $typejuryVf
     * @return OldFilmTypejury
     */
    public function setTypejuryVf($typejuryVf)
    {
        $this->typejuryVf = $typejuryVf;

        return $this;
    }

    /**
     * Get typejuryVf
     *
     * @return string 
     */
    public function getTypejuryVf()
    {
        return $this->typejuryVf;
    }

    /**
     * Set typejuryVa
     *
     * @param string $typejuryVa
     * @return OldFilmTypejury
     */
    public function setTypejuryVa($typejuryVa)
    {
        $this->typejuryVa = $typejuryVa;

        return $this;
    }

    /**
     * Get typejuryVa
     *
     * @return string 
     */
    public function getTypejuryVa()
    {
        return $this->typejuryVa;
    }

    /**
     * Set ordre
     *
     * @param integer $ordre
     * @return OldFilmTypejury
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * Get ordre
     *
     * @return integer 
     */
    public function getOrdre()
    {
        return $this->ordre;
    }

    /**
     * Set datecreation
     *
     * @param \DateTime $datecreation
     * @return OldFilmTypejury
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
     * @return OldFilmTypejury
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
}
