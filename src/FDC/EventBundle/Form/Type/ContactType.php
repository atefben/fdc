<?php

namespace FDC\EventBundle\Form\Type;

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
 * @package FDC\EventBundle\Form\Type
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
        $default = $this->translator->trans('footer.contact.placeholder.theme');

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
                'label' => 'footer.contact.label.theme',
                'required' => false
            ))
            ->add('name', 'text', array(
                'attr' => array(
                    'placeholder' => 'footer.contact.placeholder.name'
                ),
                'label' => false
            ))
            ->add('email', 'email', array(
                'attr' => array(
                    'placeholder' => 'footer.contact.placeholder.email'
                ),
                'label' => false
            ))
            ->add('subject', 'text', array(
                'attr' => array(
                    'placeholder' => 'footer.contact.placeholder.subject'
                )
            ))
            ->add('message', 'textarea', array(
                'attr' => array(
                    'cols' => 90,
                    'rows' => 10,
                    'placeholder' => 'footer.contact.placeholder.message'
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
                new GreaterThan(array('value' => 0, 'message' => 'footer.contact.invalid_theme')),
            ),
            'name' => array(
                new NotBlank(array('message' => 'footer.contact.invalid_name')),
            ),
            'email' => array(
                new NotBlank(array('message' => 'footer.contact.invalid_email')),
                new Email(array('message' => 'footer.contact.invalid_email'))
            ),
            'subject' => array(
                new NotBlank(array('message' => 'footer.contact.invalid_subject')),
            ),
            'message' => array(
                new NotBlank(array('message' => 'footer.contact.invalid_message')),
            )
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