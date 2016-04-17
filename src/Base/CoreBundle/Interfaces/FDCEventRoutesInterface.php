<?php

namespace Base\CoreBundle\Interfaces;

interface FDCEventRoutesInterface
{
    //menus
    const HOMEPAGE = 1;
    const WEB_TV  = 2;
    const MOVIE_SELECTION = 3;
    const JURY = 4;
    const PALMARES  = 5;
    const EVENTS = 6;
    const PROGRAMMATION  = 7;
    const PARTICIPATE = 8;

    //sites
    const EVENT = 1;
    const PRESS  = 2;

    //types
    const MENU = 1;
    const FOOTER  = 2;
}