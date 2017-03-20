<?php

namespace FDC\CourtMetrageBundle\Form\Type;

use FDC\CourtMetrageBundle\Entity\CcmModuleFourColumnsTranslation;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;

class ModuleFourColumnsType extends ModuleType
{
    /**
     * @var string
     */
    protected $dataClass = 'FDC\CourtMetrageBundle\Entity\CcmModuleFourColumns';

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
                    'picto1'          => array(
                        'field_type' => 'choice',
                        'choices' => CcmModuleFourColumnsTranslation::getFourColumnsPictos(),
                        'label'              => 'form.ccm.label.module.four_columns.picto1',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'description1'            => array(
                        'label'              => 'form.ccm.label.module.four_columns.description1',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'ckeditor',
                        'config_name' => 'widget',
                        'required' => false,
                    ),
                    'picto2'          => array(
                        'field_type' => 'choice',
                        'choices' => CcmModuleFourColumnsTranslation::getFourColumnsPictos(),
                        'label'              => 'form.ccm.label.module.four_columns.picto2',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'description2'            => array(
                        'label'              => 'form.ccm.label.module.four_columns.description2',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'ckeditor',
                        'config_name' => 'widget',
                        'required' => false,
                    ),
                    'picto3'          => array(
                        'field_type' => 'choice',
                        'choices' => CcmModuleFourColumnsTranslation::getFourColumnsPictos(),
                        'label'              => 'form.ccm.label.module.four_columns.picto3',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'description3'            => array(
                        'label'              => 'form.ccm.label.module.four_columns.description3',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'ckeditor',
                        'config_name' => 'widget',
                        'required' => false,
                    ),
                    'picto4'          => array(
                        'field_type' => 'choice',
                        'choices' => CcmModuleFourColumnsTranslation::getFourColumnsPictos(),
                        'label'              => 'form.ccm.label.module.four_columns.picto4',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'description4'            => array(
                        'label'              => 'form.ccm.label.module.four_columns.description4',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'ckeditor',
                        'config_name' => 'widget',
                        'required' => false,
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
        return 'module_four_columns_type';
    }
}
