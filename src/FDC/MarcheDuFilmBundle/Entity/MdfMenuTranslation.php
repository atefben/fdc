<?php

namespace FDC\MarcheDuFilmBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\Seo;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateChild;
use Base\CoreBundle\Util\TranslationChanges;
use Doctrine\ORM\Mapping as ORM;


/**
 * MdfMenuTranslation
 * @ORM\Table(name="mdf_menu_translation")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class MdfMenuTranslation implements TranslateChildInterface
{
    use Seo;
    use TranslateChild;
    use Time;
    use Translation;
    use TranslationChanges;
}

