<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldFilmPalmares
 *
 * @ORM\Table(name="old_FILM_PALMARES", indexes={@ORM\Index(name="INDFPALMIDPERSONNE", columns={"IDPERSONNE"}), @ORM\Index(name="FILM_PALMARES_FI_3", columns={"IDPRIX"}), @ORM\Index(name="IDFESTIVAL", columns={"IDFESTIVAL"}), @ORM\Index(name="IDFILM", columns={"IDFILM"}), @ORM\Index(name="IMPORTANCE", columns={"IMPORTANCE"}), @ORM\Index(name="DATEMODIFICATION", columns={"DATEMODIFICATION"})})
 * @ORM\Entity
 */
class OldFilmPalmares
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPALMARES", type="integer", nullable=false)
     */
    private $idpalmares;

    /**
     * @var string
     *
     * @ORM\Column(name="IDFESTIVAL", type="decimal", precision=22, scale=0, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idfestival;

    /**
     * @var string
     *
     * @ORM\Column(name="IDFILM", type="string", length=36, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idfilm;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDPERSONNE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idpersonne;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDPRIX", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idprix;

    /**
     * @var string
     *
     * @ORM\Column(name="IMPORTANCE", type="decimal", precision=22, scale=0, nullable=true)
     */
    private $importance;

    /**
     * @var string
     *
     * @ORM\Column(name="MENTIONEX", type="string", length=20, nullable=true)
     */
    private $mentionex;

    /**
     * @var string
     *
     * @ORM\Column(name="MENTIONUNA", type="string", length=20, nullable=true)
     */
    private $mentionuna;

    /**
     * @var string
     *
     * @ORM\Column(name="COMMENTAIRES", type="text", nullable=true)
     */
    private $commentaires;

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
     * Set idpalmares
     *
     * @param integer $idpalmares
     * @return OldFilmPalmares
     */
    public function setIdpalmares($idpalmares)
    {
        $this->idpalmares = $idpalmares;

        return $this;
    }

    /**
     * Get idpalmares
     *
     * @return integer 
     */
    public function getIdpalmares()
    {
        return $this->idpalmares;
    }

    /**
     * Set idfestival
     *
     * @param string $idfestival
     * @return OldFilmPalmares
     */
    public function setIdfestival($idfestival)
    {
        $this->idfestival = $idfestival;

        return $this;
    }

    /**
     * Get idfestival
     *
     * @return string 
     */
    public function getIdfestival()
    {
        return $this->idfestival;
    }

    /**
     * Set idfilm
     *
     * @param string $idfilm
     * @return OldFilmPalmares
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
     * Set idpersonne
     *
     * @param integer $idpersonne
     * @return OldFilmPalmares
     */
    public function setIdpersonne($idpersonne)
    {
        $this->idpersonne = $idpersonne;

        return $this;
    }

    /**
     * Get idpersonne
     *
     * @return integer 
     */
    public function getIdpersonne()
    {
        return $this->idpersonne;
    }

    /**
     * Set idprix
     *
     * @param integer $idprix
     * @return OldFilmPalmares
     */
    public function setIdprix($idprix)
    {
        $this->idprix = $idprix;

        return $this;
    }

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
     * Set importance
     *
     * @param string $importance
     * @return OldFilmPalmares
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
     * Set mentionex
     *
     * @param string $mentionex
     * @return OldFilmPalmares
     */
    public function setMentionex($mentionex)
    {
        $this->mentionex = $mentionex;

        return $this;
    }

    /**
     * Get mentionex
     *
     * @return string 
     */
    public function getMentionex()
    {
        return $this->mentionex;
    }

    /**
     * Set mentionuna
     *
     * @param string $mentionuna
     * @return OldFilmPalmares
     */
    public function setMentionuna($mentionuna)
    {
        $this->mentionuna = $mentionuna;

        return $this;
    }

    /**
     * Get mentionuna
     *
     * @return string 
     */
    public function getMentionuna()
    {
        return $this->mentionuna;
    }

    /**
     * Set commentaires
     *
     * @param string $commentaires
     * @return OldFilmPalmares
     */
    public function setCommentaires($commentaires)
    {
        $this->commentaires = $commentaires;

        return $this;
    }

    /**
     * Get commentaires
     *
     * @return string 
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * Set datecreation
     *
     * @param \DateTime $datecreation
     * @return OldFilmPalmares
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
     * @return OldFilmPalmares
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
