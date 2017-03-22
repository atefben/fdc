<?php

namespace FDC\CourtMetrageBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Base\AdminBundle\Admin\MediaImageAdmin;
use Base\AdminBundle\Admin\MediaPdfAdmin;

class ModuleThreeColumnsType extends ModuleType
{
    /**
     * @var string
     */
    protected $dataClass = 'FDC\CourtMetrageBundle\Entity\CcmModuleThreeColumns';

    /**
     * admin
     *
     * @var mixed
     * @access private
     */
    private $admin;

    /**
     * @var MediaImageAdmin
     */
    private $mediaImageAdmin;

    /**
     * @var MediaPdfAdmin
     */
    private $mediaFileAdmin;

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

    public function setMediaImageAdmin($mediaImageAdmin)
    {
        $this->mediaImageAdmin = $mediaImageAdmin;
    }

    public function setMediaFileAdmin($mediaFileAdmin)
    {
        $this->mediaFileAdmin = $mediaFileAdmin;
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
                'locales' => ['fr','en'],
                'translation_domain' => 'BaseAdminBundle',
                'fields' => array(
                    'applyChanges' => array(
                        'field_type' => 'hidden',
                        'attr'       => array(
                            'class' => 'hidden',
                        ),
                    ),
                    'title1'          => array(
                        'label'              => 'form.ccm.label.module.three_columns.title1',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'description1'            => array(
                        'label'              => 'form.ccm.label.module.three_columns.description1',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'ckeditor',
                        'config_name' => 'ccm_widget',
                        'required' => false,
                    ),
                    'title2'          => array(
                        'label'              => 'form.ccm.label.module.three_columns.title2',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'description2'            => array(
                        'label'              => 'form.ccm.label.module.three_columns.description2',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'ckeditor',
                        'config_name' => 'ccm_widget',
                        'required' => false,
                    ),
                    'title3'          => array(
                        'label'              => 'form.ccm.label.module.three_columns.title3',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'description3'            => array(
                        'label'              => 'form.ccm.label.module.three_columns.description3',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'ckeditor',
                        'config_name' => 'ccm_widget',
                        'required' => false,
                    ),
                ),
            ))
            ->add('image1', 'sonata_type_model_list', array(
                    'label' => 'form.ccm.label.module.three_columns.image1',
                    'sonata_field_description' =>  $this->admin->getFormFieldDescriptions()['image1'],
                    'model_manager' => $this->mediaImageAdmin->getModelManager(),
                    'class' => $this->mediaImageAdmin->getClass(),
                    'translation_domain' => 'BaseAdminBundle',
                    'required' => false,
                )
            )
            ->add('image2', 'sonata_type_model_list', array(
                    'label' => 'form.ccm.label.module.three_columns.image2',
                    'sonata_field_description' =>  $this->admin->getFormFieldDescriptions()['image2'],
                    'model_manager' => $this->mediaImageAdmin->getModelManager(),
                    'class' => $this->mediaImageAdmin->getClass(),
                    'translation_domain' => 'BaseAdminBundle',
                    'required' => false,
                )
            )
            ->add('image3', 'sonata_type_model_list', array(
                    'label' => 'form.ccm.label.module.three_columns.image3',
                    'sonata_field_description' =>  $this->admin->getFormFieldDescriptions()['image3'],
                    'model_manager' => $this->mediaImageAdmin->getModelManager(),
                    'class' => $this->mediaImageAdmin->getClass(),
                    'translation_domain' => 'BaseAdminBundle',
                    'required' => false,
                )
            )
            ->add('pdf1', 'sonata_type_model_list', array(
                    'label' => 'form.ccm.label.module.three_columns.pdf1',
                    'sonata_field_description' =>  $this->admin->getFormFieldDescriptions()['pdf1'],
                    'model_manager' => $this->mediaFileAdmin->getModelManager(),
                    'class' => $this->mediaFileAdmin->getClass(),
                    'translation_domain' => 'BaseAdminBundle',
                    'required' => false,
                )
            )
            ->add('pdf2', 'sonata_type_model_list', array(
                    'label' => 'form.ccm.label.module.three_columns.pdf2',
                    'sonata_field_description' =>  $this->admin->getFormFieldDescriptions()['pdf2'],
                    'model_manager' => $this->mediaFileAdmin->getModelManager(),
                    'class' => $this->mediaFileAdmin->getClass(),
                    'translation_domain' => 'BaseAdminBundle',
                    'required' => false,
                )
            )
            ->add('pdf3', 'sonata_type_model_list', array(
                    'label' => 'form.ccm.label.module.three_columns.pdf3',
                    'sonata_field_description' =>  $this->admin->getFormFieldDescriptions()['pdf3'],
                    'model_manager' => $this->mediaFileAdmin->getModelManager(),
                    'class' => $this->mediaFileAdmin->getClass(),
                    'translation_domain' => 'BaseAdminBundle',
                    'required' => false,
                )
            )
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'module_three_columns_type';
    }
}
