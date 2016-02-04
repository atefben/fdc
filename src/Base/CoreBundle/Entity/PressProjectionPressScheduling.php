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
 * @ORM\Entity
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
     * @ORM\OneToOne(targetEntity="PressProjection", cascade={"persist"})
     */
    protected $PressPressProjection;

    /**
     * @var FilmProjection
     *
     * @ORM\ManyToOne(targetEntity="FilmProjection", inversedBy="pressProjection")
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
     * Set PressPressProjection
     *
     * @param \Base\CoreBundle\Entity\PressProjection $pressPressProjection
     * @return PressProjectionPressScheduling
     */
    public function setPressPressProjection(\Base\CoreBundle\Entity\PressProjection $pressPressProjection = null)
    {
        $this->PressPressProjection = $pressPressProjection;

        return $this;
    }

    /**
     * Get PressPressProjection
     *
     * @return \Base\CoreBundle\Entity\PressProjection 
     */
    public function getPressPressProjection()
    {
        return $this->PressPressProjection;
    }

    /**
     * Set pressScheduling
     *
     * @param \Base\CoreBundle\Entity\FilmProjection $pressScheduling
     * @return PressProjectionPressScheduling
     */
    public function setPressScheduling(\Base\CoreBundle\Entity\FilmProjection $pressScheduling = null)
    {
        $this->pressScheduling = $pressScheduling;

        return $this;
    }

    /**
     * Get pressScheduling
     *
     * @return \Base\CoreBundle\Entity\FilmProjection 
     */
    public function getPressScheduling()
    {
        return $this->pressScheduling;
    }
}
