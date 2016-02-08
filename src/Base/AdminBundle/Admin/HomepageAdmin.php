<?php

namespace Base\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class HomepageAdmin extends Admin
{
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
            ->add('createdAt')
            ->add('updatedAt')
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
        $formMapper
            ->add('translations', 'a2lix_translations', array(
                'label' => false,
                'translation_domain' => 'BaseAdminBundle',
                'required_locales' => array(),
                'fields' => array(
                    'createdAt' => array(
                        'display' => false
                    ),
                    'updatedAt' => array(
                        'display' => false
                    ),
                    'pushsMain' => array(
//                        'field_type' => 'a2lix_translations'
                        'class' => 'BaseCoreBundle:HomepagePushMain'
                    )
                )
            ))
            ->add('topNewsType', 'choice', array(
                'label' => false,
                'choices' => array(0 => 'homepage.top_news_type.displayed_news', 1 => 'homepage.top_news_type.displayed_events'),
                'translation_domain' => 'BaseAdminBundle',
                'choice_translation_domain' => 'BaseAdminBundle',
                'expanded' => true
            ))
            ->add('homepageSlide', 'sonata_type_collection', array(
                'label' => 'form.label_news_news_associated',
                'help' => 'form.news.helper_news_news_associated',
                'by_reference' => false,
                'required' => false,
            ), array(
                    'edit' => 'inline',
                    'inline' => 'table'
                )
            )
            ->add('displayedSlider')
            ->add('displayedTopNews')
            ->add('displayedSocialWall')
            ->add('socialGraphHashtagTwitter', null, array(
                'sonata_help' => 'form.homepage.helper_social_graph',
                'translation_domain' => 'BaseAdminBundle'
            ))
            ->add('socialWallHashtags', null, array(
                'sonata_help' => 'form.homepage.helper_social_graph',
                'translation_domain' => 'BaseAdminBundle'
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
}
