<?php

namespace Base\AdminBundle\Admin;

use Base\CoreBundle\Entity\FDCPageJury;
use Base\CoreBundle\Entity\FDCPageJuryTranslation;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class FDCPageJuryAdmin extends Admin
{
    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'DESC',
        '_sort_by' => 'id'
    );

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('translate')
            ->add('translateOptions')
            ->add('priorityStatus')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('translate')
            ->add('translateOptions')
            ->add('priorityStatus')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $securityContext = $this->getConfigurationPool()->getContainer()->get('security.context');
        $isTranslatorEnEsCh = (
            $securityContext->isGranted('ROLE_TRANSLATOR_EN') ||
            $securityContext->isGranted('ROLE_TRANSLATOR_ES') ||
            $securityContext->isGranted('ROLE_TRANSLATOR_ZH')
        ) ? true : false;
        $requiredLocales = ($isTranslatorEnEsCh) ? array() : array('fr');

        $formMapper
            ->add('translations', 'a2lix_translations', array(
                'label'              => false,
                'translation_domain' => 'BaseAdminBundle',
                'required_locales'   => $requiredLocales,
                'fields'             => array(
                    'applyChanges' => array(
                        'field_type' => 'hidden',
                        'attr' => array (
                            'class' => 'hidden'
                        )
                    ),
                    'status'         => array(
                        'label'                     => 'form.label_status',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices'                   => FDCPageJuryTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle'
                    ),
                    'overrideName'       => array(
                        'label'              => 'form.fdc_page_jury.label_override_name',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => true,
                    ),
                    'seoTitle'       => array(
                        'attr'               => array(
                            'placeholder' => 'form.fdc_page_web_tv_trailers.placeholder_seo_title'
                        ),
                        'label'              => 'form.label_seo_title',
                        'sonata_help'        => 'form.news.helper_seo_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false,
                    ),
                    'seoDescription' => array(
                        'attr'               => array(
                            'placeholder' => 'form.fdc_page_web_tv_trailers.placeholder_seo_description'
                        ),
                        'label'              => 'form.label_seo_description',
                        'sonata_help'        => 'form.news.helper_description',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false,
                    ),
                    'createdAt'      => array(
                        'display' => false
                    ),
                    'updatedAt'      => array(
                        'display' => false
                    ),
                )
            ))
            ->add('image', 'sonata_type_model_list', array(
                'label'    => 'form.fdc_page_web_tv_trailers.image',
                'help'     => 'form.fdc_page_web_tv_trailers.helper_image',
                'required' => false,
            ))
            ->add('juryType', 'sonata_type_model_list', array(
                'label'    => 'form.fdc_page_jury.label_jury_type',
                'required' => false,
                'btn_add' => false,
            ))
            ->add('seoFile', 'sonata_media_type', array(
                'provider' => 'sonata.media.provider.image',
                'context'  => 'seo_file',
                'help'     => 'form.seo.helper_file',
                'required' => false
            ))
            ->add('translate')
            ->add('translateOptions', 'choice', array(
                'choices' => FDCPageJury::getAvailableTranslateOptions(),
                'translation_domain' => 'BaseAdminBundle',
                'multiple' => true,
                'expanded' => true
            ))
            ->add('priorityStatus', 'choice', array(
                'choices'                   => FDCPageJury::getPriorityStatuses(),
                'choice_translation_domain' => 'BaseAdminBundle',
            ))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('translate')
            ->add('translateOptions')
            ->add('priorityStatus')
        ;
    }

    public function configure()
    {
        $this->setTemplate('edit', 'BaseAdminBundle:CRUD:edit_form.html.twig');
    }
}
