<?php

namespace Base\AdminBundle\Admin;

use FDC\MarcheDuFilmBundle\Entity\ServiceWidgetProductTranslation;
use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Validator\Constraints\NotBlank;

class ServiceWidgetProductAdmin extends Admin
{

    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'DESC',
        '_sort_by' => 'id'
    );

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
                'required' => false,
                'label' => 'form.mdf.label.service_product_gallery'
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
                        'label'              => 'form.mdf.label.service_widget_product_url',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false
                    ),
                    'title'        => array(
                        'label'              => 'form.mdf.label.service_widget_product_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'constraints'        => array(
                            new NotBlank(),
                        ),
                        'required' => true
                    ),
                    'grayText'     => array(
                        'label'              => 'form.mdf.label.service_widget_product_gray_text',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false
                    ),
                    'colorText'     => array(
                        'label'              => 'form.mdf.label.service_widget_product_color_text',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false
                    ),
                    'body'         => array(
                        'label'              => 'form.mdf.label.service_widget_product_body',
                        'translation_domain' => 'BaseAdminBundle',
                        'constraints'        => array(
                            new NotBlank(),
                        ),
                        'required' => true
                    ),
                    'toggledBody'  => array(
                        'label'              => 'form.mdf.label.service_widget_product_toggled_body',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                        'attr' => array(
                            'class' => 'ckeditor'
                        ),
                        'field_type'         => 'ckeditor',
                        'config_name' => 'widget',
                        'input_sync' => true
                    ),
                    'createdAt'    => array(
                        'display' => false,
                    ),
                    'updatedAt'    => array(
                        'display' => false,
                    ),
                    'status'            => array(
                        'label'                     => 'form.mdf.label_status',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices'                   => ServiceWidgetProductTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle',
                    )
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
            ->add('id')
            ->add('title');
    }
}
