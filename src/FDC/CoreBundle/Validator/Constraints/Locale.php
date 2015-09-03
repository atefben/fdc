<?php

namespace FDC\CoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * ContainsAlphanumeric class.
 *
 * @Annotation
 *
 * @extends Constraint
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * @company Ohwee
 */
class Locale extends Constraint
{
    public $message = 'The locale "%locale%" is not enabled.';

    /**
     * validatedBy function.
     * 
     * @access public
     * @return void
     */
    public function validatedBy()
    {
        return 'fdc_validator_locale';
    }

    /**
     * getTargets function.
     * 
     * @access public
     * @return void
     */
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}