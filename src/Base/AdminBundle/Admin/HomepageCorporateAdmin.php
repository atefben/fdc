<?php

namespace Base\AdminBundle\Admin;

use Base\CoreBundle\Entity\HomepageCorporate;
use Base\CoreBundle\Entity\HomepageCorporateTranslation;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

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
            ->add('displayedSliderFilters')
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
                        'label' => 'Sous-titre 1',
                        'sonata_help' => 'X caractères max. Couleur blanche',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'popinSubtitle2' => array(
                        'label' => 'Sous-titre 2',
                        'sonata_help' => 'X caractères max. Couleur dorée',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'bannerText' => array(
                        'label' => 'Texte du bandeau',
                        'sonata_help' => 'X caractères max.',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'pushEditionTitle' => array(
                        'label' => 'Titre',
                        'sonata_help' => 'X caractères max.',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'pushEditionUrl' => array(
                        'label' => 'URL de destination',
                        'sonata_help' => 'Interne ou externe. Commence par http://',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'pushMainTitle1' => array(
                        'label' => 'Titre',
                        'sonata_help' => 'X caractères max.',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,

                    ),
                    'pushMainUrl1' => array(
                        'label' => 'URL de destination',
                        'sonata_help' => 'Interne ou externe. Commence par http://',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'pushMainTitle2' => array(
                        'label' => 'Titre',
                        'sonata_help' => 'X caractères max.',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'pushMainUrl2' => array(
                        'label' => 'URL de destination',
                        'sonata_help' => 'Interne ou externe. Commence par http://',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'pushSecondaryTitle1' => array(
                        'label' => 'Titre',
                        'sonata_help' => 'X caractères max.',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'pushSecondaryUrl1' => array(
                        'label' => 'URL de destination',
                        'sonata_help' => 'Interne ou externe. Commence par http://',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'pushSecondaryTitle2' => array(
                        'label' => 'Titre',
                        'sonata_help' => 'X caractères max.',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'pushSecondaryUrl2' => array(
                        'label' => 'URL de destination',
                        'sonata_help' => 'Interne ou externe. Commence par http://',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'pushSecondaryTitle3' => array(
                        'label' => 'Titre',
                        'sonata_help' => 'X caractères max.',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false
                    ),
                    'pushSecondaryUrl3' => array(
                        'label' => 'URL de destination',
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
            ->add('displayedBanner', 'checkbox', array(
                'label'    => 'Ne pas afficher le bandeau',
                'required' => false,
            ))
            ->add('displayedSlider', 'checkbox', array(
                'label'    => 'Ne pas afficher cette strate',
                'required' => false,
            ))
            ->add('displayedSliderFilters', 'checkbox', array(
                'label'    => 'Ne pas afficher les filtres',
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
            ->add('pushEditionImage', 'sonata_type_model_list', array(
                'label' => 'form.label_image_push',
                'help' => 'form.homepage.helper_pushes',
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
            ->add('pushSecondaryImage1', 'sonata_type_model_list', array(
                'label' => 'form.label_image_push',
                'help' => 'form.homepage.helper_pushes',
                'required' => false,
            ))
            ->add('pushSecondaryImage2', 'sonata_type_model_list', array(
                'label' => 'form.label_image_push',
                'help' => 'form.homepage.helper_pushes',
                'required' => false,
            ))
            ->add('pushSecondaryImage3', 'sonata_type_model_list', array(
                'label' => 'form.label_image_push',
                'help' => 'form.homepage.helper_pushes',
                'required' => false,
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
            ->add('translate')
            ->add('translateOptions', 'choice', array(
                'choices' => HomepageCorporate::getAvailableTranslateOptions(),
                'translation_domain' => 'BaseAdminBundle',
                'multiple' => true,
                'expanded' => true
            ))
            ->add('priorityStatus', 'choice', array(
                'choices'                   => HomepageCorporate::getPriorityStatuses(),
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
