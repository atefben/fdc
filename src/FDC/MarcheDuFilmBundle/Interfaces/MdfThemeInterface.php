<?php

namespace FDC\MarcheDuFilmBundle\Interfaces;

interface MdfThemeInterface
{
    const THEME_PRODUCERS_WORKSHOP = 'producers-workshop';
    const THEME_PRODUCERS_NETWORK = 'producers-network';
    const THEME_DOC_CORNER = 'doc-corner';
    const THEME_NEXT = 'next';
    const THEME_MIXERS = 'mixers';
    const THEME_GOES_TO_CANNES = 'goes-to-cannes';

    public static function getThemes();
}
