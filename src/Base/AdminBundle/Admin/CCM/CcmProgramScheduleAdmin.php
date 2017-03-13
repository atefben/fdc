<?php

namespace Base\AdminBundle\Admin\CCM;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Validator\Constraints\NotBlank;

class CcmProgramScheduleAdmin extends Admin
{
    public function configure()
    {
        $this->setTemplate('edit', 'BaseAdminBundle:CRUD:edit_polycollection.html.twig');
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id', null, array('label' => 'filter.common.label_id'))
            ->add('title')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
                )
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
                'translation_domain' => 'BaseAdminBundle',
                'locales' => array('fr', 'en'),
                'required_locales' => array('fr'),
                'label'  => false,
                'fields' => array(
                    'applyChanges' => array(
                        'field_type' => 'hidden',
                        'attr'       => array(
                            'class' => 'hidden',
                        ),
                    ),
                    'title'            => array(
                        'label'                     => 'form.ccm.label.program.schedule.title',
                        'translation_domain'        => 'BaseAdminBundle',
                        'constraints'        => array(
                            new NotBlank(),
                        ),
                        'required' => true
                    ),
                    'description'         => array(
                        'label'              => 'form.ccm.label.program.schedule.description',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                        'attr' => array(
                            'class' => 'ckeditor'
                        ),
                        'field_type'         => 'ckeditor',
                        'config_name' => 'widget',
                        'input_sync' => true
                    ),
                    'url'        => array(
                        'label'              => 'form.ccm.label.program.schedule.url',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                        'sonata_help' => 'form.ccm.label.external_url',
                    ),
                    'accessType'     => array(
                        'label'              => 'form.ccm.label.program.schedule.access_type',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false
                    ),
                    'location'     => array(
                        'label'              => 'form.ccm.label.program.schedule.location',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false
                    ),
                    'timeDetails'     => array(
                        'label'              => 'form.ccm.label.program.schedule.time_details',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false
                    )
                ),
            ))
            ->add('scheduleType', 'sonata_type_model_list', array(
                'label' => 'form.ccm.label.program.schedule.schedule_type',
                'translation_domain' => 'BaseAdminBundle',
                'btn_delete' => false
            ))
        ;
    }


    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('title')
            ;
    }
}
