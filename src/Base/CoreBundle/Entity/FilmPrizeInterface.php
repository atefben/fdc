<?php

namespace Base\CoreBundle\Entity;

/**
 * FilmPrizeInterface interface.
 *
 * @author      Antoine Mineau <a.mineau@ohwee.fr>
 * \@description The available FilmPrize type (from the webservice doc)
 * \@company     Ohwee
 */
interface FilmPrizeInterface
{
    const TYPE_FILM       = 0;
    const TYPE_PERSON     = 1;
}