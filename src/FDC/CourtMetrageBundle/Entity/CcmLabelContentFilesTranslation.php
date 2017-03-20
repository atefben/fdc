<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\TranslateChild;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmLabelContentFilesTranslation
 * @ORM\Table(name="ccm_label_content_files_translation")
 * @ORM\Entity()
 */
class CcmLabelContentFilesTranslation implements TranslateChildInterface
{
    use Translation;
    use TranslateChild;
    use TranslationChanges;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $boName;

    /**
     * @return string
     */
    public function getBoName()
    {
        return $this->boName;
    }

    /**
     * @param $boName
     *
     * @return $this
     */
    public function setBoName($boName)
    {
        $this->boName = $boName;

        return $this;
    }
}
