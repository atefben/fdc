<?php

namespace Base\AdminBundle\Form\Type;

use Sonata\AdminBundle\Form\DataTransformer\ModelToIdTransformer;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * FDCPageLaSelectionCannesClassicsWidgetImageType class.
 * 
 * \@extends FDCPageLaSelectionCannesClassicsWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class FDCPageLaSelectionCannesClassicsWidgetImageType extends FDCPageLaSelectionCannesClassicsWidgetType
{
    
    /**
     * dataClass
     * 
     * (default value: 'Base\\CoreBundle\\Entity\\FDCPageLaSelectionCannesClassicsWidgetImage')
     * 
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\\CoreBundle\\Entity\\FDCPageLaSelectionCannesClassicsWidgetImage';
    
    /**
     * FDCPageLaSelectionCannesClassicsImageDummyAdmin
     * 
     * @var mixed
     * @access private
     */
    private $FDCPageLaSelectionCannesClassicsImageDummyAdmin;

    private $galleryAdmin;
    
    /**
     * setFDCPageLaSelectionCannesClassicsWidgetImageDummyAdmin function.
     * 
     * @access public
     * @param mixed $FDCPageLaSelectionCannesClassicsImageDummyAdmin
     * @return void
     */
    public function setFDCPageLaSelectionCannesClassicsWidgetImageDummyAdmin($FDCPageLaSelectionCannesClassicsImageDummyAdmin)
    {
        $this->FDCPageLaSelectionCannesClassicsImageDummyAdmin = $FDCPageLaSelectionCannesClassicsImageDummyAdmin;
    }

    public function setgalleryAdmin($galleryAdmin)
    {
        $this->galleryAdmin = $galleryAdmin;
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
            'sonata_field_description' =>  $this->FDCPageLaSelectionCannesClassicsImageDummyAdmin->getFormFieldDescriptions()['gallery'],
            'model_manager' => $this->galleryAdmin->getModelManager(),
            'class' => $this->galleryAdmin->getClass(),
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
        return 'fdc_page_la_selection_cannes_classics_widget_image_type';
    }
}