<?php

namespace Base\AdminBundle\Admin\CCM;

use FDC\CourtMetrageBundle\Entity\CcmFilmRegisterTranslation;
use FDC\CourtMetrageBundle\Entity\CcmShortFilmCompetitionTab;
use FDC\CourtMetrageBundle\Entity\CcmShortFilmCompetitionTabTranslation;
use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class CcmFilmRegisterAdmin extends Admin
{
    public function configure()
    {
        $this->setTemplate('edit', 'BaseAdminBundle:CRUD:edit_polycollection.html.twig');
    }

    /**
     * @return array
     */
    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            array('BaseAdminBundle:Form:polycollection.html.twig')
        );
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit'   => array(),
                ),
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('translations', 'a2lix_translations', array(
                'locales' => ['fr','en'],
                'label'  => false,
                'fields' => array(
                    'applyChanges'      => array(
                        'field_type' => 'hidden',
                        'attr'       => array(
                            'class' => 'hidden',
                        ),
                    ),
                    'title'          => array(
                        'label'              => 'form.ccm.film_register.title',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'text'          => array(
                        'label'              => 'form.ccm.film_register.text',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                        'attr' => array(
                            'class' => 'ckeditor'
                        ),
                        'field_type'         => 'ckeditor',
                        'config_name' => 'ccm_widget',
                        'input_sync' => true
                    ),
                    'proceduresTitle'        => array(
                        'label'              => 'form.ccm.film_register.procedures_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                        'field_type'         => 'ckeditor'
                    ),
                    'status'         => array(
                        'label'                     => 'form.label_status',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices'                   => CcmFilmRegisterTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle'
                    )
                )
            ))
            ->add('headerPhoto', 'sonata_type_model_list', array(
                'label' => 'form.ccm.film_register.header_photo',
                'translation_domain' => 'BaseAdminBundle',
                'btn_delete' => false,
                'required' => true
            ))
            ->add('filmRegisterProcedure', 'infinite_form_polycollection', array(
                'label'        => false,
                'types'        => array(
                    'film_register_procedure',
                ),
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
                'by_reference' => false,
            ))
        ;
    }

    /**
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(['edit', 'list']);
    }
}
