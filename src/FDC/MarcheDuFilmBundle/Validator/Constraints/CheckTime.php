<?php

namespace FDC\MarcheDuFilmBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class CheckTime extends Constraint
{
    public $message = 'End time must be greater than start time';

    public function validatedBy()
    {
        return 'FDC\MarcheDuFilmBundle\Validator\Constraints\CheckTimeValidator';
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}