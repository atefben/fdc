<?php

namespace FDC\CoreBundle\Entity;


use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;
use FDC\CoreBundle\Util\Soif;

/**
 * FilmPersonFilmFilm
 *
 * @ORM\Table()
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class FilmPersonFilmFilm
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
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FilmFilm", inversedBy="team")
     */
    private $film;
    
    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FilmPerson", inversedBy="team")
     */
    private $person;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FilmFunctions", inversedBy="team")
     */
    private $function;

    /**
     * Set film
     *
     * @param \FDC\CoreBundle\Entity\FilmFilm $film
     * @return FilmPersonFilmFilm
     */
    public function setFilm(\FDC\CoreBundle\Entity\FilmFilm $film = null)
    {
        $this->film = $film;

        return $this;
    }

    /**
     * Get film
     *
     * @return \FDC\CoreBundle\Entity\FilmFilm 
     */
    public function getFilm()
    {
        return $this->film;
    }

    /**
     * Set person
     *
     * @param \FDC\CoreBundle\Entity\FilmPerson $person
     * @return FilmPersonFilmFilm
     */
    public function setPerson(\FDC\CoreBundle\Entity\FilmPerson $person = null)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return \FDC\CoreBundle\Entity\FilmPerson 
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Set function
     *
     * @param \FDC\CoreBundle\Entity\FilmFunctions $function
     * @return FilmPersonFilmFilm
     */
    public function setFunction(\FDC\CoreBundle\Entity\FilmFunctions $function = null)
    {
        $this->function = $function;

        return $this;
    }

    /**
     * Get function
     *
     * @return \FDC\CoreBundle\Entity\FilmFunctions 
     */
    public function getFunction()
    {
        return $this->function;
    }
}
