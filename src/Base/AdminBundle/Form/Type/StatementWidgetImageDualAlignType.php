<?php

namespace Base\AdminBundle\Form\Type;

use Sonata\AdminBundle\Form\DataTransformer\ModelToIdTransformer;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * StatementWidgetImageDualAlignType class.
 *
 * \@extends StatementWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class StatementWidgetImageDualAlignType extends StatementWidgetType
{

    /**
     * dataClass
     *
     * (default value: 'Base\\CoreBundle\\Entity\\StatementWidgetImageDualAlign')
     *
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\\CoreBundle\\Entity\\StatementWidgetImageDualAlign';

    /**
     * statementWidgetImageDummyAdmin
     *
     * @var mixed
     * @access private
     */
    private $statementWidgetImageDummyAdmin;

    /**
     * setStatementWidgetImageDummyAdmin function.
     *
     * @access public
     * @param mixed $statementWidgetImageDummyAdmin
     * @return void
     */
    public function setStatementWidgetImageDummyAdmin($statementWidgetImageDummyAdmin)
    {
        $this->statementWidgetImageDummyAdmin = $statementWidgetImageDummyAdmin;
    }

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
        $builder->add('gallery', 'sonata_type_model_list', array(
            'sonata_field_description' =>  $this->statementWidgetImageDummyAdmin->getFormFieldDescriptions()['gallery'],
            'model_manager' => $this->statementWidgetImageDummyAdmin->getModelManager(),
            'class' => $this->statementWidgetImageDummyAdmin->getClass(),
        ));
        // $builder->add('medias', 'sonata_type_collection', array(
        // 'sonata_field_description' =>  $this->statementWidgetImageDummyAdmin->getFormFieldDescriptions()['medias'],
        //    'model_manager' => $this->statementWidgetImageDummyAdmin->getModelManager(),
        //  'class' => $this->statementWidgetImageDummyAdmin->getClass(),
        // ));
        /* $builder->add('medias', 'sonata_type_collection', array(
             'by_reference' => false,
             'sonata_field_description' =>  $this->statementWidgetImageDummyAdmin->getFormFieldDescriptions()['medias'],
         ), array(
             'edit' => 'inline',
             'inline' => 'table',
             'sortable' => 'position',
         ));*/
    }

    /**
     * getName function.
     *
     * @access public
     * @return void
     */
    public function getName()
    {
        return 'statement_widget_image_dual_align_type';
    }
}