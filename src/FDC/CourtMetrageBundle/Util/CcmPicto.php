<?php

namespace FDC\CourtMetrageBundle\Util;

trait CcmPicto
{
    public static function getPictos()
    {
        return array(
            self::PICTO_POINT_INFOS => 'form.ccm.label.picto.point_infos',
            self::PICTO_CONSIGNES => 'form.ccm.label.picto.consignes',
            self::PICTO_OBJETS_TROUVES => 'form.ccm.label.picto.objets_trouves',
            self::PICTO_URGENCES => 'form.ccm.label.picto.urgences',
        );
    }
    
    public static function getFourColumnsPictos()
    {
        return array(
            self::PICTO_APPAREIL_PHOTO => 'form.ccm.label.picto.enregistreur',
            self::PICTO_SELFIE => 'form.ccm.label.picto.selfie',
            self::PICTO_TELEPHONE => 'form.ccm.label.picto.telephone',
            self::PICTO_PAPILLON => 'form.ccm.label.picto.dress_code',
        );
    }

    public static function getTransportPictos()
    {
        return array(
            self::PICTO_TRAIN => 'form.ccm.label.picto.train',
            self::PICTO_VOITURE => 'form.ccm.label.picto.voiture',
            self::PICTO_AVION => 'form.ccm.label.picto.avion',
            self::PICTO_BUS => 'form.ccm.label.picto.bus',
            self::PICTO_TAXI => 'form.ccm.label.picto.taxi',
        );
    }
}