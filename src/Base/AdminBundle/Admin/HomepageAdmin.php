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
                    'primaryPushTitle1' => array(
                        'label' => 'form.label_primary_push_title'
                    ),
                    'primaryPushTitle2' => array(
                        'label' => 'form.label_primary_push_title'
                    ),
                    'primaryPushTitle3' => array(
                        'label' => 'form.label_primary_push_title'
                    ),

                    'primaryPushUrl1' => array(
                        'label' => 'form.label_primary_push_url'
                    ),
                    'primaryPushUrl2' => array(
                        'label' => 'form.label_primary_push_url'
                    ),
                    'primaryPushUrl3' => array(
                        'label' => 'form.label_primary_push_url'
                    ),

                    'secondaryPushTitle1' => array(
                        'label' => 'form.label_secondary_push_title'
                    ),
                    'secondaryPushTitle2' => array(
                        'label' => 'form.label_secondary_push_title'
                    ),
                    'secondaryPushTitle3' => array(
                        'label' => 'form.label_secondary_push_title'
                    ),
                    'secondaryPushTitle4' => array(
                        'label' => 'form.label_secondary_push_title'
                    ),
                    'secondaryPushTitle5' => array(
                        'label' => 'form.label_secondary_push_title'
                    ),
                    'secondaryPushTitle6' => array(
                        'label' => 'form.label_secondary_push_title'
                    ),
                    'secondaryPushTitle7' => array(
                        'label' => 'form.label_secondary_push_title'
                    ),
                    'secondaryPushTitle8' => array(
                        'label' => 'form.label_secondary_push_title'
                    ),

                    'secondaryPushUrl1' => array(
                        'label' => 'form.label_secondary_push_url'
                    ),
                    'secondaryPushUrl2' => array(
                        'label' => 'form.label_secondary_push_url'
                    ),
                    'secondaryPushUrl3' => array(
                        'label' => 'form.label_secondary_push_url'
                    ),
                    'secondaryPushUrl4' => array(
                        'label' => 'form.label_secondary_push_url'
                    ),
                    'secondaryPushUrl5' => array(
                        'label' => 'form.label_secondary_push_url'
                    ),
                    'secondaryPushUrl6' => array(
                        'label' => 'form.label_secondary_push_url'
                    ),
                    'secondaryPushUrl7' => array(
                        'label' => 'form.label_secondary_push_url'
                    ),
                    'secondaryPushUrl8' => array(
                        'label' => 'form.label_secondary_push_url'
                    ),

                    'prefooterTitle1' => array(
                        'label' => 'form.label_prefooter_title'
                    ),
                    'prefooterTitle2' => array(
                        'label' => 'form.label_prefooter_title'
                    ),
                    'prefooterTitle3' => array(
                        'label' => 'form.label_prefooter_title'
                    ),
                    'prefooterTitle4' => array(
                        'label' => 'form.label_prefooter_title'
                    ),

                    'prefooterUrl1' => array(
                        'label' => 'form.label_prefooter_url'
                    ),
                    'prefooterUrl2' => array(
                        'label' => 'form.label_prefooter_url'
                    ),
                    'prefooterUrl3' => array(
                        'label' => 'form.label_prefooter_url'
                    ),
                    'prefooterUrl4' => array(
                        'label' => 'form.label_prefooter_url'
                    ),

                )
            ))
            ->add('topNewsType', 'choice', array(
                'label' => false,
                'choices' => array(0 => 'homepage.top_news_type.displayed_news', 1 => 'homepage.top_news_type.displayed_events'),
                'translation_domain' => 'BaseAdminBundle',
                'choice_translation_domain' => 'BaseAdminBundle',
                'expanded' => true
            ))
            ->add('displayedSlider','checkbox',array(
                'label' => 'form.label_display',
                'required' => false
            ))
            ->add('topVideosAssociated', 'sonata_type_collection', array(
                'label' => 'form.label_homepage_top_video_associated',
                'help' => 'form.homepage.helper_top_video_associated',
                'by_reference' => false,
                'required' => false,
            ), array(
                    'edit' => 'inline',
                    'inline' => 'table'
                )
            )
            ->add('filmsAssociated', 'sonata_type_collection', array(
                'label' => 'form.label_homepage_films_associated',
                'help' => 'form.homepage.helper_films_associated',
                'by_reference' => false,
                'required' => false,
            ), array(
                    'edit' => 'inline',
                    'inline' => 'table'
                )
            )
            ->add('topWebTvsAssociated', 'sonata_type_collection', array(
                'label' => 'form.label_homepage_top_web_tvs_associated',
                'help' => 'form.homepage.helper_top_web_tvs_associated',
                'by_reference' => false,
                'required' => false,
            ), array(
                    'edit' => 'inline',
                    'inline' => 'table'
                )
            )
            ->add('homepageSlide', 'sonata_type_collection', array(
                'label' => 'form.label_news_news_associated',
                'help' => 'form.homepage.helper_home_slider',
                'by_reference' => false,
                'required' => false,
            ), array(
                    'edit' => 'inline',
                    'inline' => 'table'
                )
            )
            ->add('displayedTopNews','checkbox',array(
                'label' => 'form.label_display',
                'required' => false
            ))
            ->add('displayedSocialWall','checkbox',array(
                'label' => 'form.label_display',
                'required' => false
            ))
            ->add('socialGraphHashtagTwitter', null, array(
                'sonata_help' => 'form.homepage.helper_social_graph',
                'translation_domain' => 'BaseAdminBundle'
            ))
            ->add('socialWallHashtags', null, array(
                'sonata_help' => 'form.homepage.helper_social_graph',
                'translation_domain' => 'BaseAdminBundle'
            ))
            ->add('pushsMainImage1', 'sonata_type_model_list', array(
                'label' => 'form.label_image_push',
                'required' => false,
            ))
            ->add('pushsMainImage2', 'sonata_type_model_list', array(
                'label' => 'form.label_image_push',
                'required' => false,
            ))
            ->add('pushsMainImage3', 'sonata_type_model_list', array(
                'label' => 'form.label_image_push',
                'required' => false,
            ))
            ->add('pushsSecondaryImage1', 'sonata_type_model_list', array(
                'label' => 'form.label_image_push',
                'required' => false,
            ))
            ->add('pushsSecondaryImage2', 'sonata_type_model_list', array(
                'label' => 'form.label_image_push',
                'required' => false,
            ))
            ->add('pushsSecondaryImage3', 'sonata_type_model_list', array(
                'label' => 'form.label_image_push',
                'required' => false,
            ))
            ->add('pushsSecondaryImage4', 'sonata_type_model_list', array(
                'label' => 'form.label_image_push',
                'required' => false,
            ))
            ->add('pushsSecondaryImage5', 'sonata_type_model_list', array(
                'label' => 'form.label_image_push',
                'required' => false,
            ))
            ->add('pushsSecondaryImage6', 'sonata_type_model_list', array(
                'label' => 'form.label_image_push',
                'required' => false,
            ))
            ->add('pushsSecondaryImage7', 'sonata_type_model_list', array(
                'label' => 'form.label_image_push',
                'required' => false,
            ))
            ->add('pushsSecondaryImage8', 'sonata_type_model_list', array(
                'label' => 'form.label_image_prefooter',
                'required' => false,
            ))
            ->add('prefooterImage1', 'sonata_type_model_list', array(
                'label' => 'form.label_image_prefooter',
                'required' => false,
            ))
            ->add('prefooterImage2', 'sonata_type_model_list', array(
                'label' => 'form.label_image_prefooter',
                'required' => false,
            ))
            ->add('prefooterImage3', 'sonata_type_model_list', array(
                'label' => 'form.label_image_prefooter',
                'required' => false,
            ))
            ->add('prefooterImage4', 'sonata_type_model_list', array(
                'label' => 'form.label_image_prefooter',
                'required' => false,
            ))
            ->add('displayedPushsMain','checkbox',array(
                'label' => 'form.label_display',
                'required' => false
            ))
            ->add('displayedPushsSecondary','checkbox',array(
                'label' => 'form.label_display',
                'required' => false
            ))
            ->add('displayedPrefooters','checkbox',array(
                'label' => 'form.label_display',
                'required' => false
            ))
            ->add('displayedFilms','checkbox',array(
                'label' => 'form.label_display',
                'required' => false
            ))
            ->add('displayedTopWebTv','checkbox',array(
                'label' => 'form.label_display',
                'required' => false
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
