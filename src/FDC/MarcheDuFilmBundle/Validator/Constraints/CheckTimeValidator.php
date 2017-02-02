<?php

namespace FDC\MarcheDuFilmBundle\Validator\Constraints;

use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class CheckTimeValidator extends ConstraintValidator
{
    public function validate($foo, Constraint $constraint)
    {
        if (!$constraint instanceof CheckTime) {
            throw new UnexpectedTypeException($constraint, __NAMESPACE__.'\CheckTime');
        }

        if ($foo->getStartTimeEvent() > $foo->getEndTimeEvent()) {
            if ($this->context instanceof ExecutionContextInterface) {
                $this->context->buildViolation($constraint->message)
                    ->addViolation();
            } else {
                $this->buildViolation($constraint->message)
                    ->addViolation();
            }
        }
    }
}