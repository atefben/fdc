<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateWidget;
use FDC\MarcheDuFilmBundle\Entity\MediaMdf;
use Doctrine\ORM\Mapping as ORM;

/**
 * MdfContentTemplateWidgetFile
 * @ORM\Table(name="mdf_content_template_widget_file")
 * @ORM\Entity(repositoryClass="FDC\MarcheDuFilmBundle\Repository\MdfContentTemplateWidgetFileRepository")
 */
class MdfContentTemplateWidgetFile extends MdfContentTemplateWidget
{
    /**
     * @var MediaMdf
     * @ORM\ManyToOne(targetEntity="FDC\MarcheDuFilmBundle\Entity\MediaMdfPdf")
     */
    protected $file;

    /**
     * @return MediaMdf
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param MediaMdf $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }
}