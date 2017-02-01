<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use FDC\MarcheDuFilmBundle\Entity\MediaMdf;
use Doctrine\ORM\Mapping as ORM;

/**
 * MdfContentTemplateWidgetImage
 * @ORM\Table(name="mdf_content_template_widget_image")
 * @ORM\Entity(repositoryClass="FDC\MarcheDuFilmBundle\Repository\MdfContentTemplateWidgetImageRepository")
 */
class MdfContentTemplateWidgetImage extends MdfContentTemplateWidget
{
    /**
     * @var MediaMdf
     * @ORM\ManyToOne(targetEntity="FDC\MarcheDuFilmBundle\Entity\MediaMdfImage", inversedBy="contentTemplateWidgetImage")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $image;

    /**
     * @return MediaMdf
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param $image
     *
     * @return $this
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }
}
