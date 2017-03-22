<?php

namespace FDC\CourtMetrageBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Base\AdminBundle\Admin\CCM\MediaImageAdmin;

class ModuleImageTextType extends ModuleType
{
    /**
     * @var string
     */
    protected $dataClass = 'FDC\CourtMetrageBundle\Entity\CcmModuleImageText';

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
                    'title'          => array(
                        'label'              => 'form.ccm.label.module.image_text.title',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'description'            => array(
                        'label'              => 'form.ccm.label.module.image_text.description',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'ckeditor',
                        'config_name' => 'ccm_widget',
                        'required' => false,
                    ),
                ),
            ))
            ->add('image', 'sonata_type_model_list', array(
                    'constraints'        => array(
                        new NotBlank(),
                    ),
                    'label' => 'form.ccm.label.module.image_text.image',
                    'sonata_field_description' =>  $this->admin->getFormFieldDescriptions()['image'],
                    'model_manager' => $this->mediaImageAdmin->getModelManager(),
                    'class' => $this->mediaImageAdmin->getClass(),
                    'translation_domain' => 'BaseAdminBundle',
                    'btn_delete' => false,
                    'required' => true
                )
            )
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'module_image_text_type';
    }
}
