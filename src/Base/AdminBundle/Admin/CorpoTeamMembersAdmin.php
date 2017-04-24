<?php

namespace Base\AdminBundle\Admin;

use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassics;
use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsTranslation;
use Base\CoreBundle\Entity\PressAccreditProcedure;
use Base\CoreBundle\Entity\PressAccreditProcedureTranslation;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class CorpoTeamMembersAdmin extends Admin
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
        $collection->remove('acl');
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
            ->add('lastname', 'doctrine_orm_callback', array(
                'callback' => function ($queryBuilder, $alias, $field, $value) {
                    if (!$value['value']) {
                        return;
                    }
                    $queryBuilder->join("{$alias}.translations", 't');
                    $queryBuilder->andWhere('t.locale = :locale');
                    $queryBuilder->setParameter('locale', 'fr');
                    $queryBuilder->andWhere('t.lastname LIKE :lastname');
                    $queryBuilder->setParameter(':lastname', '%' . $value['value'] . '%');
                    return true;
                },
                'field_type' => 'text',
                'label' => 'Nom'
            ))
            ->add('firstname', 'doctrine_orm_callback', array(
                'callback' => function ($queryBuilder, $alias, $field, $value) {
                    if (!$value['value']) {
                        return;
                    }
                    $queryBuilder->join("{$alias}.translations", 't1');
                    $queryBuilder->andWhere('t1.locale = :locale');
                    $queryBuilder->setParameter('locale', 'fr');
                    $queryBuilder->andWhere('t1.firstname LIKE :firstname');
                    $queryBuilder->setParameter(':firstname', '%' . $value['value'] . '%');
                    return true;
                },
                'field_type' => 'text',
                'label' => 'Prénom'
            ))
            ->add('function', 'doctrine_orm_callback', array(
                'callback' => function ($queryBuilder, $alias, $field, $value) {
                    if (!$value['value']) {
                        return;
                    }
                    $queryBuilder->join("{$alias}.translations", 't2');
                    $queryBuilder->andWhere('t2.locale = :locale');
                    $queryBuilder->setParameter('locale', 'fr');
                    $queryBuilder->andWhere('t2.function LIKE :function');
                    $queryBuilder->setParameter(':function', '%' . $value['value'] . '%');
                    return true;
                },
                'field_type' => 'text',
                'label' => 'Nom de la fonction'
            ));
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id', null, array('label' => 'list.common.label_id'))
            ->add('firstname', null, array(
                'template' => 'BaseAdminBundle:AccreditProcedure:list_title.html.twig',
                'label' => 'Prénom',
            ))
            ->add('lastname', null, array(
                'template' => 'BaseAdminBundle:AccreditProcedure:list_title2.html.twig',
                'label' => 'Nom',
            ))
            ->add('function', null, array(
                'template' => 'BaseAdminBundle:CorpoTeamMembers:list_function.html.twig',
                'label' => 'Nom du membre',
            ))
            ->add('createdAt', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_created_at.html.twig',
                'sortable' => 'createdAt',
            ))
            ->add('_edit_translations', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_edit_translations.html.twig',
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
                        'choice_translation_domain' => 'BaseAdminBundle',
                        'required' => false
                    ),
                    'firstname' => array(
                        'label' => 'Prénom',
                        'field_type' => 'text'
                    ),
                    'lastname' => array(
                        'label' => 'Nom',
                        'field_type' => 'text'
                    ),
                    'function' => array(
                        'label' => 'Fonction',
                        'field_type' => 'text',
                        'required' => false,
                        'sonata_help' => 'Texte tronqué à partir de 70 caractères.'
                    ),
                    'createdAt' => array(
                        'display' => false
                    ),
                    'updatedAt' => array(
                        'display' => false
                    ),
                )
            ))
            ->add('mainImage', 'sonata_type_model_list', array(
                'label' => 'Photo du membre',
                'help' => 'Dimensions attendues : 326x442. Format attendu : .jpg, .png, .gif',
                'required' => false,
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
            ))// must be added to display informations about creation user / date, update user / date (top of right sidebar)
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
            ->add('translate')
            ->add('translateOptions');
    }
}
