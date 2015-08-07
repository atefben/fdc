<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;
use FDC\CoreBundle\Util\Soif;

/**
 * FilmFestivalId
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
     */
    private $id;

   /**
     * @var integer
     *
     * @ORM\Column(type="integer")
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
     * @param \FDC\CoreBundle\Entity\FilmMedia $medias
     * @return FilmFestival
     */
    public function addMedia(\FDC\CoreBundle\Entity\FilmMedia $medias)
    {
        $this->medias[] = $medias;

        return $this;
    }

    /**
     * Remove medias
     *
     * @param \FDC\CoreBundle\Entity\FilmMedia $medias
     */
    public function removeMedia(\FDC\CoreBundle\Entity\FilmMedia $medias)
    {
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
     * @param \FDC\CoreBundle\Entity\FilmAward $awards
     * @return FilmFestival
     */
    public function addAward(\FDC\CoreBundle\Entity\FilmAward $awards)
    {
        $this->awards[] = $awards;

        return $this;
    }

    /**
     * Remove awards
     *
     * @param \FDC\CoreBundle\Entity\FilmAward $awards
     */
    public function removeAward(\FDC\CoreBundle\Entity\FilmAward $awards)
    {
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
     * @param \FDC\CoreBundle\Entity\FilmJury $juries
     * @return FilmFestival
     */
    public function addJury(\FDC\CoreBundle\Entity\FilmJury $juries)
    {
        $this->juries[] = $juries;

        return $this;
    }

    /**
     * Remove juries
     *
     * @param \FDC\CoreBundle\Entity\FilmJury $juries
     */
    public function removeJury(\FDC\CoreBundle\Entity\FilmJury $juries)
    {
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
}
