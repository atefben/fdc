<?php

namespace FDC\CourtMetrageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CcmProsDescription
 * @ORM\Table(name="ccm_pros_description")
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *  "single" = "CcmProsDescriptionSingleColumn",
 *  "double" = "CcmProsDescriptionDoubleColumn",
 * })
 */
abstract class CcmProsDescription
{

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $position;

    /**
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmProsDetail", inversedBy="description")
     * @ORM\JoinColumn(name="pros_detail_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $prosDetail;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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

    /**
     * @return mixed
     */
    public function getProsDetail()
    {
        return $this->prosDetail;
    }

    /**
     * @param mixed $prosDetail
     */
    public function setProsDetail($prosDetail)
    {
        $this->prosDetail = $prosDetail;
    }
}

