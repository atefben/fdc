<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\TranslateChild;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;

/**
 * GraphicalCharterButtonSectionTranslation
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Entity\GraphicalCharterButtonSectionTranslationRepository")
 */
class GraphicalCharterButtonSectionTranslation implements TranslateChildInterface
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
