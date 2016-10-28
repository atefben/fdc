<?php

namespace Base\CoreBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * CorpoAccreditHasProcedure
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CorpoAccreditHasProcedure
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
     * @ORM\OneToOne(targetEntity="CorpoAccreditProcedure", cascade={"persist"})
     */
    protected $procedure;

    /**
     * @var integer
     * @Gedmo\SortablePosition
     * @ORM\Column(name="position", type="integer")
     */
    protected $position;

    /**
     * @var PressHomepage
     *
     * @ORM\ManyToOne(targetEntity="CorpoAccredit", inversedBy="procedure")
     */
    protected $accredit;


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
     * Set position
     *
     * @param integer $position
     * @return CorpoAccreditHasProcedure
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
     * Set procedure
     *
     * @param \Base\CoreBundle\Entity\CorpoAccreditProcedure $procedure
     * @return CorpoAccreditHasProcedure
     */
    public function setProcedure(\Base\CoreBundle\Entity\CorpoAccreditProcedure $procedure = null)
    {
        $this->procedure = $procedure;

        return $this;
    }

    /**
     * Get procedure
     *
     * @return \Base\CoreBundle\Entity\CorpoAccreditProcedure
     */
    public function getProcedure()
    {
        return $this->procedure;
    }

    /**
     * Set accredit
     *
     * @param \Base\CoreBundle\Entity\CorpoAccredit $accredit
     * @return CorpoAccreditHasProcedure
     */
    public function setAccredit(\Base\CoreBundle\Entity\CorpoAccredit $accredit = null)
    {

        $this->accredit = $accredit;

        return $this;
    }

    /**
     * Get accredit
     *
     * @return \Base\CoreBundle\Entity\CorpoAccredit
     */
    public function getAccredit()
    {
        return $this->accredit;
    }
}
