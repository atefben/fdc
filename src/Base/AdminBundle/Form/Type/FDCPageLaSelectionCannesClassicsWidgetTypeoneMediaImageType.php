<?php

namespace Base\AdminBundle\Form\Type;

use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidgetTypeoneMediaImage;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class FDCPageLaSelectionCannesClassicsWidgetTypeoneType
 * @package Base\AdminBundle\Form\Type
 */
class FDCPageLaSelectionCannesClassicsWidgetTypeoneMediaImageType extends FDCPageLaSelectionCannesClassicsWidgetType
{

    /**
     * @var string
     */
    protected $dataClass = 'Base\\CoreBundle\\Entity\\FDCPageLaSelectionCannesClassicsWidgetTypeoneMediaImage';

    /**
     * PressGuideWidgetDocumentDummyAdmin
     *
     * @var mixed
     * @access private
     */
    private $admin;

    /**
     * @param $admin
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;
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
            ->add('translations', 'a2lix_translations', [
                'label'              => false,
                'translation_domain' => 'BaseAdminBundle',
                'required_locales'   => [],
                'fields'             => [
                    'applyChanges' => [
                        'field_type' => 'hidden',
                        'attr'       => [
                            'class' => 'hidden'
                        ]
                    ],
                    'createdAt'    => [
                        'display' => false
                    ],
                    'updatedAt'    => [
                        'display' => false
                    ],
                    'title'        => [
                        'label'              => 'form.label_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'locale_options'     => [
                            'fr' => [
                                'required' => true
                            ]
                        ]
                    ],
                    'content'      => [
                        'field_type'         => 'ckeditor',
                        'label'              => 'form.label_content',
                        'sonata_help'        => 'form.press_homepage.helper_desc',
                        'translation_domain' => 'BaseAdminBundle',
                        'config_name'        => 'press'
                    ],
                ]
            ])
            ->add('image', 'sonata_type_model_list', [
                'sonata_field_description' => $this->admin->getFormFieldDescriptions()['image'],
                'model_manager'            => $this->admin->getModelManager(),
                'class'                    => $this->admin->getFormFieldDescriptions()['image']->getAssociationAdmin()->getClass(),
            ])
        ;

    }


    /**
     * @return string
     */
    public function getName()
    {
        return 'fdc_page_la_selection_cannes_classics_widget_typeone_media_image_type';
    }
}