<?php

namespace FDC\MarcheDuFilmBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Base\AdminBundle\Admin\MediaMdfImageAdmin;

class DispatchDeServiceWidgetType extends AbstractType
{
    /**
     * @var string
     */
    protected $dataClass = 'FDC\MarcheDuFilmBundle\Entity\DispatchDeServiceWidget';

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
                        'label'              => 'form.mdf.label.dispatch_de_service_widget_title',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'subtitle'          => array(
                        'label'              => 'form.mdf.label.dispatch_de_service_widget_sub_title',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'description'          => array(
                        'field_type' => 'ckeditor',
                        'label'              => 'form.mdf.label.dispatch_de_service_widget_description',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'seeMoreUrl'          => array(
                        'label'              => 'form.mdf.label.dispatch_de_service_widget_see_more_url',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                ),
            ))
            ->add('image', 'sonata_type_model_list', array(
                'constraints'        => array(
                    new NotBlank(),
                ),
                'label' => 'form.mdf.label.header_image',
                'sonata_field_description' =>  $this->admin->getFormFieldDescriptions()['image'],
                'model_manager' => $this->mediaImageAdmin->getModelManager(),
                'class' => $this->mediaImageAdmin->getClass(),
                'translation_domain' => 'BaseAdminBundle',
                'btn_delete' => false,
                'required' => true
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
        return 'dispatch_de_service_widget_type';
    }
}
