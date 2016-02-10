<?php

namespace Base\AdminBundle\Form\Type;

use Sonata\AdminBundle\Form\DataTransformer\ModelToIdTransformer;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * PressDownloadSectionWidgetVideoType class.
 *
 * \@extends PressGuideWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class PressDownloadSectionWidgetVideoType extends PressDownloadSectionWidgetType
{

    /**
     * dataClass
     *
     * (default value: 'Base\\CoreBundle\\Entity\\PressDownloadSectionWidgetVideo')
     *
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\\CoreBundle\\Entity\\PressDownloadSectionWidgetVideo';

    /**
     * PressGuideWidgetColumnDummyAdmin
     *
     * @var mixed
     * @access private
     */
    private $PressDownloadSectionWidgetVideoDummyAdmin;

    /**
     * setPressDownloadSectionWidgetVideoDummyAdmin function.
     *
     * @access public
     * @param mixed $PressDownloadSectionWidgetVideoDummyAdmin
     * @return void
     */
    public function setPressDownloadSectionWidgetVideoDummyAdmin($PressDownloadSectionWidgetVideoDummyAdmin)
    {
        $this->PressDownloadSectionWidgetVideoDummyAdmin = $PressDownloadSectionWidgetVideoDummyAdmin;
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
                    'label' => array(
                        'label' => 'form.label_label',
                        'translation_domain' => 'BaseAdminBundle',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => true
                            )
                        )
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
                    )
                )
            ))

            ->add('image', 'sonata_type_model_list', array(
                'sonata_field_description' =>  $this->PressDownloadSectionWidgetVideoDummyAdmin->getFormFieldDescriptions()['image'],
                'model_manager' => $this->PressDownloadSectionWidgetVideoDummyAdmin->getModelManager(),
                'class' => $this->PressDownloadSectionWidgetVideoDummyAdmin->getFormFieldDescriptions()['image']->getAssociationAdmin()->getClass(),
            ))
            ->add('file', 'sonata_type_model_list', array(
                'sonata_field_description' =>  $this->PressDownloadSectionWidgetVideoDummyAdmin->getFormFieldDescriptions()['file'],
                'model_manager' => $this->PressDownloadSectionWidgetVideoDummyAdmin->getModelManager(),
                'class' => $this->PressDownloadSectionWidgetVideoDummyAdmin->getFormFieldDescriptions()['file']->getAssociationAdmin()->getClass(),
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
        return 'press_download_section_widget_video_type';
    }
}