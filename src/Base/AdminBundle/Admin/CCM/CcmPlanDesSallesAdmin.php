<?php

namespace Base\AdminBundle\Admin\CCM;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Validator\Constraints\Count;

class CcmPlanDesSallesAdmin extends Admin
{
    protected $baseRoutePattern = 'ccmplandessalles';
    protected $baseRouteName = 'ccm_plan_des_sales';
    
    public function configure()
    {
        $this->setTemplate('edit', 'BaseAdminBundle:CRUD:edit_polycollection.html.twig');
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('title')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit'   => array(),
                ),
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('sectorList', 'sonata_type_collection', array(
                'by_reference'       => false,
                'label'              => 'form.ccm.label.plan_des_salles_sector_list',
                'translation_domain' => 'BaseAdminBundle',
                'constraints'        => array(
                    new Count(
                        array(
                            'min' => 1,
                            'minMessage' => "validation.plan_des_salles_sector_min"
                        )
                    ),
                )
            ), array(
                    'edit'     => 'inline',
                    'inline'   => 'table',
                    'sortable' => 'position'
                )
            )
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('title')
        ;
    }

    /**
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(['edit', 'list']);
    }
}
