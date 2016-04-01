<?php

namespace FDC\EventMobileBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * Class ContactType
 * @package FDC\EventMobileBundle\Form\Type
 *
 */
class ContactType extends AbstractType
{
    private $themes;

    private $translator;

    /**
     * @param $themes
     * @param $translator
     */
    public function __construct($themes, $translator)
    {
        $this->themes = $themes;
        $this->translator = $translator;
    }

    /**
     * @param $themes
     * @return array
     */
    private function createSelectValues($themes)
    {
        $default = $this->translator->trans('contact.form.placeholder.theme');

        $select = array($default => 'default');
        if (count($themes) > 0) {
            foreach ($themes as $theme) {
                $select[$theme['theme']] = $theme['id'];
            }
        }

        return $select;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('select', new ChoiceType() , array(
                'choices'  => $this->createSelectValues($this->themes),
                'data' => 0,
                'choice_attr' => function($val, $key, $index) {
                    if ($val == 0) {
                        return ['class' => 'default'];
                    }
                    else {
                        return ['class' => ''];
                    }
                },
                'empty_value' => false,
                'choices_as_values' => true,
                'label' => 'contact.form.label.votremessage',
                'required' => false
            ))
            ->add('name', 'text', array(
                'attr' => array(
                    'placeholder' => 'contact.form.placeholder.nom'
                ),
                'label' => false
            ))
            ->add('email', 'email', array(
                'attr' => array(
                    'placeholder' => 'contact.form.placeholder.email'
                ),
                'label' => false
            ))
            ->add('subject', 'text', array(
                'attr' => array(
                    'placeholder' => 'contact.form.placeholder.objet'
                )
            ))
            ->add('message', 'textarea', array(
                'attr' => array(
                    'cols' => 90,
                    'rows' => 10,
                    'placeholder' => 'contact.form.placeholder.message'
                )
            ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $collectionConstraint = new Collection(array(
            'select' => array(
                new GreaterThan(array('value' => 0, 'message' => $this->translator->trans('contact.form.errors.theme'))),
            ),
            'name' => array(
                new NotBlank(array('message' => $this->translator->trans('contact.form.errors.nom'))),
            ),
            'email' => array(
                new NotBlank(array('message' => $this->translator->trans('contact.form.errors.email'))),
                new Email(array('message' => $this->translator->trans('contact.form.errors.email')))
            ),
            'subject' => array(
                new NotBlank(array('message' => $this->translator->trans('contact.form.errors.objet'))),
            ),
            'message' => array(
                new NotBlank(array('message' => $this->translator->trans('contact.form.errors.message'))),
            )
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