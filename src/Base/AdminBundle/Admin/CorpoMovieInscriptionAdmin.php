<?php

namespace Base\AdminBundle\Admin;

use Base\CoreBundle\Entity\PressAccreditTranslation;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Base\CoreBundle\Entity\PressAccredit;

class CorpoMovieInscriptionAdmin extends Admin
{
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
            ->add('hideCommonContent')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('translate')
            ->add('translateOptions')
            ->add('priorityStatus')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('hideCommonContent')
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
                    'commonContent' => array(
                        'field_type' => 'ckeditor',
                        'label' => 'form.label_content',
                        'translation_domain' => 'BaseAdminBundle',
                        'config_name' => 'press'
                    ),
                    'status' => array(
                        'label' => 'form.label_status',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'choice',
                        'choices' => PressAccreditTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle'
                    ),
                    'tabPrefix' => array(
                        'label' => 'form.corpo_movie_inscription_tab_prefix',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'text',
                        'required' => false,
                    ),
                    'seoTitle' => array(
                        'attr' => array(
                            'placeholder' => 'form.placeholder_seo_title'
                        ),
                        'label' => 'form.label_seo_title',
                        'sonata_help' => 'form.news.helper_seo_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false
                    ),
                    'seoDescription' => array(
                        'attr' => array(
                            'placeholder' => 'form.placeholder_seo_description'
                        ),
                        'label' => 'form.label_seo_description',
                        'sonata_help' => 'form.news.helper_description',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false

                    )
                )
            ))
            ->add('seoFile', 'sonata_media_type', array(
                'provider' => 'sonata.media.provider.image',
                'context'  => 'seo_file',
                'help' => 'form.seo.helper_file',
                'required' => false,
            ))
            ->add('mainImage', 'sonata_type_model_list', array(
                'label' => 'form.label_image'
            ))
            ->add('procedure', 'sonata_type_collection',
                array(
                    'type_options' => array(
                        'delete' => true,
                    ),
                    'cascade_validation' => true,
                    'by_reference' => false,
                    'label' => 'form.label_accredit_procedure_movie',
                    'required' => false
                ),
                array(
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable'  => 'position',
                )
            )->remove('delete')
            ->add('translate')
            ->add('translateOptions', 'choice', array(
                'choices'            => PressAccredit::getAvailableTranslateOptions(),
                'translation_domain' => 'BaseAdminBundle',
                'multiple'           => true,
                'expanded'           => true
            ))
            ->add('priorityStatus', 'choice', array(
                'choices'                   => PressAccredit::getPriorityStatuses(),
                'choice_translation_domain' => 'BaseAdminBundle',
            ))
            ->end()
        ;
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('hideCommonContent')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('translate')
            ->add('translateOptions')
            ->add('priorityStatus')
        ;
    }
}
