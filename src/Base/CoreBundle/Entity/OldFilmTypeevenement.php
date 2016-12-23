<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldFilmTypeevenement
 *
 * @ORM\Table(name="old_FILM_TYPEEVENEMENT", indexes={@ORM\Index(name="ORDRE", columns={"ORDRE"}), @ORM\Index(name="INTERNET", columns={"INTERNET"}), @ORM\Index(name="DATEMODIFICATION", columns={"DATEMODIFICATION"}), @ORM\Index(name="PROGRAMME", columns={"PROGRAMME"})})
 * @ORM\Entity
 */
class OldFilmTypeevenement
{
    /**
     * @var string
     *
     * @ORM\Column(name="IDTYPEEVENEMENT", type="decimal", precision=10, scale=0, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idtypeevenement;

    /**
     * @var string
     *
     * @ORM\Column(name="LIBELLE", type="string", length=20, nullable=true)
     */
    protected $libelle;

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
     * @var string
     *
     * @ORM\Column(name="ORDRE", type="decimal", precision=22, scale=0, nullable=true)
     */
    protected $ordre;

    /**
     * @var string
     *
     * @ORM\Column(name="INTERNET", type="string", length=1, nullable=true)
     */
    protected $internet;

    /**
     * @var string
     *
     * @ORM\Column(name="PROGRAMME", type="string", length=1, nullable=true)
     */
    protected $programme;



    /**
     * Get idtypeevenement
     *
     * @return string 
     */
    public function getIdtypeevenement()
    {
        return $this->idtypeevenement;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return OldFilmTypeevenement
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
     * Set datecreation
     *
     * @param \DateTime $datecreation
     * @return OldFilmTypeevenement
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
     * @return OldFilmTypeevenement
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
     * Set ordre
     *
     * @param string $ordre
     * @return OldFilmTypeevenement
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
     * Set internet
     *
     * @param string $internet
     * @return OldFilmTypeevenement
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
     * Set programme
     *
     * @param string $programme
     * @return OldFilmTypeevenement
     */
    public function setProgramme($programme)
    {
        $this->programme = $programme;

        return $this;
    }

    /**
     * Get programme
     *
     * @return string 
     */
    public function getProgramme()
    {
        return $this->programme;
    }
}
