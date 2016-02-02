<?php

namespace Base\AdminBundle\Form\Type;

use Sonata\AdminBundle\Form\DataTransformer\ModelToIdTransformer;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * PressDownloadSectionWidgetDocumentType class.
 *
 * \@extends PressGuideWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class PressDownloadSectionWidgetDocumentType extends PressDownloadSectionWidgetType
{

    /**
     * dataClass
     *
     * (default value: 'Base\\CoreBundle\\Entity\\PressDownloadSectionWidgetDocument')
     *
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\\CoreBundle\\Entity\\PressDownloadSectionWidgetDocument';

    /**
     * PressGuideWidgetColumnDummyAdmin
     *
     * @var mixed
     * @access private
     */
    private $PressDownloadSectionWidgetDocumentDummyAdmin;

    /**
     * setPressDownloadSectionWidgetDocumentDummyAdmin function.
     *
     * @access public
     * @param mixed $PressDownloadSectionWidgetDocumentDummyAdmin
     * @return void
     */
    public function setPressDownloadSectionWidgetDocumentDummyAdmin($PressDownloadSectionWidgetDocumentDummyAdmin)
    {
        $this->PressDownloadSectionWidgetDocumentDummyAdmin = $PressDownloadSectionWidgetDocumentDummyAdmin;
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
                    'title' => array(
                        'label' => 'form.label_title',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => true
                            )
                        )
                    ),
                    'label' => array(
                        'label' => 'Légende',
                        'translation_domain' => 'BaseAdminBundle',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => true
                            )
                        )
                    ),
                    'btnLabel' => array(
                        'label' => 'Libellé bouton',
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
                        'translation_domain' => 'BaseAdminBundle'
                    ),
                )
            ))

            ->add('image', 'sonata_type_model_list', array(
                'sonata_field_description' =>  $this->PressDownloadSectionWidgetDocumentDummyAdmin->getFormFieldDescriptions()['image'],
                'model_manager' => $this->PressDownloadSectionWidgetDocumentDummyAdmin->getModelManager(),
                'class' => $this->PressDownloadSectionWidgetDocumentDummyAdmin->getClass(),
            ))
            ->add('file');

    }


    /**
     * getName function.
     *
     * @access public
     * @return void
     */
    public function getName()
    {
        return 'press_download_section_widget_document_type';
    }
}