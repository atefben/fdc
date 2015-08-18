<?php

namespace FDC\CoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * LocaleValidator class.
 * 
 * @extends ConstraintValidator
 * @author Antoine Mineau <a.mineau@ohwee.fr>
 */
class LocaleValidator extends ConstraintValidator
{
    
    /**
     * locales
     * 
     * @var mixed
     * @access private
     */
    private $locales;

    /**
     * setLocales function.
     * 
     * @access public
     * @param mixed $locales
     * @return void
     */
    public function setLocales($locales)
    {
        $this->locales = $locales;
    }

    /**
     * validate function.
     * 
     * @access public
     * @param mixed $value
     * @param Constraint $constraint
     * @return void
     */
    public function validate($object, Constraint $constraint)
    {
        if (!in_array($object->getLocale(), $this->locales)) {
            $this->context->addViolation($constraint->message, array('%locale%' => $object->getLocale()));
        }
    }
}