<?php

namespace Base\CoreBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * PressProjectionScheduling
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PressProjectionScheduling
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
    protected $PressProjection;

    /**
     * @var FilmProjection
     *
     * @ORM\ManyToOne(targetEntity="FilmProjection", inversedBy="projection")
     */
    protected $scheduling;
    

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
     * Set PressProjection
     *
     * @param \Base\CoreBundle\Entity\PressProjection $pressProjection
     * @return PressProjectionScheduling
     */
    public function setPressProjection(\Base\CoreBundle\Entity\PressProjection $pressProjection = null)
    {
        $this->PressProjection = $pressProjection;

        return $this;
    }

    /**
     * Get PressProjection
     *
     * @return \Base\CoreBundle\Entity\PressProjection 
     */
    public function getPressProjection()
    {
        return $this->PressProjection;
    }

    /**
     * Set scheduling
     *
     * @param \Base\CoreBundle\Entity\FilmProjection $scheduling
     * @return PressProjectionScheduling
     */
    public function setScheduling(\Base\CoreBundle\Entity\FilmProjection $scheduling = null)
    {
        $this->scheduling = $scheduling;

        return $this;
    }

    /**
     * Get scheduling
     *
     * @return \Base\CoreBundle\Entity\FilmProjection 
     */
    public function getScheduling()
    {
        return $this->scheduling;
    }
}
