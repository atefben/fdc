<?php

namespace FDC\AdminBundle\Admin;

use FDC\CoreBundle\Entity\News;
use FDC\CoreBundle\Entity\NewsArticle;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class NewsAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('title')
            ->add('theme')
            ->add('publishedAt')
            ->add('publishEndedAt')
            ->add('status')
            ->add('type', 'doctrine_orm_callback', array(
//                'callback'   => array($this, 'getWithOpenCommentFilter'),
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
            ->add('title')
            ->add('theme')
            ->add('updatedAt')
            ->add('publishedInterval', null, array('template' => 'FDCAdminBundle:News:list_published_interval.html.twig'))
            ->add('status')
            ->add('type', null, array('template' => 'FDCAdminBundle:News:list_type.html.twig'))
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
