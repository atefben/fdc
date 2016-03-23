<?php

namespace Base\AdminBundle\Form\Type;

use Sonata\AdminBundle\Form\DataTransformer\ModelToIdTransformer;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * FDCPageParticipateWidgetColumnType class.
 *
 * \@extends FDCPageParticipateWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class FDCPageParticipateWidgetColumnType extends FDCPageParticipateWidgetType
{

    /**
     * dataClass
     *
     * (default value: 'Base\\CoreBundle\\Entity\\FDCPageParticipateWidgetColumn')
     *
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\\CoreBundle\\Entity\\FDCPageParticipateWidgetColumn';

    /**
     * FDCPageParticipateWidgetColumnDummyAdmin
     *
     * @var mixed
     * @access private
     */
    private $FDCPageParticipateWidgetColumnDummyAdmin;

    /**
     * setPressDownloadSectionWidgetDocumentDummyAdmin function.
     *
     * @access public
     * @param mixed $PressDownloadSectionWidgetDocumentDummyAdmin
     * @return void
     */
    public function setFDCPageParticipateWidgetColumnDummyAdmin($FDCPageParticipateWidgetColumnDummyAdmin)
    {
        $this->FDCPageParticipateWidgetColumnDummyAdmin = $FDCPageParticipateWidgetColumnDummyAdmin;
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
        $builder
            ->add('translations', 'a2lix_translations', array(
                'label' => false,
                'translation_domain' => 'BaseAdminBundle',
                'required_locales' => array(),
                'fields' => array(
                    'createdAt' => array(
                        'display' => false
                    ),
                    'updatedAt' => array(
                        'display' => false
                    ),
                    'title' => array(
                        'label' => 'form.label_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => true
                            )
                        )
                    ),
                    'btnLabel' => array(
                        'label' => 'form.url_btn',
                        'translation_domain' => 'BaseAdminBundle',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => false
                            )
                        )
                    )
                )
            ))
            ->add('image', 'sonata_type_model_list', array(
                'sonata_field_description' =>  $this->FDCPageParticipateWidgetColumnDummyAdmin->getFormFieldDescriptions()['image'],
                'model_manager' => $this->FDCPageParticipateWidgetColumnDummyAdmin->getModelManager(),
                'class' => $this->FDCPageParticipateWidgetColumnDummyAdmin->getFormFieldDescriptions()['image']->getAssociationAdmin()->getClass(),
            ))
            ->add('file', 'sonata_type_model_list', array(
                'sonata_field_description' =>  $this->FDCPageParticipateWidgetColumnDummyAdmin->getFormFieldDescriptions()['file'],
                'model_manager' => $this->FDCPageParticipateWidgetColumnDummyAdmin->getModelManager(),
                'class' => $this->FDCPageParticipateWidgetColumnDummyAdmin->getFormFieldDescriptions()['file']->getAssociationAdmin()->getClass(),
            ))
//            ->add('createdAt', 'hidden')
//            ->add('updatedAt', 'hidden')
        ;

    }


    /**
     * getName function.
     *
     * @access public
     * @return void
     */
    public function getName()
    {
        return 'fdc_page_participate_widget_column_type';
    }
}