<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldFilmFonction
 *
 * @ORM\Table(name="old_FILM_FONCTION", indexes={@ORM\Index(name="FONCTION_VF", columns={"FONCTION_VF"}), @ORM\Index(name="FONCTION_VA", columns={"FONCTION_VA"}), @ORM\Index(name="DATEMODIFICATION", columns={"DATEMODIFICATION"}), @ORM\Index(name="ORDRE", columns={"ORDRE"})})
 * @ORM\Entity
 */
class OldFilmFonction
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDFONCTION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idfonction;

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
     * Get idfonction
     *
     * @return integer 
     */
    public function getIdfonction()
    {
        return $this->idfonction;
    }

    /**
     * Set fonctionVf
     *
     * @param string $fonctionVf
     * @return OldFilmFonction
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
     * @return OldFilmFonction
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
     * @return OldFilmFonction
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
     * @return OldFilmFonction
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
     * @return OldFilmFonction
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
