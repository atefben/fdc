<?php

namespace Base\CoreBundle\Twig\Extension;

use \Twig_Extension;

/**
 * TransFallbackExtension class.
 *
 * @extends Twig_Extension
 * @author  Antoine Mineau
 * @company Ohwee
 */
class TransFallbackExtension extends Twig_Extension
{
    private $localeFallback;

    private $requestStack;

    public function __construct($localeFallback, $requestStack)
    {
        $this->localeFallback = $localeFallback;
        $this->requestStack = $requestStack;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('trans_fallback', array($this, 'transFallbackFilter')),
        );
    }

    public function transFallbackFilter($object, $property)
    {
        if ($object) {
            $locale = $this->requestStack->getCurrentRequest()->getLocale();

            if (method_exists($object, 'findTranslationByLocale')) {
                $trans = $object->findTranslationByLocale($locale);
                $property = ucfirst($property);

                if ($trans && $trans->{'get' . $property}()) {
                    return $trans->{'get' . $property}();
                }

                $transEn = $object->findTranslationByLocale($this->localeFallback);

                if ($transEn && $transEn->{'get' . $property}()) {
                    return $transEn->{'get' . $property}();
                }
            }
        }

        return '';
    }

    /**
     * getName function.
     *
     * @access public
     * @return void
     */
    public function getName()
    {
        return 'trans_fallback_extension';
    }
}