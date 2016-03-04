<?php

namespace Base\AdminBundle\Admin;

use Base\CoreBundle\Entity\PressAccreditProcedureTranslation;
use Base\CoreBundle\Entity\PressAccreditProcedure;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Validator\Constraints\NotBlank;
use Sonata\AdminBundle\Route\RouteCollection;

class PressAccreditProcedureAdmin extends Admin
{

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('acl');
        $collection->remove('show');
    }

    protected $translationDomain = 'BaseAdminBundle';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('procedureTitle', 'doctrine_orm_callback', array(
                'callback'   => function ($queryBuilder, $alias, $field, $value) {
                    if (!$value['value']) {
                        return;
                    }
                    $queryBuilder->join("{$alias}.translations", 't');
                    $queryBuilder->andWhere('t.locale = :locale');
                    $queryBuilder->setParameter('locale', 'fr');
                    $queryBuilder->andWhere('t.procedureTitle LIKE :procedureTitle');
                    $queryBuilder->setParameter('procedureTitle', '%' . $value['value'] . '%');
                    return true;
                },
                'field_type' => 'text',
                'label'      => 'filter.press_download.label_section'
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
                'label' => 'list.common.label_id'
            ))
            ->add('procedureTitle', null, array(
                'template' => 'BaseAdminBundle:AccreditProcedure:list_title.html.twig',
                'label'    => 'list.label_section_title',
            ))
            ->add('createdAt', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_created_at.html.twig',
                'sortable' => 'createdAt',
            ))
            ->add('updatedAt', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_updated_at.html.twig',
                'sortable' => 'updatedAt',
            ))
            ->add('_action', 'actions', array(
                'actions' => array(
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
        $formMapper
            ->add('translations', 'a2lix_translations', array(
                'label' => false,
                'translation_domain' => 'BaseAdminBundle',
                'required_locales' => array(),
                'fields' => array(
                    'status' => array(
                        'label' => 'form.label_status',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'choice',
                        'choices' => PressAccreditProcedureTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle',
                    ),
                    'createdAt' => array(
                        'display' => false
                    ),
                    'updatedAt' => array(
                        'display' => false
                    ),
                    'procedureTitle' => array(
                        'label' => 'form.label_media_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'locale_options' => array(
                            'fr' => array(
                                'required' => true
                            )
                        )
                    ),
                    'procedureContent' => array(
                        'field_type' => 'ckeditor',
                        'label' => 'form.label_procedure',
                        'sonata_help' => 'form.press_homepage.helper_desc',
                        'translation_domain' => 'BaseAdminBundle',
                        'config_name' => 'widget'
                    ),
                )
            ))
            ->add('translate')
            ->add('translateOptions', 'choice', array(
                'choices' => PressAccreditProcedure::getAvailableTranslateOptions(),
                'translation_domain' => 'BaseAdminBundle',
                'multiple' => true,
                'expanded' => true
            ))
            ->add('priorityStatus', 'choice', array(
                'choices' => PressAccreditProcedure::getPriorityStatuses(),
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

    public function configure()
    {
        $this->setTemplate('edit', 'BaseAdminBundle:CRUD:edit_polycollection.html.twig');
    }

    public function prePersist($accredit)
    {
        $this->preUpdate($accredit);
    }

    public function preUpdate($accredit)
    {
        $accredit->setProcedure($accredit->getProcedure());
    }


}
