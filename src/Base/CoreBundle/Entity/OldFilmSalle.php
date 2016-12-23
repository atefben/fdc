<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldFilmSalle
 *
 * @ORM\Table(name="old_FILM_SALLE", indexes={@ORM\Index(name="DATEMODIFICATION", columns={"DATEMODIFICATION"})})
 * @ORM\Entity
 */
class OldFilmSalle
{
    /**
     * @var string
     *
     * @ORM\Column(name="IDSALLE", type="decimal", precision=10, scale=0, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idsalle;

    /**
     * @var string
     *
     * @ORM\Column(name="LIBELLE", type="string", length=80, nullable=true)
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
     * Get idsalle
     *
     * @return string 
     */
    public function getIdsalle()
    {
        return $this->idsalle;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return OldFilmSalle
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
     * @return OldFilmSalle
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
     * @return OldFilmSalle
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
