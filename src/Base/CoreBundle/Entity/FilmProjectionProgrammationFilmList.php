<?php

namespace Base\CoreBundle\Entity;

use Base\CoreBundle\Util\Time;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

/**
 * FilmProjectionProgrammationFilmList
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmProjectionProgrammationFilmList
{
    use Time;
    
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @var FilmProjectionProgrammationType
     *
     * @ORM\ManyToOne(targetEntity="FilmProjectionProgrammationType", cascade={"persist"})
     *
     * @Groups({
     *  "film_list", "film_show",
     *  "projection_list", "projection_show"
     * })
     */
    private $type;

    /**
     * @var FilmProjection
     *
     * @ORM\ManyToOne(targetEntity="FilmProjection", inversedBy="programmationFilmsList")
     *
     * @Groups({
     *  "film_list", "film_show",
     *  "projection_list", "projection_show"
     * })
     */
    private $projection;

    /**
     * @var FilmFilm
     *
     * @ORM\ManyToMany(targetEntity="FilmFilm", inversedBy="projectionProgrammationFilmsList")
     *
     * @Groups({"projection_list", "projection_show"})
     */
    private $films;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->films = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set type
     *
     * @param \Base\CoreBundle\Entity\FilmProjectionProgrammationType $type
     * @return FilmProjectionProgrammationFilmList
     */
    public function setType(\Base\CoreBundle\Entity\FilmProjectionProgrammationType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \Base\CoreBundle\Entity\FilmProjectionProgrammationType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set projection
     *
     * @param \Base\CoreBundle\Entity\FilmProjection $projection
     * @return FilmProjectionProgrammationFilmList
     */
    public function setProjection(\Base\CoreBundle\Entity\FilmProjection $projection = null)
    {
        $this->projection = $projection;

        return $this;
    }

    /**
     * Get projection
     *
     * @return \Base\CoreBundle\Entity\FilmProjection
     */
    public function getProjection()
    {
        return $this->projection;
    }

    /**
     * Add films
     *
     * @param \Base\CoreBundle\Entity\FilmFilm $films
     * @return FilmProjectionProgrammationFilmList
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
