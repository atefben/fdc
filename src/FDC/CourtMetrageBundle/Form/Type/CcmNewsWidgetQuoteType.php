<?php

namespace FDC\CourtMetrageBundle\Form\Type;


use Symfony\Component\Form\FormBuilderInterface;

/**
 * CcmNewsWidgetQuoteType class.
 *
 * \@extends CcmNewsWidgetType
 * \@company Ohwee
 */
class CcmNewsWidgetQuoteType extends CcmNewsWidgetType
{
    /**
     * dataClass
     *
     * (default value: 'FDC\CourtMetrageBundle\Entity\CcmNewsWidgetQuote')
     *
     * @var string
     * @access protected
     */
    protected $dataClass = 'FDC\CourtMetrageBundle\Entity\CcmNewsWidgetQuote';

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
        return 'ccm_news_widget_quote_type';
    }
}