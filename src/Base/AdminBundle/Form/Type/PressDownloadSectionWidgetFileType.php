<?php

namespace Base\AdminBundle\Form\Type;

use Sonata\AdminBundle\Form\DataTransformer\ModelToIdTransformer;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * PressDownloadSectionWidgetFileType class.
 *
 * \@extends PressGuideWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class PressDownloadSectionWidgetFileType extends PressDownloadSectionWidgetType
{

    /**
     * dataClass
     *
     * (default value: 'Base\\CoreBundle\\Entity\\PressDownloadSectionWidgetFile')
     *
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\\CoreBundle\\Entity\\PressDownloadSectionWidgetFile';


    /**
     * PressGuideWidgetFileDummyAdmin
     *
     * @var mixed
     * @access private
     */
    private $PressDownloadSectionWidgetFileDummyAdmin;

    /**
     * setPressDownloadSectionWidgetFileDummyAdmin function.
     *
     * @access public
     * @param mixed $PressDownloadSectionWidgetFileDummyAdmin
     * @return void
     */
    public function setPressDownloadSectionWidgetFileDummyAdmin($PressDownloadSectionWidgetFileDummyAdmin)
    {
        $this->PressDownloadSectionWidgetFileDummyAdmin = $PressDownloadSectionWidgetFileDummyAdmin;
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
                    'copyright' => array(
                        'label' => 'form.label_copyright',
                        'translation_domain' => 'BaseAdminBundle',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => true
                            )
                        )
                    ),
                    'btnLabel' => array(
                        'label' => 'form.label_btn',
                        'translation_domain' => 'BaseAdminBundle',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => true
                            )
                        )
                    ),
                    'secondBtnLabel' => array(
                        'label' => 'form.label_second_btn',
                        'translation_domain' => 'BaseAdminBundle',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => false
                            )
                        )
                    )

                )
            ))
            ->add('updatedAt', 'sonata_type_datetime_picker',array(
                'format' => 'yyyy-MM-dd H:m',
            ))

            ->add('file', 'sonata_type_model_list', array(
                'sonata_field_description' =>  $this->PressDownloadSectionWidgetFileDummyAdmin->getFormFieldDescriptions()['file'],
                'model_manager' => $this->PressDownloadSectionWidgetFileDummyAdmin->getModelManager(),
                'class' => $this->PressDownloadSectionWidgetFileDummyAdmin->getFormFieldDescriptions()['file']->getAssociationAdmin()->getClass(),
            ))
            ->add('secondFile', 'sonata_type_model_list', array(
                'sonata_field_description' =>  $this->PressDownloadSectionWidgetFileDummyAdmin->getFormFieldDescriptions()['secondFile'],
                'model_manager' => $this->PressDownloadSectionWidgetFileDummyAdmin->getModelManager(),
                'class' => $this->PressDownloadSectionWidgetFileDummyAdmin->getFormFieldDescriptions()['secondFile']->getAssociationAdmin()->getClass(),
                'required' => false
            ))

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
        return 'press_download_section_widget_file_type';
    }
}