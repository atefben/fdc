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
     * @var MdfEditionPresentation
     *
     * @ORM\ManyToOne(targetEntity="MdfEditionPresentation", inversedBy="contentTemplateWidgets")
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
     * @return MdfEditionPresentation
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
}
