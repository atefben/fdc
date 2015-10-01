<?php

namespace Base\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class FilmFilmAdmin extends Admin
{
    protected $translationDomain = 'BaseAdminBundle';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('directorFirst')
            ->add('restored')
            ->add('titleVO')
            ->add('titleVOAlphabet')
            ->add('productionYear')
            ->add('duration')
            ->add('castingCommentary')
            ->add('website')
            ->add('galaId')
            ->add('galaName')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('soifUpdatedAt')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('directorFirst')
            ->add('restored')
            ->add('titleVO')
            ->add('titleVOAlphabet')
            ->add('productionYear')
            ->add('duration')
            ->add('castingCommentary')
            ->add('website')
            ->add('galaId')
            ->add('galaName')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('soifUpdatedAt')
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
            ->add('id')
            ->add('directorFirst')
            ->add('restored')
            ->add('titleVO')
            ->add('titleVOAlphabet')
            ->add('productionYear')
            ->add('duration')
            ->add('castingCommentary')
            ->add('website')
            ->add('galaId')
            ->add('galaName')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('soifUpdatedAt')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('directorFirst')
            ->add('restored')
            ->add('titleVO')
            ->add('titleVOAlphabet')
            //->add('translations')
            ->add('productionYear')
            ->add('duration')
            ->add('castingCommentary')
            ->add('website')
            ->add('galaId')
            ->add('galaName')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('soifUpdatedAt')
            ->add('persons')
            ->add('medias', null, array(
                'template' => 'BaseAdminBundle:FilmFilm:medias.html.twig'
            ))
        ;
    }
}
