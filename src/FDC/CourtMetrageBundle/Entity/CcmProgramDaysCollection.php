<?php

namespace FDC\CourtMetrageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Base\CoreBundle\Util\Time;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CcmProgramDaysCollection
 *
 * @ORM\Table(name="ccm_program_days_collection")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmProgramDaysCollection
{
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="CcmProgramDay", inversedBy="daysCollection")
     * @ORM\JoinColumn(name="day_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $day;

    /**
     * @ORM\ManyToOne(targetEntity="CcmProgram", inversedBy="daysCollection")
     * @Assert\Count(
     *      min = "1",
     *      minMessage = "validation.schedule_min"
     * )
     */
    private $program;

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
     * @return CcmProgramDay
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @param CcmProgramDay $day
     * 
     * @return $this
     */
    public function setDay(CcmProgramDay $day)
    {
        $this->day = $day;
        
        return $this;
    }

    /**
     * @return CcmProgram
     */
    public function getProgram()
    {
        return $this->program;
    }

    /**
     * @param CcmProgram $program
     * 
     * @return $this
     */
    public function setProgram(CcmProgram $program)
    {
        $this->program = $program;
        
        return $this;
    }
}
