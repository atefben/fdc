<?php

namespace Base\AdminBundle\Admin;

use Base\CoreBundle\Entity\SocialWall;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class SocialWallAdmin extends Admin
{
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
            ->add('createdAt')
            ->add('updatedAt')
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
            ->add('message')
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
