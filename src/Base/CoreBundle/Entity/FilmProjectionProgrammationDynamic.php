<?php

namespace Base\CoreBundle\Entity;

use Base\CoreBundle\Util\Time;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

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
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     *
     * @Groups({"projection_list", "projection_show"})
     */
    private $duration;

    /**
     * @var FilmProjectionProgrammationType
     *
     * @ORM\ManyToOne(targetEntity="FilmProjectionProgrammationType", cascade={"persist"})
     *
     * @Groups({"projection_list", "projection_show"})
     */
    private $type;
    
    /**
     * @var FilmProjection
     *
     * @ORM\ManyToOne(targetEntity="FilmProjection", inversedBy="programmationDynamics")
     */
    private $projection;

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
     * Set type
     *
     * @param \Base\CoreBundle\Entity\FilmProjectionProgrammationType $type
     * @return FilmProjectionProgrammationDynamic
     */
    public function setType(\Base\CoreBundle\Entity\FilmProjectionProgrammationType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \Base\CoreBundle\Entity\FilmProjectionProgrammationType 
     */
    public function getType()
    {
        return $this->type;
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
