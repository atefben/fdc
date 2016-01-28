<?php

namespace Base\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class PressHomepageAdmin extends Admin
{

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('homeMedia')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('homeMedia')
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
                    'title' => array(
                        'label' => 'form.press_homepage.title',
                        'translation_domain' => 'BaseAdminBundle',
                        'sonata_help' => 'form.press_homepage.helper_page',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => true
                            )
                        )
                    ),
                    'createdAt' => array(
                        'display' => false
                    ),
                    'updatedAt' => array(
                        'display' => false
                    ),
                    'pushsMain' => array(
                        'class' => 'BaseCoreBundle:PressHomepagePushMain'
                    ),
                    'pushsSecondary' => array(
                        'class' => 'BaseCoreBundle:PressHomepagePushSecondary'
                    ),
                    'sectionStatementInfoTitle' => array(
                        'label' => 'form.press_homepage_statement_info.title',
                        'translation_domain' => 'BaseAdminBundle',
                        'sonata_help' => 'form.press_homepage_statement_info.helper_page',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => true
                            )
                        )
                    ),
                )
            ))
            ->add('section', 'sonata_type_collection',
                array(
                    'type_options' => array(
                        'delete' => false,
                        'delete_options' => array(
                            'type'         => 'hidden',
                            'type_options' => array(
                                'mapped'   => false,
                                'required' => false,
                            )
                        )
                    ),
                    'btn_add' => false,
                    'cascade_validation' => true,
                    'by_reference' => false,
                ),
                array(
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable'  => 'position'
                )
            )
            ->add('homeMedia', 'sonata_type_collection',
                array(
                    'type_options' => array(
                        'delete' => false,
                        'delete_options' => array(
                            'type'         => 'hidden',
                            'type_options' => array(
                                'mapped'   => false,
                                'required' => false,
                            )
                        )
                    ),
                    'cascade_validation' => true,
                    'by_reference' => false
                ),
                array(
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable'  => 'position',
                    'embed_min' => 2,
                    'embed_max' => 4
                )
            )
            ->add('homeDownload', 'sonata_type_collection',
                array(
                    'type_options' => array(
                        'delete' => false,
                        'delete_options' => array(
                            'type'         => 'hidden',
                            'type_options' => array(
                                'mapped'   => false,
                                'required' => false,
                            )
                        )
                    ),
                    'btn_add' => true,
                    'cascade_validation' => true,
                    'by_reference' => false
                ),
                array(
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable'  => 'position',
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
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }
}
