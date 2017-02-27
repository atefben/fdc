<?php

namespace FDC\CourtMetrageBundle\Interfaces;

interface CcmPictoInterface
{
    const PICTO_POINT_INFOS = 'icon_point-infos';
    const PICTO_CONSIGNES = 'icon_consignes';
    const PICTO_OBJETS_TROUVES = 'icon_objets-trouves';
    const PICTO_URGENCES = 'icon_n-urgence';

    const PICTO_APPAREIL_PHOTO = 'icon_enregistreur';
    const PICTO_SELFIE = 'icon_selfie';
    const PICTO_TELEPHONE = 'icon_telephone';
    const PICTO_PAPILLON = 'icon_dress-code';

    const PICTO_TRAIN = 'icon_train';
    const PICTO_VOITURE = 'icon_voiture';
    const PICTO_AVION = 'icon_avion';
    const PICTO_BUS = 'icon_bus';
    const PICTO_TAXI = 'icon_taxi';

    public static function getPictos();

    public static function getFourColumnsPictos();

    public static function getTransportPictos();
}