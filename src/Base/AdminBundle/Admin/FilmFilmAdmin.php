<?php

namespace Base\AdminBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class FilmFilmAdmin extends SoifAdmin
{

    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            array('BaseAdminBundle:FilmFilm:edit.html.twig')
        );
    }

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
                    $queryBuilder->where("{$alias}.titleVO LIKE :title");
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
                    $queryBuilder->andWhere('(UPPER(fpp.firstname) LIKE UPPER(:name) OR UPPER(fpp.lastname) LIKE UPPER(:name))');
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
                    $queryBuilder->andWhere('UPPER(tst.name) LIKE UPPER(:selectionname)');
                    $queryBuilder->setParameter('selectionname', '%' . $value['value'] . '%');
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
            ))
            ->add('_preview', null, array(
                'template' => 'BaseAdminBundle:FilmFilm:list_preview.html.twig'
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Informations Générales')
                ->add('director', 'text', array(
                    'label' => false,
                    'mapped' => false
                ))
                ->add('imageMain', 'sonata_type_model_list', array(
                    'help' => 'Dimensions attendues : YxZpx - ratio paysage. Format Attendu.',
                ), array(
                    'link_parameters' => array('context' => 'film_poster')
                ))
                ->add('imageCover', 'sonata_type_model_list', array(
                    'help' => 'Dimensions attendues : YxZpx - ratio paysage. Format Attendu.'

                ), array(
                    'link_parameters' => array('context' => 'film_image_cover')
                ))
                ->add('videoMain', 'sonata_type_model_list', array(
                    'help' => 'Lorem ipsum sit dolor amet.'
                ))
            ->end()
            ->with('Associations')
                ->add('associatedMediaVideos', 'sonata_type_collection', array(
                    'label' => 'form.label_film_film_media_video',
                    'help' => 'form.film.helper_film_film_media_video',
                    'by_reference' => false,
                    'required' => false,
                    ), array(
                        'edit' => 'inline',
                        'inline' => 'table'
                    )
                )
                ->add('associatedMediaAudios', 'sonata_type_collection', array(
                    'label' => 'form.label_film_film_media_audio',
                    'help' => 'form.film.helper_film_film_media_audio',
                    'by_reference' => false,
                    'required' => false,
                ), array(
                        'edit' => 'inline',
                        'inline' => 'table'
                    )
                )
                ->add('associatedInfo', 'sonata_type_collection', array(
                    'label' => 'form.label_film_film_associated_info',
                    'help' => 'form.film.helper_film_film_associated_info',
                    'by_reference' => false,
                    'required' => false,
                    ), array(
                        'edit' => 'inline',
                        'inline' => 'table'
                    )
                )
                ->add('associatedStatement', 'sonata_type_collection', array(
                    'label' => 'form.label_film_film_associated_statement',
                    'help' => 'form.film.helper_film_film_associated_statement',
                    'by_reference' => false,
                    'required' => false,
                    ), array(
                        'edit' => 'inline',
                        'inline' => 'table'
                    )
                )
                ->add('associatedNews', 'sonata_type_collection', array(
                    'label' => 'form.label_film_film_associated_news',
                    'help' => 'form.film.helper_film_film_associated_news',
                    'by_reference' => false,
                    'required' => false,
                ), array(
                        'edit' => 'inline',
                        'inline' => 'table'
                    )
                )
                ->add('tags', 'sonata_type_collection', array(
                    'label' => 'form.label_article_tags',
                    'help' => 'form.news.helper_tags',
                    'by_reference' => false,
                    'required' => false,
                ), array(
                        'edit' => 'inline',
                        'inline' => 'table'
                    )
                )
            ->end();

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
