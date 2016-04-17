<?php

namespace Base\AdminBundle\Admin;

use Base\CoreBundle\Entity\FDCPageLaSelectionCinemaPlage;
use Base\CoreBundle\Entity\FDCPageLaSelectionCinemaPlageTranslation;
use Base\AdminBundle\Component\Admin\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class FDCPageLaSelectionCinemaPlageAdmin extends Admin
{
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('show');
        $collection->remove('export');
    }

    protected $formOptions = array(
        'cascade_validation' => true
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
            ->add('id')
            ->add('title')
            ->add('_edit_translations', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_edit_translations.html.twig'
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
                'label'              => false,
                'translation_domain' => 'BaseAdminBundle',
                'required_locales'   => array('fr'),
                'fields'             => array(
                    'status'         => array(
                        'label'                     => 'form.label_status',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices'                   => FDCPageLaSelectionCinemaPlageTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle'
                    ),
                    'subtitle'       => array(
                        'label'              => 'form.fdc_page_la_selection_cinema_plage.subtitle',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false,
                        'sonata_help'        => 'form.fdc_page_la_selection_cannes_classics.helper_titleNav'
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
            ->add('seoFile', 'sonata_media_type', array(
                'provider' => 'sonata.media.provider.image',
                'context'  => 'seo_file',
                'help'     => 'form.seo.helper_file',
                'required' => false
            ))
            ->add('translate')
            ->add('translateOptions', 'choice', array(
                'choices' => FDCPageLaSelectionCinemaPlage::getAvailableTranslateOptions(),
                'translation_domain' => 'BaseAdminBundle',
                'multiple' => true,
                'expanded' => true
            ))
            ->add('priorityStatus', 'choice', array(
                'choices'                   => FDCPageLaSelectionCinemaPlage::getPriorityStatuses(),
                'choice_translation_domain' => 'BaseAdminBundle',
            ))
            // must be added to display informations about creation user / date, update user / date (top of right sidebar)
            ->add('createdAt', null, array(
                'label' => false,
                'attr' => array (
                    'class' => 'hidden'
                )
            ))
            ->add('createdBy', null, array(
                'label' => false,
                'attr' => array (
                    'class' => 'hidden'
                )
            ))
            ->add('updatedAt', null, array(
                'label' => false,
                'attr' => array (
                    'class' => 'hidden'
                )
            ))
            ->add('updatedBy', null, array(
                'label' => false,
                'attr' => array (
                    'class' => 'hidden'
                )
            ))
        ;
    }
}
