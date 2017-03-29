<?php

namespace FDC\CourtMetrageBundle\Util;

trait CcmAPropos
{
    public static function getAProposTypes()
    {
        return array(
            self::VIDEO => 'form.ccm.label.a_propos.video',
            self::YOUTUBE => 'form.ccm.label.a_propos.youtube',
            self::IMAGE => 'form.ccm.label.a_propos.image',
        );
    }
}