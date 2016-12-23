<?php

namespace Base\CoreBundle\Interfaces;

/**
 * Interface TranslateChildInterface
 * @package Base\CoreBundle\Entity
 */
interface MdfStateInterface
{
    const STATE_INACTIVE = 0;
    const STATE_ACTIVE = 1;
    const STATE_DEACTIVATED = 2;
    const STATE_EARLY_BIRD = 3;

    public static function getPromotionStatuses();
    public static function getMainStatuses();
}
