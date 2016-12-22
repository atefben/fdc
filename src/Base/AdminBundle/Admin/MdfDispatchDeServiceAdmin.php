<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class MdfDispatchDeServiceAdmin extends Admin
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
                'label'  => false,
                'fields' => array(
                    'applyChanges'      => array(
                        'field_type' => 'hidden',
                        'attr'       => array(
                            'class' => 'hidden',
                        ),
                    ),
                    'title'          => array(
                        'label'              => 'form.label.title',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'description'          => array(
                        'label'              => 'form.label.description',
                        'translation_domain' => 'BaseAdminBundle'
                    ),
                    'showContactBlock'  => array(
                        'label'              => 'form.label.show_contact_block',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false
                    ),
                    'contactTitle'          => array(
                        'label'              => 'form.label.contact_title',
                        'translation_domain' => 'BaseAdminBundle'
                    ),
                    'contactDescription'          => array(
                        'label'              => 'form.label.contact_description',
                        'translation_domain' => 'BaseAdminBundle'
                    ),
                    'contactSeeMoreUrl'          => array(
                        'label'              => 'form.label.contact_see_more_url',
                        'translation_domain' => 'BaseAdminBundle'
                    )
                )
            ))
            ->add('dispatchDeServiceWidgets', 'infinite_form_polycollection', array(
                'label'        => false,
                'types'        => array(
                    'dispatch_de_service_widget_type',
                ),
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
                'by_reference' => false,
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
        ;
    }
}
