<?php

namespace Base\AdminBundle\Form\Type;

use Sonata\AdminBundle\Form\DataTransformer\ModelToIdTransformer;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * EventWidgetImageType class.
 * 
 * \@extends EventWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class EventWidgetImageType extends EventWidgetType
{
    
    /**
     * dataClass
     * 
     * (default value: 'Base\\CoreBundle\\Entity\\EventWidgetImage')
     * 
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\\CoreBundle\\Entity\\EventWidgetImage';
    
    /**
     * eventWidgetImageDummyAdmin
     * 
     * @var mixed
     * @access private
     */
    private $eventWidgetImageDummyAdmin;
    
    /**
     * setEventWidgetImageDummyAdmin function.
     * 
     * @access public
     * @param mixed $eventWidgetImageDummyAdmin
     * @return void
     */
    public function setEventWidgetImageDummyAdmin($eventWidgetImageDummyAdmin)
    {
        $this->eventWidgetImageDummyAdmin = $eventWidgetImageDummyAdmin;
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
            'sonata_field_description' =>  $this->eventWidgetImageDummyAdmin->getFormFieldDescriptions()['gallery'],
            'model_manager' => $this->eventWidgetImageDummyAdmin->getModelManager(),
            'class' => $this->eventWidgetImageDummyAdmin->getClass(),
        ));
       // $builder->add('medias', 'sonata_type_collection', array(
           // 'sonata_field_description' =>  $this->eventWidgetImageDummyAdmin->getFormFieldDescriptions()['medias'],
        //    'model_manager' => $this->eventWidgetImageDummyAdmin->getModelManager(),
          //  'class' => $this->eventWidgetImageDummyAdmin->getClass(),
       // ));
       /* $builder->add('medias', 'sonata_type_collection', array(
            'by_reference' => false,
            'sonata_field_description' =>  $this->eventWidgetImageDummyAdmin->getFormFieldDescriptions()['medias'],
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
        return 'event_widget_image_type';
    }
}