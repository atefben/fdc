<?php

namespace FDC\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;
use FDC\CoreBundle\Util\Soif;
use FDC\CoreBundle\Util\Translation;

/**
 * FilmJury
 *
 * @ORM\Table(indexes={@ORM\Index(name="festival_id", columns={"festival_id"}), @ORM\Index(name="position", columns={"position"}) })
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmJury
{
    use Time;
    use Translatable;
    use Soif;
    use Translation;
    
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $position;

    /**
     * @var FilmFestival
     *
     * @ORM\ManyToOne(targetEntity="FilmFestival", inversedBy="juries", cascade={"persist"})
     */
    private $festival;

    /**
     * @var Person
     *
     * @ORM\ManyToOne(targetEntity="FilmPerson", inversedBy="juries", cascade={"persist"})
     */
    private $person;

    /**
     * @var FilmJuryType
     *
     * @ORM\ManyToOne(targetEntity="FilmJuryType", inversedBy="juries", cascade={"persist"})
     */
    private $type;
    
    /**
     * @var FilmJuryType
     *
     * @ORM\ManyToOne(targetEntity="FilmJuryFunction", inversedBy="juries", cascade={"persist"})
     */
    private $function;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FilmMedia", mappedBy="jury")
     */
    private $medias;
    
    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * __construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct()
    {
        $this->medias = new ArrayCollection();
        $this->translations = new ArrayCollection();
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return FilmJury
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
     * Set bioFilmVf
     *
     * @param string $bioFilmVf
     * @return FilmJury
     */
    public function setBioFilmVf($bioFilmVf)
    {
        $this->bioFilmVf = $bioFilmVf;

        return $this;
    }

    /**
     * Get bioFilmVf
     *
     * @return string 
     */
    public function getBioFilmVf()
    {
        return $this->bioFilmVf;
    }

    /**
     * Set bioFilmVa
     *
     * @param string $bioFilmVa
     * @return FilmJury
     */
    public function setBioFilmVa($bioFilmVa)
    {
        $this->bioFilmVa = $bioFilmVa;

        return $this;
    }

    /**
     * Get bioFilmVa
     *
     * @return string 
     */
    public function getBioFilmVa()
    {
        return $this->bioFilmVa;
    }

    /**
     * Set bioFilmVf2
     *
     * @param string $bioFilmVf2
     * @return FilmJury
     */
    public function setBioFilmVf2($bioFilmVf2)
    {
        $this->bioFilmVf2 = $bioFilmVf2;

        return $this;
    }

    /**
     * Get bioFilmVf2
     *
     * @return string 
     */
    public function getBioFilmVf2()
    {
        return $this->bioFilmVf2;
    }

    /**
     * Set bioFilmVa2
     *
     * @param string $bioFilmVa2
     * @return FilmJury
     */
    public function setBioFilmVa2($bioFilmVa2)
    {
        $this->bioFilmVa2 = $bioFilmVa2;

        return $this;
    }

    /**
     * Get bioFilmVa2
     *
     * @return string 
     */
    public function getBioFilmVa2()
    {
        return $this->bioFilmVa2;
    }

    /**
     * Set person
     *
     * @param \FDC\CoreBundle\Entity\FilmPerson $person
     * @return FilmJury
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
     * Set type
     *
     * @param \FDC\CoreBundle\Entity\FilmJuryType $type
     * @return FilmJury
     */
    public function setType(\FDC\CoreBundle\Entity\FilmJuryType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \FDC\CoreBundle\Entity\FilmJuryType 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set function
     *
     * @param \FDC\CoreBundle\Entity\FilmJuryFunction $function
     * @return FilmJury
     */
    public function setFunction(\FDC\CoreBundle\Entity\FilmJuryFunction $function = null)
    {
        $this->function = $function;

        return $this;
    }

    /**
     * Get function
     *
     * @return \FDC\CoreBundle\Entity\FilmJuryFunction 
     */
    public function getFunction()
    {
        return $this->function;
    }

    /**
     * Add medias
     *
     * @param \FDC\CoreBundle\Entity\FilmMedia $medias
     * @return FilmJury
     */
    public function addMedia(\FDC\CoreBundle\Entity\FilmMedia $medias)
    {
        $this->medias[] = $medias;

        return $this;
    }

    /**
     * Remove medias
     *
     * @param \FDC\CoreBundle\Entity\FilmMedia $medias
     */
    public function removeMedia(\FDC\CoreBundle\Entity\FilmMedia $medias)
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

    /**
     * Set festival
     *
     * @param \FDC\CoreBundle\Entity\FilmFestival $festival
     * @return FilmJury
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
     * Set position
     *
     * @param integer $position
     * @return FilmJury
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
