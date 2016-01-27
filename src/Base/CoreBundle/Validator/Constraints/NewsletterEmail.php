<?php

namespace Base\CoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * NewsletterEmail class.
 *
 * @Annotation
 *
 * @extends Constraint
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * @company Ohwee
 */
class NewsletterEmail extends Constraint
{
    public $message = 'Email already used';

    /**
     * validatedBy function.
     *
     * @access public
     * @return void
     */
    public function validatedBy()
    {
        return 'base_validator_newsletter_email';
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