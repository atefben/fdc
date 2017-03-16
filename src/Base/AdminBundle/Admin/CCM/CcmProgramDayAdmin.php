<?php

namespace Base\AdminBundle\Admin\CCM;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Validator\Constraints\Count;

class CcmProgramDayAdmin extends Admin
{
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
            ->add('id', null, array(
                    'label' => 'list.ccm.id'
                )
            )
            ->add('dateString', null, array(
                    'label' => 'list.ccm.program.date_string'
                )
            )
            ->add('_action', 'actions', array(
                'label' => 'list.ccm.program.edit',
                'actions' => array(
                    'edit'   => array()
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
            ->add('dateEvent', 'sonata_type_date_picker', array(
                'label' => 'form.ccm.label.program.day.date_event',
                'format' => 'dd/MM/yyyy',
                'required' => true,
                'attr' => array(
                    'data-date-format' => 'dd/MM/yyyy',
                )
            ))
            ->add('schedulesCollection', 'sonata_type_collection', array(
                'by_reference'       => false,
                'label'              => 'form.ccm.label.program.day.schedule_collection',
                'translation_domain' => 'BaseAdminBundle',
                'required' => true,
                'constraints'        => array(
                    new Count(
                        array(
                            'min' => 1,
                            'minMessage' => "validation.schedule_min"
                        )
                    ),
                ),
            ), array(
                'edit'     => 'inline',
                'inline'   => 'table',
                'sortable' => 'position',
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
            ->add('dateString');
    }
}
