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

    private $galleryDualAlignDummyAdmin;

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

    public function setGalleryDualAlignAdmin($galleryDualAlignDummyAdmin)
    {
        $this->galleryDualAlignAdmin = $galleryDualAlignDummyAdmin;
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
            'model_manager' => $this->galleryDualAlignAdmin->getModelManager(),
            'class' => $this->galleryDualAlignAdmin->getClass(),
            'label' => false
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
        return 'statement_widget_image_dual_align_type';
    }
}