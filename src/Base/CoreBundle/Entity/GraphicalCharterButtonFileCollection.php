<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GraphicalCharterButtonFileCollection
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Entity\GraphicalCharterButtonFileCollectionRepository")
 */
class GraphicalCharterButtonFileCollection
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\GraphicalCharterButtonFile", inversedBy="graphicalCharterButtonFileCollection")
     * @ORM\JoinColumn(name="label_file_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $graphicalCharterButtonFile;

    /**
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\GraphicalCharterButtonSection", inversedBy="graphicalCharterButtonFileCollection")
     * @ORM\JoinColumn(name="label_content_files_widget_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $graphicalCharterButtonSection;

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
     * @return GraphicalCharterButtonFileCollection
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
     * Set graphicalCharterButtonFile
     *
     * @param \Base\CoreBundle\Entity\GraphicalCharterButtonFile $graphicalCharterButtonFile
     * @return GraphicalCharterButtonFileCollection
     */
    public function setGraphicalCharterButtonFile(\Base\CoreBundle\Entity\GraphicalCharterButtonFile $graphicalCharterButtonFile = null)
    {
        $this->graphicalCharterButtonFile = $graphicalCharterButtonFile;

        return $this;
    }

    /**
     * Get graphicalCharterButtonFile
     *
     * @return \Base\CoreBundle\Entity\GraphicalCharterButtonFile 
     */
    public function getGraphicalCharterButtonFile()
    {
        return $this->graphicalCharterButtonFile;
    }

    /**
     * Set graphicalCharterButtonSection
     *
     * @param \Base\CoreBundle\Entity\GraphicalCharterButtonSection $graphicalCharterButtonSection
     * @return GraphicalCharterButtonFileCollection
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
}
