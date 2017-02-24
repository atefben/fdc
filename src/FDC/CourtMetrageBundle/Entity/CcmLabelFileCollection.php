<?php

namespace FDC\CourtMetrageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CcmLabelFileCollection
 *
 * @ORM\Table(name="ccm_label_file_collection")
 * @ORM\Entity
 */
class CcmLabelFileCollection
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
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmLabelFile", inversedBy="labelFileCollection")
     * @ORM\JoinColumn(name="label_file_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $labelFile;

    /**
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmLabelContentFilesWidget", inversedBy="labelFileCollection")
     * @ORM\JoinColumn(name="label_content_files_widget_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $contentFilesWidget;

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
     * @return mixed
     */
    public function getLabelFile()
    {
        return $this->labelFile;
    }

    /**
     * @param $labelFile
     *
     * @return $this
     */
    public function setLabelFile($labelFile)
    {
        $this->labelFile = $labelFile;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getContentFilesWidget()
    {
        return $this->contentFilesWidget;
    }

    /**
     * @param $contentFilesWidget
     *
     * @return $this
     */
    public function setContentFilesWidget($contentFilesWidget)
    {
        $this->contentFilesWidget = $contentFilesWidget;

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
