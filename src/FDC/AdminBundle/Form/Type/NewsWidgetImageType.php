<?php

namespace FDC\AdminBundle\Form\Type;

use Sonata\AdminBundle\Form\DataTransformer\ModelToIdTransformer;

use Symfony\Component\Form\FormBuilderInterface;

class NewsWidgetImageType extends NewsWidgetType
{
    protected $dataClass = 'FDC\\CoreBundle\\Entity\\NewsWidgetImage';
    
    private $newsWidgetImageDummyAdmin;
    
    public function setNewsWidgetImageDummyAdmin($newsWidgetImageDummyAdmin)
    {
        $this->newsWidgetImageDummyAdmin = $newsWidgetImageDummyAdmin;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->add('gallery', 'sonata_type_model_list', array(
            'sonata_field_description' =>  $this->newsWidgetImageDummyAdmin->getFormFieldDescriptions()['gallery'],
            'model_manager' => $this->newsWidgetImageDummyAdmin->getModelManager(),
            'class' => $this->newsWidgetImageDummyAdmin->getClass(),
        ));
       // $builder->add('medias', 'sonata_type_collection', array(
           // 'sonata_field_description' =>  $this->newsWidgetImageDummyAdmin->getFormFieldDescriptions()['medias'],
        //    'model_manager' => $this->newsWidgetImageDummyAdmin->getModelManager(),
          //  'class' => $this->newsWidgetImageDummyAdmin->getClass(),
       // ));
       /* $builder->add('medias', 'sonata_type_collection', array(
            'by_reference' => false,
            'sonata_field_description' =>  $this->newsWidgetImageDummyAdmin->getFormFieldDescriptions()['medias'],
        ), array(
            'edit' => 'inline',
            'inline' => 'table',
            'sortable' => 'position',
        ));*/
    }

    public function getName()
    {
        return 'news_widget_image_type';
    }
}