<?php

namespace FDC\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\Interfaces\OneLocaleInterface;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * FilmJuryFonction
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FilmJuryFunction
{
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     */
    private $id;
    
    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="FilmJury", mappedBy="function")
     */
    private $juries;

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
        $this->juries = new ArrayCollection();
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return FilmJuryFunction
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
     * Set functionVf
     *
     * @param string $functionVf
     * @return FilmJuryFunction
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
     * @return FilmJuryFunction
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
     * @return FilmJuryFunction
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
     * Add juries
     *
     * @param \FDC\CoreBundle\Entity\FilmJury $juries
     * @return FilmJuryFunction
     */
    public function addJury(\FDC\CoreBundle\Entity\FilmJury $juries)
    {
        $this->juries[] = $juries;

        return $this;
    }

    /**
     * Remove juries
     *
     * @param \FDC\CoreBundle\Entity\FilmJury $juries
     */
    public function removeJury(\FDC\CoreBundle\Entity\FilmJury $juries)
    {
        $this->juries->removeElement($juries);
    }

    /**
     * Get juries
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getJuries()
    {
        return $this->juries;
    }
}
