<?php

namespace FDC\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * FilmPrize
 *
 * @ORM\Table(indexes={@ORM\Index(name="position", columns={"position"}), @ORM\Index(name="updated_at", columns={"updated_at"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmPrize implements FilmPrizeInterface
{
    use Time;
    use Translatable;

    /**
     * @var string
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
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @var string
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $position;

    /**
     * @ORM\OneToMany(targetEntity="FilmAward", mappedBy="prize")
     */
    private $awards;
    
    /**
     * @var ArrayCollection
     */
    protected $translations;
    
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    /**
     * getTranslationLocale function.
     * 
     * @access public
     * @param mixed $locale
     * @return void
     */
    public function findTranslationByLocale($locale)
    {
        foreach ($this->translations as $translation) {
            if ($translation->getLocale() == $locale) {
                return $translation;
            }
        }
        
        return null;
    }
    /**
     * Set id
     *
     * @param integer $id
     * @return FilmPrize
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
     * Set type
     *
     * @param integer $type
     * @return FilmPrize
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return FilmPrize
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return FilmPrize
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return FilmPrize
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
     * Add awards
     *
     * @param \FDC\CoreBundle\Entity\FilmAward $awards
     * @return FilmPrize
     */
    public function addAward(\FDC\CoreBundle\Entity\FilmAward $awards)
    {
        $this->awards[] = $awards;

        return $this;
    }

    /**
     * Remove awards
     *
     * @param \FDC\CoreBundle\Entity\FilmAward $awards
     */
    public function removeAward(\FDC\CoreBundle\Entity\FilmAward $awards)
    {
        $this->awards->removeElement($awards);
    }

    /**
     * Get awards
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAwards()
    {
        return $this->awards;
    }
}
