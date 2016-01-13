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
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $festivalStartsAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $festivalEndsAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $marcheDuFilmStartsAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $marcheduFilmEndsAt;

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
     * @ORM\OneToMany(targetEntity="Event", mappedBy="festival")
     */
    private $events;

    /**
     * @ORM\OneToMany(targetEntity="Statement", mappedBy="festival")
     */
    private $statements;

    /**
     * @ORM\OneToMany(targetEntity="FilmMedia", mappedBy="festival")
     */
    private $medias;

    /**
     * @ORM\OneToMany(targetEntity="MediaVideo", mappedBy="festival")
     */
    private $mediaVideos;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->awards = new ArrayCollection();
        $this->events = new ArrayCollection();
        $this->juries = new ArrayCollection();
        $this->medias = new ArrayCollection();
        $this->statements = new ArrayCollection();
    }

    public function __toString()
    {
        return (string)$this->year;
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

        $medias->setFestival($this);
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

        $awards->setFestival($this);
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

        $juries->setFestival($this);
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

        $films->setFestival($this);
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
     * Add events
     *
     * @param \Base\CoreBundle\Entity\Event $events
     * @return FilmFestival
     */
    public function addEvent(\Base\CoreBundle\Entity\Event $events)
    {
        if ($this->events->contains($events)) {
            return;
        }

        $events->setFestival($this);
        $this->events[] = $events;

        return $this;
    }

    /**
     * Remove events
     *
     * @param \Base\CoreBundle\Entity\Event $events
     */
    public function removeEvent(\Base\CoreBundle\Entity\Event $events)
    {
        if (!$this->events->contains($events)) {
            return;
        }

        $this->events->removeElement($events);
    }

    /**
     * Get events
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Add mediaVideos
     *
     * @param \Base\CoreBundle\Entity\MediaVideo $mediaVideos
     * @return FilmFestival
     */
    public function addMediaVideo(\Base\CoreBundle\Entity\MediaVideo $mediaVideos)
    {
        if ($this->mediaVideos->contains($mediaVideos)) {
            return;
        }

        $mediaVideos->setFestival($this);
        $this->mediaVideos[] = $mediaVideos;

        return $this;
    }

    /**
     * Remove mediaVideos
     *
     * @param \Base\CoreBundle\Entity\MediaVideo $mediaVideos
     */
    public function removeMediaVideo(\Base\CoreBundle\Entity\MediaVideo $mediaVideos)
    {
        if (!$this->mediaVideos->contains($mediaVideos)) {
            return;
        }

        $this->mediaVideos->removeElement($mediaVideos);
    }

    /**
     * Get mediaVideos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMediaVideos()
    {
        return $this->mediaVideos;
    }


    /**
     * Set festivalStartsAt
     *
     * @param \DateTime $festivalStartsAt
     * @return FilmFestival
     */
    public function setFestivalStartsAt($festivalStartsAt)
    {
        $this->festivalStartsAt = $festivalStartsAt;

        return $this;
    }

    /**
     * Get festivalStartsAt
     *
     * @return \DateTime 
     */
    public function getFestivalStartsAt()
    {
        return $this->festivalStartsAt;
    }

    /**
     * Set festivalEndsAt
     *
     * @param \DateTime $festivalEndsAt
     * @return FilmFestival
     */
    public function setFestivalEndsAt($festivalEndsAt)
    {
        $this->festivalEndsAt = $festivalEndsAt;

        return $this;
    }

    /**
     * Get festivalEndsAt
     *
     * @return \DateTime 
     */
    public function getFestivalEndsAt()
    {
        return $this->festivalEndsAt;
    }

    /**
     * Set marcheDuFilmStartsAt
     *
     * @param \DateTime $marcheDuFilmStartsAt
     * @return FilmFestival
     */
    public function setMarcheDuFilmStartsAt($marcheDuFilmStartsAt)
    {
        $this->marcheDuFilmStartsAt = $marcheDuFilmStartsAt;

        return $this;
    }

    /**
     * Get marcheDuFilmStartsAt
     *
     * @return \DateTime 
     */
    public function getMarcheDuFilmStartsAt()
    {
        return $this->marcheDuFilmStartsAt;
    }

    /**
     * Set marcheduFilmEndsAt
     *
     * @param \DateTime $marcheduFilmEndsAt
     * @return FilmFestival
     */
    public function setMarcheduFilmEndsAt($marcheduFilmEndsAt)
    {
        $this->marcheduFilmEndsAt = $marcheduFilmEndsAt;

        return $this;
    }

    /**
     * Get marcheduFilmEndsAt
     *
     * @return \DateTime 
     */
    public function getMarcheduFilmEndsAt()
    {
        return $this->marcheduFilmEndsAt;
    }

    /**
     * Add statements
     *
     * @param \Base\CoreBundle\Entity\Statement $statements
     * @return FilmFestival
     */
    public function addStatement(\Base\CoreBundle\Entity\Statement $statements)
    {
        if ($this->statements->contains($statements)) {
            return;
        }

        $statements->setFestival($this);
        $this->statements[] = $statements;

        return $this;
    }

    /**
     * Remove statements
     *
     * @param \Base\CoreBundle\Entity\Statement $statements
     */
    public function removeStatement(\Base\CoreBundle\Entity\Statement $statements)
    {
        if (!$this->statements->contains($statements)) {
            return;
        }


        $this->statements->removeElement($statements);
    }

    /**
     * Get statements
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStatements()
    {
        return $this->statements;
    }
}
