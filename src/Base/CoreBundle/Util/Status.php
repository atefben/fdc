<?php

namespace Base\CoreBundle\Util;


/**
 * Status trait.
 *
 * @author  Antoine Mineau
 * @company Ohwee
 */
trait Status
{

    /**
     * getStatuses function.
     *
     * @access public
     * @static
     * @return void
     */
    public static function getStatuses()
    {
        return array(
            self::STATUS_DRAFT => 'form.status.draft',
            self::STATUS_TRANSLATION_PENDING => 'form.status.translation_pending',
            self::STATUS_TRANSLATION_VALIDATING => 'form.status.translation_validating',
            self::STATUS_PUBLISHED => 'form.status.published',
            self::STATUS_DEACTIVATED => 'form.status.deactivated'
        );
    }
}