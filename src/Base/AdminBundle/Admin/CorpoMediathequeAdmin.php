<?php

namespace Base\AdminBundle\Admin;

use Base\CoreBundle\Entity\CorpoMediatheque;
use Base\CoreBundle\Entity\CorpoMediathequeTranslation;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class CorpoMediathequeAdmin extends Admin
{
    protected $translationDomain = 'BaseAdminBundle';

    public function configure()
    {
        $this->setTemplate('edit', 'BaseAdminBundle:CRUD:edit_polycollection.html.twig');
    }


    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('list');
        $collection->remove('create');
        $collection->remove('show');
        $collection->remove('batch');
        $collection->remove('delete');
        $collection->remove('export');
        $collection->remove('acl');
    }

    protected $formOptions = array(
        'cascade_validation' => true
    );

    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            array('BaseAdminBundle:Form:polycollection.html.twig')
        );
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id');
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('displayedSelection')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ));
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
                'label'              => false,
                'translation_domain' => 'BaseAdminBundle',
                'required_locales'   => $requiredLocales,
                'fields'             => array(
                    'applyChanges' => array(
                        'field_type' => 'hidden',
                        'attr' => array (
                            'class' => 'hidden'
                        )
                    ),
                    'status'         => array(
                        'label'                     => 'form.label_status',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices'                   => CorpoMediathequeTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle'
                    ),
                    'title'       => array(
                        'label'              => 'form.fdc_page_la_selection_cannes_classics.title',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false,
                        'sonata_help'        => 'form.fdc_page_la_selection_cannes_classics.helper_titleNav'
                    ),
                    'seoTitle'       => array(
                        'attr'               => array(
                            'placeholder' => 'form.fdc_page_web_tv_trailers.placeholder_seo_title'
                        ),
                        'label'              => 'form.label_seo_title',
                        'sonata_help'        => 'form.news.helper_seo_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false,
                    ),
                    'seoDescription' => array(
                        'attr'               => array(
                            'placeholder' => 'form.fdc_page_web_tv_trailers.placeholder_seo_description'
                        ),
                        'label'              => 'form.label_seo_description',
                        'sonata_help'        => 'form.news.helper_description',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false,
                    ),
                    'createdAt'      => array(
                        'display' => false
                    ),
                    'updatedAt'      => array(
                        'display' => false
                    ),
                )
            ))
            ->add('image', 'sonata_type_model_list', array(
                'label'    => 'form.fdc_page_web_tv_trailers.image',
                'help'     => 'form.fdc_page_web_tv_trailers.helper_image',
                'required' => false,
            ))
            ->add('seoFile', 'sonata_media_type', array(
                'provider' => 'sonata.media.provider.image',
                'context'  => 'seo_file',
                'help'     => 'form.seo.helper_file',
                'required' => false
            ))
            ->add('translate')
            ->add('translateOptions', 'choice', array(
                'choices' => CorpoMediatheque::getAvailableTranslateOptions(),
                'translation_domain' => 'BaseAdminBundle',
                'multiple' => true,
                'expanded' => true
            ))
            ->add('priorityStatus', 'choice', array(
                'choices'                   => CorpoMediatheque::getPriorityStatuses(),
                'choice_translation_domain' => 'BaseAdminBundle',
            ))
            ->add('medias', 'sonata_type_collection', array(
                'label' => 'Sélection médias',
                'help' => 'Sélectionnez une sélection de médias sélectionnés',
                'by_reference' => false,
                'required' => false,
            ), array(
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable'  => 'position'
                )
            )
            ->add('displayedSelection', 'checkbox', array(
                'label' => 'Ne pas afficher cette strate',
                'required' => false,
            ));
    }

}
