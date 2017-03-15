<?php

namespace Base\AdminBundle\Admin\CCM;

use Base\AdminBundle\Component\Admin\Admin;
use FDC\CourtMetrageBundle\Entity\CcmSocialWall;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class CcmSocialWallAdmin extends Admin
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
            ->add('id', null, array(
                    'label' => 'filter.ccm.social.id'
                )
            )
            ->add('url', null, array(
                    'label' => 'filter.ccm.social.url'
                )
            )
            ->add('network', 'doctrine_orm_choice', array(
                    'label' => 'filter.ccm.social.network'
                )
                    ,'choice',array(
                    'choices' => CcmSocialWall::getNetworks(),
                    'choice_translation_domain' => 'BaseAdminBundle'
                )
            )
            ->add('festival', null, array(
                    'label' => 'filter.ccm.social.festival'
                )
            )
            ->add('enabledDesktop', null,array(
                    'label' => 'filter.ccm.social.enabled_desktop',
                )
            )
            ->add('tags', null, array(
                    'label' => 'filter.ccm.social.tags'
                )
            )
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
            ->add('id', null, array(
                    'label' => 'list.ccm.social.id'
                )
            )
            ->add('url', null, array(
                    'template' => 'BaseAdminBundle:SocialWall:CCM/url_display_social.html.twig',
                    'label' => 'list.ccm.social.url',
                )
            )
            ->add('network', null, array(
                    'template' => 'BaseAdminBundle:SocialWall:CCM/network_display_social.html.twig',
                    'label' => 'list.ccm.social.network',
                )
            )
            ->add('content', null, array(
                    'template' => 'BaseAdminBundle:SocialWall:CCM/content_display_social.html.twig',
                    'label' => 'list.ccm.social.content',
                )
            )
            ->add('tags', null, array(
                    'label' => 'list.ccm.social.tags'
                )
            )
            ->add('message', null, array(
                    'template' => 'BaseAdminBundle:SocialWall:CCM/message.html.twig',
                    'label' => 'list.ccm.social.message',
                )
            )
            ->add('enabledDesktop', null, array(
                    'editable' => true,
                    'label' => 'list.ccm.social.enabled_desktop',
                )
            )
            ->add('createdAt', null, array(
                    'template' => 'BaseAdminBundle:TranslateMain:CCM/list_created_at.html.twig',
                    'sortable' => 'createdAt',
                    'label' => 'list.ccm.social.created_at',
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
            ->add('url')
            ->add('network')
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
            ->add('enabledDesktop')
            ->add('tags')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }
}
