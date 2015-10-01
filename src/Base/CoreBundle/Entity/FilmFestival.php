<?php

namespace Base\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\Soif;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

/**
 * FilmFestival
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmFestival
{
    use Time;
    use Soif;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     *
     * @Groups({
            "film_list", "film_show",
            "jury_list", "jury_show"
       })
     * 
     */
    private $id;

   /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     *
     * @Groups({
            "film_list", "film_show",
            "jury_list", "jury_show"
       })
     * 
     */
    private $year;

    /**
     * @ORM\OneToMany(targetEntity="FilmAward", mappedBy="festival")
     */
    private $awards;

    /**
     * @ORM\OneToMany(targetEntity="FilmJury", mappedBy="festival")
     */
    private $juries;

    /**
     * @ORM\OneToMany(targetEntity="FilmFilm", mappedBy="festival")
     */
    private $films;
    

    /**
     * @ORM\OneToMany(targetEntity="FilmMedia", mappedBy="festival")
     */
    private $medias;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->awards = new ArrayCollection();
        $this->juries = new ArrayCollection();
        $this->medias = new ArrayCollection();
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return FilmFestival
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
     * Set year
     *
     * @param integer $year
     * @return FilmFestival
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
     * Add medias
     *
     * @param \Base\CoreBundle\Entity\FilmMedia $medias
     * @return FilmFestival
     */
    public function addMedia(\Base\CoreBundle\Entity\FilmMedia $medias)
    {
        if ($this->medias->contains($medias)) {
            return;
        }

        $this->medias[] = $medias;

        return $this;
    }

    /**
     * Remove medias
     *
     * @param \Base\CoreBundle\Entity\FilmMedia $medias
     */
    public function removeMedia(\Base\CoreBundle\Entity\FilmMedia $medias)
    {
        if (!$this->medias->contains($medias)) {
            return;
        }
        
        $this->medias->removeElement($medias);
    }

    /**
     * Get medias
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMedias()
    {
        return $this->medias;
    }

    /**
     * Add awards
     *
     * @param \Base\CoreBundle\Entity\FilmAward $awards
     * @return FilmFestival
     */
    public function addAward(\Base\CoreBundle\Entity\FilmAward $awards)
    {
        if ($this->awards->contains($awards)) {
            return;
        }
        
        $this->awards[] = $awards;

        return $this;
    }

    /**
     * Remove awards
     *
     * @param \Base\CoreBundle\Entity\FilmAward $awards
     */
    public function removeAward(\Base\CoreBundle\Entity\FilmAward $awards)
    {
        if (!$this->awards->contains($awards)) {
            return;
        }
        
        $this->awards->removeElement($awards);
    }

    /**
     * Get awards
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAwards()
    {
        return $this->awards;
    }

    /**
     * Add juries
     *
     * @param \Base\CoreBundle\Entity\FilmJury $juries
     * @return FilmFestival
     */
    public function addJury(\Base\CoreBundle\Entity\FilmJury $juries)
    {
        if ($this->juries->contains($juries)) {
            return;
        }
        
        $this->juries[] = $juries;

        return $this;
    }

    /**
     * Remove juries
     *
     * @param \Base\CoreBundle\Entity\FilmJury $juries
     */
    public function removeJury(\Base\CoreBundle\Entity\FilmJury $juries)
    {
        if (!$this->juries->contains($juries)) {
            return;
        }
        
        $this->juries->removeElement($juries);
    }

    /**
     * Get juries
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getJuries()
    {
        return $this->juries;
    }

    /**
     * Add films
     *
     * @param \Base\CoreBundle\Entity\FilmFilm $films
     * @return FilmFestival
     */
    public function addFilm(\Base\CoreBundle\Entity\FilmFilm $films)
    {
        if ($this->films->contains($films)) {
            return;
        }
        
        $this->films[] = $films;

        return $this;
    }

    /**
     * Remove films
     *
     * @param \Base\CoreBundle\Entity\FilmFilm $films
     */
    public function removeFilm(\Base\CoreBundle\Entity\FilmFilm $films)
    {
        if (!$this->films->contains($films)) {
            return;
        }
        
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
}
