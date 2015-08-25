<?php

namespace FDC\CoreBundle\Util;

use \DateTime;

trait MediaTranslation
{
    public static function getStatuses()
    {
        return array(
            self::STATUS_DRAFT => 'news.status.draft',
            self::STATUS_TRANSLATION_PENDING => 'news.status.translation_pending',
            self::STATUS_TRANSLATION_VALIDATING => 'news.status.translation_validating',
            self::STATUS_PUBLISHED => 'news.status.published',
            self::STATUS_DEACTIVATED => 'news.status.deactivated'
        );
    }
}