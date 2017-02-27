<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\TranslateChild;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;

/**
 * CcmLabelSectionTranslation
 * @ORM\Table(name="ccm_label_section_translation")
 * @ORM\Entity(repositoryClass="FDC\CourtMetrageBundle\Repository\CcmLabelSectionTranslationRepository")
 */
class CcmLabelSectionTranslation implements TranslateChildInterface
{
    use Translation;
    use TranslateChild;
    use TranslationChanges;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $name;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}
