<?php

namespace Base\CoreBundle\Entity;

/**
 * Interface MainStatusInterface
 * @package Base\CoreBundle\Entity
 */
interface MainStatusInterface
{
    const TRANSLATION_STATUS_NOT_TRANSLATE = 0;
    const TRANSLATION_STATUS_TRANSLATE_ENGLISH = 1;
    const TRANSLATION_STATUS_TRANSLATE_ALL = 2;

    const PRIORITY_STATUS_LOW = 0;
    const PRIORITY_STATUS_AVERAGE = 1;
    const PRIORITY_STATUS_URGENT = 2;
    const PRIORITY_STATUS_NOW = 3;

    /**
     * getTranslationStatuses function.
     *
     * @access public
     * @static
     * @return void
     */
    static public function getTranslationStatuses();

    /**
     * getTranslationStatuses function.
     *
     * @access public
     * @static
     * @return void
     */
    static public function getPriorityStatuses();
}