<?php

namespace FDC\CourtMetrageBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Base\AdminBundle\Admin\MediaImageAdmin;

class ModulePFType extends ModuleType
{
    /**
     * @var string
     */
    protected $dataClass = 'FDC\CourtMetrageBundle\Entity\CcmModulePF';

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
                    'namePF'          => array(
                        'label'              => 'form.ccm.label.module.pf.name_pf',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'description'            => array(
                        'label'              => 'form.ccm.label.module.pf.description',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'ckeditor',
                        'required' => false,
                    ),
                    'nameSurname'          => array(
                        'label'              => 'form.ccm.label.module.pf.name_surname',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'function'          => array(
                        'label'              => 'form.ccm.label.module.pf.function',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                ),
            ))
            ->add('logo', 'sonata_type_model_list', array(
                    'constraints'        => array(
                        new NotBlank(),
                    ),
                    'label' => 'form.ccm.label.module.pf.logo',
                    'sonata_field_description' =>  $this->admin->getFormFieldDescriptions()['logo'],
                    'model_manager' => $this->mediaImageAdmin->getModelManager(),
                    'class' => $this->mediaImageAdmin->getClass(),
                    'translation_domain' => 'BaseAdminBundle',
                    'btn_delete' => false,
                    'required' => true
                )
            )
            ->add('photo', 'sonata_type_model_list', array(
                    'label' => 'form.ccm.label.module.pf.photo',
                    'sonata_field_description' =>  $this->admin->getFormFieldDescriptions()['photo'],
                    'model_manager' => $this->mediaImageAdmin->getModelManager(),
                    'class' => $this->mediaImageAdmin->getClass(),
                    'translation_domain' => 'BaseAdminBundle',
                    'btn_delete' => false,
                    'required' => false
                )
            )
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'module_partenaires_fournisseur_type';
    }
}
