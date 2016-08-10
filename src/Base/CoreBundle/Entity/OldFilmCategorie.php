<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldFilmCategorie
 *
 * @ORM\Table(name="old_FILM_CATEGORIE", indexes={@ORM\Index(name="DATEMODIFICATION", columns={"DATEMODIFICATION"})})
 * @ORM\Entity
 */
class OldFilmCategorie
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDCATEGORIE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcategorie;

    /**
     * @var string
     *
     * @ORM\Column(name="CATEGORIE_VF", type="string", length=50, nullable=true)
     */
    private $categorieVf;

    /**
     * @var string
     *
     * @ORM\Column(name="CATEGORIE_VA", type="string", length=50, nullable=true)
     */
    private $categorieVa;

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
     * @var integer
     *
     * @ORM\Column(name="ORDRE", type="integer", nullable=false)
     */
    private $ordre;



    /**
     * Get idcategorie
     *
     * @return integer 
     */
    public function getIdcategorie()
    {
        return $this->idcategorie;
    }

    /**
     * Set categorieVf
     *
     * @param string $categorieVf
     * @return OldFilmCategorie
     */
    public function setCategorieVf($categorieVf)
    {
        $this->categorieVf = $categorieVf;

        return $this;
    }

    /**
     * Get categorieVf
     *
     * @return string 
     */
    public function getCategorieVf()
    {
        return $this->categorieVf;
    }

    /**
     * Set categorieVa
     *
     * @param string $categorieVa
     * @return OldFilmCategorie
     */
    public function setCategorieVa($categorieVa)
    {
        $this->categorieVa = $categorieVa;

        return $this;
    }

    /**
     * Get categorieVa
     *
     * @return string 
     */
    public function getCategorieVa()
    {
        return $this->categorieVa;
    }

    /**
     * Set datecreation
     *
     * @param \DateTime $datecreation
     * @return OldFilmCategorie
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
     * @return OldFilmCategorie
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
     * @param integer $ordre
     * @return OldFilmCategorie
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
}
