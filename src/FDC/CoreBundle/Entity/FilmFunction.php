<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * FilmFonction
 *
 * @ORM\Table(indexes={@ORM\Index(name="function_vf", columns={"function_vf"}), @ORM\Index(name="function_va", columns={"function_va"}), @ORM\Index(name="updated_at", columns={"updated_at"}), @ORM\Index(name="order", columns={"order"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FilmFunction
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
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $order;
    
    /**
     * @ORM\OneToMany(targetEntity="FilmPerson", mappedBy="function")
     */
    private $persons;
    
    /**
     * @ORM\OneToMany(targetEntity="FilmAtelierGeneric", mappedBy="function")
     */
    private $filmAtelierGenerics;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->persons = new \Doctrine\Common\Collections\ArrayCollection();
        $this->filmAtelierGenerics = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return FilmFunction
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
     * @return FilmFunction
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
     * Set order
     *
     * @param integer $order
     * @return FilmFunction
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return integer 
     */
    public function getOrder()
    {
        return $this->order;
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
