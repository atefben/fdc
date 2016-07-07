<?php

namespace Base\CoreBundle\Component;

abstract class Gender
{
    /**
     * Get gender from string
     *
     * @param string $string
     * @return string
     */
    public static function getGenderFromString($string) {
        $string = strtoupper($string);
        $male_strings = array('MONSIEUR', 'MR');
        $female_strings = array('MADAME', 'MS');

        if(in_array($string, $male_strings)) {
            return 'M';
        } elseif(in_array($string, $female_strings)) {
            return 'F';
        } else {
            return false;
        }
    }

    public static function functionGenderFormatter($function, $genderstring) {
        $default = array(
            '(e)',
            '(ne)',
            '(teur/trice)',
            '(eur/euse)',
            '(er/ière)',
            '(a)',
            '(or/riz)',
            '(o/a)',
            '(os/as)'
        );
        $male = array(
            '',
            '',
            'teur',
            'eur',
            'er',
            '',
            'or',
            'o',
            'os'
        );
        $female = array(
            '',
            'ne',
            'trice',
            'euse',
            'ière',
            'a',
            'riz',
            'a',
            'as'
        );
        if(self::getGenderFromString($genderstring) == 'M') {
            return str_replace($default, $male, $function);
        } elseif(self::getGenderFromString($genderstring) == 'F') {
            return str_replace($default, $female, $function);
        } else {
            return $function;
        }

    }
    
}