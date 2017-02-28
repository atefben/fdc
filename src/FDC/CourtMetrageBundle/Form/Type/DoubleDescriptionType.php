<?php

namespace FDC\CourtMetrageBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Validator\Constraints\NotBlank;

class DoubleDescriptionType extends DescriptionType
{
    /**
     * @var string
     */
    protected $dataClass = 'FDC\CourtMetrageBundle\Entity\CcmProsDescriptionDoubleColumn';

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('translations', 'a2lix_translations', array(
                'locales' => ['fr','en'],
                'translation_domain' => 'BaseAdminBundle',
                'fields' => array(
                    'applyChanges' => array(
                        'field_type' => 'hidden',
                        'attr'       => array(
                            'class' => 'hidden',
                        ),
                    ),
                    'titleFirst'          => array(
                        'label'              => 'form.ccm.label.pros.detail_title_first_double',
                        'translation_domain' => 'BaseAdminBundle',
                        'constraints'        => array(
                            new NotBlank(),
                        ),
                        'required' => true,
                    ),
                    'descriptionFirst'            => array(
                        'label'              => 'form.ccm.label.pros.detail_description_first_double',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'ckeditor',
                        'attr' => array(
                            'class' => 'ckeditor'
                        ),
                        'config_name' => 'widget',
                        'constraints'        => array(
                            new NotBlank(),
                        ),
                        'required' => true,
                    ),
                    'titleSecond'          => array(
                        'label'              => 'form.ccm.label.pros.detail_title_second_double',
                        'translation_domain' => 'BaseAdminBundle',
                        'constraints'        => array(
                            new NotBlank(),
                        ),
                        'required' => true,
                    ),
                    'descriptionSecond'            => array(
                        'label'              => 'form.ccm.label.pros.detail_description_second_double',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'ckeditor',
                        'attr' => array(
                            'class' => 'ckeditor'
                        ),
                        'config_name' => 'widget',
                        'constraints'        => array(
                            new NotBlank(),
                        ),
                        'required' => true,
                    ),
                ),
            ))
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'double_description_type';
    }
}
