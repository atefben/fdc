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
     */
    protected $projection;

    /**
     * @var PressProjectionPressScheduling
     * @ORM\OneToMany(targetEntity="PressProjectionPressScheduling", mappedBy="pressScheduling", cascade={"persist"}, orphanRemoval=true)
     */
    protected $projectionP;

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
        $this->projectionP = new ArrayCollection();
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

        $projection->setScheduling($this);
        $this->projection->add($projection);

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
     * Add projectionP
     *
     * @param \Base\CoreBundle\Entity\PressProjectionPressScheduling $projectionP
     * @return PressProjection
     */
    public function addProjectionP(\Base\CoreBundle\Entity\PressProjectionPressScheduling $projectionP)
    {

        $projectionP->setPressScheduling($this);
        $this->projectionP->add($projectionP);

    }

    /**
     * Remove projectionP
     *
     * @param \Base\CoreBundle\Entity\PressProjectionPressScheduling $projectionP
     */
    public function removeProjectionP(\Base\CoreBundle\Entity\PressProjectionPressScheduling $projectionP)
    {
        $this->projectionP->removeElement($projectionP);
    }

    /**
     * Get projectionP
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProjectionP()
    {
        return $this->projectionP;
    }
}
