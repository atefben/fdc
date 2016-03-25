<?php

namespace Base\AdminBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * FDCCannesClassicsWidgetTextType class.
 *
 * \@extends FDCCannesClassicsWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class FDCCannesClassicsWidgetTextType extends FDCCannesClassicsWidgetType
{
    /**
     * dataClass
     *
     * (default value: 'Base\CoreBundle\Entity\FDCCannesClassicsWidgetText')
     *
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\CoreBundle\Entity\FDCCannesClassicsWidgetText';

    /**
     * buildForm function.
     *
     * @access public
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->add('translations', 'a2lix_translations', array(
            'translation_domain' => 'BaseAdminBundle',
            'required_locales' => array('fr'),
            'fields' => array(
                'content' => array(
                    'label' => false,
                    'attr' => array(
                        'class' => 'ckeditor'
                    ),
                    'constraints' => array(
                        new NotBlank()
                    ),
                    'required' => true,
                    'field_type' => 'ckeditor',
                    'config_name' => 'widget'
                ),
                'createdAt' => array(
                    'display' => false
                ),
                'updatedAt' => array(
                    'display' => false
                ),
            )
        ));
    }

    /**
     * getName function.
     *
     * @access public
     * @return string
     */
    public function getName()
    {
        return 'fdc_cannes_classics_widget_text_type';
    }
}