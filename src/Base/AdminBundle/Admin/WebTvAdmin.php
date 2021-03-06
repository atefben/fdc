<?php

namespace Base\AdminBundle\Admin;

use Base\CoreBundle\Entity\WebTv;
use Base\CoreBundle\Entity\WebTvTranslation;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Validator\Constraints\NotBlank;

class WebTvAdmin extends Admin
{
    protected $formOptions = array(
        'cascade_validation' => true
    );

    protected $translationDomain = 'BaseAdminBundle';

    public function configure()
    {
        $this->setTemplate('edit', 'BaseAdminBundle:CRUD:edit_form.html.twig');
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('name', 'doctrine_orm_callback', array(
                'callback'           => function ($queryBuilder, $alias, $field, $value) {
                    if (!$value['value']) {
                        return;
                    }
                    $queryBuilder->join("{$alias}.translations", 't');
                    $queryBuilder->andWhere('t.locale = :locale');
                    $queryBuilder->setParameter('locale', 'fr');
                    $queryBuilder->andWhere('t.name LIKE :name');
                    $queryBuilder->setParameter('name', '%' . $value['value'] . '%');

                    return true;
                },
                'field_type'         => 'text',
                'label'              => 'filter.label_web_tv_name',
                'translation_domain' => 'BaseAdminBundle',
            ))
            ->add('priorityStatus', 'doctrine_orm_callback', array(
                'callback'      => function ($queryBuilder, $alias, $field, $value) {
                    if (!$value['value']) {
                        return;
                    }
                    $queryBuilder->andWhere('o.priorityStatus LIKE :priorityStatus');
                    $queryBuilder->setParameter('priorityStatus', '%' . $value['value'] . '%');

                    return true;
                },
                'field_type'    => 'choice',
                'field_options' => array(
                    'choices'                   => WebTv::getPriorityStatusesList(),
                    'choice_translation_domain' => 'BaseAdminBundle'
                ),
            ))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('name', null, array(
                'template'           => 'BaseAdminBundle:WebTv:list_name.html.twig',
                'label'              => 'list.label_web_tv_name',
                'translation_domain' => 'BaseAdminBundle',
            ))
            ->add('priorityStatus', 'choice', array(
                'choices'   => WebTv::getPriorityStatusesList(),
                'catalogue' => 'BaseAdminBundle',
            ))
            ->add('_edit_translations', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_edit_translations.html.twig',
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
                    'name'           => array(
                        'label'              => 'form.label_web_tv_name',
                        'sonata_help'        => 'form.web_tv.helper_name',
                        'translation_domain' => 'BaseAdminBundle',
                        'constraints'        => array(
                            new NotBlank(),
                        ),
                        'attr' => array(
                            'maxlength' => 30
                        )
                    ),
                    'status'         => array(
                        'label'                     => 'form.label_status',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices'                   => WebTvTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle'
                    ),
                    'seoTitle'       => array(
                        'attr'               => array(
                            'placeholder' => 'form.placeholder_seo_title'
                        ),
                        'label'              => 'form.label_seo_title',
                        'sonata_help'        => 'form.new.helper_seo_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false,
                    ),
                    'seoDescription' => array(
                        'attr'               => array(
                            'placeholder' => 'form.placeholder_seo_description'
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
                    )
                )
            ))
            ->add('seoFile', 'sonata_media_type', array(
                'provider' => 'sonata.media.provider.image',
                'context'  => 'seo_file',
                'help'     => 'form.seo.helper_file',
                'required' => false
            ))
            ->add('image', 'sonata_type_model_list', array(
                'help'     => 'form.web_tv.helper_image',
                'required' => false,
            ))
            ->add('translate')
            ->add('translateOptions', 'choice', array(
                'choices'            => WebTv::getAvailableTranslateOptions(),
                'translation_domain' => 'BaseAdminBundle',
                'multiple'           => true,
                'expanded'           => true
            ))
            ->add('priorityStatus', 'choice', array(
                'choices'                   => WebTv::getPriorityStatuses(),
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

    public function getExportFields()
    {
        return array(
            'Id'                      => 'id',
            'Nom de la chaîne master' => 'exportName',
            'Date de création'        => 'exportCreatedAt',
            'Date de modification'    => 'exportUpdatedAt',
            'Statut master'           => 'exportStatusMaster',
            'Traduction en'           => 'exportTranslationEn',
            'Statut en'               => 'exportStatusEn',
            'Traduction es'           => 'exportTranslationEs',
            'Statut es'               => 'exportStatusEs',
            'Traduction zh'           => 'exportTranslationZh',
            'Statut zh'               => 'exportStatusZh',
        );
    }
}
