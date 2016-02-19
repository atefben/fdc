<?php

namespace Base\AdminBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * InfoWidgetTextType class.
 * 
 * \@extends InfoWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class InfoWidgetTextType extends InfoWidgetType
{
    /**
     * dataClass
     * 
     * (default value: 'Base\CoreBundle\Entity\InfoWidgetText')
     * 
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\CoreBundle\Entity\InfoWidgetText';
    
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
                    'field_type' => 'ckeditor',
                    'config_name' => 'widget',
                    'required' => false
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
     * @return void
     */
    public function getName()
    {
        return 'info_widget_text_type';
    }
}