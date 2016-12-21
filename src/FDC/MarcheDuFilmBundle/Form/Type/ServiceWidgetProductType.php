<?php

namespace FDC\MarcheDuFilmBundle\Form\Type;

use Base\AdminBundle\Admin\GalleryAdmin;
use Base\AdminBundle\Admin\MediaImageAdmin;
use Base\AdminBundle\Admin\ServiceWidgetProductAdmin;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * NewsWidgetTextType class.
 *
 * \@extends NewsWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class ServiceWidgetProductType extends ServiceWidgetType
{
    /**
     * @var string
     */
    protected $dataClass = 'FDC\MarcheDuFilmBundle\Entity\ServiceWidgetProduct';

    /**
     * @var ServiceWidgetProductAdmin
     */
    private $serviceWidgetProductAdmin;

    /**
     * @var GalleryAdmin
     */
    private $galleryAdmin;

    public function setGalleryAdmin($galleryAdmin)
    {
        $this->galleryAdmin = $galleryAdmin;
    }

    public function setServiceWidgetProductAdmin($serviceWidgetProductAdmin)
    {
        $this->serviceWidgetProductAdmin = $serviceWidgetProductAdmin;
    }


    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('gallery', 'sonata_type_model_list', array(
                'sonata_field_description' =>  $this->serviceWidgetProductAdmin->getFormFieldDescriptions()['gallery'],
                'model_manager' => $this->galleryAdmin->getModelManager(),
                'class' => $this->galleryAdmin->getClass(),
                'btn_delete' => false,
                'label' => 'form.label.service._widget_product_gallery'

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
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'service_widget_product_type';
    }
}