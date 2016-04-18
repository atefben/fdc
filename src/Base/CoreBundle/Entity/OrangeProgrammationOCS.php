<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

/**
 * OrangeProgrammationOCS
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class OrangeProgrammationOCS extends Orange
{
    use Translatable;
    
    public function __toString() {
        $string = substr(strrchr(get_class($this), '\\'), 1);

        if ($this->getId() && $this->findTranslationByLocale('fr')) {
            $string = $this->findTranslationByLocale('fr')->getTitle();
            $string = $this->truncate($string, 40, '..."', true);
        }

        return $string;
    }
}
