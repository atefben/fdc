<?php

namespace Base\AdminBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;

class EventWidgetMosaicMovieType extends EventWidgetType
{
    /**
     * dataClass
     *
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\CoreBundle\Entity\EventWidgetMosaicMovie';

    /**
     * @var
     */
    private $eventWidgetMosaicMovieDummyAdmin;

    /**
     * @var
     */
    private $widgetMosaicMovieAdmin;

    public function setEventWidgetMosaicMovieDummyAdmin($eventWidgetMosaicMovieDummyAdmin)
    {
        $this->eventWidgetMosaicMovieDummyAdmin = $eventWidgetMosaicMovieDummyAdmin;
    }

    public function setWidgetMosaicMovieAdmin($widgetMosaicMovieAdmin)
    {
        $this->widgetMosaicMovieAdmin = $widgetMosaicMovieAdmin;
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
        $builder->add('widgetMosaicMovie', 'sonata_type_model_list', array(
            'sonata_field_description' =>  $this->eventWidgetMosaicMovieDummyAdmin->getFormFieldDescriptions()['widgetMosaicMovie'],
            'model_manager' => $this->widgetMosaicMovieAdmin->getModelManager(),
            'class' => $this->widgetMosaicMovieAdmin->getClass(),
            'label' => false
        ));
    }

    /**
     * getName function.
     *
     * @access public
     * @return void
     */
    public function getName()
    {
        return 'event_widget_mosaic_movie_type';
    }
}