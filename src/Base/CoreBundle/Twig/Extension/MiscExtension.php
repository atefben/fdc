<?php

namespace Base\CoreBundle\Twig\Extension;

use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Behat\Transliterator\Transliterator;
use Symfony\Component\HttpFoundation\RequestStack;
use Twig_Extension;

/**
 * Class MiscExtension
 * @package Base\CoreBundle\Twig\Extension
 */
class MiscExtension extends Twig_Extension
{

    /**
     * @var string
     */
    protected $defaultLocale;

    /**
     * @var RequestStack
     */
    protected $requestStack;

    /**
     * @param string $defaultLocale
     */
    public function setDefaultLocale($defaultLocale)
    {
        $this->defaultLocale = $defaultLocale;
    }

    /**
     * @param RequestStack $requestStack
     */
    public function setRequestStack(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }


    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('urlize', [$this, 'urlize']),
            new \Twig_SimpleFilter('is_published', [$this, 'isPublished']),
        ];
    }

    public function urlize($text)
    {
        return Transliterator::urlize($text);
    }

    public function isPublished($object, $site = null)
    {
        if (!method_exists($object, 'findTranslationByLocale')) {
            return null;
        }
        if ($site) {
            $inSite = false;
            foreach ($object->getSites() as $site) {
                if ($site->getSlug() == $site) {
                    $inSite = true;
                }
            }
            if (!$inSite) {
                return false;
            }
        }
        $currentLocale = $this->requestStack->getCurrentRequest()->getLocale();
        $trans = $object->findTranslationByLocale($currentLocale);
        if (!$trans) {
            return false;
        }
        if ($this->defaultLocale == $currentLocale) {
            if ($trans->getStatus() == TranslateChildInterface::STATUS_PUBLISHED) {
                return true;
            }
            return false;
        } else {
            $main = $object->findTranslationByLocale($this->defaultLocale);
            if ($main->getStatus() == TranslateChildInterface::STATUS_PUBLISHED && $trans->getStatus() == TranslateChildInterface::STATUS_TRANSLATED) {

            }
            return false;
        }
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'misc_extension';
    }
}