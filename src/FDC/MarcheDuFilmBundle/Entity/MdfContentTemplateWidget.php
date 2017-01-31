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
 *  "video" = "MdfContentTemplateWidgetVideo"
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
     * @var MdfConferenceProgram
     *
     * @ORM\ManyToOne(targetEntity="MdfConferenceProgram", cascade={"all"}, inversedBy="contentTemplateConferenceWidgets")
     * @ORM\JoinColumn(name="conference_program_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $conferenceProgram;

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
     * @return MdfConferenceProgram
     */
    public function getConferenceProgram()
    {
        return $this->conferenceProgram;
    }

    /**
     * @param $conferenceProgram
     *
     * @return $this
     */
    public function setConferenceProgram($conferenceProgram)
    {
        $this->conferenceProgram = $conferenceProgram;

        return $this;
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

    public function isWidgetVideo()
    {
        return $this instanceof MdfContentTemplateWidgetVideo;
    }
}
