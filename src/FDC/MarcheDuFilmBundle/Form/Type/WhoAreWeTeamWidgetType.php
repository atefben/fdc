<?php

namespace FDC\MarcheDuFilmBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Base\AdminBundle\Admin\MediaMdfImageAdmin;
use Symfony\Component\Validator\Constraints\NotBlank;

class WhoAreWeTeamWidgetType extends AbstractType
{
    /**
     * @var string
     */
    protected $dataClass = 'FDC\MarcheDuFilmBundle\Entity\MdfWhoAreWeTeamWidget';

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
                    'name'          => array(
                        'label'              => 'form.mdf.label.wo_are_we_team.widget_name',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => true
                    ),
                    'post'          => array(
                        'label'              => 'form.mdf.label.wo_are_we_team.widget_post',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => true
                    ),
                    'email'          => array(
                        'label'              => 'form.mdf.label.wo_are_we_team.widget_email',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false
                    ),
                    'phone'          => array(
                        'label'              => 'form.mdf.label.wo_are_we_team.widget_phone',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false
                    )
                ),
            ))
            ->add('image', 'sonata_type_model_list', array(
                'label' => 'form.mdf.label.wo_are_we_team.widget_image',
                'sonata_field_description' =>  $this->admin->getFormFieldDescriptions()['image'],
                'model_manager' => $this->mediaImageAdmin->getModelManager(),
                'class' => $this->mediaImageAdmin->getClass(),
                'translation_domain' => 'BaseAdminBundle',
                'btn_delete' => false,
                'required' => false
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
        return 'who_are_we_team_widget_type';
    }
}
