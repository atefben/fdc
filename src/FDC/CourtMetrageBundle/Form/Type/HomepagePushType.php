<?php

namespace FDC\CourtMetrageBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Base\AdminBundle\Admin\CCM\MediaImageAdmin;
use FDC\CourtMetrageBundle\Entity\HomepageSliderTranslation;

class HomepagePushType extends AbstractType
{
    /**
     * @var string
     */
    protected $dataClass = 'FDC\CourtMetrageBundle\Entity\HomepagePush';

    /**
     * admin
     *
     * @var mixed
     * @access private
     */
    private $admin;

    /**
     * @var MediaImageAdmin
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
            ->add('translations', 'a2lix_translations', array(
                'locales' => ['fr','en'],
                'translation_domain' => 'BaseAdminBundle',
                'required_locales' => array('fr'),
                'fields' => array(
                    'applyChanges' => array(
                        'field_type' => 'hidden',
                        'attr'       => array(
                            'class' => 'hidden',
                        ),
                    ),
                    'whiteTitle'          => array(
                        'label'              => 'form.ccm.label.push.whiteTitle',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false
                    ),
                    'goldenTitle'          => array(
                        'label'              => 'form.ccm.label.push.goldenTitle',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false
                    ),
                    'url'          => array(
                        'label'              => 'form.ccm.label.push.url',
                        'translation_domain' => 'BaseAdminBundle',
                        'sonata_help' => 'form.ccm.label.help_relative_url',
                    ),
                ),
            ))
            ->add('image', 'sonata_type_model_list', array(
                'constraints'        => array(
                    new NotBlank(),
                ),
                'label' => 'form.label_image',
                'sonata_field_description' =>  $this->admin->getFormFieldDescriptions()['image'],
                'model_manager' => $this->mediaImageAdmin->getModelManager(),
                'class' => $this->mediaImageAdmin->getClass(),
                'translation_domain' => 'BaseAdminBundle',
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
        return 'ccm_homepage_push_type';
    }
}
