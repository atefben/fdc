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
     * @ORM\OneToOne(targetEntity="FilmProjection", cascade={"persist"})
     */
    protected $projection;

    /**
     * @var FilmProjection
     *
     * @ORM\ManyToOne(targetEntity="PressProjection", inversedBy="projection")
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
     * Set projection
     *
     * @param \Base\CoreBundle\Entity\FilmProjection $projection
     * @return PressProjectionScheduling
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
     * Set scheduling
     *
     * @param \Base\CoreBundle\Entity\PressProjection $scheduling
     * @return PressProjectionScheduling
     */
    public function setScheduling(\Base\CoreBundle\Entity\PressProjection $scheduling = null)
    {
        $this->scheduling = $scheduling;

        return $this;
    }

    /**
     * Get scheduling
     *
     * @return \Base\CoreBundle\Entity\PressProjection 
     */
    public function getScheduling()
    {
        return $this->scheduling;
    }
}
