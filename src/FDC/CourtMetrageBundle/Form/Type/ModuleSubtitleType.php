<?php

namespace FDC\CourtMetrageBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;

class ModuleSubtitleType extends ModuleType
{
    /**
     * @var string
     */
    protected $dataClass = 'FDC\CourtMetrageBundle\Entity\CcmModuleSubtitle';

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
                    'title'          => array(
                        'label'              => 'form.ccm.label.module.subtitle.title',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'description'            => array(
                        'label'              => 'form.ccm.label.module.subtitle.description',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'ckeditor',
                        'config_name' => 'ccm_widget',
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
        return 'module_subtitle_type';
    }
}
