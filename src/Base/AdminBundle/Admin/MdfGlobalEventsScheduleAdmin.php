<?php

namespace Base\AdminBundle\Admin;

use FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram;
use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Validator\Constraints\NotBlank;

class MdfGlobalEventsScheduleAdmin extends Admin
{
    protected $translationDomain = 'BaseAdminBundle';

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
            ->add('eventType')
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
                'required_locales' => array('fr'),
                'fields' => array(
                    'applyChanges' => array(
                        'field_type' => 'hidden',
                        'attr'       => array(
                            'class' => 'hidden',
                        ),
                    ),
                    'conference'            => array(
                        'label'                     => 'form.mdf.label.global_events_event_conference',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices'                   => MdfConferenceProgram::getConferences(),
                        'choice_translation_domain' => 'BaseAdminBundle',
                    ),
                    'eventType'          => array(
                        'label'              => 'form.mdf.label.global_events_event_type',
                        'translation_domain' => 'BaseAdminBundle',
                        'constraints'        => array(
                            new NotBlank(),
                        ),
                        'required' => true
                    ),
                    'eventDescription'         => array(
                        'label'              => 'form.mdf.label.global_events_event_description',
                        'translation_domain' => 'BaseAdminBundle',
                        'constraints'        => array(
                            new NotBlank(),
                        ),
                        'required' => true
                    ),
                    'url'        => array(
                        'label'              => 'form.mdf.label.global_events_event_url',
                        'translation_domain' => 'BaseAdminBundle',
                        'constraints'        => array(
                            new NotBlank(),
                        ),
                        'required' => true
                    ),
                    'accessType'     => array(
                        'label'              => 'form.mdf.label.global_events_event_access_type',
                        'translation_domain' => 'BaseAdminBundle'
                    ),
                    'location'     => array(
                        'label'              => 'form.mdf.label.global_events_event_location',
                        'translation_domain' => 'BaseAdminBundle'
                    )
                ),
            ))
            ->add('startTimeEvent', 'time', array(
                    'label' => 'form.mdf.label.global_event_start_time',
                    'required' => false,
                    'attr' => array('class' => 'fixed-time')
                )
            )
            ->add('endTimeEvent', 'time', array(
                    'label' => 'form.mdf.label.global_event_end_time',
                    'required' => false,
                    'attr' => array('class' => 'fixed-time')
                )
            )
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('eventType');
    }
}
