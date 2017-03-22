<?php

namespace FDC\CourtMetrageBundle\Form\Type;


use Symfony\Component\Form\FormBuilderInterface;

/**
 * CcmShortFilmCornerWidgetQuoteType class.
 *
 * \@extends CcmShortFilmCornerWidgetType
 * \@company Ohwee
 */
class CcmShortFilmCornerWidgetQuoteType extends CcmShortFilmCornerWidgetType
{
    /**
     * dataClass
     *
     * (default value: 'FDC\CourtMetrageBundle\Entity\CcmShortFilmCornerWidgetQuote')
     *
     * @var string
     * @access protected
     */
    protected $dataClass = 'FDC\CourtMetrageBundle\Entity\CcmShortFilmCornerWidgetQuote';

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
                        'class' => 'quote'
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
        return 'ccm_sfc_widget_quote_type';
    }
}