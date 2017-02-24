<?php

namespace FDC\CourtMetrageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CcmLabelContentFilesWidgetCollection
 *
 * @ORM\Table(name="ccm_label_content_files_widget_collection")
 * @ORM\Entity
 */
class CcmLabelContentFilesWidgetCollection
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
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmLabelContentFilesWidget", inversedBy="labelContentFileWidgetCollection")
     * @ORM\JoinColumn(name="label_content_file_widget_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $labelContentFileWidget;

    /**
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmLabelContentFiles", inversedBy="labelContentFileWidgetCollection")
     * @ORM\JoinColumn(name="label_content_files_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $labelContentFiles;

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
    public function getLabelContentFileWidget()
    {
        return $this->labelContentFileWidget;
    }

    /**
     * @param $labelContentFileWidget
     *
     * @return $this
     */
    public function setLabelContentFileWidget($labelContentFileWidget)
    {
        $this->labelContentFileWidget = $labelContentFileWidget;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLabelContentFiles()
    {
        return $this->labelContentFiles;
    }

    /**
     * @param $labelContentFiles
     *
     * @return $this
     */
    public function setLabelContentFiles($labelContentFiles)
    {
        $this->labelContentFiles = $labelContentFiles;

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
