<?php

namespace FDC\MarcheDuFilmBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Base\AdminBundle\Admin\GalleryMdfAdmin;

class ContentTemplateWidgetGalleryType extends ContentTemplateWidgetType
{
    /**
     * @var string
     */
    protected $dataClass = 'FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateWidgetGallery';

    /**
     * admin
     *
     * @var mixed
     * @access private
     */
    private $admin;

    /**
     * @var GalleryMdfAdmin
     */
    private $mediaGalleryAdmin;

    /**
     * setSonataAdmin function.
     *
     * @access public
     * @param mixed $admin
     * @return void
     */
    public function setSonataAdmin($admin)
    {
        $this->admin = $admin;
    }

    public function setMediaGalleryAdmin($mediaGalleryAdmin)
    {
        $this->mediaGalleryAdmin = $mediaGalleryAdmin;
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
                'sonata_field_description' =>  $this->admin->getFormFieldDescriptions()['gallery'],
                'model_manager' => $this->mediaGalleryAdmin->getModelManager(),
                'class' => $this->mediaGalleryAdmin->getClass(),
                'btn_delete' => false,
                'label' => 'form.mdf.content_template.label.gallery',
                'translation_domain' => 'BaseAdminBundle'

            ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'content_template_widget_gallery_type';
    }
}