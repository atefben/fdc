<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\Soif;
use Base\CoreBundle\Util\TranslationByLocale;

/**
 * FilmPrize
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmPrize implements FilmPrizeInterface
{
    use Time;
    use Translatable;
    use Soif;
    use TranslationByLocale;

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

    /**
     * __construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct()
    {
        $this->awards = new ArrayCollection();
        $this->translations = new ArrayCollection();
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
     * @param \Base\CoreBundle\Entity\FilmAward $awards
     * @return FilmPrize
     */
    public function addAward(\Base\CoreBundle\Entity\FilmAward $awards)
    {
        if ($this->awards->contains($awards)) {
            return;
        }

        $this->awards[] = $awards;

        return $this;
    }

    /**
     * Remove awards
     *
     * @param \Base\CoreBundle\Entity\FilmAward $awards
     */
    public function removeAward(\Base\CoreBundle\Entity\FilmAward $awards)
    {
        if (!$this->awards->contains($awards)) {
            return;
        }
        
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
