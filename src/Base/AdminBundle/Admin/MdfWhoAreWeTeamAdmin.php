<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use FDC\MarcheDuFilmBundle\Entity\MdfWhoAreWeTeamTranslation;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class MdfWhoAreWeTeamAdmin extends Admin
{
    protected $translationDomain = 'BaseAdminBundle';
    protected $formOptions = array(
        'cascade_validation' => true,
    );

    public function configure()
    {
        $this->setTemplate('edit', 'BaseAdminBundle:CRUD:edit_polycollection.html.twig');
    }

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
                    'edit'   => array(),
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
            ->add('translations', 'a2lix_translations', array(
                'label'  => false,
                'fields' => array(
                    'applyChanges'      => array(
                        'field_type' => 'hidden',
                        'attr'       => array(
                            'class' => 'hidden',
                        ),
                    ),
                    'title'          => array(
                        'label'              => 'form.mdf.label.who_are_we_team.subtitle',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'status'            => array(
                        'label'                     => 'form.mdf.label_status',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices'                   => MdfWhoAreWeTeamTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle',
                    )
                ),
            ))
            ->add('whoAreWeTeamContactWidgets', 'infinite_form_polycollection', array(
                'label'        => false,
                'types'        => array(
                    'who_are_we_team_contact_widget_type',
                ),
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
                'by_reference' => false,
            ))
            ->add('whoAreWeTeamWidgets', 'infinite_form_polycollection', array(
                'label'        => false,
                'types'        => array(
                    'who_are_we_team_widget_type',
                ),
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
                'by_reference' => false,
            ))
        ;
    }

    /**
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(['edit', 'list']);
    }
}
