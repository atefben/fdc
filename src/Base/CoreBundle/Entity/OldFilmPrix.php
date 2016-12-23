<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldFilmPrix
 *
 * @ORM\Table(name="old_FILM_PRIX", indexes={@ORM\Index(name="IMPORTANCE", columns={"IMPORTANCE"}), @ORM\Index(name="DATEMODIFICATION", columns={"DATEMODIFICATION"})})
 * @ORM\Entity
 */
class OldFilmPrix
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPRIX", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idprix;

    /**
     * @var string
     *
     * @ORM\Column(name="LIBELLE", type="string", length=255, nullable=true)
     */
    protected $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="IMPORTANCE", type="decimal", precision=22, scale=0, nullable=true)
     */
    protected $importance;

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
     * @ORM\Column(name="LIBELLEUS", type="string", length=255, nullable=true)
     */
    protected $libelleus;

    /**
     * @var string
     *
     * @ORM\Column(name="IMPORTANCE2", type="decimal", precision=22, scale=0, nullable=true)
     */
    protected $importance2;



    /**
     * Get idprix
     *
     * @return integer 
     */
    public function getIdprix()
    {
        return $this->idprix;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return OldFilmPrix
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
     * Set importance
     *
     * @param string $importance
     * @return OldFilmPrix
     */
    public function setImportance($importance)
    {
        $this->importance = $importance;

        return $this;
    }

    /**
     * Get importance
     *
     * @return string 
     */
    public function getImportance()
    {
        return $this->importance;
    }

    /**
     * Set datecreation
     *
     * @param \DateTime $datecreation
     * @return OldFilmPrix
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
     * @return OldFilmPrix
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
     * Set libelleus
     *
     * @param string $libelleus
     * @return OldFilmPrix
     */
    public function setLibelleus($libelleus)
    {
        $this->libelleus = $libelleus;

        return $this;
    }

    /**
     * Get libelleus
     *
     * @return string 
     */
    public function getLibelleus()
    {
        return $this->libelleus;
    }

    /**
     * Set importance2
     *
     * @param string $importance2
     * @return OldFilmPrix
     */
    public function setImportance2($importance2)
    {
        $this->importance2 = $importance2;

        return $this;
    }

    /**
     * Get importance2
     *
     * @return string 
     */
    public function getImportance2()
    {
        return $this->importance2;
    }
}
