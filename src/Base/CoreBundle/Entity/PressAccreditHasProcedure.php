<?php

namespace Base\CoreBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * PressAccreditHasProcedure
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PressAccreditHasProcedure
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
     * @ORM\OneToOne(targetEntity="PressAccreditProcedure", cascade={"persist"})
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
     * @ORM\ManyToOne(targetEntity="PressAccredit", inversedBy="procedure")
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
     * @return PressAccreditHasProcedure
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
     * @param \Base\CoreBundle\Entity\PressAccreditProcedure $procedure
     * @return PressAccreditHasProcedure
     */
    public function setProcedure(\Base\CoreBundle\Entity\PressAccreditProcedure $procedure = null)
    {
        $this->procedure = $procedure;

        return $this;
    }

    /**
     * Get procedure
     *
     * @return \Base\CoreBundle\Entity\PressAccreditProcedure 
     */
    public function getProcedure()
    {
        return $this->procedure;
    }

    /**
     * Set accredit
     *
     * @param \Base\CoreBundle\Entity\PressAccredit $accredit
     * @return PressAccreditHasProcedure
     */
    public function setAccredit(\Base\CoreBundle\Entity\PressAccredit $accredit = null)
    {

        $this->accredit = $accredit;

        return $this;
    }

    /**
     * Get accredit
     *
     * @return \Base\CoreBundle\Entity\PressAccredit 
     */
    public function getAccredit()
    {
        return $this->accredit;
    }
}
