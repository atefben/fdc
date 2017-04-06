<?php

namespace Base\AdminBundle\Form\Type;

use Base\AdminBundle\Admin\CCM\MediaImageSimpleAdmin;
use Base\CoreBundle\Entity\GraphicalCharterSectionWidgetOneColumn;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class GraphicalCharterSectionWidgetOneColumnType extends GraphicalCharterSectionWidgetType
{
    /**
     * @var string
     */
    protected $dataClass = GraphicalCharterSectionWidgetOneColumn::class;

    /**
     * admin
     *
     * @var mixed
     * @access private
     */
    private $admin;

    /**
     * @var MediaImageSimpleAdmin
     */
    private $mediaImageSimpleAdmin;

    /**
     * @var
     */
    private $sonataAdminContentFiles;

    /**
     * @var
     */
    private $contentFilesAdmin;

    /**
     * @param $sonataAdminContentFiles
     */
    public function setSonataAdminContentFiles($sonataAdminContentFiles)
    {
        $this->sonataAdminContentFiles = $sonataAdminContentFiles;
    }

    /**
     * @param $contentFilesAdmin
     */
    public function setContentFilesAdmin($contentFilesAdmin)
    {
        $this->contentFilesAdmin = $contentFilesAdmin;
    }

    /**
     * setSonataAdmin function.
     *
     * @access public
     * @param mixed $admin
     * @return void
     */
    public function setSonataAdmin($admin)
    {
        $this->admin = $admin;
    }

    public function setMediaImageSimpleAdmin($mediaImageAdmin)
    {
        $this->mediaImageSimpleAdmin = $mediaImageAdmin;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('translations', 'a2lix_translations', [
                'translation_domain' => 'BaseAdminBundle',
                'required_locales'   => ['fr'],
                'fields'             => [
                    'applyChanges'                      => [
                        'field_type' => 'hidden',
                        'attr'       => [
                            'class' => 'hidden',
                        ],
                    ],
                    'title'                             => [
                        'label'              => 'form.ccm.graphical_charter.title',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false
                    ],
                    'legend'                            => [
                        'label'              => 'form.ccm.graphical_charter.legend',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false,
                        'attr'               => [
                            'class' => 'ckeditor'
                        ],
                        'field_type'         => 'ckeditor',
                        'config_name'        => 'ccm_widget',
                        'input_sync'         => true
                    ],
                    'subLegend'                         => [
                        'label'              => 'form.ccm.graphical_charter.subLegend',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false,
                        'attr'               => [
                            'class' => 'ckeditor'
                        ],
                        'field_type'         => 'ckeditor',
                        'config_name'        => 'ccm_widget',
                        'input_sync'         => true,
                    ],
                    'technicalConstraints'              => [
                        'label'              => 'form.ccm.graphical_charter.technical_constraints',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false,
                        'attr'               => [
                            'class' => 'ckeditor'
                        ],
                        'field_type'         => 'ckeditor',
                        'config_name'        => 'ccm_widget',
                        'input_sync'         => true
                    ],
                    'isTechnicalConstraintsPopupActive' => [
                        'label'              => 'form.ccm.graphical_charter.is_technical_constraints_popup_active',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type'         => 'checkbox',
                        'required'           => false
                    ]
                ],
            ])
            ->add('image', 'sonata_type_model_list', [
                'label'                    => 'form.label_image',
                'constraints'              => [
                    new NotBlank(),
                ],
                'sonata_field_description' => $this->admin->getFormFieldDescriptions()['image'],
                'model_manager'            => $this->mediaImageSimpleAdmin->getModelManager(),
                'class'                    => $this->mediaImageSimpleAdmin->getClass(),
                'translation_domain'       => 'BaseAdminBundle',
                'btn_delete'               => false,
                'required'                 => true
            ])
            ->add('graphicalCharterButtonGroup', 'sonata_type_model_list', [
                'label'                    => 'form.ccm.graphical_charter.content_files_one_column',
                'sonata_field_description' => $this->sonataAdminContentFiles->getFormFieldDescriptions()['graphicalCharterButtonGroup'],
                'model_manager'            => $this->contentFilesAdmin->getModelManager(),
                'class'                    => $this->contentFilesAdmin->getClass(),
                'translation_domain'       => 'BaseAdminBundle',
                'btn_delete'               => true,
                'required'                 => false
            ])
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'graphical_charter_section_widget_one_column_type';
    }
}
