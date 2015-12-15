<?php

namespace FDC\EventBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Collection;

/**
 * Class ContactType
 * @package FDC\EventBundle\Form\Type
 *
 */
class ShareEmailType extends AbstractType
{

    private $translator;

    /**
     * @param $translator
     */
    public function __construct($translator)
    {
        $this->translator = $translator;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'email', array(
                'attr' => array(
                    'placeholder' => 'sharemail.form.placeholder.email'
                ),
                'label' => false
            ))
            ->add('user', 'email', array(
                'attr' => array(
                    'placeholder' => 'sharemail.form.placeholder.votreemail',
                    'class'       => 'popin'
                ),
                'label' => false
            ))
            ->add('copy', new CheckboxType() , array(
                'attr' => array(
                    'class'       => 'popin',
                    'id'          => 'mail-copy'
                ),
                'data' => false,
                'required' => false
            ))
            ->add('message', 'textarea', array(
                'attr' => array(
                    'placeholder' => 'sharemail.form.placeholder.message',
                    'class'       => 'popin'
                ),
                'label' => false
            ))
            ->add('newsletter', new CheckboxType() , array(
                'attr' => array(
                    'class'       => 'popin'
                ),
                'data' => false,
                'required' => false
            ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $collectionConstraint = new Collection(array(
            'email-dest' => array(
                new GreaterThan(array('value' => 0, 'message' => $this->translator->trans('contact.form.errors.theme'))),
                new Email(array('message' => $this->translator->trans('contact.form.errors.email')))
            ),
            'email-user' => array(
                new NotBlank(array('message' => $this->translator->trans('contact.form.errors.nom'))),
                new Email(array('message' => $this->translator->trans('contact.form.errors.email')))
            ),
            'message' => array(
                new NotBlank(array('message' => $this->translator->trans('contact.form.errors.email'))
            ))
        ));

        $resolver->setDefaults(array(
            'constraints' => $collectionConstraint,
            'translation_domain' => 'FDCEventBundle'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'contact';
    }
}