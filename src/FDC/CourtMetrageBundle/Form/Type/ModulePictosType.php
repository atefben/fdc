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
                    ),
                    'title1'          => array(
                        'label'              => 'form.ccm.label.module.pictos.title1',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'description1'            => array(
                        'label'              => 'form.ccm.label.module.pictos.description1',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'ckeditor',
                    ),
                    'picto2'          => array(
                        'field_type' => 'choice',
                        'choices' => CcmModulePictosTranslation::getPictos(),
                        'label'              => 'form.ccm.label.module.pictos.picto2',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'title2'          => array(
                        'label'              => 'form.ccm.label.module.pictos.title2',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'description2'            => array(
                        'label'              => 'form.ccm.label.module.pictos.description2',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'ckeditor',
                    ),
                    'picto3'          => array(
                        'field_type' => 'choice',
                        'choices' => CcmModulePictosTranslation::getPictos(),
                        'label'              => 'form.ccm.label.module.pictos.picto3',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'title3'          => array(
                        'label'              => 'form.ccm.label.module.pictos.title3',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'description3'            => array(
                        'label'              => 'form.ccm.label.module.pictos.description3',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'ckeditor',
                    ),
                    'picto4'          => array(
                        'field_type' => 'choice',
                        'choices' => CcmModulePictosTranslation::getPictos(),
                        'label'              => 'form.ccm.label.module.pictos.picto4',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'title4'          => array(
                        'label'              => 'form.ccm.label.module.pictos.title4',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'description4'            => array(
                        'label'              => 'form.ccm.label.module.pictos.description4',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'ckeditor',
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
