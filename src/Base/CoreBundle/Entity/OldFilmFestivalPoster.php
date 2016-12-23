<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldFilmFestivalPoster
 *
 * @ORM\Table(name="old_FILM_FESTIVAL_POSTER")
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\OldFilmFestivalPosterRepository")
 */
class OldFilmFestivalPoster
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPOSTER", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idposter;

    /**
     * @var string
     *
     * @ORM\Column(name="IDFESTIVAL", type="decimal", precision=10, scale=0, nullable=false)
     */
    protected $idfestival;

    /**
     * @var string
     *
     * @ORM\Column(name="TITRE_VF", type="string", length=255, nullable=true)
     */
    protected $titreVf;

    /**
     * @var string
     *
     * @ORM\Column(name="TITRE_VA", type="string", length=255, nullable=true)
     */
    protected $titreVa;

    /**
     * @var string
     *
     * @ORM\Column(name="TYPEPOSTER", type="decimal", precision=10, scale=0, nullable=true)
     */
    protected $typeposter;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPTION_VF", type="text", nullable=true)
     */
    protected $descriptionVf;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPTION_VA", type="text", nullable=true)
     */
    protected $descriptionVa;

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
     * @ORM\Column(name="INTERNET", type="string", length=1, nullable=true)
     */
    protected $internet;



    /**
     * Get idposter
     *
     * @return integer 
     */
    public function getIdposter()
    {
        return $this->idposter;
    }

    /**
     * Set idfestival
     *
     * @param string $idfestival
     * @return OldFilmFestivalPoster
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
     * Set titreVf
     *
     * @param string $titreVf
     * @return OldFilmFestivalPoster
     */
    public function setTitreVf($titreVf)
    {
        $this->titreVf = $titreVf;

        return $this;
    }

    /**
     * Get titreVf
     *
     * @return string 
     */
    public function getTitreVf()
    {
        return $this->titreVf;
    }

    /**
     * Set titreVa
     *
     * @param string $titreVa
     * @return OldFilmFestivalPoster
     */
    public function setTitreVa($titreVa)
    {
        $this->titreVa = $titreVa;

        return $this;
    }

    /**
     * Get titreVa
     *
     * @return string 
     */
    public function getTitreVa()
    {
        return $this->titreVa;
    }

    /**
     * Set typeposter
     *
     * @param string $typeposter
     * @return OldFilmFestivalPoster
     */
    public function setTypeposter($typeposter)
    {
        $this->typeposter = $typeposter;

        return $this;
    }

    /**
     * Get typeposter
     *
     * @return string 
     */
    public function getTypeposter()
    {
        return $this->typeposter;
    }

    /**
     * Set descriptionVf
     *
     * @param string $descriptionVf
     * @return OldFilmFestivalPoster
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
     * @return OldFilmFestivalPoster
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
     * @return OldFilmFestivalPoster
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
     * @return OldFilmFestivalPoster
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
     * Set internet
     *
     * @param string $internet
     * @return OldFilmFestivalPoster
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
}
