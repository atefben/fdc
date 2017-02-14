<?php

namespace FDC\CourtMetrageBundle\Form;


use Symfony\Component\Form\FormBuilderInterface;

/**
 * CcmNewsWidgetSignatureType class.
 *
 * \@extends CcmNewsWidgetType
 * \@company Ohwee
 */
class CcmNewsWidgetSignatureType extends CcmNewsWidgetType
{
    /**
     * dataClass
     *
     * (default value: 'FDC\CourtMetrageBundle\Entity\CcmNewsWidgetSignature')
     *
     * @var string
     * @access protected
     */
    protected $dataClass = 'FDC\CourtMetrageBundle\Entity\CcmNewsWidgetSignature';

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
            'label' => false,
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
                        'class' => '' // todo: add class?
                    )
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
        return 'ccm_news_widget_signature_type';
    }
}