<?php

namespace FDC\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\TranslationByLocale;
use FDC\CoreBundle\Util\Time;
use FDC\CoreBundle\Util\Soif;

use JMS\Serializer\Annotation\Groups;

/**
 * FilmProjection
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmProjection
{
    use Translatable;
    use TranslationByLocale;
    use Time;
    use Soif;
    
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     *
     * @Groups({"projection_list", "projection_show"})
     */
    private $id;
    
    /**
     * @var DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @Groups({"projection_list", "projection_show"})
     */
    private $startsAt;
    
    /**
     * @var DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @Groups({"projection_list", "projection_show"})
     */
    private $endsAt;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     *
     * @Groups({"projection_list", "projection_show"})
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     *
     * @Groups({"projection_list", "projection_show"})
     */
    private $programmationSection;

    /**
     * @var FilmFestival
     *
     * @ORM\ManyToOne(targetEntity="FilmFestival")
     *
     * @Groups({"projection_list", "projection_show"})
     */
    private $festival;

    /**
     * @var FilmRoom
     *
     * @ORM\ManyToOne(targetEntity="FilmProjectionRoom", inversedBy="projections", cascade={"persist"})
     *
     * @Groups({"projection_list", "projection_show"})
     */
    private $room;
    
    /**
     * @var FilmProjectionProgrammationFilm
     *
     * @ORM\OneToMany(targetEntity="FilmProjectionProgrammationFilm", mappedBy="projection", cascade={"all"}, orphanRemoval=true)
     *
     * @Groups({"projection_list", "projection_show"})
     */
    private $programmationFilms;
    
    /**
     * @var FilmProjectionProgrammationDynamic
     *
     * @ORM\OneToMany(targetEntity="FilmProjectionProgrammationDynamic", mappedBy="projection", cascade={"all"}, orphanRemoval=true)
     *
     * @Groups({"projection_list", "projection_show"})
     */
    private $programmationDynamics;
    
    /**
     * @var FilmProjectionProgrammationFilmList
     *
     * @ORM\OneToMany(targetEntity="FilmProjectionProgrammationFilmList", mappedBy="projection", cascade={"all"}, orphanRemoval=true)
     *
     * @Groups({"projection_list", "projection_show"})
     */
    private $programmationFilmsList;

    /**
     * @var FilmProjectionMedia
     *
     * @ORM\OneToMany(targetEntity="FilmProjectionMedia", mappedBy="projection", cascade={"all"}, orphanRemoval=true)
     *
     * @Groups({"projection_list", "projection_show"})
     */
    private $medias;

    /**
     * @var ArrayCollection
     *
     * @Groups({"projection_list", "projection_show"})
     */
    protected $translations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->programmationFilms = new ArrayCollection();
        $this->programmationDynamics= new ArrayCollection();
        $this->programmationFilmsList = new ArrayCollection();
        $this->medias = new ArrayCollection();
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
     * Set id
     *
     * @param integer $id
     * @return FilmProjection
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * @param \FDC\CoreBundle\Entity\FilmFestival $festival
     * @return FilmProjection
     */
    public function setFestival(\FDC\CoreBundle\Entity\FilmFestival $festival = null)
    {
        $this->festival = $festival;

        return $this;
    }

    /**
     * Get festival
     *
     * @return \FDC\CoreBundle\Entity\FilmFestival 
     */
    public function getFestival()
    {
        return $this->festival;
    }

    /**
     * Set room
     *
     * @param \FDC\CoreBundle\Entity\FilmProjectionRoom $room
     * @return FilmProjection
     */
    public function setRoom(\FDC\CoreBundle\Entity\FilmProjectionRoom $room = null)
    {
        $this->room = $room;

        return $this;
    }

    /**
     * Get room
     *
     * @return \FDC\CoreBundle\Entity\FilmProjectionRoom 
     */
    public function getRoom()
    {
        return $this->room;
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
     * Add medias
     *
     * @param \FDC\CoreBundle\Entity\FilmProjectionMedia $medias
     * @return FilmProjection
     */
    public function addMedia(\FDC\CoreBundle\Entity\FilmProjectionMedia $medias)
    {
        $this->medias[] = $medias;
        $medias->setProjection($this);

        return $this;
    }

    /**
     * Remove medias
     *
     * @param \FDC\CoreBundle\Entity\FilmProjectionMedia $medias
     */
    public function removeMedia(\FDC\CoreBundle\Entity\FilmProjectionMedia $medias)
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
    
    public function hasMedia($id)
    {
        foreach ($this->medias as $media) {
            if ($media->getFile() && $media->getFile()->getId() == $id) {
                return $media;
            }
        }
        
        return null;
    }

    /**
     * Set programmationSection
     *
     * @param string $programmationSection
     * @return FilmProjection
     */
    public function setProgrammationSection($programmationSection)
    {
        $this->programmationSection = $programmationSection;

        return $this;
    }

    /**
     * Get programmationSection
     *
     * @return string 
     */
    public function getProgrammationSection()
    {
        return $this->programmationSection;
    }

    /**
     * Add programmationFilms
     *
     * @param \FDC\CoreBundle\Entity\FilmProjectionProgrammationFilm $programmationFilms
     * @return FilmProjection
     */
    public function addProgrammationFilm(\FDC\CoreBundle\Entity\FilmProjectionProgrammationFilm $programmationFilms)
    {
        if ($this->programmationFilms->contains($programmationFilms)) {
            return;
        }

        $this->programmationFilms[] = $programmationFilms;
        $programmationFilms->setProjection($this);

        return $this;
    }

    /**
     * Remove programmationFilms
     *
     * @param \FDC\CoreBundle\Entity\FilmProjectionProgrammationFilm $programmationFilms
     */
    public function removeProgrammationFilm(\FDC\CoreBundle\Entity\FilmProjectionProgrammationFilm $programmationFilms)
    {
        if (!$this->programmationFilms->contains($programmationFilms)) {
            return;
        }

        $this->programmationFilms->removeElement($programmationFilms);
    }

    /**
     * Get programmationFilms
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProgrammationFilms()
    {
        return $this->programmationFilms;
    }

    /**
     * Add programmationDynamics
     *
     * @param \FDC\CoreBundle\Entity\FilmProjectionProgrammationDynamic $programmationDynamics
     * @return FilmProjection
     */
    public function addProgrammationDynamic(\FDC\CoreBundle\Entity\FilmProjectionProgrammationDynamic $programmationDynamics)
    {
        if ($this->programmationDynamics->contains($programmationDynamics)) {
            return;
        }
        
        $this->programmationDynamics[] = $programmationDynamics;

        return $this;
    }

    /**
     * Remove programmationDynamics
     *
     * @param \FDC\CoreBundle\Entity\FilmProjectionProgrammationDynamic $programmationDynamics
     */
    public function removeProgrammationDynamic(\FDC\CoreBundle\Entity\FilmProjectionProgrammationDynamic $programmationDynamics)
    {
        if (!$this->programmationDynamics->contains($programmationDynamics)) {
            return;
        }
        
        $this->programmationDynamics->removeElement($programmationDynamics);
    }

    /**
     * Get programmationDynamics
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProgrammationDynamics()
    {
        return $this->programmationDynamics;
    }

    /**
     * Add programmationFilmsList
     *
     * @param \FDC\CoreBundle\Entity\FilmProjectionProgrammationFilmList $programmationFilmsList
     * @return FilmProjection
     */
    public function addProgrammationFilmsList(\FDC\CoreBundle\Entity\FilmProjectionProgrammationFilmList $programmationFilmsList)
    {
        if ($this->programmationFilmsList->contains($programmationFilmsList)) {
            return;
        }
        
        $this->programmationFilmsList[] = $programmationFilmsList;

        return $this;
    }

    /**
     * Remove programmationFilmsList
     *
     * @param \FDC\CoreBundle\Entity\FilmProjectionProgrammationFilmList $programmationFilmsList
     */
    public function removeProgrammationFilmsList(\FDC\CoreBundle\Entity\FilmProjectionProgrammationFilmList $programmationFilmsList)
    {
        if (!$this->programmationFilmsList->contains($programmationFilmsList)) {
            return;
        }
        
        $this->programmationFilmsList->removeElement($programmationFilmsList);
    }

    /**
     * Get programmationFilmsList
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProgrammationFilmsList()
    {
        return $this->programmationFilmsList;
    }
}
