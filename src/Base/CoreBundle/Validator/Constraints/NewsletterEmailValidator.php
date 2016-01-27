<?php

namespace Base\CoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * NewsletterEmailValidator class.
 *
 * @extends ConstraintValidator
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * @company Ohwee
 */
class NewsletterEmailValidator extends ConstraintValidator
{

    /**
     * em
     *
     * @var mixed
     * @access private
     */
    private $em;

    /**
     * setEntityManager function.
     *
     * @access public
     * @param mixed $em
     * @return void
     */
    public function setEntityManager($em)
    {
        $this->em = $em;
    }

    public function getEntityManager()
    {
        return $this->em;
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
       $em = $this->getEntityManager();
       if(isset($_POST['contact']['email'])) {
           $exist = $em->getRepository('BaseCoreBundle:Newsletter')->findOneBy(array('email' => $_POST['contact']['email']));
           if($exist != null && $object == true) {
               $this->context->addViolation($constraint->message);
           }
       } else {
           $this->context->addViolation($constraint->message);
       }
    }
}