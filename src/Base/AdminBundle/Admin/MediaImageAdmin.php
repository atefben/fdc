<?php
namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use Base\CoreBundle\Entity\MediaImage;
use Base\CoreBundle\Entity\MediaImageTranslation;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * MediaImageAdmin class.
 *
 * \@extends Admin
 * @author  Antoine Mineau <a.mineau@ohwee.fr>
 * \@company Ohwee
 */
class MediaImageAdmin extends Admin
{
    protected $formOptions = array(
        'cascade_validation' => true
    );
    protected $translationDomain = 'BaseAdminBundle';

    public function configure()
    {
        $this->setTemplate('edit', 'BaseAdminBundle:CRUD:edit_form.html.twig');
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id', null, array('label' => 'filter.common.label_id'))
            ->add('legend', 'doctrine_orm_callback', array(
                'callback'   => function ($queryBuilder, $alias, $field, $value) {
                    if (!$value['value']) {
                        return;
                    }
                    $queryBuilder->join("{$alias}.translations", 't');
                    $queryBuilder->andWhere('t.locale = :locale');
                    $queryBuilder->setParameter('locale', 'fr');
                    $queryBuilder->andWhere('t.legend LIKE :legend');
                    $queryBuilder->setParameter('legend', '%' . $value['value'] . '%');
                    return true;
                },
                'field_type' => 'text',
                'label'      => 'filter.media_image.label_legend'
            ))
            ->add('theme')
        ;

        $datagridMapper = $this->addCreatedBetweenFilters($datagridMapper);
        $datagridMapper = $this->addPublishedBetweenFilters($datagridMapper);
        $datagridMapper = $this->addStatusFilter($datagridMapper);
        $datagridMapper = $this->addPriorityFilter($datagridMapper);

        $datagridMapper
            ->add('displayedAll', null, array(
                'field_type' => 'checkbox',
                'label'      => 'filter.media_image.displayed_all',

            ))
            ->add('displayedHome', null, array(
                'field_type' => 'checkbox',
                'label'      => 'filter.media_image.displayed_home',

            ))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id', null, array('label' => 'list.common.label_id'))
            ->add('legend', null, array(
                'label'    => 'list.label_legend_img',
                'template' => 'BaseAdminBundle:MediaImage:list_legend.html.twig',
            ))
            ->add('theme', null, array())
            ->add('createdAt', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_created_at.html.twig',
                'sortable' => 'createdAt',
            ))
            ->add('publishedInterval', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_published_interval.html.twig',
                'sortable' => 'publishedAt',
            ))
            ->add('displayedMobile', null, array(
                'label' => 'list.displayed_mobile',
            ))
            ->add('priorityStatus', 'choice', array(
                'choices'   => MediaImage::getPriorityStatusesList(),
                'catalogue' => 'BaseAdminBundle'
            ))
            ->add('_edit_translations', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_edit_translations.html.twig',
            ))
            ->add('oldNewsId', null, array(
                'label'    => 'dashboard.link.old_news_id',
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $requiredFile = ($this->subject && $this->subject->getId()) ? false : true;
        $formMapper
            ->add('translations', 'a2lix_translations', array(
                'label'  => false,
                'fields' => array(
                    'applyChanges' => array(
                        'field_type' => 'hidden',
                        'attr' => array (
                            'class' => 'hidden'
                        )
                    ),
                    'createdAt'      => array(
                        'display' => false
                    ),
                    'updatedAt'      => array(
                        'display' => false
                    ),
                    'file'           => array(
                        'required'           => $requiredFile,
                        'field_type'         => 'sonata_media_type',
                        'translation_domain' => 'BaseAdminBundle',
                        'sonata_help'        => 'form.media_image.helper_file',
                        'provider'           => 'sonata.media.provider.image',
                        'context'            => 'media_image',
                        'constraints'        => array(
                            new NotBlank()
                        )
                    ),
                    'legend'         => array(
                        'label'              => 'form.label_legend_img',
                        'translation_domain' => 'BaseAdminBundle',
                        'sonata_help'        => 'form.media.helper_legend',
                        'constraints'        => array(
                            new NotBlank()
                        )
                    ),
                    'alt'            => array(
                        'label'              => 'form.label_alt_img',
                        'translation_domain' => 'BaseAdminBundle',
                        'sonata_help'        => 'form.media.helper_alt',
                        'required'           => false
                    ),
                    'copyright'      => array(
                        'sonata_help'        => 'form.media.helper_copyright',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false
                    ),
                    'status'         => array(
                        'label'                     => 'form.label_status',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices'                   => MediaImageTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle',
                        'constraints'               => array(
                            new NotBlank()
                        )
                    ),
                    'seoTitle'       => array(
                        'attr'               => array(
                            'placeholder' => 'form.placeholder_seo_title'
                        ),
                        'label'              => 'form.label_seo_title',
                        'sonata_help'        => 'form.news.helper_seo_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false
                    ),
                    'seoDescription' => array(
                        'attr'               => array(
                            'placeholder' => 'form.placeholder_seo_description'
                        ),
                        'label'              => 'form.label_seo_description',
                        'sonata_help'        => 'form.news.helper_description',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false
                    )
                )
            ))
            ->add('sites', null, array(
                'label'    => 'form.label_publish_on',
                'class'    => 'BaseCoreBundle:Site',
                'multiple' => true,
                'expanded' => true
            ))
            ->add('publishedAt', 'sonata_type_datetime_picker', array(
                'format'   => 'dd/MM/yyyy HH:mm',
                'required' => false,
                'attr'     => array(
                    'data-date-format' => 'dd/MM/yyyy HH:mm',
                )
            ))
            ->add('publishEndedAt', 'sonata_type_datetime_picker', array(
                'format'   => 'dd/MM/yyyy HH:mm',
                'required' => false,
                'attr'     => array(
                    'data-date-format' => 'dd/MM/yyyy HH:mm',
                )
            ))
            ->add('theme', 'sonata_type_model_list', array(
                'btn_delete' => false,
                'required'   => false
            ))
            ->add('tags', 'sonata_type_collection', array(
                'label' => 'form.label_article_tags',
                'help' => 'form.news.helper_tags',
                'by_reference' => false,
                'required' => false,
            ), array(
                    'edit' => 'inline',
                    'inline' => 'table'
                )
            )
            ->add('seoFile', 'sonata_media_type', array(
                'provider' => 'sonata.media.provider.image',
                'context'  => 'seo_file',
                'help'     => 'form.seo.helper_file',
                'required' => false
            ))
            ->add('translate')
            ->add('displayedMobile')
            ->add('excludeFromSearch', null, array(
                'label' => 'form.label_exclude_from_search',
            ))
            ->add('displayedAll', null, array(
                'label' => 'form.media_image.displayed_all'
            ))
            ->add('displayedHome', null, array(
                'label' => 'form.media_image.displayed_home'
            ))
            ->add('translateOptions', 'choice', array(
                'choices'            => MediaImage::getAvailableTranslateOptions(),
                'translation_domain' => 'BaseAdminBundle',
                'multiple'           => true,
                'expanded'           => true
            ))
            ->add('priorityStatus', 'choice', array(
                'choices'                   => MediaImage::getPriorityStatuses(),
                'choice_translation_domain' => 'BaseAdminBundle'
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

    public function getExportFields()
    {
        return array(
            'Id'                                                  => 'id',
            'Légende de l\'image'                                 => 'exportLegend',
            'Thème'                                               => 'exportTheme',
            'Id créateur'                                         => 'exportAuthor',
            'Date de création'                                    => 'exportCreatedAt',
            'Dates de publication'                                => 'exportPublishDates',
            'Date de modification'                                => 'exportUpdatedAt',
            'Statut master'                                       => 'exportStatusMaster',
            'Statut traduction es'                                => 'exportStatusEn',
            'Statut traduction en'                                => 'exportStatusEs',
            'Statut traduction zh'                                => 'exportStatusZh',
            'Publié sur'                                          => 'exportSites',
            'Remontée dans toutes les photos'                     => 'exportDisplayedAll',
            'Remontée dans le diaporama du quotidien en homepage' => 'exportDisplayedHome',
        );
    }

    public function prePersist($object)
    {
        if ($object instanceof MediaImage) {
            foreach ($object->getTranslations() as $translation) {
                if ($translation instanceof MediaImageTranslation) {
                    if ($translation->getFile()) {
                        $translation->getFile()->setUploadedFromBO(true);
                    }
                }
            }
        }
        session_write_close();
    }

    public function preUpdate($object)
    {
        if ($object instanceof MediaImage) {
            foreach ($object->getTranslations() as $translation) {
                if ($translation instanceof MediaImageTranslation) {
                    if ($translation->getFile()) {
                        $translation->getFile()->setUploadedFromBO(true);
                    }
                }
            }
        }
        session_write_close();
    }
}