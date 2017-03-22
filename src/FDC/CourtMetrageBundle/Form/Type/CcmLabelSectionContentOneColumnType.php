<?php

namespace FDC\CourtMetrageBundle\Form\Type;

use Base\AdminBundle\Admin\MediaImageSimpleAdmin;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class CcmLabelSectionContentOneColumnType extends CcmLabelSectionContentType
{
    /**
     * @var string
     */
    protected $dataClass = 'FDC\CourtMetrageBundle\Entity\CcmLabelSectionContentOneColumn';

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
            ->add('translations', 'a2lix_translations', array(
                'translation_domain' => 'BaseAdminBundle',
                'locales' => ['fr','en'],
                'required_locales' => array('fr'),
                'fields' => array(
                    'applyChanges' => array(
                        'field_type' => 'hidden',
                        'attr'       => array(
                            'class' => 'hidden',
                        ),
                    ),
                    'title'             => array(
                        'label'              => 'form.ccm.graphical_charter.title',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false
                    ),
                    'legend'          => array(
                        'label'              => 'form.ccm.graphical_charter.legend',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                        'attr' => array(
                            'class' => 'ckeditor'
                        ),
                        'field_type'         => 'ckeditor',
                        'config_name' => 'ccm_widget',
                        'input_sync' => true
                    ),
                    'technicalConstraints'          => array(
                        'label'              => 'form.ccm.graphical_charter.technical_constraints',
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
                        'label' => 'form.ccm.graphical_charter.is_technical_constraints_popup_active',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'checkbox',
                        'required' => false
                    )
                ),
            ))
            ->add('image', 'sonata_type_model_list', array(
                'label' => 'form.label_image',
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
            ->add('labelContentFiles', 'sonata_type_model_list', array(
                'label' => 'form.ccm.graphical_charter.content_files_one_column',
                'sonata_field_description' =>  $this->sonataAdminContentFiles->getFormFieldDescriptions()['labelContentFiles'],
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
        return 'ccm_label_section_content_one_column_type';
    }
}
