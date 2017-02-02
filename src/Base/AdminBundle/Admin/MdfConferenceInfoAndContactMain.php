<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class MdfConferenceInfoAndContactMain extends Admin
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
                        'label'              => 'form.mdf.label.subtitle',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'description'          => array(
                        'field_type' => 'ckeditor',
                        'label'              => 'form.mdf.label.description',
                        'translation_domain' => 'BaseAdminBundle'
                    )
                )
            ))
            ->add('isActive', 'checkbox', array(
                'label' => 'form.mdf.active',
                'required' => false
            ))
            ->add('conferenceInfoAndContactWidgets', 'infinite_form_polycollection', array(
                'label'        => false,
                'types'        => array(
                    'conference_info_and_contact_widget_type',
                ),
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
                'by_reference' => false,
            ))
        ;
    }
}
