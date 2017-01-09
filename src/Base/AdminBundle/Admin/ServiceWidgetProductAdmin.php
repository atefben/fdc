<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ServiceWidgetProductAdmin extends Admin
{

    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'DESC',
        '_sort_by' => 'id'
    );

    protected $translationDomain = 'BaseAdminBundle';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id', null, array('label' => 'filter.common.label_id'))
            ->add('title', null, array(
                'translation_domain' => 'BaseAdminBundle',
            ))
            ->add('displayedHomeCorpo', null, array(
                'label'      => 'filter.label_homepage_corpo_displayed_galleries',
                'field_type' => 'checkbox',
            ))
        ;

        $datagridMapper = $this->addCreatedBetweenFilters($datagridMapper);
    }

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
            ->add('gallery', 'sonata_type_model_list',array(
                'btn_delete' => true
            ))
            ->add('translations', 'a2lix_translations', array(
                'translation_domain' => 'BaseAdminBundle',
                'required_locales' => array('fr'),
                'fields' => array(
                    'applyChanges' => array(
                        'field_type' => 'hidden',
                        'attr'       => array(
                            'class' => 'hidden',
                        ),
                    ),
                    'url'          => array(
                        'label'              => 'form.label.service_widget_product_url',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'title'        => array(
                        'label'              => 'form.label.service_widget_product_title',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'subTitle'     => array(
                        'label'              => 'form.label.service_widget_product_sub_title',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'body'         => array(
                        'label'              => 'form.label.service_widget_product_body',
                        'translation_domain' => 'BaseAdminBundle',
                        'attr'               => array(
                            'class' => 'ckeditor',
                        ),
                        'required'           => false,
                        'field_type'         => 'ckeditor',
                        'config_name'        => 'widget',
                    ),
                    'toggledBody'  => array(
                        'label'              => 'form.label.service_widget_product_toggled_body',
                        'translation_domain' => 'BaseAdminBundle',
                        'attr'               => array(
                            'class' => 'ckeditor',
                        ),
                        'required'           => false,
                        'field_type'         => 'ckeditor',
                        'config_name'        => 'widget',
                    ),
                    'createdAt'    => array(
                        'display' => false,
                    ),
                    'updatedAt'    => array(
                        'display' => false,
                    ),
                ),
            ));
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id');
    }
}
