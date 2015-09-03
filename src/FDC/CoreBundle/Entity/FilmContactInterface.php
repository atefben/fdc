<?php
    
namespace FDC\CoreBundle\Entity;

/**
 * FilmContactInterface interface.
 *
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * @company Ohwee
 */
interface FilmContactInterface
{
    // related to type, values are from the soif doucmentation FilmContacts -> TypeContactId 
    const TYPE_PERSON = 0;
    const TYPE_PRODUCTION_COMPANY = 1;
    const TYPE_INTERNATIONAL_SELLING = 2;
    const TYPE_FRENCH_DISTRIBUTION = 3;
    const TYPE_SCHOOL = 4;
    const TYPE_MINOR_PRODUCTION_COMPANY = 5;
    const TYPE_FRENCH_PRESS_COMPANY = 6;
    const TYPE_INTERNATIONAL_PRESS_COMPANY = 7;
}