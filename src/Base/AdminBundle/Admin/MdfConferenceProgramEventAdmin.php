<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

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
                        'label'              => 'form.mdf.conference_program.title',
                        'translation_domain' => 'BaseAdminBundle'
                    ),
                    'subTitle'          => array(
                        'label'              => 'form.mdf.conference_program.subTitle',
                        'translation_domain' => 'BaseAdminBundle'
                    ),
                    'description'          => array(
                        'label'              => 'form.mdf.conference_program.description',
                        'translation_domain' => 'BaseAdminBundle'
                    ),
                    'eventHour'          => array(
                        'label'              => 'form.mdf.conference_program.eventHour',
                        'translation_domain' => 'BaseAdminBundle'
                    ),
                    'eventPlace'          => array(
                        'label'              => 'form.mdf.conference_program.eventPlace',
                        'translation_domain' => 'BaseAdminBundle'
                    ),
                    'eventAccessType'          => array(
                        'label'              => 'form.mdf.conference_program.eventAccessType',
                        'translation_domain' => 'BaseAdminBundle'
                    )
                )
            ))
        ;

    }
}
