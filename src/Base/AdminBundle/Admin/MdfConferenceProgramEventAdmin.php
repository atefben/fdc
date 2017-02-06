<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgramEventTranslation;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Validator\Constraints\Count;

class MdfConferenceProgramEventAdmin extends Admin
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
            ->add('id')
            ->add('title')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show'   => array(),
                    'edit'   => array(),
                    'delete' => array(),
                ),
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('position', 'hidden')
            ->add('translations', 'a2lix_translations', array(
                'label' => false,
                'translation_domain' => 'BaseAdminBundle',
                'required_locales' => array(),
                'fields' => array(
                    'applyChanges' => array(
                        'field_type' => 'hidden',
                        'attr' => array (
                            'class' => 'hidden'
                        )
                    ),
                    'title'          => array(
                        'label'              => 'form.mdf.conference_program.event.title',
                        'translation_domain' => 'BaseAdminBundle'
                    ),
                    'subTitle'          => array(
                        'label'              => 'form.mdf.conference_program.event.subTitle',
                        'translation_domain' => 'BaseAdminBundle'
                    ),
                    'description'          => array(
                        'label'              => 'form.mdf.conference_program.event.description',
                        'translation_domain' => 'BaseAdminBundle'
                    ),
                    'eventPlace'          => array(
                        'label'              => 'form.mdf.conference_program.event.eventPlace',
                        'translation_domain' => 'BaseAdminBundle'
                    ),
                    'eventAccessType'          => array(
                        'label'              => 'form.mdf.conference_program.event.eventAccessType',
                        'translation_domain' => 'BaseAdminBundle'
                    ),
                    'status'            => array(
                        'label'                     => 'form.mdf.label_status',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices'                   => MdfConferenceProgramEventTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle',
                    ),
                    'speakersTitle'          => array(
                        'label'              => 'form.mdf.conference_program.event.speakers_title',
                        'translation_domain' => 'BaseAdminBundle'
                    )
                )
            ))
            ->add('startTimeEvent', 'time', array(
                'label' => 'form.mdf.conference_program.event.eventStarTime',
                'required' => false,
                'attr' => array('class' => 'fixed-time')
            ))
            ->add('endTimeEvent', 'time', array(
                'label' => 'form.mdf.conference_program.event.eventEndTime',
                'required' => false,
                'attr' => array('class' => 'fixed-time')
            ))
            ->add('speakerCollections', 'sonata_type_collection', array(
                'by_reference'       => false,
                'label'              => 'form.mdf.conference_program.event.speakers',
                'translation_domain' => 'BaseAdminBundle',
                'constraints'        => array(
                    new Count(
                        array(
                            'max' => 8,
                            'maxMessage' => "validation.speakers_max"
                        )
                    ),
                ),
            ), array(
                'edit'     => 'inline',
                'inline'   => 'table',
                'sortable' => 'position',
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
            ->add('subTitle')
        ;
    }
}
