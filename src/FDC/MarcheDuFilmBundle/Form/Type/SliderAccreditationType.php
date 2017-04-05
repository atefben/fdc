<?php

namespace FDC\MarcheDuFilmBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Base\AdminBundle\Admin\MediaMdfImageAdmin;
use Symfony\Component\Form\AbstractType;
use Base\AdminBundle\Admin\MdfSliderAccreditationAdmin;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SliderAccreditationType extends AbstractType
{
    /**
     * @var string
     */
    protected $dataClass = 'FDC\MarcheDuFilmBundle\Entity\MdfSliderAccreditation';

    /**
     * @var MdfSliderAccreditationAdmin
     */
    private $sliderAccreditationAdmin;

    /**
     * @var MediaMdfImageAdmin
     */
    private $mediaImageAdmin;

    /**
     * @param $sliderAccreditationAdmin
     */
    public function setSliderAccreditationAdmin($sliderAccreditationAdmin)
    {
        $this->sliderAccreditationAdmin = $sliderAccreditationAdmin;
    }

    public function setMediaImageAdmin($mediaImageAdmin)
    {
        $this->mediaImageAdmin = $mediaImageAdmin;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('_type', 'hidden', array(
                'data'   => $this->getName(),
                'mapped' => false
            ))
            ->add('position', 'hidden')
            ->add('translations', 'a2lix_translations', array(
                'translation_domain' => 'BaseAdminBundle',
                'fields' => array(
                    'applyChanges' => array(
                        'field_type' => 'hidden',
                        'attr'       => array(
                            'class' => 'hidden',
                        ),
                    ),
                    'title'          => array(
                        'label'              => 'form.mdf.label.slider_accreditation_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'constraints'        => array(
                            new NotBlank(),
                        ),
                        'required' => true,
                    ),
                    'subTitle'          => array(
                        'label'              => 'form.mdf.label.slider_accreditation_subtitle',
                        'translation_domain' => 'BaseAdminBundle',
                        'constraints'        => array(
                            new NotBlank(),
                        ),
                        'required' => true,
                    ),
                    'url'          => array(
                        'label'              => 'form.mdf.label.slider_accreditation_url',
                        'translation_domain' => 'BaseAdminBundle',
                        'constraints'        => array(
                            new NotBlank(),
                        ),
                        'required' => true,
                    ),
                ),
            ))
            ->add('image', 'sonata_type_model_list', array(
                'label' => 'form.mdf.label.slider_accreditation_image',
                'sonata_field_description' =>  $this->sliderAccreditationAdmin->getFormFieldDescriptions()['image'],
                'model_manager' => $this->mediaImageAdmin->getModelManager(),
                'class' => $this->mediaImageAdmin->getClass(),
                'translation_domain' => 'BaseAdminBundle',
                'constraints'        => array(
                    new NotBlank(),
                ),
                'btn_delete' => false,
                'required' => true
            ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'  => $this->dataClass,
            'model_class' => $this->dataClass,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'slider_accreditation_type';
    }
}
