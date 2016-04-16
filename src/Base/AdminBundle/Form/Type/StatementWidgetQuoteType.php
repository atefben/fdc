<?php

namespace Base\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType as BaseType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * StatementWidgetQuoteType class.
 *
 * \@extends StatementWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class StatementWidgetQuoteType extends StatementWidgetType
{
    /**
     * dataClass
     *
     * (default value: 'Base\CoreBundle\Entity\StatementWidgetQuote')
     *
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\CoreBundle\Entity\StatementWidgetQuote';

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
            'required_locales' => array(),
            'fields' => array(
                'content' => array(
                    'label' => false,
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
        return 'statement_widget_quote_type';
    }
}