<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MdfContentTemplateWidget
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *  "text" = "MdfContentTemplateWidgetText",
 *  "image" = "MdfContentTemplateWidgetImage",
 *  "gallery" = "MdfContentTemplateWidgetGallery",
 *  "file" = "MdfContentTemplateWidgetFile",
 * })
 */
abstract class MdfContentTemplateWidget
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var MdfContentTemplate
     *
     * @ORM\ManyToOne(targetEntity="MdfContentTemplate", inversedBy="contentTemplateWidgets")
     */
    protected $contentTemplate;

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
     * @return MdfContentTemplate
     */
    public function getContentTemplate()
    {
        return $this->contentTemplate;
    }

    /**
     * @param $contentTemplate
     *
     * @return $this
     */
    public function setContentTemplate($contentTemplate)
    {
        $this->contentTemplate = $contentTemplate;

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

    public function isWidgetText()
    {
        return $this instanceof MdfContentTemplateWidgetText;
    }

    public function isWidgetImage()
    {
        return $this instanceof MdfContentTemplateWidgetImage;
    }

    public function isWidgetGallery()
    {
        return $this instanceof MdfContentTemplateWidgetGallery;
    }

    public function isWidgetFile()
    {
        return $this instanceof MdfContentTemplateWidgetFile;
    }
}
