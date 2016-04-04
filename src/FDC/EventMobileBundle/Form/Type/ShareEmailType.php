<?php

namespace FDC\EventMobileBundle\Form\Type;

use Base\CoreBundle\Validator\Constraints\NewsletterEmail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Collection;


/**
 * Class ContactType
 * @package FDC\EventMobileBundle\Form\Type
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
            ->add('email', 'text', array(
                'attr' => array(
                    'placeholder' => 'sharemail.form.placeholder.email'
                ),
                'label' => false
            ))
            ->add('user', 'text', array(
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
                'label' => false,
                'required' => false
            ))
            ->add('newsletter', new CheckboxType() , array(
                'attr' => array(
                    'class'       => 'popin'
                ),
                'data' => false,
                'required' => false
            ))
            ->add('section', 'hidden', array('label' => false))
            ->add('url', 'hidden', array('label' => false))
            ->add('detail', 'hidden', array('label' => false))
            ->add('title', 'hidden', array('label' => false))
            ->add('description', 'hidden', array('label' => false));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $collectionConstraint = new Collection(array(
            'email' => array(
                new NotBlank(array('message' => $this->translator->trans('contact.form.errors.email'))),
                new Email(array('message' => $this->translator->trans('contact.form.errors.email')))
            ),
            'user' => array(
                new NotBlank(array('message' => $this->translator->trans('contact.form.errors.email'))),
                new Email(array('message' => $this->translator->trans('contact.form.errors.email')))
            ),
            'message' => array(),
            'copy'=> array(),
            'newsletter' => array(),
            'section' => array(),
            'detail' => array(),
            'title' => array(),
            'description' => array(),
            'url' => array()
        ));

        $resolver->setDefaults(array(
            'constraints' => $collectionConstraint,
            'translation_domain' => 'FDCEventMobileBundle'
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