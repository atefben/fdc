<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldFilmFonctionjury
 *
 * @ORM\Table(name="old_FILM_FONCTIONJURY", indexes={@ORM\Index(name="FONCTION_VF", columns={"FONCTION_VF"}), @ORM\Index(name="FONCTION_VA", columns={"FONCTION_VA"}), @ORM\Index(name="ORDRE", columns={"ORDRE"}), @ORM\Index(name="DATEMODIFICATION", columns={"DATEMODIFICATION"})})
 * @ORM\Entity
 */
class OldFilmFonctionjury
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDFONCTIONJURY", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idfonctionjury;

    /**
     * @var string
     *
     * @ORM\Column(name="FONCTION_VF", type="string", length=30, nullable=true)
     */
    private $fonctionVf;

    /**
     * @var string
     *
     * @ORM\Column(name="FONCTION_VA", type="string", length=30, nullable=true)
     */
    private $fonctionVa;

    /**
     * @var integer
     *
     * @ORM\Column(name="ORDRE", type="integer", nullable=true)
     */
    private $ordre;

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
     * Get idfonctionjury
     *
     * @return integer 
     */
    public function getIdfonctionjury()
    {
        return $this->idfonctionjury;
    }

    /**
     * Set fonctionVf
     *
     * @param string $fonctionVf
     * @return OldFilmFonctionjury
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
     * @return OldFilmFonctionjury
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
     * Set ordre
     *
     * @param integer $ordre
     * @return OldFilmFonctionjury
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
     * @return OldFilmFonctionjury
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
     * @return OldFilmFonctionjury
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
