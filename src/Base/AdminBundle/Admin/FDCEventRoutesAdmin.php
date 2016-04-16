<?php

namespace Base\AdminBundle\Admin;

use Base\CoreBundle\Interfaces\FDCEventRoutesInterface;
use Knp\Menu\ItemInterface;
use Sonata\AdminBundle\Admin\AdminInterface;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class FDCEventRoutesAdmin extends Admin
{
    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $query->andWhere(
            $query->expr()->eq($query->getRootAliases()[0] . '.hidden', ':hidden')
        );
        $query->setParameter('hidden', false);
        return $query;
    }

    public function configureRoutes(RouteCollection $routes)
    {
        parent::configureRoutes($routes);
        $routes->add('tree', 'tree');
    }

    protected function configureTabMenu(ItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {
        $menu->addChild('Arborescence', array(
            'uri' => $this->generateUrl('tree'),
        ));
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $em = $this->getConfigurationPool()->getContainer()->get('doctrine.orm.entity_manager');
        $routes = $em->getRepository('BaseCoreBundle:FDCEventRoutes')->findBy(
                array('parent' => null),
                array('id' => 'asc')
        );

        $parents = array();
        foreach ($routes as $key => $route) {
            $parents[$route->getId()] = $route->getName();
        }

        $datagridMapper
            ->add('name')
            ->add('enabled')
            ->add('site', 'doctrine_orm_callback', array(
                'callback'      => function ($queryBuilder, $alias, $field, $value) {
                    if (!$value['value']) {
                        return;
                    }
                    $queryBuilder->andWhere('o.site LIKE :site');
                    $queryBuilder->setParameter('site', '%' . $value['value'] . '%');

                    return true;
                },
                'field_type'    => 'choice',
                'field_options' => array(
                    'choices'                   => array(
                        FDCEventRoutesInterface::EVENT => 'Site évènementiel',
                        FDCEventRoutesInterface::PRESS => 'Site presse' ),
                    'choice_translation_domain' => 'BaseAdminBundle'
                ),
            ))
            ->add('type', 'doctrine_orm_callback', array(
                'callback'      => function ($queryBuilder, $alias, $field, $value) {
                    if (!$value['value']) {
                        return;
                    }
                    $queryBuilder->andWhere('o.type LIKE :type');
                    $queryBuilder->setParameter('type', '%' . $value['value'] . '%');

                    return true;
                },
                'field_type'    => 'choice',
                'field_options' => array(
                    'choices'                   => array(
                        FDCEventRoutesInterface::MENU => 'Menu',
                        FDCEventRoutesInterface::FOOTER => 'Footer' ),
                    'choice_translation_domain' => 'BaseAdminBundle'
                ),
            ))
            ->add('parent', 'doctrine_orm_callback' , array(
                'callback' => function($queryBuilder, $alias, $field, $value) {
                    if (!$value['value']) {
                        return;
                    }

                    $queryBuilder->andWhere("{$alias}.parent = :value");
                    $queryBuilder->orWhere("{$alias}.id = :value");
                    $queryBuilder->setParameter('value', $value['value']);

                    return true;
                },
                'field_type' => 'choice',
                'field_options' => array(
                    'choices' => $parents
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
            ->add('site', null, array(
                'template' => 'BaseAdminBundle:FDCEventRoutes:list_site.html.twig',
            ))
            ->add('type', null, array(
                'template' => 'BaseAdminBundle:FDCEventRoutes:list_type.html.twig',
            ))
            ->add('name')
            ->add('parent')
            ->add('enabled', null, array('editable' => true))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array()
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
            ->add('name')
            ->add('transName')
            ->add('route')
            ->add('enabled')
            ->add('parent')
            ->add('position')
            ->add('site', 'choice', array(
                'choices' => array(
                FDCEventRoutesInterface::EVENT => 'Site évènementiel',
                FDCEventRoutesInterface::PRESS => 'Site presse' ),
                'label' => 'Site'
           ))
            ->add('type', 'choice', array(
                'choices' => array(
                    FDCEventRoutesInterface::MENU => 'Menu',
                    FDCEventRoutesInterface::FOOTER => 'Footer' ),
                'label' => 'Type'
            ))
            ->add('hasWaitingPage')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('route')
            ->add('name')
            ->add('enabled')
            ->add('parent')
            ->add('position')
        ;
    }
}
