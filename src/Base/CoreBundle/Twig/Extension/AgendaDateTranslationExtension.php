<?php

namespace Base\CoreBundle\Twig\Extension;

use Symfony\Component\HttpFoundation\RequestStack;
use Twig_Extension;

/**
 * Class AgendaDateTranslationExtension
 * @package Base\CoreBundle\Twig\Extension
 */
class AgendaDateTranslationExtension extends Twig_Extension
{

    /**
     * @var string
     */
    private $localeFallback;

    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * FilmMediaExtension constructor.
     * @param string $localeFallback
     * @param RequestStack $requestStack
     */
    public function __construct($localeFallback, $requestStack)
    {
        $this->localeFallback = $localeFallback;
        $this->requestStack = $requestStack;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('agenda_leftbar_translate_hour', array($this, 'leftBarTranslateHour')),
        );
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('agenda_leftbar_translate_hour', array($this, 'leftBarTranslateHour')),
        );
    }

    /**
     * @param $hour
     * @return mixed
     */
    public function leftBarTranslateHour($hour)
    {
        $locale = $this->requestStack->getCurrentRequest()->getLocale();

        if (in_array($locale, array('fr', 'es'))) {
            $output =  str_pad($hour, 2, '0', STR_PAD_LEFT) . 'H';
        } elseif ($locale == 'zh') {
            $output =  str_pad($hour, 2, '0', STR_PAD_LEFT) . '点';
        } elseif ($locale == 'en') {
            if ($hour < 12) {
                $output =  $hour . 'AM';
            } else {
                $output =  (string)((int)$hour - 12) . 'PM';
            }
        }
        return $output;
    }


    /**
     * @return string
     */
    public function getName()
    {
        return 'agenda_date_translation_extension';
    }
}