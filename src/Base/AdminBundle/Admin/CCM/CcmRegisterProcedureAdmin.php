<?php

namespace Base\AdminBundle\Admin\CCM;

use FDC\CourtMetrageBundle\Entity\CcmRegisterProcedureTranslation;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Url;

class CcmRegisterProcedureAdmin extends Admin
{
    public function configure()
    {
        $this->setTemplate('edit', 'BaseAdminBundle:CRUD:edit_polycollection.html.twig');
    }

    /**
     * @return array
     */
    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            array('BaseAdminBundle:Form:polycollection.html.twig')
        );
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id', null, array(
                    'label' => 'list.ccm.id'
                )
            )
            ->add('name', null, array(
                    'label' => 'list.ccm.register.name'
                )
            )
            ->add('_edit_translations', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_edit_translations.html.twig',
                'label' => 'list.ccm.register.edit'
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('translations', 'a2lix_translations', array(
                'locales' => ['fr','en'],
                'label'  => false,
                'fields' => array(
                    'applyChanges'      => array(
                        'field_type' => 'hidden',
                        'attr'       => array(
                            'class' => 'hidden',
                        ),
                    ),
                    'name'          => array(
                        'label'              => 'form.ccm.register_procedure.name',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false
                    ),
                    'procedureText'          => array(
                        'label'              => 'form.ccm.film_register.procedure_text',
                        'translation_domain' => 'BaseAdminBundle',
                        'attr' => array(
                            'class' => 'ckeditor'
                        ),
                        'field_type' => 'ckeditor',
                        'config_name' => 'ccm_widget',
                        'input_sync' => true,
                        'required' => false
                    ),
                    'characteristicsTitle'   => array(
                        'label'              => 'form.ccm.film_register.characteristics_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false
                    ),
                    'characteristicsText'          => array(
                        'label'              => 'form.ccm.film_register.characteristics_text',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                        'attr' => array(
                            'class' => 'ckeditor'
                        ),
                        'field_type' => 'ckeditor',
                        'config_name' => 'ccm_widget',
                        'input_sync' => true
                    ),
                    'characteristicsButtonLabel'   => array(
                        'label'              => 'form.ccm.film_register.characteristics_button_label',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false
                    ),
                    'isCharacteristicsActive' => array(
                        'label' => 'form.ccm.film_register.is_characteristics_active',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'checkbox',
                        'required' => false
                    ),
                    'regulationTitle'   => array(
                        'label'              => 'form.ccm.film_register.regulation_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false
                    ),
                    'regulationText'          => array(
                        'label'              => 'form.ccm.film_register.regulation_text',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                        'attr' => array(
                            'class' => 'ckeditor'
                        ),
                        'field_type' => 'ckeditor',
                        'config_name' => 'ccm_widget',
                        'input_sync' => true
                    ),
                    'isRegulationActive' => array(
                        'label' => 'form.ccm.film_register.is_regulation_active',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'checkbox',
                        'required' => false
                    ),
                    'registerFormTitle'   => array(
                        'label'              => 'form.ccm.film_register.register_form_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false
                    ),
                    'registerFormText'          => array(
                        'label'              => 'form.ccm.film_register.register_form_text',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                        'attr' => array(
                            'class' => 'ckeditor'
                        ),
                        'field_type' => 'ckeditor',
                        'config_name' => 'ccm_widget',
                        'input_sync' => true
                    ),
                    'isRegisterFormActive' => array(
                        'label' => 'form.ccm.film_register.is_register_form_active',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'checkbox',
                        'required' => false
                    ),
                    'contactUsTitle'   => array(
                        'label'              => 'form.ccm.film_register.contact_us_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false
                    ),
                    'contactUsLeftText'          => array(
                        'label'              => 'form.ccm.film_register.contact_us_left_text',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                        'attr' => array(
                            'class' => 'ckeditor'
                        ),
                        'field_type' => 'ckeditor',
                        'config_name' => 'ccm_widget',
                        'input_sync' => true
                    ),
                    'contactUsRightText'          => array(
                        'label'              => 'form.ccm.film_register.contact_us_right_text',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                        'attr' => array(
                            'class' => 'ckeditor'
                        ),
                        'field_type' => 'ckeditor',
                        'config_name' => 'ccm_widget',
                        'input_sync' => true
                    ),
                    'techniqueCharacteristicsTitle'   => array(
                        'label'              => 'form.ccm.film_register.technique_characteristics_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false
                    ),
                    'techniqueCharacteristicsVideo'          => array(
                        'label'              => 'form.ccm.film_register.technique_characteristics_video',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                        'attr' => array(
                            'class' => 'ckeditor'
                        ),
                        'field_type' => 'ckeditor',
                        'config_name' => 'ccm_widget',
                        'input_sync' => true
                    ),
                    'techniqueCharacteristicsAudio'          => array(
                        'label'              => 'form.ccm.film_register.technique_characteristics_audio',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                        'attr' => array(
                            'class' => 'ckeditor'
                        ),
                        'field_type' => 'ckeditor',
                        'config_name' => 'ccm_widget',
                        'input_sync' => true
                    ),
                    'techniqueCharacteristicsText'          => array(
                        'label'              => 'form.ccm.film_register.technique_characteristics_text',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                        'attr' => array(
                            'class' => 'ckeditor'
                        ),
                        'field_type' => 'ckeditor',
                        'config_name' => 'ccm_widget',
                        'input_sync' => true
                    ),
                    'regulationDetailsText'          => array(
                        'label'              => 'form.ccm.film_register.regulation_details_text',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                        'attr' => array(
                            'class' => 'ckeditor'
                        ),
                        'field_type' => 'ckeditor',
                        'config_name' => 'ccm_widget',
                        'input_sync' => true
                    ),
                    'regulationDetailsButtonLabel'   => array(
                        'label'              => 'form.ccm.film_register.regulation_details_button_label',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false
                    ),
                    'regulationDetailsButtonUrl'   => array(
                        'label'              => 'form.ccm.film_register.regulation_details_button_url',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                        'constraints'        => array(
                            new Url(),
                        )
                    ),
                    'status'         => array(
                        'label'                     => 'form.label_status',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices'                   => CcmRegisterProcedureTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle'
                    )
                )
            ))
            ->add('registerFormBackground', 'sonata_type_model_list', array(
                'label' => 'form.ccm.film_register.register_form_background',
                'translation_domain' => 'BaseAdminBundle',
                'btn_delete' => false,
                'required' => false
            ))
            ->add('regulationDetailsFile', 'sonata_type_model_list', array(
                'label' => 'form.ccm.film_register.regulation_details_file',
                'translation_domain' => 'BaseAdminBundle',
                'btn_delete' => false,
                'required' => false
            ))
        ;
    }
}