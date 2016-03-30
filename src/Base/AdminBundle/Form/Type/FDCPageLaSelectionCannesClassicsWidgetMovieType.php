<?php

namespace Base\AdminBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * FDCPageLaSelectionCannesClassicsWidgetMovieType class.
 *
 * \@extends FDCPageLaSelectionCannesClassicsWidgetType
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class FDCPageLaSelectionCannesClassicsWidgetMovieType extends FDCPageLaSelectionCannesClassicsWidgetType
{
    /**
     * dataClass
     *
     * (default value: 'Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidgetMovieType')
     *
     * @var string
     * @access protected
     */
    protected $dataClass = 'Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidgetMovie';

    private $FDCPageLaSelectionCannesClassicsMovieDummyAdmin;

    /**
     * setFDCPageLaSelectionCannesClassicsWidgetImageDummyAdmin function.
     *
     * @access public
     * @param mixed $FDCPageLaSelectionCannesClassicsImageDummyAdmin
     * @return void
     */
    public function setFDCPageLaSelectionCannesClassicsWidgetMovieDummyAdmin($FDCPageLaSelectionCannesClassicsMovieDummyAdmin)
    {
        $this->FDCPageLaSelectionCannesClassicsMovieDummyAdmin = $FDCPageLaSelectionCannesClassicsMovieDummyAdmin;
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
        $builder->add('films', 'sonata_type_collection', array(
            'sonata_field_description' =>  $this->FDCPageLaSelectionCannesClassicsMovieDummyAdmin->getFormFieldDescriptions()['films'],
         //   'model_manager' => $this->galleryAdmin->getModelManager(),
         //   'class' => $this->galleryAdmin->getClass(),
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
        return 'fdc_page_la_selection_cannes_classics_widget_movie_type';
    }
}