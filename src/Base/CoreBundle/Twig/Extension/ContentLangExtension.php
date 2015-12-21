<?php

namespace Base\CoreBundle\Twig\Extension;

use \Twig_Extension;

/**
 * FallbackTranslationExtension class.
 *
 * @extends Twig_Extension
 * @author  Antoine Mineau
 * @company Ohwee
 */
class ContentLangExtension extends Twig_Extension
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
            new \Twig_SimpleFilter('content_lang', array($this, 'contentLangFilter')),
        );
    }

    public function contentLangFilter($object, $property)
    {
        $locale = $this->requestStack->getCurrentRequest()->getLocale();
        $trans = $object->findTranslationByLocale($locale);
        $property = ucfirst($property);

        if ($trans && $trans->{'get'.$property}()) {
            return '';
        }

        return "lang=\"{$this->localeFallback}\"";
    }

    /**
     * getName function.
     *
     * @access public
     * @return void
     */
    public function getName()
    {
        return 'content_lang_extension';
    }
}