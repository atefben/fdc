<?php

namespace FDC\AdminBundle\Form\Type;

use Sonata\AdminBundle\Form\DataTransformer\ModelToIdTransformer;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * NewsWidgetImageType class.
 * 
 * \@extends NewsWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class NewsWidgetImageType extends NewsWidgetType
{
    
    /**
     * dataClass
     * 
     * (default value: 'FDC\\CoreBundle\\Entity\\NewsWidgetImage')
     * 
     * @var string
     * @access protected
     */
    protected $dataClass = 'FDC\\CoreBundle\\Entity\\NewsWidgetImage';
    
    /**
     * newsWidgetImageDummyAdmin
     * 
     * @var mixed
     * @access private
     */
    private $newsWidgetImageDummyAdmin;
    
    /**
     * setNewsWidgetImageDummyAdmin function.
     * 
     * @access public
     * @param mixed $newsWidgetImageDummyAdmin
     * @return void
     */
    public function setNewsWidgetImageDummyAdmin($newsWidgetImageDummyAdmin)
    {
        $this->newsWidgetImageDummyAdmin = $newsWidgetImageDummyAdmin;
    }
    
    /**
     * buildForm function.
     * 
     * @access public
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return void
     */
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

    /**
     * getName function.
     * 
     * @access public
     * @return void
     */
    public function getName()
    {
        return 'news_widget_image_type';
    }
}