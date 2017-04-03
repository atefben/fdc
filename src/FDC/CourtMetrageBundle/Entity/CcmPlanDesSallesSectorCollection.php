<?php

namespace FDC\CourtMetrageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CcmPlanDesSallesSectorCollection
 *
 * @ORM\Table(name="ccm_plan_des_salles_sector_collection")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class CcmPlanDesSallesSectorCollection
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
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmPlanDesSallesSector", inversedBy="planDesSallesCollection")
     * @ORM\JoinColumn(name="plan_des_salles_sector__id", referencedColumnName="id", onDelete="SET NULL")
     * @Assert\Count(
     *      min = "1",
     *      minMessage = "validation.plan_des_salles_sector_min"
     * ) 
     */
    private $sector;

    /**
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmPlanDesSalles", inversedBy="sectorList")
     * @ORM\JoinColumn(name="plan_des_salles_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $planDesSalles;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $position;

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
     * @return CcmPlanDesSallesSector
     */
    public function getSector()
    {
        return $this->sector;
    }

    /**
     * @param CcmPlanDesSallesSector $sector
     */
    public function setSector($sector)
    {
        $this->sector = $sector;
    }

    /**
     * @return CcmPlanDesSalles
     */
    public function getPlanDesSalles()
    {
        return $this->planDesSalles;
    }

    /**
     * @param CcmPlanDesSalles $planDesSalles
     */
    public function setPlanDesSalles(CcmPlanDesSalles $planDesSalles)
    {
        $this->planDesSalles = $planDesSalles;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }
}
