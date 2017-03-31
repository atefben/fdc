<?php

namespace FDC\CourtMetrageBundle\Util;

trait CcmIcon
{
    public static function getIcons()
    {
        return array(
            self::RENDRE => 'form.ccm.label.icon.rendre',
            self::PLANS => 'form.ccm.label.icon.plans',
            self::HEBERGEMENT => 'form.ccm.label.icon.hebergement',
            self::INFORMATION => 'form.ccm.label.icon.information',
            self::CARTE_ID => 'form.ccm.label.icon.carte_id',
            self::ACCES_TYPES => 'form.ccm.label.icon.access',
            self::PROJECTEUR => 'form.ccm.label.icon.projecteur',
            self::CHECK => 'form.ccm.label.icon.check',
            self::HORLOGE => 'form.ccm.label.icon.horloge',
        );
    }
}