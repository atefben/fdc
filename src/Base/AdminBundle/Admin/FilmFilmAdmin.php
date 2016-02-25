<?php

namespace Base\AdminBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class FilmFilmAdmin extends SoifAdmin
{

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $em = $this->getConfigurationPool()->getContainer()->get('doctrine.orm.entity_manager');
        $years = $em->getRepository('BaseCoreBundle:FilmFestival')->findAll();

        $datagridMapper
            ->add('title', 'doctrine_orm_callback', array(
                'callback' => function ($queryBuilder, $alias, $field, $value) {
                    if (!$value['value']) {
                        return;
                    }
                    $queryBuilder->join("{$alias}.translations", 't');
                    $queryBuilder->andWhere('t.locale = :locale');
                    $queryBuilder->setParameter('locale', 'fr');
                    $queryBuilder->andWhere('t.title LIKE :title');
                    $queryBuilder->setParameter('title', '%' . $value['value'] . '%');

                    return true;
                },
                'field_type' => 'text'
            ))
            ->add('realisator', 'doctrine_orm_callback', array(
                'callback' => function ($queryBuilder, $alias, $field, $value) {
                    if ($value['value'] === null) {
                        return;
                    }
                    $queryBuilder->join("{$alias}.persons", 'fp');
                    $queryBuilder->join("fp.person", 'fpp');
                    $queryBuilder->join("fp.functions", 'ff');
                    $queryBuilder->join("ff.function", 'fff');
                    $queryBuilder->andWhere("fff.id = 3");
                    $queryBuilder->andWhere('UPPER(CONCAT(fpp.firstname , fpp.lastname)) LIKE UPPER(:name)');
                    $queryBuilder->setParameter('name', '%' . $value['value'] . '%');


                },
                'field_type' => 'text'
            ))
            ->add('selection', 'doctrine_orm_callback', array(
                'callback' => function ($queryBuilder, $alias, $field, $value) {
                    if ($value['value'] === null) {
                        return;
                    }
                    $queryBuilder->join("{$alias}.selectionSection", 'ts');
                    $queryBuilder->join("ts.translations", 'tst');
                    $queryBuilder->andWhere('tst.locale = :sectionLocale');
                    $queryBuilder->setParameter('sectionLocale', 'fr');
                    $queryBuilder->andWhere('UPPER(tst.name) LIKE UPPER(:name)');
                    $queryBuilder->setParameter('name', '%' . $value['value'] . '%');
                    return true;
                },
                'field_type' => 'text'
            ))
            ->add('festival-year', 'doctrine_orm_callback', array(
                'callback' => function ($queryBuilder, $alias, $field, $value) {
                    $em = $this->getConfigurationPool()->getContainer()->get('doctrine.orm.entity_manager');
                    $years = $em->getRepository('BaseCoreBundle:FilmFestival')->findAll();
                    if ($value['value'] === null) {
                        return;
                    }
                    $queryBuilder->join("{$alias}.festival", 'fs');
                    $queryBuilder->andWhere('fs.year LIKE :year');
                    $queryBuilder->setParameter('year', '%' . $years[$value['value']] . '%');
                    return true;
                },
                'field_type' => 'choice',
                'field_options' => array(
                    'choices' => $years
                )
            ))
            ->add('have_trailer', 'doctrine_orm_callback', array(
                'callback' => function ($queryBuilder, $alias, $field, $value) {
                    if ($value['value'] === null) {
                        return;
                    }

                    if ($value['value']) {
                        $queryBuilder->join("{$alias}.associatedMediaVideos", 'amv');
                        $queryBuilder->join('amv.mediaVideo', 'mv');
                        $queryBuilder->andWhere('mv.displayedTrailer = 1');
                    }
                    return true;
                },
                'field_type' => 'checkbox',
                'label' => 'filter.label_have_trailer',
            ));
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('title', null, array(
                'template' => 'BaseAdminBundle:FilmFilm:title.html.twig'
            ))
            ->add('realisator', null, array(
                'template' => 'BaseAdminBundle:FilmFilm:realisator.html.twig'
            ))
            ->add('selection', null, array(
                'template' => 'BaseAdminBundle:FilmFilm:selection.html.twig'
            ))
            ->add('festival-year', null, array(
                'template' => 'BaseAdminBundle:FilmFilm:festival-year.html.twig'
            ))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                    'soif_refresh' => array('template' => 'BaseAdminBundle:CRUD:list__action_soif_refresh.html.twig'),
                )
            ));
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
            ->add('createdAt')
            ->add('updatedAt')
            ->add('soifUpdatedAt');
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
            ->add('productionYear')
            ->add('duration')
            ->add('castingCommentary')
            ->add('website')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('soifUpdatedAt')
            ->add('persons')
            ->add('medias', null, array(
                'template' => 'BaseAdminBundle:FilmFilm:medias.html.twig'
            ));
    }
}
