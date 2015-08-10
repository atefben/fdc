<?php

namespace FDC\CoreBundle\Util;

trait Translation
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