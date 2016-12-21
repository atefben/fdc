<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * MdfContentTemplateWidgetText
 * @ORM\Table(name="mdf_content_template_widget_text")
 * @ORM\Entity
 */
class MdfContentTemplateWidgetText extends MdfContentTemplateWidget
{
    use Translatable;

    /**
     * ArrayCollection
     */
    protected $translations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }
}
