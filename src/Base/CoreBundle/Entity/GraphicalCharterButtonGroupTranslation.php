<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\TranslateChild;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;

/**
 * GraphicalCharterButtonGrouptranslation
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\GraphicalCharterButtonGroupTranslationRepository")
 */
class GraphicalCharterButtonGroupTranslation implements TranslateChildInterface
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
