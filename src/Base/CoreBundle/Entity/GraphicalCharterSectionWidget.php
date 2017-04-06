<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GraphicalCharterSectionWidget
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *  "text" = "GraphicalCharterSectionWidgetText",
 *  "oneColumn" = "GraphicalCharterSectionWidgetOneColumn",
 *  "twoColumns" = "GraphicalCharterSectionWidgetTwoColumns",
 *  "threeColumns" = "GraphicalCharterSectionWidgetThreeColumns"
 * })
 */
abstract class GraphicalCharterSectionWidget
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
     * @var GraphicalCharterSection
     *
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\GraphicalCharterSection", inversedBy="widgets")
     */
    protected $graphicalCharterSection;

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

    public function isWidgetText()
    {
        return $this instanceof GraphicalCharterSectionWidgetText;
    }

    public function isWidgetOneColumn()
    {
        return $this instanceof GraphicalCharterSectionWidgetOneColumn;
    }

    public function isWidgetTwoColumns()
    {
        return $this instanceof GraphicalCharterSectionWidgetTwoColumns;
    }

    public function isWidgetThreeColumns()
    {
        return $this instanceof GraphicalCharterSectionWidgetThreeColumns;
    }

    /**
     * Set graphicalCharterSection
     *
     * @param \Base\CoreBundle\Entity\GraphicalCharterSection $graphicalCharterSection
     * @return GraphicalCharterSectionWidget
     */
    public function setGraphicalCharterSection(\Base\CoreBundle\Entity\GraphicalCharterSection $graphicalCharterSection = null)
    {
        $this->graphicalCharterSection = $graphicalCharterSection;

        return $this;
    }

    /**
     * Get graphicalCharterSection
     *
     * @return \Base\CoreBundle\Entity\GraphicalCharterSection 
     */
    public function getGraphicalCharterSection()
    {
        return $this->graphicalCharterSection;
    }
}
