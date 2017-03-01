<?php

namespace FDC\MarcheDuFilmBundle\Form\Type;

use Base\AdminBundle\Admin\MediaMdfPdfAdmin;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Base\AdminBundle\Admin\MediaMdfImageAdmin;
use Symfony\Component\Validator\Constraints\NotBlank;

class PressGraphicalCharterWidgetType extends AbstractType
{
    /**
     * @var string
     */
    protected $dataClass = 'FDC\MarcheDuFilmBundle\Entity\MdfPressGraphicalCharterWidget';

    /**
     * admin
     *
     * @var mixed
     * @access private
     */
    private $admin;

    /**
     * @var MediaMdfImageAdmin
     */
    private $mediaImageAdmin;

    /**
     * @var
     */
    private $fileAdmin;

    /**
     * @var MediaMdfPdfAdmin
     */
    private $mediaFileAdmin;

    public function setMediaFileAdmin($mediaFileAdmin)
    {
        $this->mediaFileAdmin = $mediaFileAdmin;
    }

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
        $builder
            ->add('_type', 'hidden', array(
                'data'   => $this->getName(),
                'mapped' => false
            ))
            ->add('position', 'hidden')
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
                    'title'          => array(
                        'label'              => 'form.mdf.label.press.graphical_charter_widget_title',
                        'translation_domain' => 'BaseAdminBundle',
                    )
                ),
            ))
            ->add('image', 'sonata_type_model_list', array(
                'constraints' => array(
                    new NotBlank(),
                ),
                'label' => 'form.mdf.label.press.graphical_charter_widget_image',
                'sonata_field_description' =>  $this->admin->getFormFieldDescriptions()['image'],
                'model_manager' => $this->mediaImageAdmin->getModelManager(),
                'class' => $this->mediaImageAdmin->getClass(),
                'translation_domain' => 'BaseAdminBundle',
                'btn_delete' => false,
                'required' => true
            ))
            ->add('epsFile', 'sonata_type_model_list', array(
                'sonata_field_description' =>  $this->admin->getFormFieldDescriptions()['epsFile'],
                'model_manager' => $this->mediaFileAdmin->getModelManager(),
                'class' => $this->mediaFileAdmin->getClass(),
                'btn_delete' => false,
                'label' => 'form.label_file_eps',
                'translation_domain' => 'BaseAdminBundle'
            ));
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class'  => $this->dataClass,
                'model_class' => $this->dataClass,
            ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'press_graphical_charter_widget_type';
    }
}
