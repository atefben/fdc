<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use FDC\MarcheDuFilmBundle\Entity\MediaMdf;
use Doctrine\ORM\Mapping as ORM;

/**
 * MdfContentTemplateWidgetImage
 * @ORM\Table(name="mdf_content_template_widget_image")
 * @ORM\Entity
 */
class MdfContentTemplateWidgetImage extends MdfContentTemplateWidget
{
    /**
     * @var MediaMdf
     * @ORM\ManyToOne(targetEntity="FDC\MarcheDuFilmBundle\Entity\MediaMdfImage")
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
