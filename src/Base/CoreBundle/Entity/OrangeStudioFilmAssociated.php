<?php

namespace Base\CoreBundle\Entity;

use Base\CoreBundle\Util\Time;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;


/**
 * EventFilmProjectionAssociated
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class OrangeStudioFilmAssociated
{
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Event
     *
     * @ORM\ManyToOne(targetEntity="OrangeStudio", inversedBy="associatedFilms")
     */
    protected $orangeStudio;

    /**
     * @var FilmProjection
     *
     * @ORM\ManyToOne(targetEntity="FilmFilm")
     * @Groups({"orange_studio"})
     */
    protected $association;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $position = 0;

    public function __toString()
    {
        $string = substr(strrchr(get_class($this), '\\'), 1);

        if ($this->getId()) {
            $string .= ' #' . $this->getId();
        }

        return $string;
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
     * Set orangeStudio
     *
     * @param \Base\CoreBundle\Entity\OrangeStudio $orangeStudio
     * @return OrangeStudioFilmAssociated
     */
    public function setOrangeStudio(OrangeStudio $orangeStudio = null)
    {
        $this->orangeStudio = $orangeStudio;

        return $this;
    }

    /**
     * Get event
     *
     * @return \Base\CoreBundle\Entity\OrangeStudio
     */
    public function getOrangeStudio()
    {
        return $this->orangeStudio;
    }

    /**
     * Set association
     *
     * @param \Base\CoreBundle\Entity\FilmFilm $association
     * @return OrangeStudioFilmAssociated
     */
    public function setAssociation(FilmFilm $association = null)
    {
        $this->association = $association;

        return $this;
    }

    /**
     * Get association
     *
     * @return \Base\CoreBundle\Entity\FilmFilm
     */
    public function getAssociation()
    {
        return $this->association;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return OrangeStudioFilmAssociated
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
}
