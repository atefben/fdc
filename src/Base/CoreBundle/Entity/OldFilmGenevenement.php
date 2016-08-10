<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldFilmGenevenement
 *
 * @ORM\Table(name="old_FILM_GENEVENEMENT", indexes={@ORM\Index(name="FILM_GENEVENEMENT_FI_1", columns={"IDEVENEMENT"}), @ORM\Index(name="FILM_GENEVENEMENT_FI_2", columns={"IDPARTICIPANT"}), @ORM\Index(name="FILM_GENEVENEMENT_FI_3", columns={"IDFILM"}), @ORM\Index(name="DATEMODIFICATION", columns={"DATEMODIFICATION"})})
 * @ORM\Entity
 */
class OldFilmGenevenement
{
    /**
     * @var string
     *
     * @ORM\Column(name="IDGENEVENEMENT", type="decimal", precision=10, scale=0, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idgenevenement;

    /**
     * @var string
     *
     * @ORM\Column(name="IDEVENEMENT", type="decimal", precision=22, scale=0, nullable=true)
     */
    private $idevenement;

    /**
     * @var string
     *
     * @ORM\Column(name="IDPARTICIPANT", type="decimal", precision=22, scale=0, nullable=true)
     */
    private $idparticipant;

    /**
     * @var string
     *
     * @ORM\Column(name="IDFILM", type="decimal", precision=22, scale=0, nullable=true)
     */
    private $idfilm;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPTION_VF", type="text", nullable=true)
     */
    private $descriptionVf;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPTION_VA", type="text", nullable=true)
     */
    private $descriptionVa;

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
     * Get idgenevenement
     *
     * @return string 
     */
    public function getIdgenevenement()
    {
        return $this->idgenevenement;
    }

    /**
     * Set idevenement
     *
     * @param string $idevenement
     * @return OldFilmGenevenement
     */
    public function setIdevenement($idevenement)
    {
        $this->idevenement = $idevenement;

        return $this;
    }

    /**
     * Get idevenement
     *
     * @return string 
     */
    public function getIdevenement()
    {
        return $this->idevenement;
    }

    /**
     * Set idparticipant
     *
     * @param string $idparticipant
     * @return OldFilmGenevenement
     */
    public function setIdparticipant($idparticipant)
    {
        $this->idparticipant = $idparticipant;

        return $this;
    }

    /**
     * Get idparticipant
     *
     * @return string 
     */
    public function getIdparticipant()
    {
        return $this->idparticipant;
    }

    /**
     * Set idfilm
     *
     * @param string $idfilm
     * @return OldFilmGenevenement
     */
    public function setIdfilm($idfilm)
    {
        $this->idfilm = $idfilm;

        return $this;
    }

    /**
     * Get idfilm
     *
     * @return string 
     */
    public function getIdfilm()
    {
        return $this->idfilm;
    }

    /**
     * Set descriptionVf
     *
     * @param string $descriptionVf
     * @return OldFilmGenevenement
     */
    public function setDescriptionVf($descriptionVf)
    {
        $this->descriptionVf = $descriptionVf;

        return $this;
    }

    /**
     * Get descriptionVf
     *
     * @return string 
     */
    public function getDescriptionVf()
    {
        return $this->descriptionVf;
    }

    /**
     * Set descriptionVa
     *
     * @param string $descriptionVa
     * @return OldFilmGenevenement
     */
    public function setDescriptionVa($descriptionVa)
    {
        $this->descriptionVa = $descriptionVa;

        return $this;
    }

    /**
     * Get descriptionVa
     *
     * @return string 
     */
    public function getDescriptionVa()
    {
        return $this->descriptionVa;
    }

    /**
     * Set datecreation
     *
     * @param \DateTime $datecreation
     * @return OldFilmGenevenement
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
     * @return OldFilmGenevenement
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
