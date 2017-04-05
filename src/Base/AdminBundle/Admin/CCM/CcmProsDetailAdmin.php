<?php

namespace Base\AdminBundle\Admin\CCM;

use FDC\CourtMetrageBundle\Entity\CcmDomainTranslation;
use FDC\CourtMetrageBundle\Entity\CcmProsActivityTranslation;
use FDC\CourtMetrageBundle\Entity\CcmProsDetailTranslation;
use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Count;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Symfony\Component\Validator\Constraints\Url;

class CcmProsDetailAdmin extends Admin
{
    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'DESC',
        '_sort_by' => 'id'
    );

    protected $translationDomain = 'BaseAdminBundle';

    protected $formOptions = array(
        'cascade_validation' => true,
    );

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

    public function filterCallbackJoinTwiceTranslations($queryBuilder, $alias, $field, $value)
    {
        static $joined = false;
        if (!$joined) {
            $queryBuilder
                ->join("{$alias}.translations", 't2');
            $joined = true;
        }

        return $queryBuilder;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id', null, array('label' => 'filter.ccm.pro.id'))
            ->add('name', 'doctrine_orm_callback', array(
                    'callback'   => function ($queryBuilder, $alias, $field, $value) {
                        if ($value['value'] === null) {
                            return;
                        }
                        $this->filterCallbackJoinTranslations($queryBuilder, $alias, $field, $value);
                        $queryBuilder->andWhere('t.name LIKE :name');
                        $queryBuilder->setParameter('name', '%' . $value['value'] . '%');
                        return true;
                    },
                    'field_type' => 'text',
                    'label'      => 'filter.ccm.pro.name',
                )
            )
            ->add('domainCollection', 'doctrine_orm_callback', array(
                    'callback' => function($queryBuilder, $alias, $field, $value) {
                        if ($value['value'] === null || $value['value'] === '') {
                            return;
                        }
                        $queryBuilder->join("{$alias}.domainsCollection", 'do')
                            ->andWhere("do.domain = :domain")
                            ->setParameter('domain', $value['value']);

                        return true;
                    },
                    'field_type' => 'choice',
                    'field_options' => array(
                        'choices' => $this->getDomains(),
                        'choice_translation_domain' => 'BaseAdminBundle'
                    ),
                    'label'      => 'filter.ccm.pro.domains_activities',
                )
            )
        ;

        $datagridMapper = $this->addCreatedBetweenFilters($datagridMapper);
        $datagridMapper = $this->addStatusFilter($datagridMapper);

        $datagridMapper
            ->add('status_translated', 'doctrine_orm_callback', array(
                'callback'   => function ($queryBuilder, $alias, $field, $value) {
                    if (!$value['value']) {
                        return;
                    }

                    if ($value['value']) {
                        $this->filterCallbackJoinTwiceTranslations($queryBuilder, $alias, $field, $value);
                        $queryBuilder->andWhere('t2.status = :translated');
                        $queryBuilder->setParameter('translated', CcmProsDetailTranslation::STATUS_TRANSLATED);
                    }
                    return true;
                },
                'field_type' => 'checkbox',
                'label'      => 'list.news_common.translated',
            ))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id', null, array(
                    'label' => 'list.ccm.pro.identifiant'
                )
            )
            ->add('name', null, array(
                    'label'    => 'list.ccm.pro.name',
                )
            )
            ->add('domainsCollection', 'null', array(
                'template' => 'BaseAdminBundle:TranslateMain:CCM/list_domains.html.twig',
                'catalogue' => 'BaseAdminBundle',
                'label'     => 'list.ccm.pro.domains_activities'
            ))
            ->add('statusMain', 'choice', array(
                    'choices'   => CcmProsDetailTranslation::getMainStatuses(),
                    'catalogue' => 'BaseAdminBundle',
                    'label'    => 'list.ccm.pro.status',
                )
            )
            ->add('_edit_translations', null, array(
                    'template' => 'BaseAdminBundle:TranslateMain:list_edit_translations.html.twig',
                    'label'    => 'list.ccm.pro.edit_translations',
                )
            )
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('image', 'sonata_type_model_list',array(
                'label' => 'form.ccm.label.pros.detail_image',
                'required' => false
            ))
            ->add('isShortFilmCorner', 'checkbox', array(
                'label' => 'form.ccm.label.pros.detail_is_sfc',
                'required' => false
            ))
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
                    'name'          => array(
                        'label'              => 'form.ccm.label.pros.detail_name',
                        'translation_domain' => 'BaseAdminBundle',
                        'constraints'        => array(
                            new NotBlank(),
                        ),
                        'required' => true
                    ),
                    'quote'          => array(
                        'label'              => 'form.ccm.label.pros.detail_quote',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'country'          => array(
                        'label'              => 'form.ccm.label.pros.detail_country',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false
                    ),
                    'url'          => array(
                        'label'              => 'form.ccm.label.pros.detail_url',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                        'sonata_help' => 'form.ccm.label.help_relative_url',
                        'constraints' => array(
                            new Url()
                        ),
                    ),
                    'urlName'          => array(
                        'label'              => 'form.ccm.label.pros.detail_url_name',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false
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
                        'choices'                   => CcmProsDetailTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle',
                    ),
                ),
            ))
            ->add('domainsCollection', 'sonata_type_collection', array(
                'by_reference'       => false,
                'label'              => 'form.ccm.label.pros.page_domains_list',
                'translation_domain' => 'BaseAdminBundle',
                'required' => true,
                'constraints'        => array(
                    new Count(
                        array(
                            'min' => 1,
                            'minMessage' => "validation.pros.min"
                        )
                    ),
                ),
            ), array(
                    'edit'     => 'inline',
                    'inline'   => 'table',
                    'sortable' => 'position',
                )
            )
            ->add('contactsCollection', 'sonata_type_collection', array(
                    'by_reference'       => false,
                    'required' => false,
                    'label'              => 'form.ccm.label.pros.detail_contacts_list',
                    'translation_domain' => 'BaseAdminBundle',
                ), array(
                    'edit'     => 'inline',
                    'inline'   => 'table',
                    'sortable' => 'position',
                )
            )
            ->add('description', 'infinite_form_polycollection', array(
                    'label' => false,
                    'types' => array(
                        'single_description_type',
                        'double_description_type',
                    ),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype' => true,
                    'by_reference' => false,
                )
            )
        ;
    }

    protected function getDomains()
    {
        $em = $this->getConfigurationPool()->getContainer()->get('Doctrine')->getManager();

        $domainsCollection = $em->getRepository(CcmDomainTranslation::class)
            ->findBy(
                array(
                    'locale' => $this->request ? $this->request->getLocale() : 'fr'
                )
            );

        if ($domainsCollection) {
            $domains = [];
            foreach ($domainsCollection as $item) {
                $domains[$item->getTranslatable()->getId()] = $item->getName();
            }

            return $domains;
        }

        return [];
    }

}