<?php

namespace Base\AdminBundle\Admin;

use Base\CoreBundle\Entity\CorpoSearch;
use Base\CoreBundle\Entity\CorpoSearchTranslation;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class CorpoSearchAdmin extends Admin
{
    protected $translationDomain = 'BaseAdminBundle';

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

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('list');
        $collection->remove('create');
        $collection->remove('show');
        $collection->remove('batch');
        $collection->remove('delete');
        $collection->remove('export');
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
            ->add('id')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('translate')
            ->add('translateOptions')
            ->add('priorityStatus')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $securityContext = $this->getConfigurationPool()->getContainer()->get('security.context');
        $isTranslatorEnEsCh = (
            $securityContext->isGranted('ROLE_TRANSLATOR_EN') ||
            $securityContext->isGranted('ROLE_TRANSLATOR_ES') ||
            $securityContext->isGranted('ROLE_TRANSLATOR_ZH')
        ) ? true : false;
        $requiredLocales = ($isTranslatorEnEsCh) ? array() : array('fr');

        $formMapper
            ->add('translations', 'a2lix_translations', array(
                'label' => false,
                'translation_domain' => 'BaseAdminBundle',
                'required_locales' => $requiredLocales,
                'fields' => array(
                    'applyChanges' => array(
                        'field_type' => 'hidden',
                        'attr' => array (
                            'class' => 'hidden'
                        )
                    ),
                    'createdAt' => array(
                        'display' => false
                    ),
                    'updatedAt' => array(
                        'display' => false
                    ),
                    'pushTitle1' => array(
                        'label' => 'Titre Push 1',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'pushTitle2' => array(
                        'label' => 'Titre Push 2',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'pushTitle3' => array(
                        'label' => 'Titre Push 3',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'pushUrl1' => array(
                        'label' => 'form.homepage_corporate.label_url',
                        'sonata_help' => 'Interne ou externe. Commence par http://',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'pushUrl2' => array(
                        'label' => 'form.homepage_corporate.label_url',
                        'sonata_help' => 'Interne ou externe. Commence par http://',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'pushUrl3' => array(
                        'label' => 'form.homepage_corporate.label_url',
                        'sonata_help' => 'Interne ou externe. Commence par http://',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'status' => array(
                        'label' => 'form.label_status',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'choice',
                        'choices' => CorpoSearchTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle'
                    )
                )
            ))
            ->add('pushImage1', 'sonata_type_model_list', array(
                'label' => 'form.label_image_push',
                'help' => 'form.homepage.helper_pushes',
                'required' => false,
            ))
            ->add('pushImage2', 'sonata_type_model_list', array(
                'label' => 'form.label_image_push',
                'help' => 'form.homepage.helper_pushes',
                'required' => false,
            ))
            ->add('pushImage3', 'sonata_type_model_list', array(
                'label' => 'form.label_image_push',
                'help' => 'form.homepage.helper_push3',
                'required' => false,
            ))
            ->add('translate')
            ->add('translateOptions', 'choice', array(
                'choices' => CorpoSearch::getAvailableTranslateOptions(),
                'translation_domain' => 'BaseAdminBundle',
                'multiple' => true,
                'expanded' => true
            ))
            ->add('priorityStatus', 'choice', array(
                'choices'                   => CorpoSearch::getPriorityStatuses(),
                'choice_translation_domain' => 'BaseAdminBundle',
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
            ->add('translate')
            ->add('translateOptions')
            ->add('priorityStatus')
        ;
    }
}
