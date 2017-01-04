<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use FDC\MarcheDuFilmBundle\Entity\GalleryMdf;
use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateWidget;
use Doctrine\ORM\Mapping as ORM;

/**
 * MdfContentTemplateWidgetGallery
 * @ORM\Table(name="mdf_content_template_widget_gallery")
 * @ORM\Entity(repositoryClass="FDC\MarcheDuFilmBundle\Repository\MdfContentTemplateWidgetGalleryRepository")
 */
class MdfContentTemplateWidgetGallery extends MdfContentTemplateWidget
{
    /**
     * @var GalleryMdf
     * @ORM\ManyToOne(targetEntity="FDC\MarcheDuFilmBundle\Entity\GalleryMdf", cascade={"all"})
     */
    protected $gallery;

    /**
     * @return GalleryMdf
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * @param GalleryMdf $gallery
     */
    public function setGallery($gallery)
    {
        $this->gallery = $gallery;
    }
}
