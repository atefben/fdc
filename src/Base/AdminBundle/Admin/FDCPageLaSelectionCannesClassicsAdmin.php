<?php

namespace Base\AdminBundle\Admin;

use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassics;
use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsTranslation;
use Base\CoreBundle\Entity\MediaVideo;
use Base\CoreBundle\Entity\MediaVideoTranslation;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class FDCPageLaSelectionCannesClassicsAdmin extends Admin
{
    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'DESC',
        '_sort_by' => 'id'
    );

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('show');
        $collection->remove('export');
    }

    protected $formOptions = array(
        'cascade_validation' => true
    );

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

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('title', 'doctrine_orm_callback', array(
                'callback' => function ($queryBuilder, $alias, $field, $value) {
                    if (!$value['value']) {
                        return;
                    }
                    $queryBuilder->join("{$alias}.translations", 't');
                    $queryBuilder->andWhere('t.locale = :locale');
                    $queryBuilder->setParameter('locale', 'fr');
                    $queryBuilder->andWhere('t.title LIKE :title');
                    $queryBuilder->setParameter('title', '%' . $value['value'] . '%');

                    return true;
                },
                'field_type' => 'text'
            ));
        $datagridMapper = $this->addCreatedBetweenFilters($datagridMapper);
        $datagridMapper = $this->addStatusFilter($datagridMapper);
        $datagridMapper = $this->addPriorityFilter($datagridMapper);
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('title', null, array('template' => 'BaseAdminBundle:FDCPageLaSelectionCannesClassics:list_title.html.twig'))
            ->add('weight', null, array('label' => 'Position'))
            ->add('createdAt', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_created_at.html.twig',
                'sortable' => 'createdAt',
            ))
            ->add('priorityStatus', 'choice', array(
                'choices' => MediaVideo::getPriorityStatusesList(),
                'catalogue' => 'BaseAdminBundle'
            ))
            ->add('statusMain', 'choice', array(
                'choices' => MediaVideoTranslation::getStatuses(),
                'catalogue' => 'BaseAdminBundle',
            ))
            ->add('_edit_translations', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_edit_translations.html.twig'
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
                'label' => false,
                'translation_domain' => 'BaseAdminBundle',
                'required_locales' => $requiredLocales,
                'fields' => array(
                    'applyChanges' => array(
                        'field_type' => 'hidden',
                        'attr' => array(
                            'class' => 'hidden'
                        )
                    ),
                    'status' => array(
                        'label' => 'form.label_status',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'choice',
                        'choices' => FDCPageLaSelectionCannesClassicsTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle'
                    ),
                    'titleNav' => array(
                        'label' => 'form.fdc_page_la_selection_cannes_classics.title_nav',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                        'sonata_help' => 'form.fdc_page_la_selection_cannes_classics.helper_titleNav'
                    ),
                    'title' => array(
                        'label' => 'form.fdc_page_la_selection_cannes_classics.title',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'hideTitle' => array(
                        'label' => 'form.fdc_page_la_selection_cannes_classics.hide_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                        'sonata_help' => 'form.fdc_page_la_selection_cannes_classics.helper_hide_title'
                    ),
                    'seoTitle' => array(
                        'attr' => array(
                            'placeholder' => 'form.fdc_page_web_tv_trailers.placeholder_seo_title'
                        ),
                        'label' => 'form.label_seo_title',
                        'sonata_help' => 'form.news.helper_seo_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'seoDescription' => array(
                        'attr' => array(
                            'placeholder' => 'form.fdc_page_web_tv_trailers.placeholder_seo_description'
                        ),
                        'label' => 'form.label_seo_description',
                        'sonata_help' => 'form.news.helper_description',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'createdAt' => array(
                        'display' => false
                    ),
                    'updatedAt' => array(
                        'display' => false
                    ),
                )
            ))
            ->add('sites', null, array(
                'label' => 'form.label_publish_on',
                'class' => 'BaseCoreBundle:Site',
                'multiple' => true,
                'expanded' => true,
            ))
            ->add('publishedAt', 'sonata_type_datetime_picker', array(
                'format' => 'dd/MM/yyyy HH:mm',
                'required' => false,
                'attr' => array(
                    'data-date-format' => 'dd/MM/yyyy HH:mm',
                ),
            ))
            ->add('publishEndedAt', 'sonata_type_datetime_picker', array(
                'format' => 'dd/MM/yyyy HH:mm',
                'required' => false,
                'attr' => array(
                    'data-date-format' => 'dd/MM/yyyy HH:mm',
                ),
            ))
            ->add('image', 'sonata_type_model_list', array(
                'label' => 'form.fdc_page_web_tv_trailers.image',
                'help' => 'form.fdc_page_web_tv_trailers.helper_image',
                'required' => false,
            ))
            ->add('weight', null, array(
                'label' => 'Position',
            ))
            ->add('widgets', 'infinite_form_polycollection', array(
                'label' => false,
                'types' => array(
                    'fdc_page_la_selection_cannes_classics_widget_text_type',
                    'fdc_page_la_selection_cannes_classics_widget_quote_type',
                    'fdc_page_la_selection_cannes_classics_widget_audio_type',
                    'fdc_page_la_selection_cannes_classics_widget_image_type',
                    'fdc_page_la_selection_cannes_classics_widget_image_dual_align_type',
                    'fdc_page_la_selection_cannes_classics_widget_video_type',
                    'fdc_page_la_selection_cannes_classics_widget_video_youtube_type',
                    'fdc_page_la_selection_cannes_classics_widget_subtitle_type',
                    'fdc_page_la_selection_cannes_classics_widget_intro_type',
                    'fdc_page_la_selection_cannes_classics_widget_movie_type'

                ),
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false,
            ))
            ->add('seoFile', 'sonata_media_type', array(
                'provider' => 'sonata.media.provider.image',
                'context' => 'seo_file',
                'help' => 'form.seo.helper_file',
                'required' => false
            ))
            ->add('translate')
            ->add('translateOptions', 'choice', array(
                'choices' => FDCPageLaSelectionCannesClassics::getAvailableTranslateOptions(),
                'translation_domain' => 'BaseAdminBundle',
                'multiple' => true,
                'expanded' => true
            ))
            ->add('priorityStatus', 'choice', array(
                'choices' => FDCPageLaSelectionCannesClassics::getPriorityStatuses(),
                'choice_translation_domain' => 'BaseAdminBundle',
            ))
            // must be added to display informations about creation user / date, update user / date (top of right sidebar)
            ->add('createdAt', null, array(
                'label' => false,
                'attr' => array(
                    'class' => 'hidden'
                )
            ))
            ->add('createdBy', null, array(
                'label' => false,
                'attr' => array(
                    'class' => 'hidden'
                )
            ))
            ->add('updatedAt', null, array(
                'label' => false,
                'attr' => array(
                    'class' => 'hidden'
                )
            ))
            ->add('updatedBy', null, array(
                'label' => false,
                'attr' => array(
                    'class' => 'hidden'
                )
            ));
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id');
    }

    public function prePersist($object)
    {
        $this->preUpdate($object);
    }

    public function preUpdate($object)
    {
        $date = $object->getPublishedAt()->format('Y');
        $em = $this->getConfigurationPool()->getContainer()->get('Doctrine')->getManager();
        $result = $em->getRepository('BaseCoreBundle:FilmFestival')->findOneBy(array('year' => $date));
        $object->setFestival($result);
    }


}
