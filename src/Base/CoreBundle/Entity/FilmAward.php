<?php

namespace Base\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\Soif;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

/**
 * FilmAward
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\FilmAwardRepository")
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
     *
     * @Groups({
     *  "award_list", "award_show",
     * })
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     *
     * @Groups({
     *  "award_list", "award_show",
     *  "film_list", "film_show"
     * })
     */
    private $position;
    
    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=true)
     *
     * @Groups({
     *  "award_list", "award_show",
     *  "film_list", "film_show"
     * })
     */
    private $filmMutual;
    
    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=true)
     *
     * @Groups({
     *  "award_list", "award_show",
     * })
     */
    private $personMutual;

    /**
     * @var string
     *
     * @ORM\Column(type="boolean", nullable=true)
     *
     * @Groups({
     *  "award_list", "award_show",
     * })
     */
    private $exAequo;

    /**
     * @var string
     *
     * @ORM\Column(type="boolean", nullable=true)
     *
     * @Groups({
     *  "award_list", "award_show",
     * })
     */
    private $unanimity;

    /**
     * @var text
     *
     * @ORM\Column(type="text", nullable=true)
     *
     * @Groups({
     *  "award_list", "award_show",
     * })
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
     *
     * @Groups({
     * "award_list", "award_show",
     * "film_list", "film_show"
     * })
     */
    private $prize;

    /**
     * @var FilmAwardAssociation
     *
     * @ORM\oneToMany(targetEntity="FilmAwardAssociation", mappedBy="award", cascade={"all"})
     *
     * @Groups({"award_list", "award_show"})
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
     * @param \Base\CoreBundle\Entity\FilmFestival $festival
     * @return FilmAward
     */
    public function setFestival(\Base\CoreBundle\Entity\FilmFestival $festival = null)
    {
        $this->festival = $festival;

        return $this;
    }

    /**
     * Get festival
     *
     * @return \Base\CoreBundle\Entity\FilmFestival
     */
    public function getFestival()
    {
        return $this->festival;
    }

    /**
     * Set prize
     *
     * @param \Base\CoreBundle\Entity\FilmPrize $prize
     * @return FilmAward
     */
    public function setPrize(\Base\CoreBundle\Entity\FilmPrize $prize = null)
    {
        $this->prize = $prize;

        return $this;
    }

    /**
     * Get prize
     *
     * @return \Base\CoreBundle\Entity\FilmPrize
     */
    public function getPrize()
    {
        return $this->prize;
    }

    /**
     * Add associations
     *
     * @param \Base\CoreBundle\Entity\FilmAwardAssociation $associations
     * @return FilmAward
     */
    public function addAssociation(\Base\CoreBundle\Entity\FilmAwardAssociation $associations)
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
     * @param \Base\CoreBundle\Entity\FilmAwardAssociation $associations
     */
    public function removeAssociation(\Base\CoreBundle\Entity\FilmAwardAssociation $associations)
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
