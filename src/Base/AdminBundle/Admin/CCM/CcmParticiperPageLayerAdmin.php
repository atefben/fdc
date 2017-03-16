<?php

namespace Base\AdminBundle\Admin\CCM;

use Base\AdminBundle\Component\Admin\Admin;
use FDC\CourtMetrageBundle\Entity\CcmParticiperPage;
use FDC\CourtMetrageBundle\Entity\CcmParticiperPageLayer;
use FDC\CourtMetrageBundle\Entity\CcmParticiperPageLayerTranslation;
use FDC\CourtMetrageBundle\Entity\CcmParticiperPageTranslation;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Validator\Constraints\NotBlank;

class CcmParticiperPageLayerAdmin extends Admin
{
    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'DESC',
        '_sort_by' => 'id'
    );

    protected $translationDomain = 'BaseAdminBundle';

    public function configure()
    {
        $this->setTemplate('edit', 'BaseAdminBundle:CRUD:edit_polycollection.html.twig');
    }

    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            array('BaseAdminBundle:Form:polycollection.html.twig')
        );
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id', null, array(
                    'label' => 'list.ccm.id'
                )
            )
            ->add('name', null, array(
                    'label' => 'list.ccm.participer.layer_name'
                )
            )
            ->add('_edit_translations', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_edit_translations.html.twig',
                'label' => 'list.ccm.participer.edit'
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('translations', 'a2lix_translations', array(
                'locales' => ['fr','en'],
                'label'  => false,
                'fields' => array(
                    'applyChanges'      => array(
                        'field_type' => 'hidden',
                        'attr'       => array(
                            'class' => 'hidden',
                        ),
                    ),
                    'name'          => array(
                        'label'              => 'form.ccm.label.layer.name',
                        'translation_domain' => 'BaseAdminBundle',
                        'constraints'        => array(
                            new NotBlank(),
                        ),
                        'required' => true
                    ),
                    'createdAt'         => array(
                        'display' => false,
                    ),
                    'updatedAt'         => array(
                        'display' => false,
                    ),
                    'seoTitle' => array(
                        'attr' => array(
                            'placeholder' => 'form.placeholder_seo_title'
                        ),
                        'label' => 'form.label_seo_title',
                        'sonata_help' => 'form.news.helper_seo_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false
                    ),
                    'seoDescription' => array(
                        'attr' => array(
                            'placeholder' => 'form.placeholder_seo_description'
                        ),
                        'label' => 'form.label_seo_description',
                        'sonata_help' => 'form.news.helper_description',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false

                    ),
                    'status'            => array(
                        'label'                     => 'form.ccm.label_status',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices'                   => CcmParticiperPageLayerTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle',
                    ),
                ),
            ))
            ->add('seoFile', 'sonata_media_type', array(
                'provider' => 'sonata.media.provider.image',
                'context' => 'seo_file',
                'help' => 'form.seo.helper_file',
                'required' => false,
            ))
            ->add('icon', 'choice', array(
                'label' => 'form.ccm.label.layer.icon',
                'translation_domain'        => 'BaseAdminBundle',
                'choices' => CcmParticiperPageLayer::getIcons(),
                'choice_translation_domain' => 'BaseAdminBundle',
            ))
            ->add('modules', 'infinite_form_polycollection', array(
                    'label' => false,
                    'types' => array(
                        'module_image_text_type',
                        'module_partenaires_fournisseur_type',
                        'module_pictos_type',
                        'module_three_columns_type',
                        'module_four_columns_type',
                        'module_subtitle_type',
                        'module_transport_type',
                        'module_google_maps_type',
                    ),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype' => true,
                    'by_reference' => false,
                )
            )
        ;
    }

    protected function getPages()
    {
        $em = $this->getConfigurationPool()->getContainer()->get('Doctrine')->getManager();

        $pagesCollection = $em->getRepository(CcmParticiperPageTranslation::class)
            ->findBy(
                array(
                    'locale' => $this->request->getLocale()
                )
            );

        if ($pagesCollection) {
            $pages = [];
            foreach ($pagesCollection as $item) {
                $pages[$item->getSlug()] = $item->getName();
            }

            return $pages;
        }

        return [];
    }
}