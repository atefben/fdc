<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Base\CoreBundle\Entity\PressMediaLibrary;
use Base\CoreBundle\Entity\PressMediaLibraryTranslation;

class PressMediaLibraryAdmin extends Admin
{
    protected $formOptions = array(
        'cascade_validation' => true
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
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('translations', 'a2lix_translations', array(
                'label' => false,
                'translation_domain' => 'BaseAdminBundle',
                'required_locales' => array(),
                'fields' => array(
                    'applyChanges' => array(
                        'field_type' => 'hidden',
                        'attr' => array (
                            'class' => 'hidden'
                        )
                    ),
                    'createdAt' => array(
                        'display' => false
                    ),
                    'updatedAt' => array(
                        'display' => false
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
                    'status' => array(
                        'label' => 'form.label_status',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'choice',
                        'choices' => PressMediaLibraryTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle'
                    ),
                )
            ))
            ->add('translate', 'checkbox' , array(
                'required' => false,
            ))
            ->add('translateOptions', 'choice', array(
                'choices' => PressMediaLibrary::getAvailableTranslateOptions(),
                'translation_domain' => 'BaseAdminBundle',
                'multiple' => true,
                'expanded' => true
            ))
            ->add('priorityStatus', 'choice', array(
                'choices' => PressMediaLibrary::getPriorityStatuses(),
                'choice_translation_domain' => 'BaseAdminBundle'
            ))
            ->add('seoFile', 'sonata_media_type', array(
                'provider' => 'sonata.media.provider.image',
                'context'  => 'seo_file',
                'help' => 'form.seo.helper_file',
                'required' => false,
            ))

            ->end()
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
        ;
    }

    public function configure()
    {
        $this->setTemplate('edit', 'BaseAdminBundle:CRUD:edit_form.html.twig');
    }

}
