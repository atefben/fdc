<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

use Symfony\Component\Validator\Constraints\DateTime;

/**
 * FilmCategory
 *
 * @ORM\Table(indexes={@ORM\Index(name="updated_at", columns={"updated_at"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmCategory
{
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $nameFr;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $nameEn;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $order;
    
    /**
     * @var Film
     *
     * @ORM\OneToMany(targetEntity="FilmFilm", mappedBy="category")
     */
    private $films;
    
    /**
     * @var Film
     *
     * @ORM\OneToMany(targetEntity="FilmAtelier", mappedBy="category")
     */
    private $filmAteliers;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->films = new \Doctrine\Common\Collections\ArrayCollection();
        $this->filmAteliers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return FilmCategory
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
     * Set nameFr
     *
     * @param string $nameFr
     * @return FilmCategory
     */
    public function setNameFr($nameFr)
    {
        $this->nameFr = $nameFr;

        return $this;
    }

    /**
     * Get nameFr
     *
     * @return string 
     */
    public function getNameFr()
    {
        return $this->nameFr;
    }

    /**
     * Set nameEn
     *
     * @param string $nameEn
     * @return FilmCategory
     */
    public function setNameEn($nameEn)
    {
        $this->nameEn = $nameEn;

        return $this;
    }

    /**
     * Get nameEn
     *
     * @return string 
     */
    public function getNameEn()
    {
        return $this->nameEn;
    }

    /**
     * Set order
     *
     * @param integer $order
     * @return FilmCategory
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return integer 
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Add films
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $films
     * @return FilmCategory
     */
    public function addFilm(\FDC\CoreBundle\Entity\FilmFilm $films)
    {
        $this->films[] = $films;

        return $this;
    }

    /**
     * Remove films
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $films
     */
    public function removeFilm(\FDC\CoreBundle\Entity\FilmFilm $films)
    {
        $this->films->removeElement($films);
    }

    /**
     * Get films
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFilms()
    {
        return $this->films;
    }

    /**
     * Add filmAteliers
     *
     * @param \FDC\CoreBundle\Entity\FilmAtelier $filmAteliers
     * @return FilmCategory
     */
    public function addFilmAtelier(\FDC\CoreBundle\Entity\FilmAtelier $filmAteliers)
    {
        $this->filmAteliers[] = $filmAteliers;

        return $this;
    }

    /**
     * Remove filmAteliers
     *
     * @param \FDC\CoreBundle\Entity\FilmAtelier $filmAteliers
     */
    public function removeFilmAtelier(\FDC\CoreBundle\Entity\FilmAtelier $filmAteliers)
    {
        $this->filmAteliers->removeElement($filmAteliers);
    }

    /**
     * Get filmAteliers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFilmAteliers()
    {
        return $this->filmAteliers;
    }
}
