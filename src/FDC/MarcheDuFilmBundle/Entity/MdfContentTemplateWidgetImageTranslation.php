<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;

/**
 * MdfContentTemplateWidgetTextTranslation
 * @ORM\Table(name="mdf_content_template_widget_image_translation")
 * @ORM\Entity
 */
class MdfContentTemplateWidgetImageTranslation
{
    use Translation;
    use TranslationChanges;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $legendCopyRight;

    /**
     * @return string
     */
    public function getLegendCopyRight()
    {
        return $this->legendCopyRight;
    }

    /**
     * @param $legendCopyRight
     *
     * @return $this
     */
    public function setLegendCopyRight($legendCopyRight)
    {
        $this->legendCopyRight = $legendCopyRight;

        return $this;
    }
}
