<?php

namespace FDC\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;
use FDC\CoreBundle\Util\Translation;
use FDC\CoreBundle\Validator\Constraints as FDCAssert;

/**
 * FilmFunction
 *
 * @ORM\Table(indexes={@ORM\Index(name="updated_at", columns={"updated_at"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FilmFunction
{
    use Time;
    use Translatable;
    use Translation;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
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
     * @ORM\OneToMany(targetEntity="FilmAtelierGeneric", mappedBy="function")
     */
    private $filmAtelierGenerics;

    /**
     * @var ArrayCollection
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
        $this->filmAtelierGenerics = new ArrayCollection();
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
     * @param \FDC\CoreBundle\Entity\FilmPerson $persons
     * @return FilmFunction
     */
    public function addPerson(\FDC\CoreBundle\Entity\FilmPerson $persons)
    {
        $this->persons[] = $persons;

        return $this;
    }

    /**
     * Remove persons
     *
     * @param \FDC\CoreBundle\Entity\FilmPerson $persons
     */
    public function removePerson(\FDC\CoreBundle\Entity\FilmPerson $persons)
    {
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
     * @param \FDC\CoreBundle\Entity\FilmFilmPersonFunction $filmPersons
     * @return FilmFunction
     */
    public function addFilmPerson(\FDC\CoreBundle\Entity\FilmFilmPersonFunction $filmPersons)
    {
        $this->filmPersons[] = $filmPersons;

        return $this;
    }

    /**
     * Remove filmPersons
     *
     * @param \FDC\CoreBundle\Entity\FilmFilmPersonFunction $filmPersons
     */
    public function removeFilmPerson(\FDC\CoreBundle\Entity\FilmFilmPersonFunction $filmPersons)
    {
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

    /**
     * Add filmAtelierGenerics
     *
     * @param \FDC\CoreBundle\Entity\FilmAtelierGeneric $filmAtelierGenerics
     * @return FilmFunction
     */
    public function addFilmAtelierGeneric(\FDC\CoreBundle\Entity\FilmAtelierGeneric $filmAtelierGenerics)
    {
        $this->filmAtelierGenerics[] = $filmAtelierGenerics;

        return $this;
    }

    /**
     * Remove filmAtelierGenerics
     *
     * @param \FDC\CoreBundle\Entity\FilmAtelierGeneric $filmAtelierGenerics
     */
    public function removeFilmAtelierGeneric(\FDC\CoreBundle\Entity\FilmAtelierGeneric $filmAtelierGenerics)
    {
        $this->filmAtelierGenerics->removeElement($filmAtelierGenerics);
    }

    /**
     * Get filmAtelierGenerics
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFilmAtelierGenerics()
    {
        return $this->filmAtelierGenerics;
    }
}
