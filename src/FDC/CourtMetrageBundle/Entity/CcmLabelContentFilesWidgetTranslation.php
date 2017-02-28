<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\TranslationChanges;
use Base\CoreBundle\Util\TranslateChild;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmLabelContentFilesWidgetTranslation
 * @ORM\Table(name="ccm_label_content_files_widget_translation")
 * @ORM\Entity(repositoryClass="FDC\CourtMetrageBundle\Repository\CcmLabelContentFilesWidgetTranslationRepository")
 */
class CcmLabelContentFilesWidgetTranslation implements TranslateChildInterface
{
    use Translation;
    use TranslateChild;
    use TranslationChanges;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $buttonsSectionTitle;

    /**
     * @return string
     */
    public function getButtonsSectionTitle()
    {
        return $this->buttonsSectionTitle;
    }

    /**
     * @param string $buttonsSectionTitle
     */
    public function setButtonsSectionTitle($buttonsSectionTitle)
    {
        $this->buttonsSectionTitle = $buttonsSectionTitle;
    }
}
