<?php

namespace Base\AdminBundle\Admin;

use FDC\MarcheDuFilmBundle\Entity\MdfGlobalEvents;
use FDC\MarcheDuFilmBundle\Entity\MdfGlobalEventsTranslation;
use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class MdfGlobalEventsAdmin
 * @package Base\AdminBundle\Admin
 */
class MdfGlobalEventsAdmin extends Admin
{

    protected $translationDomain = 'BaseAdminBundle';

    public function configure()
    {
        $this->setTemplate('edit', 'BaseAdminBundle:CRUD:edit_polycollection.html.twig');
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id', null, array('label' => 'filter.common.label_id'))
            ->add('title')
            ->add('createdAt', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_created_at.html.twig',
                'sortable' => 'createdAt',
            ))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
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
            ->add('translations', 'a2lix_translations', array(
                'label'  => false,
                'fields' => array(
                    'applyChanges'      => array(
                        'field_type' => 'hidden',
                        'attr'       => array(
                            'class' => 'hidden',
                        ),
                    ),
                    'title'          => array(
                        'label'              => 'form.mdf.label.global_events_title',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'body'            => array(
                        'label'              => 'form.mdf.label.global_events_description',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                        'attr' => array(
                            'class' => 'ckeditor'
                        ),
                        'config_name' => 'widget',
                        'field_type' => 'ckeditor',
                    ),
                    'createdAt'         => array(
                        'display' => false,
                    ),
                    'updatedAt'         => array(
                        'display' => false,
                    ),'status'            => array(
                        'label'                     => 'form.mdf.label_status',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices'                   => MdfGlobalEventsTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle',
                    ),
                ),
            ))
            ->add('daysCollection', 'sonata_type_collection', array(
                'by_reference'       => false,
                'label'              => 'form.mdf.label.global_events_days_collection',
                'translation_domain' => 'BaseAdminBundle',
            ), array(
                'edit'     => 'inline',
                'inline'   => 'table',
                'sortable' => 'position',
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
            ->add('title')
        ;
    }
}
