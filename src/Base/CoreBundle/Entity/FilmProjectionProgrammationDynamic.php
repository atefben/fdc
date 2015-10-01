<?php

namespace Base\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * FilmProjectionProgrammationDynamic
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class FilmProjectionProgrammationDynamic
{
    use Time;
    
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
     * @ORM\Column(type="integer")
     */
    private $duration;

    /**
     * @var FilmProjectionProgrammationType
     *
     * @ORM\ManyToOne(targetEntity="FilmProjectionProgrammationType", cascade={"persist"})
     */
    private $type;
    
    /**
     * @var FilmProjection
     *
     * @ORM\ManyToOne(targetEntity="FilmProjection", inversedBy="programmationDynamics")
     */
    private $projection;

    /**
     * Set id
     *
     * @param integer $id
     * @return FilmProjectionProgrammationDynamic
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
     * Set duration
     *
     * @param integer $duration
     * @return FilmProjectionProgrammationDynamic
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return integer 
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return FilmProjectionProgrammationDynamic
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set projection
     *
     * @param \Base\CoreBundle\Entity\FilmProjection $projection
     * @return FilmProjectionProgrammationDynamic
     */
    public function setProjection(\Base\CoreBundle\Entity\FilmProjection $projection = null)
    {
        $this->projection = $projection;

        return $this;
    }

    /**
     * Get projection
     *
     * @return \Base\CoreBundle\Entity\FilmProjection
     */
    public function getProjection()
    {
        return $this->projection;
    }
}
