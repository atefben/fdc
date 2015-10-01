<?php

namespace Base\CoreBundle\Util;

/**
 * TranslationByLocale trait.
 *
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * @company Ohwee
 */
trait TranslationByLocale
{
    /**
     * findTranslationByLocale function.
     * 
     * @access public
     * @param mixed $locale
     * @return void
     */
    public function findTranslationByLocale($locale)
    {
        foreach ($this->translations as $translation) {
            if ($translation->getLocale() == $locale) {
                return $translation;
            }
        }
        
        return null;
    }
}