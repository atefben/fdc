<?php

namespace FDC\CoreBundle\Entity;

use \Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * FilmAtelierGeneric
 *
 * @ORM\Table(indexes={@ORM\Index(name="person_id", columns={"person_id"}), @ORM\Index(name="id_position", columns={"id", "position"}), @ORM\Index(name="position", columns={"position"}) })
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmAtelierGeneric
{
    use Time;

    /**
     * @var string
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $functionVf;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $functionVa;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $roleVf;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $roleVa;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=22, scale=0, nullable=true)
     */
    private $position;

    /**
     * @var FilmFunction
     *
     * @ORM\ManyToOne(targetEntity="FilmFunction", inversedBy="filmAtelierGenerics")
     */
    private $function;

    /**
     * @var FilmPerson
     *
     * @ORM\ManyToOne(targetEntity="FilmPerson", inversedBy="filmAtelierGenerics")
     */
    private $person;

    /**
     * @var FilmAtelier
     *
     * @ORM\ManyToOne(targetEntity="FilmAtelier", inversedBy="filmAtelierGenerics")
     */
    private $filmAtelier;

    /**
     * @var FilmMedia
     *
     * @ORM\OneToMany(targetEntity="FilmMedia", mappedBy="filmAtelierGeneric")
     */
    private $medias;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->medias = new ArrayCollection();
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
     * Set functionVf
     *
     * @param string $functionVf
     * @return FilmAtelierGeneric
     */
    public function setFunctionVf($functionVf)
    {
        $this->functionVf = $functionVf;

        return $this;
    }

    /**
     * Get functionVf
     *
     * @return string 
     */
    public function getFunctionVf()
    {
        return $this->functionVf;
    }

    /**
     * Set functionVa
     *
     * @param string $functionVa
     * @return FilmAtelierGeneric
     */
    public function setFunctionVa($functionVa)
    {
        $this->functionVa = $functionVa;

        return $this;
    }

    /**
     * Get functionVa
     *
     * @return string 
     */
    public function getFunctionVa()
    {
        return $this->functionVa;
    }

    /**
     * Set roleVf
     *
     * @param string $roleVf
     * @return FilmAtelierGeneric
     */
    public function setRoleVf($roleVf)
    {
        $this->roleVf = $roleVf;

        return $this;
    }

    /**
     * Get roleVf
     *
     * @return string 
     */
    public function getRoleVf()
    {
        return $this->roleVf;
    }

    /**
     * Set roleVa
     *
     * @param string $roleVa
     * @return FilmAtelierGeneric
     */
    public function setRoleVa($roleVa)
    {
        $this->roleVa = $roleVa;

        return $this;
    }

    /**
     * Get roleVa
     *
     * @return string 
     */
    public function getRoleVa()
    {
        return $this->roleVa;
    }

    /**
     * Set function
     *
     * @param \FDC\CoreBundle\Entity\FilmFunction $function
     * @return FilmAtelierGeneric
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
     * @param \FDC\CoreBundle\Entity\FilmPerson $person
     * @return FilmAtelierGeneric
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
     * Set filmAtelier
     *
     * @param \FDC\CoreBundle\Entity\FilmAtelier $filmAtelier
     * @return FilmAtelierGeneric
     */
    public function setFilmAtelier(\FDC\CoreBundle\Entity\FilmAtelier $filmAtelier = null)
    {
        $this->filmAtelier = $filmAtelier;

        return $this;
    }

    /**
     * Get filmAtelier
     *
     * @return \FDC\CoreBundle\Entity\FilmAtelier 
     */
    public function getFilmAtelier()
    {
        return $this->filmAtelier;
    }

    /**
     * Add medias
     *
     * @param \FDC\CoreBundle\Entity\FilmMedia $medias
     * @return FilmAtelierGeneric
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
}