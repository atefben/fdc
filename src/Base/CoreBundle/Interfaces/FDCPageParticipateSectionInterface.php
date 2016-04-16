<?php

namespace Base\CoreBundle\Interfaces;

interface FDCPageParticipateSectionInterface
{
    const BONNE_PRATIQUES = 1;
    const TYPES_ACCES  = 2;
    const FDC_MODE_EMPLOI = 3;
    const ACCES_PROJECTION = 4;
    const GUIDE_PRESS = 5;

    public static function getPages();
}