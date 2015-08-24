<?php

/*
 * This file is part of the Sonata project.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\MediaBundle\Provider;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\MediaBundle\Provider\FileProvider as SonataFileProvider;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class FileProvider extends SonataFileProvider
{
    public function setTranslationsFields(FormMapper $formMapper)
    {
        $locales = array('fr', 'en', 'es', 'pt', 'ru', 'jp', 'cn', 'ar');
        $validationGroups = array('en');
        $formMapper->add('translations', 'a2lix_translations', array(
            'label' => false,
            'required_locales' => $validationGroups,
            'fields' => array(
                // remove fields not set by user
                'createdAt' => array(
                        'display' => false
                    ),
                'updatedAt' => array(
                    'display' => false
                ),
                'legend' => array(
                    'sonata_help' => 'X caractères max.',
                    'locale_options' => array(
                        'en' => array(
                            'constraints' => array(
                                new NotBlank()
                            )
                        )
                    )
                ),
                'theme' => array(
                   // 'field_type' => 'sonata_type_model',
                    //    'sonata_field_description' => $translationDummyAdmin->getFormFieldDescriptions()['theme'],
                    //    'model_manager' => $themeAdmin->getModelManager(),
                    //   'class' => $themeAdmin->getClass(),
                       'class' => 'FDCCoreBundle:Theme',
                      //  'allow_add' => true,  
                ),
                'alt' => array(
                    'sonata_help' => 'X caractères max.',
                    'locale_options' => array(
                        'en' => array(
                            'constraints' => array(
                                new NotBlank()
                            )
                        )
                    )
                ),
                'copyright' => array(
                    'sonata_help' => 'X caractères max.',
                    'locale_options' => array(
                        'fr' => array(
                            'required' => false
                        ),
                        'en' => array(
                            'required' => false
                        )
                    )
                ),
                'publishedAt' => array(
                        'field_type' => 'sonata_type_datetime_picker',
                        'format' => 'dd/MM/yyyy HH:mm',
                        'attr' => array(
                            'data-date-format' => 'dd/MM/yyyy HH:mm',
                        )
                    ),
                'publishEndedAt' => array(
                    'field_type' => 'sonata_type_datetime_picker',
                    'format' => 'dd/MM/yyyy HH:mm',
                    'attr' => array(
                        'data-date-format' => 'dd/MM/yyyy HH:mm',
                    )
                ),
                'sites' => array(
                    'multiple' => true,
                    'expanded' => true,
                    'class' => 'FDCCoreBundle:Site'
                )
            )
        ))
        ->end();
    }
    public function buildEditForm(FormMapper $formMapper)
    {
        $formMapper->add('binaryContent', 'file', array('required' => false));
        $this->setTranslationsFields($formMapper);
    }

    public function buildCreateForm(FormMapper $formMapper)
    {
//        $themeAdmin = $this->configurationPool->getAdminByClass("FDC\\CoreBundle\\Entity\\Theme");
  //      $translationDummyAdmin = $this->configurationPool->getAdminByAdminCode('fdc.admin.translation_dummy');
       // @TODO validation groups based on user locale  / roles 
        $formMapper->add('binaryContent', 'file', array(
            'constraints' => array(
                new NotBlank(),
                new NotNull(),
            ),
        ));
        $this->setTranslationsFields($formMapper);
    }
}
