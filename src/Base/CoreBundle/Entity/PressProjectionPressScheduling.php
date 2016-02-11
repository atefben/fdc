<?php

namespace Base\CoreBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * PressProjectionPressScheduling
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\PressProjectionPressSchedulingRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class PressProjectionPressScheduling
{
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\OneToOne(targetEntity="FilmProjection", cascade={"persist"})
     */
    protected $projection;

    /**
     * @var FilmProjection
     *
     * @ORM\ManyToOne(targetEntity="PressProjection", inversedBy="projectionPress", cascade={"persist"})
     */
    protected $pressScheduling;


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
     * Set projection
     *
     * @param \Base\CoreBundle\Entity\FilmProjection $projection
     * @return PressProjectionPressScheduling
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

    /**
     * Set pressScheduling
     *
     * @param \Base\CoreBundle\Entity\PressProjection $pressScheduling
     * @return PressProjectionPressScheduling
     */
    public function setPressScheduling(\Base\CoreBundle\Entity\PressProjection $pressScheduling = null)
    {
        $this->pressScheduling = $pressScheduling;

        return $this;
    }

    /**
     * Get pressScheduling
     *
     * @return \Base\CoreBundle\Entity\PressProjection 
     */
    public function getPressScheduling()
    {
        return $this->pressScheduling;
    }
}
