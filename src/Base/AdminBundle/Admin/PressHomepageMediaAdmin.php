<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class PressHomepageMediaAdmin extends Admin
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
            ->add('film')
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
            ->add('film')
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $container = $this->getConfigurationPool()->getContainer();
        $pressHomepageId = $container->getParameter('admin_press_homepage_id');
        $pressHomepage = $container->get('doctrine')->getRepository('BaseCoreBundle:PressHomepage')->findOneById($pressHomepageId);

        $formMapper
            ->add('film', 'sonata_type_model_list', array(
                'help' => 'form.news.helper_film_film_associated',
                'required' => false,
                'btn_add' => false,
                'btn_delete' => false,
                'label' => 'form.label_film'
            ))
            ->add('homepage', 'entity', array(
                'class' => 'BaseCoreBundle:PressHomepage',
                'data' => $pressHomepage,
                'attr' => array('hidden' => true)
            ))
            ->add('position', 'hidden', array('attr'=>array('hidden' => true)))
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
