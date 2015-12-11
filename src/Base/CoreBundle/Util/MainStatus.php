<?php

namespace Base\CoreBundle\Util;

/**
 * MainStatus trait.
 *
 * @author  Antoine Mineau
 * @company Ohwee
 */
trait MainStatus
{
    /**
     * getTranslationStatuses function.
     *
     * @access public
     * @static
     * @return void
     */
    public static function getTranslationStatuses()
    {
        return array(
            self::TRANSLATION_STATUS_NOT_TRANSLATE => 'form.translation_status.not_translate',
            self::TRANSLATION_STATUS_TRANSLATE_ENGLISH => 'form.translation_status.translate_english',
            self::TRANSLATION_STATUS_TRANSLATE_ALL => 'form.translation_status.translate_all'
        );
    }

    /**
     * getPriorityStatuses function.
     *
     * @access public
     * @static
     * @return void
     */
    public static function getPriorityStatuses()
    {
        return array(
            self::PRIORITY_STATUS_LOW => 'form.priority_status.low',
            self::PRIORITY_STATUS_AVERAGE => 'form.priority_status.average',
            self::PRIORITY_STATUS_URGENT => 'form.priority_status.urgent',
            self::PRIORITY_STATUS_NOW => 'form.priority_status.now'
        );
    }
}