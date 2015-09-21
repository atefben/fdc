<?php

namespace FDC\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;
use FDC\CoreBundle\Util\Soif;

/**
 * FilmAward
 *
 * @ORM\Table()
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class FilmAward
{
    use Time;
    use Soif;
    
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
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
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $filmMutual;
    
    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $personMutual;

    /**
     * @var string
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $exAequo;

    /**
     * @var string
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $unanimity;

    /**
     * @var text
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $comment;

    /**
     * @var FilmFestival
     *
     * @ORM\ManyToOne(targetEntity="FilmFestival", inversedBy="awards")
     */
    private $festival;

    /**
     * @var FilmPrize
     *
     * @ORM\ManyToOne(targetEntity="FilmPrize", inversedBy="awards")
     */
    private $prize;

    /**
     * @var FilmAwardAssociation
     *
     * @ORM\oneToMany(targetEntity="FilmAwardAssociation", mappedBy="award", cascade={"persist"})
     */
    private $associations;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->associations = new ArrayCollection();
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return FilmAward
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
     * Set position
     *
     * @param integer $position
     * @return FilmAward
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
     * Set filmMutual
     *
     * @param boolean $filmMutual
     * @return FilmAward
     */
    public function setFilmMutual($filmMutual)
    {
        $this->filmMutual = $filmMutual;

        return $this;
    }

    /**
     * Get filmMutual
     *
     * @return boolean 
     */
    public function getFilmMutual()
    {
        return $this->filmMutual;
    }

    /**
     * Set personMutual
     *
     * @param boolean $personMutual
     * @return FilmAward
     */
    public function setPersonMutual($personMutual)
    {
        $this->personMutual = $personMutual;

        return $this;
    }

    /**
     * Get personMutual
     *
     * @return boolean 
     */
    public function getPersonMutual()
    {
        return $this->personMutual;
    }

    /**
     * Set exAequo
     *
     * @param boolean $exAequo
     * @return FilmAward
     */
    public function setExAequo($exAequo)
    {
        $this->exAequo = $exAequo;

        return $this;
    }

    /**
     * Get exAequo
     *
     * @return boolean 
     */
    public function getExAequo()
    {
        return $this->exAequo;
    }

    /**
     * Set unanimity
     *
     * @param boolean $unanimity
     * @return FilmAward
     */
    public function setUnanimity($unanimity)
    {
        $this->unanimity = $unanimity;

        return $this;
    }

    /**
     * Get unanimity
     *
     * @return boolean 
     */
    public function getUnanimity()
    {
        return $this->unanimity;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return FilmAward
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set festival
     *
     * @param \FDC\CoreBundle\Entity\FilmFestival $festival
     * @return FilmAward
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
     * Set prize
     *
     * @param \FDC\CoreBundle\Entity\FilmPrize $prize
     * @return FilmAward
     */
    public function setPrize(\FDC\CoreBundle\Entity\FilmPrize $prize = null)
    {
        $this->prize = $prize;

        return $this;
    }

    /**
     * Get prize
     *
     * @return \FDC\CoreBundle\Entity\FilmPrize 
     */
    public function getPrize()
    {
        return $this->prize;
    }

    /**
     * Add associations
     *
     * @param \FDC\CoreBundle\Entity\FilmAwardAssociation $associations
     * @return FilmAward
     */
    public function addAssociation(\FDC\CoreBundle\Entity\FilmAwardAssociation $associations)
    {
        if ($this->associations->contains($associations)) {
            return;
        }
        
        $associations->setAward($this);
        $this->associations[] = $associations;

        return $this;
    }

    /**
     * Remove associations
     *
     * @param \FDC\CoreBundle\Entity\FilmAwardAssociation $associations
     */
    public function removeAssociation(\FDC\CoreBundle\Entity\FilmAwardAssociation $associations)
    {
        if (!$this->associations->contains($associations)) {
            return;
        }
        
        $this->associations->removeElement($associations);
    }

    /**
     * Get associations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAssociations()
    {
        return $this->associations;
    }
}
