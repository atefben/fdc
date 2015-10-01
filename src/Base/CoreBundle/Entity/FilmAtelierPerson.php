<?php

namespace Base\CoreBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

use Symfony\Component\Validator\Constraints\DateTime;

/**
 * FilmAtelierPerson
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmAtelierPerson
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
     * @var FilmFilm
     *
     * @ORM\ManyToOne(targetEntity="FilmAtelier", inversedBy="persons", cascade={"persist"})
     * @ORM\JoinColumn(name="film_id", referencedColumnName="id", nullable=false)
     */
    private $film;

    /**
     * @var FilmPerson
     *
     * @ORM\ManyToOne(targetEntity="FilmPerson", inversedBy="personsAtelier", cascade={"persist"})
     * @ORM\JoinColumn(name="person_id", referencedColumnName="id", nullable=false)
     */
    private $person;
    
    /**
     * @var FilmAtelierPersonFunction
     *
     * @ORM\oneToMany(targetEntity="FilmAtelierPersonFunction", mappedBy="filmAtelier", cascade={"persist"})
     */
    private $functions;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->functions = new ArrayCollection();
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
     * Set film
     *
     * @param \Base\CoreBundle\Entity\FilmAtelier $film
     * @return FilmAtelierPerson
     */
    public function setFilm(\Base\CoreBundle\Entity\FilmAtelier $film = null)
    {
        $this->film = $film;

        return $this;
    }

    /**
     * Get film
     *
     * @return \Base\CoreBundle\Entity\FilmAtelier
     */
    public function getFilm()
    {
        return $this->film;
    }

    /**
     * Set person
     *
     * @param \Base\CoreBundle\Entity\FilmPerson $person
     * @return FilmAtelierPerson
     */
    public function setPerson(\Base\CoreBundle\Entity\FilmPerson $person = null)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return \Base\CoreBundle\Entity\FilmPerson
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Add functions
     *
     * @param \Base\CoreBundle\Entity\FilmAtelierPersonFunction $functions
     * @return FilmAtelierPerson
     */
    public function addFunction(\Base\CoreBundle\Entity\FilmAtelierPersonFunction $functions)
    {
        if ($this->functions->contains($functions)) {
            return;
        }
        
        $this->functions[] = $functions;

        return $this;
    }

    /**
     * Remove functions
     *
     * @param \Base\CoreBundle\Entity\FilmAtelierPersonFunction $functions
     */
    public function removeFunction(\Base\CoreBundle\Entity\FilmAtelierPersonFunction $functions)
    {
        if (!$this->functions->contains($functions)) {
            return;
        }
        
        $this->functions->removeElement($functions);
    }

    /**
     * Get functions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFunctions()
    {
        return $this->functions;
    }
}
