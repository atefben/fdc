<?php

namespace FDC\CourtMetrageBundle\Form\Type;

use FDC\CourtMetrageBundle\Entity\CcmModuleTransportTranslation;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;

class ModuleTransportType extends ModuleType
{
    /**
     * @var string
     */
    protected $dataClass = 'FDC\CourtMetrageBundle\Entity\CcmModuleTransport';

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
                    'picto'          => array(
                        'field_type' => 'choice',
                        'choices' => CcmModuleTransportTranslation::getTransportPictos(),
                        'label'              => 'form.ccm.label.module.transport.picto',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'title'          => array(
                        'label'              => 'form.ccm.label.module.transport.title',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'description'            => array(
                        'label'              => 'form.ccm.label.module.transport.description',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'ckeditor',
                    ),
                    'url'          => array(
                        'label'              => 'form.ccm.label.module.transport.url',
                        'translation_domain' => 'BaseAdminBundle',
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
        return 'module_transport_type';
    }
}
