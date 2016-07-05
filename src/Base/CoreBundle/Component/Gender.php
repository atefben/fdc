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
    private static function _getGenderFromString($string) {
        $male_strings = array('Monsieur', 'Mr');
        $female_strings = array('Madame', 'Ms');

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
        $gender = strtoupper($genderstring);
        if ($gender == 'MONSIEUR' || $gender == 'MR') {
            return str_replace($default, $male, $function);
        } elseif ($gender == 'MADAME' || $gender == 'MS') {
            return str_replace($default, $female, $function);
        } else {
            return $function;
        }
    }
    
}