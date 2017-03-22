<?php

namespace FDC\CourtMetrageBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Base\AdminBundle\Admin\CCM\MediaImageAdmin;
use FDC\CourtMetrageBundle\Entity\HomepageSejourTranslation;
use Symfony\Component\Validator\Constraints\Url;

class HomepageSejourType extends AbstractType
{
    /**
     * @var string
     */
    protected $dataClass = 'FDC\CourtMetrageBundle\Entity\HomepageSejour';

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
                    'title1'          => array(
                        'label'              => 'form.ccm.label.sejour.title1',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'title2'          => array(
                        'label'              => 'form.ccm.label.sejour.title2',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'url'          => array(
                        'label'              => 'form.ccm.label.sejour.url',
                        'translation_domain' => 'BaseAdminBundle',
                        'sonata_help' => 'form.ccm.label.external_url',
                        'constraints' => array(
                            new Url()
                        ),
                    ),
                    'button'          => array(
                        'label'              => 'form.ccm.label.sejour.button',
                        'translation_domain' => 'BaseAdminBundle',
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
        return 'ccm_homepage_sejour_type';
    }
}
