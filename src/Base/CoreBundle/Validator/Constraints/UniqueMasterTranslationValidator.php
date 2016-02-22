<?php

namespace Base\CoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManager;

/**
 * LocaleValidator class.
 *
 * @extends ConstraintValidator
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * @company Ohwee
 */
class UniqueMasterTranslationValidator extends ConstraintValidator
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function validate($name, Constraint $constraint)
    {
        $conflicts = $this->em
            ->getRepository('BaseCoreBundle:WebTvTranslation')
            ->findBy(array(
                'name' => $name,
                'locale' => 'fr'
            ));

        if(count($conflicts) > 0) {
            $this->context->addViolationAt('name', 'Une chaîne du même nom existe déjà');
        }
    }
}