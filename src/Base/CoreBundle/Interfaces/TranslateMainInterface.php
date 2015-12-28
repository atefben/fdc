<?php

namespace Base\CoreBundle\Interfaces;

/**
 * Interface TranslateMainInterface
 * @package Base\CoreBundle\Entity
 */
interface TranslateMainInterface
{
    const PRIORITY_STATUS_NONE = 0;
    const PRIORITY_STATUS_LOW = 1;
    const PRIORITY_STATUS_AVERAGE = 2;
    const PRIORITY_STATUS_URGENT = 3;
    const PRIORITY_STATUS_NOW = 4;

    const TRANSLATE_OPTION_EN = 0;
    const TRANSLATE_OPTION_ZH = 1;
    const TRANSLATE_OPTION_ES = 2;

    public static function getPriorityStatuses();

    public static function getAvailableTranslateOptions();
}