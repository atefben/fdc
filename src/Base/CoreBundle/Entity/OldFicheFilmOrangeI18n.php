<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldFicheFilmOrangeI18n
 *
 * @ORM\Table(name="old_fiche_film_orange_i18n")
 * @ORM\Entity
 */
class OldFicheFilmOrangeI18n
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="culture", type="string", length=7, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $culture;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=500, nullable=true)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="director", type="string", length=100, nullable=true)
     */
    protected $director;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=100, nullable=true)
     */
    protected $country;

    /**
     * @var integer
     *
     * @ORM\Column(name="year", type="integer", nullable=true)
     */
    protected $year;

    /**
     * @var string
     *
     * @ORM\Column(name="length", type="string", length=10, nullable=true)
     */
    protected $length;

    /**
     * @var string
     *
     * @ORM\Column(name="program", type="text", nullable=true)
     */
    protected $program;

    /**
     * @var string
     *
     * @ORM\Column(name="rerun", type="text", nullable=true)
     */
    protected $rerun;

    /**
     * @var string
     *
     * @ORM\Column(name="synopsis", type="text", nullable=true)
     */
    protected $synopsis;

    /**
     * @var string
     *
     * @ORM\Column(name="casting", type="text", nullable=true)
     */
    protected $casting;

    /**
     * @var string
     *
     * @ORM\Column(name="detail_image_filename", type="string", length=255, nullable=true)
     */
    protected $detailImageFilename;

    /**
     * @var string
     *
     * @ORM\Column(name="detail_image_copyright", type="string", length=255, nullable=true)
     */
    protected $detailImageCopyright;

    /**
     * @var string
     *
     * @ORM\Column(name="poster_image_filename", type="string", length=255, nullable=true)
     */
    protected $posterImageFilename;

    /**
     * @var string
     *
     * @ORM\Column(name="poster_image_copyright", type="string", length=255, nullable=true)
     */
    protected $posterImageCopyright;



    /**
     * Set id
     *
     * @param integer $id
     * @return OldFicheFilmOrangeI18n
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set culture
     *
     * @param string $culture
     * @return OldFicheFilmOrangeI18n
     */
    public function setCulture($culture)
    {
        $this->culture = $culture;

        return $this;
    }

    /**
     * Get culture
     *
     * @return string 
     */
    public function getCulture()
    {
        return $this->culture;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return OldFicheFilmOrangeI18n
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set director
     *
     * @param string $director
     * @return OldFicheFilmOrangeI18n
     */
    public function setDirector($director)
    {
        $this->director = $director;

        return $this;
    }

    /**
     * Get director
     *
     * @return string 
     */
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return OldFicheFilmOrangeI18n
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set year
     *
     * @param integer $year
     * @return OldFicheFilmOrangeI18n
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer 
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set length
     *
     * @param string $length
     * @return OldFicheFilmOrangeI18n
     */
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Get length
     *
     * @return string 
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set program
     *
     * @param string $program
     * @return OldFicheFilmOrangeI18n
     */
    public function setProgram($program)
    {
        $this->program = $program;

        return $this;
    }

    /**
     * Get program
     *
     * @return string 
     */
    public function getProgram()
    {
        return $this->program;
    }

    /**
     * Set rerun
     *
     * @param string $rerun
     * @return OldFicheFilmOrangeI18n
     */
    public function setRerun($rerun)
    {
        $this->rerun = $rerun;

        return $this;
    }

    /**
     * Get rerun
     *
     * @return string 
     */
    public function getRerun()
    {
        return $this->rerun;
    }

    /**
     * Set synopsis
     *
     * @param string $synopsis
     * @return OldFicheFilmOrangeI18n
     */
    public function setSynopsis($synopsis)
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    /**
     * Get synopsis
     *
     * @return string 
     */
    public function getSynopsis()
    {
        return $this->synopsis;
    }

    /**
     * Set casting
     *
     * @param string $casting
     * @return OldFicheFilmOrangeI18n
     */
    public function setCasting($casting)
    {
        $this->casting = $casting;

        return $this;
    }

    /**
     * Get casting
     *
     * @return string 
     */
    public function getCasting()
    {
        return $this->casting;
    }

    /**
     * Set detailImageFilename
     *
     * @param string $detailImageFilename
     * @return OldFicheFilmOrangeI18n
     */
    public function setDetailImageFilename($detailImageFilename)
    {
        $this->detailImageFilename = $detailImageFilename;

        return $this;
    }

    /**
     * Get detailImageFilename
     *
     * @return string 
     */
    public function getDetailImageFilename()
    {
        return $this->detailImageFilename;
    }

    /**
     * Set detailImageCopyright
     *
     * @param string $detailImageCopyright
     * @return OldFicheFilmOrangeI18n
     */
    public function setDetailImageCopyright($detailImageCopyright)
    {
        $this->detailImageCopyright = $detailImageCopyright;

        return $this;
    }

    /**
     * Get detailImageCopyright
     *
     * @return string 
     */
    public function getDetailImageCopyright()
    {
        return $this->detailImageCopyright;
    }

    /**
     * Set posterImageFilename
     *
     * @param string $posterImageFilename
     * @return OldFicheFilmOrangeI18n
     */
    public function setPosterImageFilename($posterImageFilename)
    {
        $this->posterImageFilename = $posterImageFilename;

        return $this;
    }

    /**
     * Get posterImageFilename
     *
     * @return string 
     */
    public function getPosterImageFilename()
    {
        return $this->posterImageFilename;
    }

    /**
     * Set posterImageCopyright
     *
     * @param string $posterImageCopyright
     * @return OldFicheFilmOrangeI18n
     */
    public function setPosterImageCopyright($posterImageCopyright)
    {
        $this->posterImageCopyright = $posterImageCopyright;

        return $this;
    }

    /**
     * Get posterImageCopyright
     *
     * @return string 
     */
    public function getPosterImageCopyright()
    {
        return $this->posterImageCopyright;
    }
}
