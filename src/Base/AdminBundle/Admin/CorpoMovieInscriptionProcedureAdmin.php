<?php

namespace Base\AdminBundle\Admin;

use Base\CoreBundle\Entity\PressAccreditProcedure;
use Base\CoreBundle\Entity\PressAccreditProcedureTranslation;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class CorpoMovieInscriptionProcedureAdmin extends Admin
{
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('acl');
        $collection->remove('show');
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id', null, array('label' => 'list.common.label_id'))
            ->add('title', null, array(
                'template' => 'BaseAdminBundle:AccreditProcedure:list_title.html.twig',
                'label'    => 'list.accredit_procedure.label_title',
            ))
            ->add('createdAt', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_created_at.html.twig',
                'sortable' => 'createdAt',
            ))
            ->add('publishedInterval', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_published_interval.html.twig',
                'sortable' => 'publishedAt',
            ))
            ->add('priorityStatus', 'choice', array(
                'choices'   => PressAccreditProcedure::getPriorityStatusesList(),
                'catalogue' => 'BaseAdminBundle'
            ))
            ->add('statusMain', 'choice', array(
                'choices'   => PressAccreditProcedureTranslation::getMainStatuses(),
                'catalogue' => 'BaseAdminBundle'
            ))
            ->add('_edit_translations', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_edit_translations.html.twig',
            ))
        ;
    }

    protected $translationDomain = 'BaseAdminBundle';

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
                    'status' => array(
                        'label' => 'form.label_status',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'choice',
                        'choices' => PressAccreditProcedureTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle',
                    ),
                    'createdAt' => array(
                        'display' => false
                    ),
                    'updatedAt' => array(
                        'display' => false
                    ),
                    'title' => array(
                        'label' => 'form.label_media_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => true
                            )
                        )
                    ),
                    'procedureContent' => array(
                        'field_type' => 'ckeditor',
                        'label' => 'form.label_procedure',
                        'sonata_help' => 'form.press_homepage.helper_desc',
                        'translation_domain' => 'BaseAdminBundle',
                        'config_name' => 'press'
                    ),
                    'rulesContent' => array(
                        'field_type' => 'ckeditor',
                        'label' => 'form.label_procedure',
                        'sonata_help' => 'form.press_homepage.helper_desc',
                        'translation_domain' => 'BaseAdminBundle',
                        'config_name' => 'press'
                    ),
                    'btnSelectionLabel' => array(
                        'field_type' => 'text'
                    ),
                    'btnSelectionLink' => array(
                        'field_type' => 'text'
                    ),
                    'btnInscriptionLabel' => array(
                        'field_type' => 'text'
                    ),
                    'btnInscriptionLink' => array(
                        'field_type' => 'text'
                    )
                )
            ))
            ->add('pdf', 'sonata_type_model_list',
                array(
                    "required" => false,
                )
            )
            ->add('mainImage', 'sonata_type_model_list', array(
                'label' => 'form.label_image'
            ))
            ->add('translate')
            ->add('translateOptions', 'choice', array(
                'choices' => PressAccreditProcedure::getAvailableTranslateOptions(),
                'translation_domain' => 'BaseAdminBundle',
                'multiple' => true,
                'expanded' => true
            ))
            ->add('priorityStatus', 'choice', array(
                'choices' => PressAccreditProcedure::getPriorityStatuses(),
                'choice_translation_domain' => 'BaseAdminBundle'
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
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }

    public function configure()
    {
        $this->setTemplate('edit', 'BaseAdminBundle:CRUD:edit_polycollection.html.twig');
    }

    public function prePersist($accredit)
    {
        $this->preUpdate($accredit);
    }

    public function preUpdate($accredit)
    {
        $accredit->setProcedure($accredit->getProcedure());
    }
}
