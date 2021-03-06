<?php

namespace Base\AdminBundle\Admin;

use Base\CoreBundle\Entity\SocialWall;
use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class SocialWallAdmin extends Admin
{
    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'DESC', // sort direction
        '_sort_by' => 'createdAt' // field name
    );

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('url')
            ->add('network', 'doctrine_orm_choice', array(),'choice',array(
                'choices' => SocialWall::getNetworks(),
                'choice_translation_domain' => 'BaseAdminBundle'
                ))
            ->add('festival')
            ->add('enabledMobile')
            ->add('enabledDesktop')
            ->add('tags')
            ->add('createdBefore', 'doctrine_orm_callback', array(
                'callback'      => function ($queryBuilder, $alias, $field, $value) {
                    if ($value['value'] === null) {
                        return;
                    }
                    $queryBuilder->andWhere("{$alias}.createdAt < :before");
                    $queryBuilder->setParameter('before', $value['value']->format('Y-m-d H:i:s'));

                    return true;
                },
                'field_type'    => 'sonata_type_date_picker',
                'field_options' =>  array(
                    'dp_language' => 'fr',
                    'format' => 'dd/MM/yyyy',
                ),
                'label'         => 'filter.media_audio.label_created_before',
            ))
            ->add('createdAfter', 'doctrine_orm_callback', array(
                'callback'      => function ($queryBuilder, $alias, $field, $value) {
                    if ($value['value'] === null) {
                        return;
                    }
                    $queryBuilder->andWhere("{$alias}.createdAt > :after");
                    $queryBuilder->setParameter('after', $value['value']->format('Y-m-d H:i:s'));

                    return true;
                },
                'field_type'    => 'sonata_type_date_picker',
                'field_options' =>  array(
                    'dp_language' => 'fr',
                    'format' => 'dd/MM/yyyy',
                ),
                'label'         => 'filter.media_audio.label_created_after',
            ))
            ->add('updatedBefore', 'doctrine_orm_callback', array(
                'callback'      => function ($queryBuilder, $alias, $field, $value) {
                    if ($value['value'] === null) {
                        return;
                    }
                    $queryBuilder->andWhere('o.updatedAt < :before');
                    $queryBuilder->setParameter('before', $value['value']->format('Y-m-d H:i:s'));

                    return true;
                },
                'field_type'    => 'sonata_type_date_picker',
                'field_options' =>  array(
                    'dp_language' => 'fr',
                    'format' => 'dd/MM/yyyy',
                ),
                'label'         => 'filter.common.label_updated_before',
            ))
            ->add('updatedAfter', 'doctrine_orm_callback', array(
                'callback'      => function ($queryBuilder, $alias, $field, $value) {
                    if ($value['value'] === null) {
                        return;
                    }
                    $queryBuilder->andWhere('o.updatedAt > :after');
                    $queryBuilder->setParameter('after', $value['value']->format('Y-m-d H:i:s'));

                    return true;
                },
                'field_type'    => 'sonata_type_date_picker',
                'field_options' =>  array(
                    'dp_language' => 'fr',
                    'format' => 'dd/MM/yyyy',
                ),
                'label'         => 'filter.common.label_updated_after',
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
            ->add('url', null, array('template' => 'BaseAdminBundle:SocialWall:url_display_social.html.twig'))
            ->add('network', null, array('template' => 'BaseAdminBundle:SocialWall:network_display_social.html.twig'))
            ->add('content', null, array('template' => 'BaseAdminBundle:SocialWall:content_display_social.html.twig'))
            ->add('tags')
            ->add('message', null, array('template' => 'BaseAdminBundle:SocialWall:message.html.twig'))
            ->add('enabledMobile', null, array('editable' => true))
            ->add('enabledDesktop', null, array('editable' => true))
            ->add('createdAt', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_created_at.html.twig',
                'sortable' => 'createdAt',
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('url')
            ->add('network')
            ->add('enabledMobile')
            ->add('enabledDesktop')
            ->add('tags')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('url')
            ->add('network')
            ->add('enabledMobile')
            ->add('enabledDesktop')
            ->add('tags')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }
}
