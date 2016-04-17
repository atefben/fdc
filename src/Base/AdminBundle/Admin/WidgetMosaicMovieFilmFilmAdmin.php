<?php

namespace Base\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class WidgetMosaicMovieFilmFilmAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('titleOriginal')
            ->add('year')
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
            ->add('titleOriginal')
            ->add('year')
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
        if (isset($_GET['trans']) && isset($_GET['locale']) && $_GET['trans'] == '1') {
            $locale = $_GET['locale'];
            $formMapper
                ->add('translations', 'a2lix_translations', array(
                    'locales' => array($locale),
                    'label' => 'form.widget_mosaic_movie_film_film_translation.label_title',
                    'required' => false,
                    'fields' => array(
                        'title' => array(
                            'required' => false,
                            'label' => false,
                            'translation_domain' => 'BaseAdminBundle',
                        ),
                        'createdAt' => array(
                            'display' => false
                        ),
                        'updatedAt' => array(
                            'display' => false
                        ),
                    )
                ))
            ;
        } else {
            $formMapper
                ->add('image', 'sonata_type_model_list', array(
                    'label' => 'form.widget_mosaic_movie_film_film.image',
                    'required' => false
                ))
                ->add('translations', 'a2lix_translations', array(
                    'locales' => array('fr'),
                    'label' => 'form.widget_mosaic_movie_film_film_translation.label_title',
                    'required' => false,
                    'fields' => array(
                        'title' => array(
                            'required' => false,
                            'label' => false,
                            'translation_domain' => 'BaseAdminBundle',
                        ),
                        'createdAt' => array(
                            'display' => false
                        ),
                        'updatedAt' => array(
                            'display' => false
                        ),
                    )
                ))
                ->add('titleOriginal')
                ->add('year')
            ;
        }
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('titleOriginal')
            ->add('year')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }
}
