<?php

namespace Base\AdminBundle\Form\Type;

use Sonata\AdminBundle\Form\DataTransformer\ModelToIdTransformer;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * PressDownloadSectionWidgetArchiveType class.
 *
 * \@extends PressGuideWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class PressDownloadSectionWidgetArchiveType extends PressDownloadSectionWidgetType
{

    /**
     * dataClass
     *
     * (default value: 'Base\\CoreBundle\\Entity\\PressDownloadSectionWidgetDocument')
     *
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\\CoreBundle\\Entity\\PressDownloadSectionWidgetArchive';

    /**
     * PressGuideWidgetDocumentDummyAdmin
     *
     * @var mixed
     * @access private
     */
    private $PressDownloadSectionWidgetArchiveDummyAdmin;

    /**
     * setPressDownloadSectionWidgetArchiveDummyAdmin function.
     *
     * @access public
     * @param mixed $PressDownloadSectionWidgetArchiveDummyAdmin
     * @return void
     */
    public function setPressDownloadSectionWidgetArchiveDummyAdmin($PressDownloadSectionWidgetArchiveDummyAdmin)
    {
        $this->PressDownloadSectionWidgetArchiveDummyAdmin = $PressDownloadSectionWidgetArchiveDummyAdmin;
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
                    'btnLabel' => array(
                        'label' => 'form.label_btn',
                        'translation_domain' => 'BaseAdminBundle',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => true
                            )
                        )
                    ),
                    'content' => array(
                        'field_type' => 'ckeditor',
                        'label' => 'form.label_content',
                        'sonata_help' => 'form.press_homepage.helper_desc',
                        'translation_domain' => 'BaseAdminBundle',
                        'config_name' => 'widget'
                    ),
                    'copyright' => array(
                        'label' => 'Copyright',
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
                'sonata_field_description' =>  $this->PressDownloadSectionWidgetArchiveDummyAdmin->getFormFieldDescriptions()['image'],
                'model_manager' => $this->PressDownloadSectionWidgetArchiveDummyAdmin->getModelManager(),
                'class' => $this->PressDownloadSectionWidgetArchiveDummyAdmin->getFormFieldDescriptions()['image']->getAssociationAdmin()->getClass(),
            ))
            ->add('file', 'sonata_type_model_list', array(
                'sonata_field_description' =>  $this->PressDownloadSectionWidgetArchiveDummyAdmin->getFormFieldDescriptions()['file'],
                'model_manager' => $this->PressDownloadSectionWidgetArchiveDummyAdmin->getModelManager(),
                'class' => $this->PressDownloadSectionWidgetArchiveDummyAdmin->getFormFieldDescriptions()['file']->getAssociationAdmin()->getClass(),
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
        return 'press_download_section_widget_archive_type';
    }
}