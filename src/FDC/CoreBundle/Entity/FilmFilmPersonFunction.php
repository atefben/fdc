<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

use JMS\Serializer\Annotation\Groups;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * FilmFilmPersonFunction
 *
 * @ORM\Table(
 *  uniqueConstraints={@ORM\UniqueConstraint(columns={
 *      "function_id", "film_person_id"
 *  })})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(fields={"function", "filmPerson"})
 */
class FilmFilmPersonFunction
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
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $position;

    /**
     * @var FilmFunction
     *
     * @ORM\ManyToOne(targetEntity="FilmFunction", inversedBy="filmPersons", cascade={"persist"})
     * @ORM\JoinColumn(name="function_id", referencedColumnName="id", nullable=false)
     *
     * @Groups({"film_list", "film_show"})
     */
    private $function;

    /**
     * @var FilmFunction
     *
     * @ORM\ManyToOne(targetEntity="FilmFilmPerson", inversedBy="functions", cascade={"persist"})
     * @ORM\JoinColumn(name="film_person_id", referencedColumnName="id", nullable=false)
     */
    private $filmPerson;

    /**
     * __construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct()
    {
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
     * Set position
     *
     * @param integer $position
     * @return FilmFilmPerson
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
     * Set function
     *
     * @param \FDC\CoreBundle\Entity\FilmFunction $function
     * @return FilmFilmPersonFunction
     */
    public function setFunction(\FDC\CoreBundle\Entity\FilmFunction $function = null)
    {
        $this->function = $function;

        return $this;
    }

    /**
     * Get function
     *
     * @return \FDC\CoreBundle\Entity\FilmFunction 
     */
    public function getFunction()
    {
        return $this->function;
    }

    /**
     * Set person
     *
     * @param \FDC\CoreBundle\Entity\FilmFilmPerson $person
     * @return FilmFilmPersonFunction
     */
    public function setFilmPerson(\FDC\CoreBundle\Entity\FilmFilmPerson $filmPerson = null)
    {
        $this->filmPerson = $filmPerson;

        return $this;
    }

    /**
     * Get person
     *
     * @return \FDC\CoreBundle\Entity\FilmFilmPerson 
     */
    public function getFilmPerson()
    {
        return $this->filmPerson;
    }
}
