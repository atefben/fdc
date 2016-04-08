<?php

namespace Base\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

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
     *
     * @Groups({
     *     "film_list",
     *     "film_show",
     *     "projection_list",
     *     "projection_show",
     *     "news_list",
     *     "news_show",
     *     "classics",
     *     "orange_studio"
     * })
     */
    private $position;

    /**
     * @var FilmFunction
     *
     * @ORM\ManyToOne(targetEntity="FilmFunction", inversedBy="filmPersons", cascade={"persist"})
     * @ORM\JoinColumn(name="function_id", referencedColumnName="id", nullable=false)
     *
     * @Groups({
     *     "film_list",
     *     "film_show",
     *     "projection_list",
     *     "projection_show",
     *     "classics",
     *     "orange_studio"
     * })
     */
    private $function;

    /**
     * @var FilmFilmPerson
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
     * @param \Base\CoreBundle\Entity\FilmFunction $function
     * @return FilmFilmPersonFunction
     */
    public function setFunction(\Base\CoreBundle\Entity\FilmFunction $function = null)
    {
        $this->function = $function;

        return $this;
    }

    /**
     * Get function
     *
     * @return \Base\CoreBundle\Entity\FilmFunction
     */
    public function getFunction()
    {
        return $this->function;
    }

    /**
     * Set person
     *
     * @param \Base\CoreBundle\Entity\FilmFilmPerson $person
     * @return FilmFilmPersonFunction
     */
    public function setFilmPerson(\Base\CoreBundle\Entity\FilmFilmPerson $filmPerson = null)
    {
        $this->filmPerson = $filmPerson;

        return $this;
    }

    /**
     * Get person
     *
     * @return \Base\CoreBundle\Entity\FilmFilmPerson
     */
    public function getFilmPerson()
    {
        return $this->filmPerson;
    }
}
