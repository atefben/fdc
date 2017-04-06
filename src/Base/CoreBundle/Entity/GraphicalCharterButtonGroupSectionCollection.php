<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GraphicalCharterButtonGroupSectionCollection
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\GraphicalCharterButtonGroupSectionCollectionRepository")
 */
class GraphicalCharterButtonGroupSectionCollection
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\GraphicalCharterButtonSection", inversedBy="GraphicalCharterButtonGroupSectionCollection")
     * @ORM\JoinColumn(name="graphical_charter_button_section", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $graphicalCharterButtonSection;

    /**
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\GraphicalCharterButtonGroup", inversedBy="GraphicalCharterButtonGroupSectionCollection")
     * @ORM\JoinColumn(name="graphical_charter_button_group", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $graphicalCharterButtonGroup;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $position;

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
     * @return GraphicalCharterButtonGroupSectionCollection
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
     * Set graphicalCharterButtonSection
     *
     * @param \Base\CoreBundle\Entity\GraphicalCharterButtonSection $graphicalCharterButtonSection
     * @return GraphicalCharterButtonGroupSectionCollection
     */
    public function setGraphicalCharterButtonSection(\Base\CoreBundle\Entity\GraphicalCharterButtonSection $graphicalCharterButtonSection = null)
    {
        $this->graphicalCharterButtonSection = $graphicalCharterButtonSection;

        return $this;
    }

    /**
     * Get graphicalCharterButtonSection
     *
     * @return \Base\CoreBundle\Entity\GraphicalCharterButtonSection 
     */
    public function getGraphicalCharterButtonSection()
    {
        return $this->graphicalCharterButtonSection;
    }

    /**
     * Set graphicalCharterButtonGroup
     *
     * @param \Base\CoreBundle\Entity\GraphicalCharterButtonGroup $graphicalCharterButtonGroup
     * @return GraphicalCharterButtonGroupSectionCollection
     */
    public function setGraphicalCharterButtonGroup(\Base\CoreBundle\Entity\GraphicalCharterButtonGroup $graphicalCharterButtonGroup = null)
    {
        $this->graphicalCharterButtonGroup = $graphicalCharterButtonGroup;

        return $this;
    }

    /**
     * Get graphicalCharterButtonGroup
     *
     * @return \Base\CoreBundle\Entity\GraphicalCharterButtonGroup 
     */
    public function getGraphicalCharterButtonGroup()
    {
        return $this->graphicalCharterButtonGroup;
    }
}
