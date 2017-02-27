<?php

namespace FDC\CourtMetrageBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Base\AdminBundle\Admin\ThemeAdmin;
use FDC\CourtMetrageBundle\Entity\HomepageActualiteTranslation;

class HomepageActualiteType extends AbstractType
{
    /**
     * @var string
     */
    protected $dataClass = 'FDC\CourtMetrageBundle\Entity\HomepageActualite';

    /**
     * admin
     *
     * @var mixed
     * @access private
     */
    private $adminTheme;

    /**
     * @var ThemeAdmin
     */
    private $themeAdmin;

    /**
     * @var ImageAdmin
     */
    private $imageAdmin;

    /**
     * setSonataAdmin function.
     *
     * @access public
     * @param mixed $admin
     * @return void
     */
    public function setSonataAdminTheme($adminTheme)
    {
        $this->adminTheme = $adminTheme;
    }

    public function setThemeAdmin($themeAdmin)
    {
        $this->themeAdmin = $themeAdmin;
    }

    public function setImageAdmin($imageAdmin)
    {
        $this->imageAdmin = $imageAdmin;
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
                        'label'              => 'form.ccm.label.actualite.title',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'description'          => array(
                        'label'              => 'form.ccm.label.actualite.description',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'url'          => array(
                        'label'              => 'form.ccm.label.actualite.url',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                ),
            ))
            ->add('image', 'sonata_type_model_list', array(
                'constraints'        => array(
                    new NotBlank(),
                ),
                'label' => 'form.label_image',
                'sonata_field_description' =>  $this->adminTheme->getFormFieldDescriptions()['image'],
                'model_manager' => $this->imageAdmin->getModelManager(),
                'class' => $this->imageAdmin->getClass(),
                'translation_domain' => 'BaseAdminBundle',
                'btn_delete' => false,
                'required' => true,
            ))
            ->add('theme', 'sonata_type_model_list', array(
                'constraints'        => array(
                    new NotBlank(),
                ),
                'label' => 'form.label_theme',
                'sonata_field_description' =>  $this->adminTheme->getFormFieldDescriptions()['theme'],
                'model_manager' => $this->themeAdmin->getModelManager(),
                'class' => $this->themeAdmin->getClass(),
                'translation_domain' => 'BaseAdminBundle',
                'btn_delete' => false,
                'required' => true,
            ))
            ->add('date', 'sonata_type_datetime_picker', array(
                'label'    => 'form.ccm.label.actualite.date',
                'translation_domain' => 'BaseAdminBundle',
                'format'   => 'dd/MM/yyyy',
                'required' => true,
                'attr'     => array(
                    'data-date-format' => 'dd/MM/yyyy',
                ),
            ))
            ->add('isActive', 'checkbox', array(
                'label'    => 'form.ccm.label.actualite.is_active_actualite',
                'translation_domain' => 'BaseAdminBundle',
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
        return 'ccm_homepage_actualite_type';
    }
}
