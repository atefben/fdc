<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * FilmMinorProduction
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmMinorProduction
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
     * @var Country
     *
     * @ORM\ManyToOne(targetEntity="FilmFilm", inversedBy="minorProductions")
     */
    private $film;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $position;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(type="integer")
     */
    private $value;

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
     * @return FilmMinorProduction
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
     * Set value
     *
     * @param integer $value
     * @return FilmMinorProduction
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return integer 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set film
     *
     * @param \Base\CoreBundle\Entity\FilmFilm $film
     * @return FilmMinorProduction
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
}
