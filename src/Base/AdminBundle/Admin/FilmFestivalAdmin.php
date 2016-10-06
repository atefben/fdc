<?php

namespace Base\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class FilmFestivalAdmin extends Admin
{
    public function configure()
    {
        $this->setTemplate('edit', 'BaseAdminBundle:CRUD:edit_polycollection.html.twig');
    }

    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            array('BaseAdminBundle:Form:polycollection.html.twig')
        );
    }
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('year')
            ->add('festivalStartsAt')
            ->add('festivalEndsAt')
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
            ->add('year')
            ->add('festivalStartsAt')
            ->add('festivalEndsAt')
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
            ->add('year')
            /*->add('festivalStartsAt', 'sonata_type_datetime_picker', array(
                'format' => 'dd/MM/yyyy HH:mm',
                'required' => false,
                'attr' => array(
                    'data-date-format' => 'dd/MM/yyyy HH:mm',
                )
            ))
            ->add('festivalEndsAt', 'sonata_type_datetime_picker', array(
                'format' => 'dd/MM/yyyy HH:mm',
                'required' => false,
                'attr' => array(
                    'data-date-format' => 'dd/MM/yyyy HH:mm',
                )
            ))*/
            //->add('marcheDuFilmStartsAt')
            //->add('marcheduFilmEndsAt')
            ->add('associatedMediaImages', 'sonata_type_collection', array(
                'label' => 'form.label_film_festival_media_image_associated',
                'help' => 'form.film_festival.helper_film_festival_media_image_associated',
                'by_reference' => false,
                'required' => false,
            ), array(
                    'edit' => 'inline',
                    'inline' => 'table'
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
            ->add('year')
            ->add('festivalStartsAt')
            ->add('festivalEndsAt')
            ->add('marcheDuFilmStartsAt')
            ->add('marcheduFilmEndsAt')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('soifUpdatedAt')
        ;
    }
}
