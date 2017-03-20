<?php

namespace Base\AdminBundle\Admin\CCM;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Debug\Exception\FatalErrorException;
use Symfony\Component\Routing\Router;
use Symfony\Component\Validator\Constraints\NotBlank;
use FDC\CourtMetrageBundle\Entity\CcmParticiperPageTranslation;
use Symfony\Component\Validator\Constraints\Url;

class CcmParticiperPageAdmin extends Admin
{
    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'DESC',
        '_sort_by' => 'id'
    );

    protected $translationDomain = 'BaseAdminBundle';

    protected $ccmDomain;

    /**
     * @var Router
     */
    protected $router;

    /**
     * @param string $domain
     */
    public function setCcmDomain($domain)
    {
        $this->ccmDomain = $domain;
    }

    /**
     * @param Router $router
     */
    public function setRouter($router)
    {
        $this->router = $router;
    }


    public function configure()
    {
        $this->setTemplate('edit', 'BaseAdminBundle:CRUD:edit_polycollection.html.twig');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('title', 'doctrine_orm_callback', array(
                'callback'   => function ($queryBuilder, $alias, $field, $value) {
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
                'field_type' => 'text',
                'label' => 'Titre de la page',
            ))
        ;
        $datagridMapper = $this->addCreatedBetweenFilters($datagridMapper);
        $datagridMapper = $this->addUpdatedBetweenFilters($datagridMapper);
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id', null, array(
                    'label' => 'list.ccm.id'
                )
            )
            ->add('title', null, array(
                'template' => 'BaseAdminBundle:News:list_title.html.twig',
                'label' => 'list.ccm.participer.title',
            ))
            ->add('createdAt', null, array(
                    'template' => 'BaseAdminBundle:TranslateMain:list_created_at.html.twig',
                    'sortable' => 'createdAt',
                    'label' => 'list.ccm.participer.date_creation'
                )
            )
            ->add('updatedAt', null, array(
                    'template' => 'BaseAdminBundle:TranslateMain:list_created_at.html.twig',
                    'sortable' => 'updatedAt',
                    'label' => 'list.ccm.participer.date_update'
                )
            )
            ->add('_edit_translations', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_edit_translations.html.twig',
                'label' => 'list.ccm.participer.edit'
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        /** @var CcmParticiperPageTranslation $trans */
        $trans = $this->getSubject()->findTranslationByLocale('fr');
        $slug = $trans ? $trans->getSlug() : null;
        $url = 'http://' . $this->ccmDomain . $this->router->generate('fdc_court_metrage_participer_page', ['slug' => $slug ? $slug : 'page-slug']);

        $formMapper
            ->add('translations', 'a2lix_translations', array(
                    'locales' => ['fr','en'],
                    'label'  => false,
                    'fields' => array(
                        'applyChanges'      => array(
                            'field_type' => 'hidden',
                            'attr'       => array(
                                'class' => 'hidden',
                            ),
                        ),
                        'title'          => array(
                            'label'              => 'form.ccm.label.participer.page_title',
                            'translation_domain' => 'BaseAdminBundle',
                            'constraints'        => array(
                                new NotBlank(),
                            ),
                            'required' => true
                        ),
                        'name'          => array(
                            'label'              => 'form.ccm.label.participer.page_name',
                            'translation_domain' => 'BaseAdminBundle',
                            'constraints'        => array(
                                new NotBlank(),
                            ),
                            'required' => true
                        ),
                        'slug'          => array(
                            'label'              => 'form.ccm.label.participer.page_slug',
                            'sonata_help'        => 'L\'url sera: ' . $url,
                            'translation_domain' => 'BaseAdminBundle',
                            'constraints'        => array(
                                new NotBlank(),
                                new Url()
                            ),
                            'required' => true
                        ),
                        'createdAt'         => array(
                            'display' => false,
                        ),
                        'updatedAt'         => array(
                            'display' => false,
                        ),
                        'seoTitle' => array(
                            'attr' => array(
                                'placeholder' => 'group.ccm.placeholder_seo_title'
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

                        ),
                        'status'            => array(
                            'label'                     => 'form.ccm.label_status',
                            'translation_domain'        => 'BaseAdminBundle',
                            'field_type'                => 'choice',
                            'choices'                   => CcmParticiperPageTranslation::getStatuses(),
                            'choice_translation_domain' => 'BaseAdminBundle',
                        ),
                    ),
                )
            )
            ->add('seoFile', 'sonata_media_type', array(
                'provider' => 'sonata.media.provider.image',
                'context' => 'seo_file',
                'help' => 'form.seo.helper_file',
                'required' => false,
            ))
            ->add('image', 'sonata_type_model_list',array(
                    'label' => 'form.ccm.label.participer.page_image',
                    'constraints'        => array(
                        new NotBlank(),
                    ),
                    'required' => true
                )
            )
            ->add('pageLayersCollection', 'sonata_type_collection', array(
                'by_reference'       => false,
                'required' => false,
                'label'              => 'form.ccm.label.participer.layers_list',
                'translation_domain' => 'BaseAdminBundle',
            ), array(
                    'edit'     => 'inline',
                    'inline'   => 'table',
                    'sortable' => 'position',
                )
            )->end()
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('name');
    }
}