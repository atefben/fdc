<?php

namespace Base\AdminBundle\Form\Type;

use Base\AdminBundle\Admin\CCM\MediaImageSimpleAdmin;
use Base\CoreBundle\Entity\GraphicalCharterSectionWidget;
use Base\CoreBundle\Entity\GraphicalCharterSectionWidgetTwoColumns;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class GraphicalCharterSectionWidgetTwoColumnsType extends GraphicalCharterSectionWidgetType
{
    /**
     * @var string
     */
    protected $dataClass = GraphicalCharterSectionWidgetTwoColumns::class;

    /**
     * admin
     *
     * @var mixed
     * @access private
     */
    private $admin;

    /**
     * @var
     */
    private $adminTwo;

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
    private $sonataAdminContentFilesTwo;

    /**
     * @var
     */
    private $contentFilesAdmin;

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

    public function setSonataAdminContentFiles($sonataAdminContentFiles)
    {
        $this->sonataAdminContentFiles = $sonataAdminContentFiles;
    }

    public function setSonataAdminContentFilesTwo($sonataAdminContentFilesTwo)
    {
        $this->sonataAdminContentFilesTwo = $sonataAdminContentFilesTwo;
    }

    public function setContentFilesAdmin($contentFilesAdmin)
    {
        $this->contentFilesAdmin = $contentFilesAdmin;
    }

    public function setSonataTwoAdmin($adminTwo)
    {
        $this->adminTwo = $adminTwo;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('translations', 'a2lix_translations', array(
                'translation_domain' => 'BaseAdminBundle',
                'required_locales' => array('fr'),
                'fields' => array(
                    'applyChanges' => array(
                        'field_type' => 'hidden',
                        'attr'       => array(
                            'class' => 'hidden',
                        ),
                    ),
                    'title'             => array(
                        'label'              => 'form.ccm.graphical_charter.title_1',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false
                    ),
                    'legend'          => array(
                        'label'              => 'form.ccm.graphical_charter.legend_1',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                        'attr' => array(
                            'class' => 'ckeditor'
                        ),
                        'field_type'         => 'ckeditor',
                        'config_name' => 'ccm_widget',
                        'input_sync' => true
                    ),
                    'isTechnicalConstraintsPopupActive' => array(
                        'label' => 'form.ccm.graphical_charter.is_technical_constraints_popup_active_1',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'checkbox',
                        'required' => false
                    ),
                    'title2'             => array(
                        'label'              => 'form.ccm.graphical_charter.title_2',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false
                    ),
                    'legend2'          => array(
                        'label'              => 'form.ccm.graphical_charter.legend_2',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                        'attr' => array(
                            'class' => 'ckeditor'
                        ),
                        'field_type'         => 'ckeditor',
                        'config_name' => 'ccm_widget',
                        'input_sync' => true
                    ),
                    'isTechnicalConstraintsPopupActive2' => array(
                        'label' => 'form.ccm.graphical_charter.is_technical_constraints_popup_active_2',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'checkbox',
                        'required' => false
                    )
                ),
            ))
            ->add('image', 'sonata_type_model_list', array(
                'label' => 'form.ccm.graphical_charter.image_1',
                'constraints'        => array(
                    new NotBlank(),
                ),
                'sonata_field_description' =>  $this->admin->getFormFieldDescriptions()['image'],
                'model_manager' => $this->mediaImageSimpleAdmin->getModelManager(),
                'class' => $this->mediaImageSimpleAdmin->getClass(),
                'translation_domain' => 'BaseAdminBundle',
                'btn_delete' => false,
                'required' => true
            ))
            ->add('image2', 'sonata_type_model_list', array(
                'label' => 'form.ccm.graphical_charter.image_2',
                'constraints'        => array(
                    new NotBlank(),
                ),
                'sonata_field_description' =>  $this->adminTwo->getFormFieldDescriptions()['image2'],
                'model_manager' => $this->mediaImageSimpleAdmin->getModelManager(),
                'class' => $this->mediaImageSimpleAdmin->getClass(),
                'translation_domain' => 'BaseAdminBundle',
                'btn_delete' => false,
                'required' => true
            ))
            ->add('graphicalCharterButtonGroup', 'sonata_type_model_list', array(
                'label' => 'form.ccm.graphical_charter.content_files',
                'sonata_field_description' =>  $this->sonataAdminContentFiles->getFormFieldDescriptions()['graphicalCharterButtonGroup'],
                'model_manager' => $this->contentFilesAdmin->getModelManager(),
                'class' => $this->contentFilesAdmin->getClass(),
                'translation_domain' => 'BaseAdminBundle',
                'btn_delete' => true,
                'required' => false
            ))
            ->add('graphicalCharterButtonGroup2', 'sonata_type_model_list', array(
                'label' => 'form.ccm.graphical_charter.content_files_2',
                'sonata_field_description' =>  $this->sonataAdminContentFilesTwo->getFormFieldDescriptions()['graphicalCharterButtonGroup2'],
                'model_manager' => $this->contentFilesAdmin->getModelManager(),
                'class' => $this->contentFilesAdmin->getClass(),
                'translation_domain' => 'BaseAdminBundle',
                'btn_delete' => true,
                'required' => false
            ))
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'graphical_charter_section_widget_two_columns_type';
    }
}
