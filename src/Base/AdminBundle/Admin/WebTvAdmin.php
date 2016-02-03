<?php

namespace Base\AdminBundle\Admin;

use Base\CoreBundle\Entity\WebTv;
use Base\CoreBundle\Entity\WebTvTranslation;

use Sonata\AdminBundle\Admin\Admin;
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

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name', 'doctrine_orm_callback', array(
                'callback' => function($queryBuilder, $alias, $field, $value) {
                    if (!$value['value']) {
                        return;
                    }
                    $queryBuilder->join("{$alias}.translations", 't');
                    $queryBuilder->where('t.locale = :locale');
                    $queryBuilder->setParameter('locale', 'fr');
                    $queryBuilder->andWhere('t.name LIKE :name');
                    $queryBuilder->setParameter('name', '%'. $value['value']. '%');

                    return true;
                },
                'field_type' => 'text'
            ))
            ->add('priorityStatus', 'doctrine_orm_callback', array(
                'callback' => function($queryBuilder, $alias, $field, $value) {
                    if (!$value['value']) {
                        return;
                    }
                    $queryBuilder->andWhere('o.priorityStatus LIKE :priorityStatus');
                    $queryBuilder->setParameter('priorityStatus', '%'. $value['value']. '%');

                    return true;
                },
                'field_type' => 'choice',
                'field_options' => array(
                    'choices' => WebTv::getPriorityStatusesList(),
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
            ->add('name', null, array('template' => 'BaseAdminBundle:WebTv:list_name.html.twig'))
            ->add('priorityStatus', 'choice', array(
                'choices' => WebTv::getPriorityStatusesList(),
                'catalogue' => 'BaseAdminBundle'
            ))
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
                'label' => false,
                'translation_domain' => 'BaseAdminBundle',
                'required_locales' => array('fr'),
                'fields' => array(
                    'name' => array(
                        'label' => 'form.label_web_tv_name',
                        'sonata_help' => 'form.web_tv.helper_name',
                        'translation_domain' => 'BaseAdminBundle',
                        'constraints' => array(
                            new NotBlank(),
                        ),
                    ),
                    'status' => array(
                        'label' => 'form.label_status',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'choice',
                        'choices' => WebTvTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle'
                    ),
                    'createdAt' => array(
                        'display' => false
                    ),
                    'updatedAt' => array(
                        'display' => false
                    )
                )
            ))
            ->add('image', 'sonata_type_model_list', array(
                'help' => 'form.web_tv.helper_image',
                'required' => false,
            ))
            ->add('translate')
            ->add('priorityStatus', 'choice', array(
                'choices' => WebTv::getPriorityStatuses(),
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
        $this->setTemplate('edit', 'BaseAdminBundle:CRUD:edit_form.html.twig');
    }
}
