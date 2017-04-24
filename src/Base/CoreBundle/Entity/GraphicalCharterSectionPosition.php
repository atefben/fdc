<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GraphicalCharterSectionPosition
 * @ORM\Table()
 * @ORM\Entity()
 */
class GraphicalCharterSectionPosition
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var GraphicalCharterSection
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\GraphicalCharterSection", inversedBy="graphicalCharters")
     */
    protected $graphicalCharterSection;

    /**
     * @var GraphicalCharter
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\GraphicalCharter", inversedBy="graphicalCharterSections")
     * @ORM\JoinColumn(name="graphical_charter", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $graphicalCharter;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
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
     * @return GraphicalCharterSectionPosition
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
     * Set graphicalCharterSection
     *
     * @param \Base\CoreBundle\Entity\GraphicalCharterSection $graphicalCharterSection
     * @return GraphicalCharterSectionPosition
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

    /**
     * Set graphicalCharter
     *
     * @param \Base\CoreBundle\Entity\GraphicalCharter $graphicalCharter
     * @return GraphicalCharterSectionPosition
     */
    public function setGraphicalCharter(\Base\CoreBundle\Entity\GraphicalCharter $graphicalCharter = null)
    {
        $this->graphicalCharter = $graphicalCharter;

        return $this;
    }

    /**
     * Get graphicalCharter
     *
     * @return \Base\CoreBundle\Entity\GraphicalCharter 
     */
    public function getGraphicalCharter()
    {
        return $this->graphicalCharter;
    }
}
