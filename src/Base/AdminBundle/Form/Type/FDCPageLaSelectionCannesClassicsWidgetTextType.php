<?php

namespace Base\AdminBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * FDCPageLaSelectionCannesClassicsWidgetTextType class.
 * 
 * \@extends FDCPageLaSelectionCannesClassicsWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class FDCPageLaSelectionCannesClassicsWidgetTextType extends FDCPageLaSelectionCannesClassicsWidgetType
{
    /**
     * dataClass
     * 
     * (default value: 'Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidgetText')
     * 
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidgetText';
    
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
     * @return void
     */
    public function getName()
    {
        return 'fdc_page_la_selection_cannes_classics_widget_text_type';
    }
}