<?php

namespace Base\AdminBundle\Admin\CCM;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Validator\Constraints\NotBlank;
use FDC\CourtMetrageBundle\Entity\CcmParticiperPageTranslation;

class CcmParticiperPageAdmin extends Admin
{
    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'DESC',
        '_sort_by' => 'id'
    );

    protected $translationDomain = 'BaseAdminBundle';

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
            ->add('title', null, array(
                'template' => 'BaseAdminBundle:News:list_title.html.twig',
                'label' => 'Titre de la page',
            ))
            ->add('createdAt')
            ->add('updatedAt')
            ->add('_edit_translations', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_edit_translations.html.twig'
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
                            'translation_domain' => 'BaseAdminBundle',
                            'constraints'        => array(
                                new NotBlank(),
                            ),
                            'required' => true
                        ),
                        'createdAt'         => array(
                            'display' => false,
                        ),
                        'updatedAt'         => array(
                            'display' => false,
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