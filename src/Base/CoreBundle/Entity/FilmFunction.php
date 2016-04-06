<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Base\CoreBundle\Interfaces\FilmFunctionInterface;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Util\Time;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;

/**
 * FilmFunction
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FilmFunction implements TranslateMainInterface, FilmFunctionInterface
{
    use Time;
    use Translatable;
    use TranslateMain;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     *
     * @Groups({"film_list", "film_show"})
     */
    private $id;
    
    /**
     * @ORM\OneToMany(targetEntity="FilmPerson", mappedBy="function")
     */
    private $persons;
    
    /**
     * @ORM\OneToMany(targetEntity="FilmFilmPersonFunction", mappedBy="function")
     */
    private $filmPersons;

    /**
     * @var ArrayCollection
     *
     * @Groups({"film_list", "film_show", "projection_list", "projection_show", "classics"})
     */
    protected $translations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->filmPersons = new ArrayCollection();
        $this->persons = new ArrayCollection();
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return FilmFunction
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
     * Add persons
     *
     * @param \Base\CoreBundle\Entity\FilmPerson $persons
     * @return FilmFunction
     */
    public function addPerson(\Base\CoreBundle\Entity\FilmPerson $persons)
    {
        if ($this->persons->contains($persons)) {
            return;
        }
        
        $this->persons[] = $persons;

        return $this;
    }

    /**
     * Remove persons
     *
     * @param \Base\CoreBundle\Entity\FilmPerson $persons
     */
    public function removePerson(\Base\CoreBundle\Entity\FilmPerson $persons)
    {
        if (!$this->persons->contains($persons)) {
            return;
        }
        
        $this->persons->removeElement($persons);
    }

    /**
     * Get persons
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPersons()
    {
        return $this->persons;
    }

    /**
     * Add filmPersons
     *
     * @param \Base\CoreBundle\Entity\FilmFilmPersonFunction $filmPersons
     * @return FilmFunction
     */
    public function addFilmPerson(\Base\CoreBundle\Entity\FilmFilmPersonFunction $filmPersons)
    {
        if ($this->filmPersons->contains($filmPersons)) {
            return;
        }
        
        $this->filmPersons[] = $filmPersons;

        return $this;
    }

    /**
     * Remove filmPersons
     *
     * @param \Base\CoreBundle\Entity\FilmFilmPersonFunction $filmPersons
     */
    public function removeFilmPerson(\Base\CoreBundle\Entity\FilmFilmPersonFunction $filmPersons)
    {
        if (!$this->filmPersons->contains($filmPersons)) {
            return;
        }
        
        $this->filmPersons->removeElement($filmPersons);
    }

    /**
     * Get filmPersons
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFilmPersons()
    {
        return $this->filmPersons;
    }
}
