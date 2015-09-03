<?php

namespace FDC\AdminBundle\Admin;

use FDC\CoreBundle\Entity\News;
use FDC\CoreBundle\Entity\NewsArticle;
use FDC\CoreBundle\Entity\NewsArticleTranslation;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;


/**
 * NewsAdmin class.
 * 
 * @extends Admin
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * @company Ohwee
 */
class NewsAdmin extends Admin
{
    protected $translationDomain = 'FDCAdminBundle';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('title', 'doctrine_orm_callback', array(
                'callback' => function($queryBuilder, $alias, $field, $value) {
                    if (!$value['value']) {
                        return;
                    }
                    $queryBuilder->join("{$alias}.translations", 't');
                    $queryBuilder->where('t.locale = :locale');
                    $queryBuilder->setParameter('locale', 'fr');
                    $queryBuilder->andWhere('t.title LIKE :title');
                    $queryBuilder->setParameter('title', '%'. $value['value']. '%');

                    return true;
                },
                'field_type' => 'text'
            ))
            ->add('theme')
            ->add('publishedAt')
            ->add('publishEndedAt')
            ->add('status', 'doctrine_orm_callback', array(
                'callback' => function($queryBuilder, $alias, $field, $value) {
                    if (!$value['value']) {
                        return;
                    }
                    $queryBuilder->join("{$alias}.translations", 't');
                    $queryBuilder->where('t.locale = :locale');
                    $queryBuilder->setParameter('locale', 'fr');
                    $queryBuilder->andWhere('t.status = :status');
                    $queryBuilder->setParameter('status', $value['value']);

                    return true;
                },
                'field_type' => 'choice',
                'field_options' => array(
                    'choices' => NewsArticleTranslation::getStatuses(),
                    'choice_translation_domain' => 'FDCAdminBundle'
                ),
            ))
            ->add('translate')
            ->add('type', 'doctrine_orm_callback', array(
                'callback' => function($queryBuilder, $alias, $field, $value) {
                    if (!$value['value']) {
                        return;
                    }

                    $queryBuilder->where("{$alias} INSTANCE OF {$value['value']}");

                    return true;
                },
                'field_type' => 'choice',
                'field_options' => array(
                    'choices' => News::getTypes()
                )
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
            ->add('title', null, array('template' => 'FDCAdminBundle:News:list_title.html.twig'))
            ->add('theme')
            ->add('updatedAt')
            ->add('publishedInterval', null, array('template' => 'FDCAdminBundle:News:list_published_interval.html.twig'))
            ->add('status', null, array('template' => 'FDCAdminBundle:News:list_status.html.twig'))
            ->add('type', null, array('template' => 'FDCAdminBundle:News:list_type.html.twig'))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('id')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
        ;
    }
}
