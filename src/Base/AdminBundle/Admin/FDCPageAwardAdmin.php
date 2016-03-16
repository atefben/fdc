<?php

namespace Base\AdminBundle\Admin;

use Base\CoreBundle\Entity\FDCPageAward;
use Base\CoreBundle\Entity\FDCPageAwardTranslation;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class FDCPageAwardAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id');
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show'   => array(),
                    'edit'   => array(),
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
        $translationsFields = array(
            'label'              => false,
            'translation_domain' => 'BaseAdminBundle',
            'required_locales'   => array('fr'),
            'fields'             => array(
                'status'         => array(
                    'label'                     => 'form.label_status',
                    'translation_domain'        => 'BaseAdminBundle',
                    'field_type'                => 'choice',
                    'choices'                   => FDCPageAwardTranslation::getStatuses(),
                    'choice_translation_domain' => 'BaseAdminBundle'
                ),
                'name'           => array(
                    'label'              => 'form.fdc_page_award.label_name',
                    'translation_domain' => 'BaseAdminBundle',
                    'required'           => true,
                ),
                'seoTitle'       => array(
                    'attr'               => array(
                        'placeholder' => 'form.fdc_page_award.placeholder_seo_title'
                    ),
                    'label'              => 'form.label_seo_title',
                    'sonata_help'        => 'form.news.helper_seo_title',
                    'translation_domain' => 'BaseAdminBundle',
                    'required'           => false,
                ),
                'seoDescription' => array(
                    'attr'               => array(
                        'placeholder' => 'form.fdc_page_award.placeholder_seo_description'
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
        );

        if ($this->subject && $this->subject->getId() == 1) {
            $translationsFields['fields']['nameLongsMetrages'] = array(
                'label'              => 'form.fdc_page_award.label_name_longs_metrages',
                'translation_domain' => 'BaseAdminBundle',
                'required'           => false,
            );
            $translationsFields['fields']['nameCourtsMetrages'] = array(
                'label'              => 'form.fdc_page_award.label_name_courts_metrages',
                'translation_domain' => 'BaseAdminBundle',
                'required'           => false,
            );
        }
        elseif ($this->subject && $this->subject->getId() == 4) {
            $translationsFields['fields']['nameEnCompetition'] = array(
                'label'              => 'form.fdc_page_award.label_name_en_competition',
                'translation_domain' => 'BaseAdminBundle',
                'required'           => true,
            );
            $translationsFields['fields']['header'] = array(
                'label'              => 'form.fdc_page_award.label_header',
                'translation_domain' => 'BaseAdminBundle',
                'required'           => true,
            );
        }

        $formMapper
            ->add('translations', 'a2lix_translations', $translationsFields)
            ->add('image', 'sonata_type_model_list', array(
                'label'    => 'form.fdc_page_award.image',
                'help'     => 'form.fdc_page_award.helper_image',
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
                'choices'            => FDCPageAward::getAvailableTranslateOptions(),
                'translation_domain' => 'BaseAdminBundle',
                'multiple'           => true,
                'expanded'           => true
            ))
            ->add('priorityStatus', 'choice', array(
                'choices'                   => FDCPageAward::getPriorityStatuses(),
                'choice_translation_domain' => 'BaseAdminBundle',
            ))
        ;

        if ($this->subject && in_array($this->subject->getId(), array(1, 4))) {
            $formMapper
                ->add('selectionLongsMetrages', 'sonata_type_model_list', array(
                    'label'    => 'form.fdc_page_award.selection_longs_metrages',
                    'required' => false,
                ))
                ->add('selectionCourtsMetrages', 'sonata_type_model_list', array(
                    'label'    => 'form.fdc_page_award.selection_courts_metrages',
                    'required' => false,
                ))
            ;

            if ($this->subject->getId()) {
                $formMapper
                    ->add('otherSelectionSectionsAssociated', 'sonata_type_collection', array(
                        'label'        => 'form.fdc_page_award.label_other_selection_sections',
                        'by_reference' => false,
                        'required'     => false,
                    ), array(
                            'edit'     => 'inline',
                            'inline'   => 'table',
                            'sortable' => 'position',
                        )
                    );
            }
        }
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id');
    }

    public function configure()
    {
        $this->setTemplate('edit', 'BaseAdminBundle:CRUD:edit_form.html.twig');
    }
}
