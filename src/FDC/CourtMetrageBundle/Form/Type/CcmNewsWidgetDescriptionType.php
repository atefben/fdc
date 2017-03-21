<?php

namespace FDC\CourtMetrageBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * CcmNewsWidgetDescriptionType class.
 * 
 * \@extends CcmNewsWidgetType
 * \@company Ohwee
 */
class CcmNewsWidgetDescriptionType extends CcmNewsWidgetType
{
    /**
     * dataClass
     * 
     * (default value: 'FDC\CourtMetrageBundle\Entity\CcmNewsWidgetDescription')
     * 
     * @var string
     * @access protected
     */
    protected $dataClass = 'FDC\CourtMetrageBundle\Entity\CcmNewsWidgetDescription';
    
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
            'locales' => ['fr','en'],
            'fields' => array(
                'applyChanges' => array(
                    'field_type' => 'hidden',
                    'attr' => array (
                        'class' => 'hidden'
                    )
                ),
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
                    'config_name' => 'ccm_widget'
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
     */
    public function getName()
    {
        return 'ccm_news_widget_description_type';
    }
}