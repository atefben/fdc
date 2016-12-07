<?php

namespace Base\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class FilmFestivalAdmin extends Admin
{
    protected $translationDomain = 'BaseAdminBundle';

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

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('delete');
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id', null, array('label' => 'list.film_festival.label_edition'))
            ->add('year', null, array('label' => 'list.film_festival.label_year'))
            //->add('festivalStartsAt', null, array('label' => 'list.film_festival.label_startsat'))
            //->add('festivalEndsAt', null, array('label' => 'list.film_festival.label_endsat'))
            ->add('festivalStartsAt', null, array(
                'field_type'    => 'sonata_type_date_picker',
                'field_options' =>  array(
                    'dp_language' => 'fr',
                    'format' => 'dd/MM/yyyy',
                ),
                'label'         => 'list.film_festival.label_startsat',
            ))
            ->add('festivalEndsAt', null, array(
                'field_type'    => 'sonata_type_date_picker',
                'field_options' =>  array(
                    'dp_language' => 'fr',
                    'format' => 'dd/MM/yyyy',
                ),
                'label'         => 'list.film_festival.label_endsat',
            ))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id', null, array('label' => 'list.film_festival.label_edition'))
            ->add('year', null, array('label' => 'list.film_festival.label_year'))
            ->add('festivalStartsAt', null, array('label' => 'list.film_festival.label_startsat'))
            ->add('festivalEndsAt', null, array('label' => 'list.film_festival.label_endsat'))
            //->add('createdAt')
            //->add('updatedAt')
            ->add('_action', 'actions', array(
                'actions' => array(
                    //'show' => array(),
                    'edit' => array(),
                    //'delete' => array(),
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
            ->with('Retrospective')

            ->add('year', null, array('label' => 'list.film_festival.label_year'))
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
                'label' => 'form.film_festival.label_media_image_associated',
                'help' => 'form.film_festival.label_helper_media_image_associated',
                'by_reference' => false,
                'required' => false,
            ), array(
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable'  => 'position'
                )
            )
            ->end()

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
            ->add('festivalStartsAt', null, array('label' => 'list.festival.label_startsat'))
            ->add('festivalEndsAt', null, array('label' => 'list.festival.label_endsat'))
            ->add('marcheDuFilmStartsAt')
            ->add('marcheduFilmEndsAt')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('soifUpdatedAt')
        ;
    }
}
