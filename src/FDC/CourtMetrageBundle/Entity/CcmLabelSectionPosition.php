<?php

namespace FDC\CourtMetrageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CcmLabelSectionPosition
 * @ORM\Table(name="ccm_label_section_position")
 * @ORM\Entity
 */
class CcmLabelSectionPosition
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var CcmLabelSection
     *
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmLabelSection")
     *
     */
    protected $labelSection;

    /**
     * @ORM\ManyToOne(targetEntity="CcmLabel", inversedBy="labelSection")
     * @ORM\JoinColumn(name="label_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $label;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $position;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return CcmLabelSection
     */
    public function getLabelSection()
    {
        return $this->labelSection;
    }

    /**
     * @param $labelSection
     *
     * @return $this
     */
    public function setLabelSection($labelSection)
    {
        $this->labelSection = $labelSection;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param $label
     *
     * @return $this
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param $position
     *
     * @return $this
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }
}
