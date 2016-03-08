<?php

namespace Base\AdminBundle\Admin;

use Base\CoreBundle\Entity\FDCPageWebTvLive;
use Base\CoreBundle\Entity\FDCPageWebTvLiveTranslation;
use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class FDCPageWebTvLiveAdmin extends Admin
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
        $datagridMapper->add('id');
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
                'label'              => false,
                'translation_domain' => 'BaseAdminBundle',
                'required_locales'   => array('fr'),
                'fields'             => array(
                    'status'         => array(
                        'label'                     => 'form.label_status',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices'                   => FDCPageWebTvLiveTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle'
                    ),
                    'title'          => array(
                        'label'              => 'form.fdc_page_web_tv_live.label_title',
                        'field_type'         => 'text',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false,
                    ),
                    'firstSubHead'   => array(
                        'label'              => 'form.fdc_page_web_tv_live.label_first_sub_head',
                        'sonata_help'        => 'form.fdc_page_web_tv_live.helper_first_sub_head',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false,
                    ),
                    'secondSubHead'  => array(
                        'label'              => 'form.fdc_page_web_tv_live.label_second_sub_head',
                        'sonata_help'        => 'form.fdc_page_web_tv_live.helper_second_sub_head',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false,
                    ),
                    'directUrl'      => array(
                        'field_type'         => 'text',
                        'label'              => 'form.fdc_page_web_tv_live.label_direct_url',
                        'sonata_help'        => 'form.fdc_page_web_tv_live.helper_direct_url',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false,
                    ),
                    'teaserUrl'      => array(
                        'field_type'         => 'text',
                        'label'              => 'form.fdc_page_web_tv_live.label_teaser_url',
                        'sonata_help'        => 'form.fdc_page_web_tv_live.helper_teaser_url',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false,
                    ),
                    'seoTitle'       => array(
                        'attr'               => array(
                            'placeholder' => 'form.fdc_page_web_tv_live.placeholder_seo_title'
                        ),
                        'label'              => 'form.label_seo_title',
                        'sonata_help'        => 'form.news.helper_seo_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false,
                    ),
                    'seoDescription' => array(
                        'attr'               => array(
                            'placeholder' => 'form.fdc_page_web_tv_live.placeholder_seo_description'
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
            ->add('live', 'choice', array(
                'label'                     => false,
                'choices'                   => array(
                    0 => 'form.fdc_page_web_tv_live.live_false',
                    1 => 'form.fdc_page_web_tv_live.live_true',
                ),
                'expanded'                  => true,
                'multiple'                  => false,
                'choice_translation_domain' => 'BaseAdminBundle',
                'translation_domain'        => 'BaseAdminBundle',
            ))
            ->add('seoFile', 'sonata_media_type', array(
                'provider' => 'sonata.media.provider.image',
                'context'  => 'seo_file',
                'help'     => 'form.seo.helper_file',
                'required' => false
            ))
            ->add('image', 'sonata_type_model_list', array(
                'label'    => 'form.fdc_page_web_tv_live.image',
                'help'     => 'form.fdc_page_web_tv_live.helper_image',
                'required' => false,
            ))
            ->add('associatedWebTvs', 'sonata_type_collection', array(
                'label'        => 'form.fdc_page_web_tv_live.label_web_tvs_associated',
                'help'         => 'form.fdc_page_web_tv_live.helper_web_tvs_associated',
                'by_reference' => false,
                'required'     => false,
            ), array(
                    'edit'   => 'inline',
                    'inline' => 'table',
                    'sortable' => 'position',
                )
            )
            ->add('associatedMediaVideos', 'sonata_type_collection', array(
                'label'        => 'form.fdc_page_web_tv_live.label_media_videos_associated',
                'help'         => 'form.fdc_page_web_tv_live.helper_media_videos_associated',
                'by_reference' => false,
                'required'     => false,
            ), array(
                    'edit'   => 'inline',
                    'inline' => 'table',
                    'sortable' => 'position',
                )
            )
            ->add('doNotDisplayWebTvArea', 'checkbox', array(
                'label'    => 'form.fdc_page_web_tv_live.label_display_web_tv_area',
                'required' => false,
            ))
            ->add('doNotDisplayTrailerArea', 'checkbox', array(
                'label'    => 'form.fdc_page_web_tv_live.label_display_trailer_area',
                'required' => false,
            ))
            ->add('doNotDisplayLastVideosArea', 'checkbox', array(
                'label'    => 'form.fdc_page_web_tv_live.label_display_last_video_area',
                'required' => false,
            ))
            ->add('translate')
            ->add('translateOptions', 'choice', array(
                'choices'            => FDCPageWebTvLive::getAvailableTranslateOptions(),
                'translation_domain' => 'BaseAdminBundle',
                'multiple'           => true,
                'expanded'           => true
            ))
            ->add('priorityStatus', 'choice', array(
                'choices'                   => FDCPageWebTvLive::getPriorityStatuses(),
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
            ->add('id');
    }

    public function configure()
    {
        $this->setTemplate('edit', 'BaseAdminBundle:CRUD:edit_form.html.twig');
    }
}
