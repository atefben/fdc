<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class PressHomepageSectionAdmin extends Admin
{

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('createdAt')
            ->add('updatedAt');
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('createdAt')
            ->add('updatedAt');
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('class', 'choice', array(
                // disabled : true when block are created
                'choices' => array(
                    'communique' => "Communiqué et info",
                    'programmation' => "Programmation du jour",
                    'media' => "Médiathèque",
                    'download' => "A télécharger",
                    'push1' => "Push 1",
                    'push2' => "Push 2",
                    'statistics' => "Statistiques",
                ),
                'disabled' => false,
                'label' => 'form.press_homepage.label_section',
                'required' => false
            ))
            ->add('position', 'hidden', array('attr' => array("hidden" => true)));

    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('createdAt')
            ->add('updatedAt');
    }

    public function prePersist($homepage)
    {
        $this->preUpdate($homepage);
    }

    public function preUpdate($homepage)
    {
        $homepage->setSection($homepage->getSection());
    }
}
