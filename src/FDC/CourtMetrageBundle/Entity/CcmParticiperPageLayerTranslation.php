<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\Seo;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateChild;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;


/**
 * CcmParticiperPageLayerTranslation
 * @ORM\Table(name="ccm_participer_page_layer_translation")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmParticiperPageLayerTranslation implements TranslateChildInterface
{

    use Seo;
    use TranslateChild;
    use Time;
    use Translation;
    use TranslationChanges;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
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

