<?php

namespace Base\CoreBundle\Entity;

/**
 * StatementTranslationInterface interface.
 */
interface StatementTranslationInterface
{
    // related to status
    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED  = 1;
    const STATUS_TRANSLATION_PENDING = 2;
    const STATUS_TRANSLATION_VALIDATING = 3;
    const STATUS_DEACTIVATED = 4;

    /**
     * getStatuses function.
     *
     * @access public
     * @static
     * @return void
     */
    static public function getStatuses();
}