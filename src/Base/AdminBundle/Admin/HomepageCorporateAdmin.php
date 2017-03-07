<?php

namespace Base\AdminBundle\Admin;

use Base\CoreBundle\Entity\HomepageCorporate;
use Base\CoreBundle\Entity\HomepageCorporateTranslation;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class HomepageCorporateAdmin extends Admin
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
            ->add('festivalStartsAt')
            ->add('festivalEndsAt')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('festivalStartsAt')
            ->add('festivalEndsAt')
            ->add('displayedPopin')
            ->add('displayedBanner')
            ->add('displayedSlider')
            ->add('displayedFeaturedContents')
            ->add('displayedFeaturedContentsFilters')
            ->add('displayedCannesReleases')
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
                    'popinSubtitle1' => array(
                        'label' => 'form.homepage_corporate.label_subtitle_1',
                        'sonata_help' => 'Couleur blanche',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'popinSubtitle2' => array(
                        'label' => 'form.homepage_corporate.label_subtitle_2',
                        'sonata_help' => 'Couleur dorée',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'bannerText' => array(
                        'label' => 'form.homepage_corporate.label_banner_text',
//                        'sonata_help' => 'X caractères max.',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'pushEditionTitle' => array(
                        'label' => 'form.homepage_corporate.label_title',
//                        'sonata_help' => 'X caractères max.',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'pushEditionUrl' => array(
                        'label' => 'form.homepage_corporate.label_url',
                        'sonata_help' => 'Interne ou externe. Commence par http://',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'pushMainTitle1' => array(
                        'label' => 'form.homepage_corporate.label_title',
//                        'sonata_help' => 'X caractères max.',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,

                    ),
                    'pushMainSubtitle1' => array(
                        'label' => 'form.homepage_corporate.label_subtitle',
//                        'sonata_help' => 'X caractères max.',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,

                    ),
                    'pushMainUrl1' => array(
                        'label' => 'form.homepage_corporate.label_url',
                        'sonata_help' => 'Interne ou externe. Commence par http://',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'pushMainTitle2' => array(
                        'label' => 'form.homepage_corporate.label_subtitle',
//                        'sonata_help' => 'X caractères max.',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'pushMainSubtitle2' => array(
                        'label' => 'form.homepage_corporate.label_subtitle',
//                        'sonata_help' => 'X caractères max.',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,

                    ),
                    'pushMainUrl2' => array(
                        'label' => 'form.homepage_corporate.label_url',
                        'sonata_help' => 'Interne ou externe. Commence par http://',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'pushSecondaryTitle1' => array(
                        'label' => 'form.homepage_corporate.label_title',
//                        'sonata_help' => 'X caractères max.',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'pushSecondaryUrl1' => array(
                        'label' => 'form.homepage_corporate.label_url',
                        'sonata_help' => 'Interne ou externe. Commence par http://',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'pushSecondaryTitle2' => array(
                        'label' => 'form.homepage_corporate.label_title',
//                        'sonata_help' => 'X caractères max.',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'pushSecondaryUrl2' => array(
                        'label' => 'form.homepage_corporate.label_url',
                        'sonata_help' => 'Interne ou externe. Commence par http://',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'pushSecondaryTitle3' => array(
                        'label' => 'form.homepage_corporate.label_title',
//                        'sonata_help' => 'X caractères max.',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false
                    ),
                    'pushSecondaryUrl3' => array(
                        'label' => 'form.homepage_corporate.label_url',
                        'sonata_help' => 'Interne ou externe. Commence par http://',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'status' => array(
                        'label' => 'form.label_status',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'choice',
                        'choices' => HomepageCorporateTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle'
                    )
                )
            ))
            ->add('festivalStartsAt', 'sonata_type_datetime_picker', array(
                'label' => 'Date d\'ouverture du festival',
                'format' => 'dd/MM/yyyy HH:mm',
                'required' => false,
                'attr' => array(
                    'data-date-format' => 'dd/MM/yyyy HH:mm',
                )
            ))
            ->add('displayedPopin', 'checkbox', array(
                'label'    => 'Ne pas afficher la pop-in',
                'required' => false,
            ))
            ->add('displayedVideo', 'checkbox', array(
                'label'    => 'Ne pas afficher cette strate',
                'required' => false,
            ))
            ->add('displayedBanner', 'checkbox', array(
                'label'    => 'Ne pas afficher le bandeau',
                'required' => false,
            ))
            ->add('displayedSlider', 'checkbox', array(
                'label'    => 'Ne pas afficher cette strate',
                'required' => false,
            ))
            ->add('displayedFeaturedContentsFilters', 'checkbox', array(
                'label'    => 'Ne pas afficher les filtres',
                'required' => false,
            ))
            ->add('displayedFeaturedContents', 'checkbox', array(
                'label'    => 'Ne pas afficher cette strate',
                'required' => false,
            ))
            ->add('displayedCannesReleases', 'checkbox', array(
                'label'    => 'Ne pas afficher cette strate',
                'required' => false,
            ))
            ->add('displayedPushEdition', 'checkbox', array(
                'label'    => 'Ne pas afficher cette strate',
                'required' => false,
            ))
            ->add('displayedPushsMain', 'checkbox', array(
                'label'    => 'Ne pas afficher cette strate',
                'required' => false,
            ))
            ->add('displayedPushsSecondary', 'checkbox', array(
                'label'    => 'Ne pas afficher cette strate',
                'required' => false,
            ))
            ->add('displayedGallery', 'checkbox', array(
                'label'    => 'Ne pas afficher cette strate',
                'required' => false,
            ))
            ->add('pushEditionImage', 'sonata_type_model_list', array(
                'label' => 'form.label_image_push',
                'help' => 'form.homepage.helper_prefooter',
                'required' => false,
            ))
            ->add('pushMainImage1', 'sonata_type_model_list', array(
                'label' => 'form.label_image_push',
                'help' => 'form.homepage.helper_pushes',
                'required' => false,
            ))
            ->add('pushMainImage2', 'sonata_type_model_list', array(
                'label' => 'form.label_image_push',
                'help' => 'form.homepage.helper_pushes',
                'required' => false,
            ))
            ->add('VideoUne', 'sonata_type_model_list', array(
                'label' => 'Vidéo à la une',
                'required' => false,
            ))
            ->add('pushSecondaryImage1', 'sonata_type_model_list', array(
                'label' => 'form.label_image_push',
                'help' => 'form.homepage.helper_pushes_351x222',
                'required' => false,
            ))
            ->add('pushSecondaryImage2', 'sonata_type_model_list', array(
                'label' => 'form.label_image_push',
                'help' => 'form.homepage.helper_pushes_351x222',
                'required' => false,
            ))
            ->add('pushSecondaryImage3', 'sonata_type_model_list', array(
                'label' => 'form.label_image_push',
                'help' => 'form.homepage.helper_pushes_703x443',
                'required' => false,
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
            ->add('homepageSlide', 'sonata_type_collection', array(
                'label' => 'Communiqués et infos associées',
                'help' => 'Sélectionnez de 3 à 6 communiqués ou infos. Ils apparaitront en front-office dans l\'ordre des lignes',
                'by_reference' => false,
                'required' => false,
            ), array(
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable'  => 'position'
                )
            )
            ->add('translate', null, array(
                'label' => 'form.label_translate',
            ))
            ->add('translateOptions', 'choice', array(
                'choices' => HomepageCorporate::getAvailableTranslateOptions(),
                'translation_domain' => 'BaseAdminBundle',
                'multiple' => true,
                'expanded' => true,
            ))
            ->add('priorityStatus', 'choice', array(
                'choices'                   => HomepageCorporate::getPriorityStatuses(),
                'choice_translation_domain' => 'BaseAdminBundle',
                'label'                     => 'form.label_priority_status',
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
            ->add('festivalStartsAt')
            ->add('festivalEndsAt')
            ->add('displayedPopin')
            ->add('displayedBanner')
            ->add('displayedSlider')
            ->add('displayedSliderFilters')
            ->add('displayedCannesReleases')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('translate')
            ->add('translateOptions')
            ->add('priorityStatus')
        ;
    }
}
