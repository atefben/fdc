<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * PressDownload
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PressProjection
{
    use Time;
    use Translatable;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var PressProjectionScheduling
     * @ORM\OneToMany(targetEntity="PressProjectionScheduling", mappedBy="scheduling", cascade={"persist"}, orphanRemoval=true)
     * @ORM\OrderBy({"date" = "ASC"})
     */
    protected $projection;

    /**
     * @var PressProjectionPressScheduling
     * @ORM\OneToMany(targetEntity="PressProjectionPressScheduling", mappedBy="pressScheduling", cascade={"persist"}, orphanRemoval=true)
     * @ORM\OrderBy({"date" = "ASC"})
     */
    protected $pressProjection;

    /**
     * ArrayCollection
     */
    protected $translations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->projection = new ArrayCollection();
        $this->pressProjection = new ArrayCollection();
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
     * Add projection
     *
     * @param \Base\CoreBundle\Entity\PressProjectionScheduling $projection
     * @return PressProjection
     */
    public function addProjection(\Base\CoreBundle\Entity\PressProjectionScheduling $projection)
    {
        $projection->setPressProjection($this);
        $this->projection[] = $projection;

        return $this;
    }

    /**
     * Remove projection
     *
     * @param \Base\CoreBundle\Entity\PressProjectionScheduling $projection
     */
    public function removeProjection(\Base\CoreBundle\Entity\PressProjectionScheduling $projection)
    {
        $this->projection->removeElement($projection);
    }

    /**
     * Get projection
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProjection()
    {
        return $this->projection;
    }

    /**
     * Add pressProjection
     *
     * @param \Base\CoreBundle\Entity\PressProjectionPressScheduling $pressProjection
     * @return PressProjection
     */
    public function addPressProjection(\Base\CoreBundle\Entity\PressProjectionPressScheduling $pressProjection)
    {
        $pressProjection->setPressProjection($this);
        $this->pressProjection[] = $pressProjection;

        return $this;
    }

    /**
     * Remove pressProjection
     *
     * @param \Base\CoreBundle\Entity\PressProjectionPressScheduling $pressProjection
     */
    public function removePressProjection(\Base\CoreBundle\Entity\PressProjectionPressScheduling $pressProjection)
    {
        $this->pressProjection->removeElement($pressProjection);
    }

    /**
     * Get pressProjection
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPressProjection()
    {
        return $this->pressProjection;
    }
}
