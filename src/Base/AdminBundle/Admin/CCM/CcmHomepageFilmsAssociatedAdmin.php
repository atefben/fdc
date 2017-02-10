<?php

namespace Base\AdminBundle\Admin\CCM;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class CcmHomepageFilmsAssociatedAdmin extends Admin
{

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
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
            ->add('createdAt')
            ->add('updatedAt')
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
            ->add('association', 'sonata_type_model_list', array(
                'btn_add' => false,
                'label' => 'form.label_films_associated',
                'btn_delete' => false
            ))
            ->add('video', 'sonata_type_model_list', array(
                'btn_add' => false,
                'label' => 'form.label_video_extract_associated',
                'btn_delete' => false
            ))
            ->add('tabletImage', 'sonata_type_model_list', array(
                'btn_add' => false,
                'label' => 'form.label_tablet_image',
                'btn_delete' => false
            ))
            ->add('mobileImage', 'sonata_type_model_list', array(
                'btn_add' => false,
                'label' => 'form.label_image_mobile',
                'btn_delete' => false
            ))
            ->add('position','hidden',array('attr'=>array("hidden" => true)))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }
}
