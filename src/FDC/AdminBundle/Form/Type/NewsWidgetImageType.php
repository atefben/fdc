<?php

namespace FDC\AdminBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;

class NewsWidgetImageType extends NewsWidgetType
{
    protected $dataClass = 'FDC\\CoreBundle\\Entity\\NewsWidgetImage';

    private $galleryDummyAdmin;
    
    private $newsWidgetImageDummyAdmin;
    
    public function setGalleryDummyAdmin($galleryDummyAdmin)
    {
        $this->galleryDummyAdmin = $galleryDummyAdmin;
    }
    
    public function setNewsWidgetImageDummyAdmin($newsWidgetImageDummyAdmin)
    {
        $this->newsWidgetImageDummyAdmin = $newsWidgetImageDummyAdmin;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->add('gallery', 'sonata_type_model_list', array(
            'sonata_field_description' => $this->newsWidgetImageDummyAdmin->getFormFieldDescriptions()['gallery'],
            'model_manager' => $this->galleryDummyAdmin->getModelManager(),
            'class' => $this->galleryDummyAdmin->getClass()
        ));
    }

    public function getName()
    {
        return 'news_widget_image_type';
    }
}