<?php

namespace FDC\CourtMetrageBundle\Form\Type;

use FDC\CourtMetrageBundle\Entity\CcmModuleTransportTranslation;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Validator\Constraints\Url;

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
                'locales' => ['fr','en'],
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
                        'required' => false,
                    ),
                    'title'          => array(
                        'label'              => 'form.ccm.label.module.transport.title',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'description'            => array(
                        'label'              => 'form.ccm.label.module.transport.description',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'ckeditor',
                        'config_name' => 'ccm_widget',
                        'required' => false,
                    ),
                    'url'          => array(
                        'label'              => 'form.ccm.label.module.transport.url',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                        'sonata_help' => 'form.ccm.label.external_url',
                        'constraints' => array(
                            new Url()
                        ),
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
