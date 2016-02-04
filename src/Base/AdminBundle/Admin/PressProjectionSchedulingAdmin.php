<?php

namespace Base\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class PressProjectionSchedulingAdmin extends Admin
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
            ->add('section')
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
            ->add('section')
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $em = $this->modelManager->getEntityManager('Base\CoreBundle\Entity\FilmProjection');

        $query = $em->createQueryBuilder('p')
            ->select('p')
            ->from('BaseCoreBundle:FilmProjection', 'p')
            ->where('p.type = 1')
            ->orderBy('p.startsAt', 'ASC');

        $formMapper
            ->add('PressProjection', 'sonata_type_model_list', array(
                'required' => false,
                'btn_add' => false,
                'label' => 'form.label_projection',
            ),
            array(
                'query' => $query
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
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }

    public function prePersist($scheduling)
    {
        $this->preUpdate($scheduling);
    }

    public function preUpdate($scheduling)
    {
        $scheduling->setProjection($scheduling->getProjection());
    }

}
