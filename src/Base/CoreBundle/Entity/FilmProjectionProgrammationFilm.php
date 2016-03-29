<?php

namespace Base\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * FilmProjectionProgrammationFilm
 *
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="type_film_projection_uniqueness", columns={"type_id", "film_id", "projection_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(fields={"type", "film", "projection"})
 */
class FilmProjectionProgrammationFilm
{   
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
     * @Groups({"projection_list", "projection_show"})
     */
    private $type;

    /**
     * @var FilmFilm
     *
     * @ORM\ManyToOne(targetEntity="FilmFilm", cascade={"persist"}, inversedBy="projectionProgrammationFilms")
     *
     * @Groups({"projection_list", "projection_show", "home", "news_list"})
     */
    private $film;

    /**
     * @var FilmProjection
     *
     * @ORM\ManyToOne(targetEntity="FilmProjection", inversedBy="programmationFilms")
     * @ORM\JoinColumn(name="projection_id", onDelete="CASCADE")
     *
     * @Groups({"film_list", "film_show"})
     */
    private $projection;

    public function __toString()
    {
        if ($this->getId() && $this->getFilm() !== null) {
            return $this->getFilm()->getTitleVO();
        }

        return '';
    }


    /**
     * Set type
     *
     * @param \Base\CoreBundle\Entity\FilmProjectionProgrammationType $type
     * @return FilmProjectionProgrammationFilm
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
     * Set film
     *
     * @param \Base\CoreBundle\Entity\FilmFilm $film
     * @return FilmProjectionProgrammationFilm
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
     * Set projection
     *
     * @param \Base\CoreBundle\Entity\FilmProjection $projection
     * @return FilmProjectionProgrammationFilm
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
