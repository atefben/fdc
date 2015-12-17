<?php

namespace Base\CoreBundle\Interfaces;

/**
 * Interface TranslateChildInterface
 * @package Base\CoreBundle\Entity
 */
interface TranslateChildInterface
{
    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED  = 1;
    const STATUS_TRANSLATION_PENDING = 2;
    const STATUS_TRANSLATION_VALIDATING = 3;
    const STATUS_TRANSLATED = 4;
    const STATUS_DEACTIVATED = 5;

    public static function getStatuses();
}