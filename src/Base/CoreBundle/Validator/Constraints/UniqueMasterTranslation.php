<?php
namespace Base\CoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/** @Annotation */
class UniqueMasterTranslation extends Constraint
{
    public function validatedBy()
    {
        return 'unique_master_translation';
    }
    public function getTargets()
    {
        return self::PROPERTY_CONSTRAINT;
    }
}