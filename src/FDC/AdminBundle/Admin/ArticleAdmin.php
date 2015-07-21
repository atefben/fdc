<?php

namespace FDC\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * Profile Admin
 */
class ArticleAdmin extends Admin
{
    public function createQuery($context = 'list')
    {
        $session = $this->getRequest()->getSession();
        $site = $session->get('fdc_site');

        $query = parent::createQuery($context);
        $query->andWhere(
            $query->expr()->eq($query->getRootAliases()[0] . '.site', ':site')
        );
        $query->setParameter('site', $site->getId());
        return $query;
    }

    /**
     * Configure the list
     *
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $list list
     */
    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('id')
            ->add('title', null, array('template' => 'FDCAdminBundle:Article:list_title.html.twig'))
            ->add('lock.user')
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
     * Configure the form
     *
     * @param FormMapper $formMapper formMapper
     */
    public function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Header')
                ->add('headerGallery', 'sonata_type_model_list')
                ->add('headerAudio', 'sonata_type_model_list')
                ->add('headerVideo', 'sonata_type_model_list')
            ->end()
            ->with('Body')
            ->add('translations', 'a2lix_translations', array(
                'fields' => array(
                    // hide fields
                    'createdAt' => array(
                        'display' => false
                    ),
                    'updatedAt' => array(
                        'display' => false
                    )
                )
            ))
            ->end()
            ->with('Footer')
                ->add('footerGallery', 'sonata_type_model_list')
                ->add('footerAudios', 'sonata_type_collection')
                ->add('footerVideos')
            ->end()
        ;
    }
    
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
        //    ->add('content')
        ;
    }
    
    protected function configureShowFields(ShowMapper $showMapper)
    {
         $showMapper
            ->add('id')
         //   ->add('content')
        ;
    }
    
    public function prePersist($object)
    {
        $session = $this->getRequest()->getSession();
        $userSite = $session->get('fdc_site');
        
        $dm = $this->getConfigurationPool()->getContainer()->get('doctrine')->getManager();
        $userSite = $dm->getRepository('FDCCoreBundle:Site')->findOneBySlug($userSite->getSlug());
        
        $object->setSite($userSite);
    }
    
    public function preUpdate($object)
    {
        $session = $this->getRequest()->getSession();
        $userSite = $session->get('fdc_site');
        $object->setSite($userSite);
    }

}