<?php

namespace FDC\CourtMetrageBundle\Interfaces;

interface CcmIconInterface
{
    const RENDRE = 'icon_se-rendre-a-cannes';
    const PLANS = 'icon_a-votre-service';
    const HEBERGEMENT = 'icon_hebergement';
    const INFORMATION = 'icon_informations';
    const HORLOGE = 'icon_horaires';
    const CARTE_ID = 'icon_acces';
    const ACCES_TYPES = 'icon_les-differents-types-dacces';
    const PROJECTEUR = 'icon_les-salles-de-projections';
    const CHECK = 'icon_les-bonnes-pratiques';
    
    public static function getIcons();
}