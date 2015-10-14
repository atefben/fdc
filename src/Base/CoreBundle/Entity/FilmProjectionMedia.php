<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

/**
 * FilmProjectionMedia
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmProjectionMedia
{
    /**
     * @var string
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", inversedBy="projectionMedias", cascade={"persist"})
     *
     * @Groups({"projection_list", "projection_show"})
     */
    private $file;
    
    /**
     * @var FilmProjection
     *
     * @ORM\ManyToOne(targetEntity="FilmProjection", inversedBy="medias", cascade={"persist"})
     */
    private $projection;
    
    /**
     * @var string
     *
     * @ORM\Column(type="integer", nullable=true)
     *
     * @Groups({"projection_list", "projection_show"})
     */
    private $position;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Groups({"projection_list", "projection_show"})
     */
    private $filename;
    
    /**
     * @var string
     *
     * @ORM\Column(type="integer", nullable=true)
     *
     * @Groups({"projection_list", "projection_show"})
     */
    private $type;

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
     * Set startsAt
     *
     * @param \DateTime $startsAt
     * @return FilmProjection
     */
    public function setStartsAt($startsAt)
    {
        $this->startsAt = $startsAt;

        return $this;
    }

    /**
     * Get startsAt
     *
     * @return \DateTime 
     */
    public function getStartsAt()
    {
        return $this->startsAt;
    }

    /**
     * Set endsAt
     *
     * @param \DateTime $endsAt
     * @return FilmProjection
     */
    public function setEndsAt($endsAt)
    {
        $this->endsAt = $endsAt;

        return $this;
    }

    /**
     * Get endsAt
     *
     * @return \DateTime 
     */
    public function getEndsAt()
    {
        return $this->endsAt;
    }

    /**
     * Set festival
     *
     * @param \Base\CoreBundle\Entity\FilmFestival $festival
     * @return FilmProjection
     */
    public function setFestival(\Base\CoreBundle\Entity\FilmFestival $festival = null)
    {
        $this->festival = $festival;

        return $this;
    }

    /**
     * Get festival
     *
     * @return \Base\CoreBundle\Entity\FilmFestival
     */
    public function getFestival()
    {
        return $this->festival;
    }

    /**
     * Set film
     *
     * @param \Base\CoreBundle\Entity\FilmFilm $film
     * @return FilmProjection
     */
    public function setFilm(\Base\CoreBundle\Entity\FilmFilm $film = null)
    {
        $this->film = $film;

        return $this;
    }

    /**
     * Get film
     *
     * @return \Base\CoreBundle\Entity\FilmFilm
     */
    public function getFilm()
    {
        return $this->film;
    }

    /**
     * Add films
     *
     * @param \Base\CoreBundle\Entity\FilmFilm $films
     * @return FilmProjection
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

    /**
     * Set type
     *
     * @param string $type
     * @return FilmProjection
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return FilmProjectionMedia
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set filename
     *
     * @param string $filename
     * @return FilmProjectionMedia
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string 
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set projection
     *
     * @param \Base\CoreBundle\Entity\FilmProjection $projection
     * @return FilmProjectionMedia
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
     * Set file
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $file
     * @return FilmProjectionMedia
     */
    public function setFile(\Application\Sonata\MediaBundle\Entity\Media $file = null)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media 
     */
    public function getFile()
    {
        return $this->file;
    }
}
