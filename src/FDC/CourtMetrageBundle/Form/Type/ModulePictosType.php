<?php

namespace FDC\CourtMetrageBundle\Form\Type;

use FDC\CourtMetrageBundle\Entity\CcmModulePictosTranslation;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;

class ModulePictosType extends ModuleType
{
    /**
     * @var string
     */
    protected $dataClass = 'FDC\CourtMetrageBundle\Entity\CcmModulePictos';

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
                        'choices' => CcmModulePictosTranslation::getPictos(),
                        'label'              => 'form.ccm.label.module.pictos.picto1',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'title1'          => array(
                        'label'              => 'form.ccm.label.module.pictos.title1',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'description1'            => array(
                        'label'              => 'form.ccm.label.module.pictos.description1',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'ckeditor',
                        'config_name' => 'widget',
                        'required' => false,
                    ),
                    'picto2'          => array(
                        'field_type' => 'choice',
                        'choices' => CcmModulePictosTranslation::getPictos(),
                        'label'              => 'form.ccm.label.module.pictos.picto2',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'title2'          => array(
                        'label'              => 'form.ccm.label.module.pictos.title2',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'description2'            => array(
                        'label'              => 'form.ccm.label.module.pictos.description2',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'ckeditor',
                        'config_name' => 'widget',
                        'required' => false,
                    ),
                    'picto3'          => array(
                        'field_type' => 'choice',
                        'choices' => CcmModulePictosTranslation::getPictos(),
                        'label'              => 'form.ccm.label.module.pictos.picto3',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'title3'          => array(
                        'label'              => 'form.ccm.label.module.pictos.title3',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'description3'            => array(
                        'label'              => 'form.ccm.label.module.pictos.description3',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'ckeditor',
                        'config_name' => 'widget',
                        'required' => false,
                    ),
                    'picto4'          => array(
                        'field_type' => 'choice',
                        'choices' => CcmModulePictosTranslation::getPictos(),
                        'label'              => 'form.ccm.label.module.pictos.picto4',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'title4'          => array(
                        'label'              => 'form.ccm.label.module.pictos.title4',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'description4'            => array(
                        'label'              => 'form.ccm.label.module.pictos.description4',
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
        return 'module_pictos_type';
    }
}
