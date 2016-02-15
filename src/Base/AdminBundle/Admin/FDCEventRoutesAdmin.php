<?php

namespace Base\AdminBundle\Admin;

use Knp\Menu\ItemInterface;
use Sonata\AdminBundle\Admin\AdminInterface;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class FDCEventRoutesAdmin extends Admin
{

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
        $datagridMapper
            ->add('route')
            ->add('enabled')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('route')
            ->add('enabled')
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
            ->add('route')
            ->add('name')
            ->add('enabled')
            ->add('parent')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('route')
            ->add('enabled')
        ;
    }
}
