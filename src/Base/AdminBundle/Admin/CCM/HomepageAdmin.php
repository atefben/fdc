<?php

namespace  Base\AdminBundle\Admin\CCM;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class HomepageAdmin extends Admin
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
                    'title' => array(
                        'label'              => 'form.ccm.label.title',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => true
                    ),
                )
            ))
            ->add('sliders', 'infinite_form_polycollection', array(
                'label'        => false,
                'types'        => array(
                    'homepage_slider_type',
                ),
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
                'by_reference' => false,
            ))
            ->add('pushes', 'infinite_form_polycollection', array(
                'label'        => false,
                'types'        => array(
                    'homepage_push_type',
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

    /**
     * Pre persist.
     *
     * @param Homepage $homepage
     */
    public function prePersist($homepage)
    {
        parent::prePersist($homepage);

        foreach ($homepage->getSliders() as $slider) {
            $slider->setHomepage($homepage);
        }
        foreach ($homepage->getPushes() as $push) {
            $push->setHomepage($homepage);
        }
    }

    /**
     * Pre update.
     *
     * @param Homepage $homepage
     */
    public function preUpdate($homepage)
    {
        parent::preUpdate($homepage);

        foreach ($homepage->getSliders() as $slider) {
            $slider->setHomepage($homepage);
        }
        foreach ($homepage->getPushes() as $push) {
            $push->setHomepage($homepage);
        }
    }
}
