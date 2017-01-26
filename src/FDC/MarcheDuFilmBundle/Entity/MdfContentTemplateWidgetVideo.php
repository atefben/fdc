<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MdfContentTemplateWidgetVideo
 * @ORM\Table(name="mdf_content_template_widget_video")
 * @ORM\Entity(repositoryClass="FDC\MarcheDuFilmBundle\Repository\MdfContentTemplateWidgetVideoRepository")
 */
class MdfContentTemplateWidgetVideo extends MdfContentTemplateWidget
{
    /**
     * @var MediaMdfVideo
     * @ORM\ManyToOne(targetEntity="FDC\MarcheDuFilmBundle\Entity\MediaMdfVideo")
     */
    protected $video;

    /**
     * @return MediaMdfVideo
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @param $video
     *
     * @return $this
     */
    public function setVideo($video)
    {
        $this->video = $video;

        return $this;
    }
}
