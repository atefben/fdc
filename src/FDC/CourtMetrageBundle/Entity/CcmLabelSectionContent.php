<?php

namespace FDC\CourtMetrageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CcmLabelSectionContent
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *  "text" = "CcmLabelSectionContentText"
 * })
 */
abstract class CcmLabelSectionContent
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var CcmLabelSection
     *
     * @ORM\ManyToOne(targetEntity="CcmLabelSection", inversedBy="labelSectionContent")
     */
    protected $labelSection;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
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
