<?php

namespace Base\AdminBundle\Twig\Extension;

use \Twig_Extension;

use Base\CoreBundle\Interfaces\TranslateChildInterface;

/**
 * TranslateStatusToAdminClassExtension class.
 *
 * @extends Twig_Extension
 * @author  Antoine Mineau
 * @company Ohwee
 */
class TranslateStatusToAdminClassExtension extends Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('translate_status_to_admin_class', array($this, 'translateStatusToAdminClassFilter')),
        );
    }

    private static function getStatusesToAdminClass()
    {
        return array(
            TranslateChildInterface::STATUS_DRAFT => 'fdc-status-locked-bg-color',
            TranslateChildInterface::STATUS_TRANSLATION_PENDING => 'fdc-status-translation-pending-bg-color',
            TranslateChildInterface::STATUS_TRANSLATION_VALIDATING => 'fdc-status-translation-validating-bg-color',
            TranslateChildInterface::STATUS_VALIDATING => 'fdc-status-validating-bg-color',
            TranslateChildInterface::STATUS_TRANSLATED => 'fdc-status-translated-bg-color',
            TranslateChildInterface::STATUS_PUBLISHED => 'fdc-status-published-bg-color',
            TranslateChildInterface::STATUS_DEACTIVATED => 'fdc-status-deactivated-bg-color'
        );
    }

    public function translateStatusToAdminClassFilter($status)
    {
        $statusesToAdminClass = $this->getStatusesToAdminClass();

        if (isset($statusesToAdminClass[$status])) {
            return $statusesToAdminClass[$status];
        }

        return '';
    }

    /**
     * getName function.
     *
     * @access public
     * @return void
     */
    public function getName()
    {
        return 'translate_status_to_admin_class_extension';
    }
}