<?php

namespace Base\AdminBundle\Admin\CCM;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Validator\Constraints\NotBlank;

class CcmMainNavAdmin extends Admin
{

    protected $translationDomain = 'BaseAdminBundle';

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
            ->add('id', null, array('label' => 'filter.common.label_id'))
            ->add('name')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show'   => array(),
                    'edit'   => array(),
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
            ->add('name', null, array(
                    'label' => 'form.ccm.label.menu.main_nav_name',
                    'constraints'        => array(
                        new NotBlank(),
                    ),
                    'required' => true
                )
            )
            ->add('foTranslationKey', null, array(
                    'label' => 'form.ccm.label.menu.main_nav_fo_translation_key',
                    'constraints'        => array(
                        new NotBlank(),
                    ),
                    'required' => true
                )
            )
            ->add('route', null, array(
                    'label' => 'form.ccm.label.menu.main_nav_route',
                    'constraints'        => array(
                        new NotBlank(),
                    ),
                    'required' => true
                )
            )
            ->add('isActive', 'checkbox', array(
                    'label' => 'form.ccm.label.menu.main_nav_is_active',
                    'required' => false,
                )
            )
            ->add('subNavsCollection', 'sonata_type_collection', array(
                    'by_reference'       => false,
                    'label'              => 'form.ccm.label.menu.sub_nav_list',
                    'translation_domain' => 'BaseAdminBundle',
                ), 
                array(
                    'edit'     => 'inline',
                    'inline'   => 'table',
                    'sortable' => 'position',
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
            ->add('name');
    }
}
