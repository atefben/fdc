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
    public function leftBarTranslateHour($hour,$space = false, $disabledLangs = false)
    {
        $locale = $this->requestStack->getCurrentRequest()->getLocale();

        // avoid to use the hour translation on specific locales
        if ($disabledLangs === true && in_array($locale, array('fr', 'es', 'zh'))) {
            return $hour;
        }

        if (in_array($locale, array('fr', 'es'))) {
            $output =  str_pad($hour, 2, '0', STR_PAD_LEFT) . 'H';
        } elseif ($locale == 'zh') {
            $output = str_pad($hour, 2, '0', STR_PAD_LEFT) . '点';
        } elseif ($locale == 'en') {
            if ($hour > 12) {
                $display = explode(':', $hour);
                if (is_array($display) && count($display) == 2) {
                    $display = (isset($display[1])) ? ($display[0] - 12 . ':' . $display[1]) : $display[0];
                } else {
                    $display = ($hour > 12) ? $hour - 12 : $hour;
                }
            } elseif (!$hour) {
                $display = '12';
            }
            else {
                $display = $hour;
            }

            $output = $display . ($space ? ' ' : '') . ((int)$hour < 12 ? 'AM' : 'PM');
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