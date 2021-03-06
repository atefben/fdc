<?php
namespace Base\AdminBundle\Admin\CCM;

use Base\AdminBundle\Component\Admin\Admin;
use FDC\CourtMetrageBundle\Entity\CcmMediaImage;
use FDC\CourtMetrageBundle\Entity\CcmMediaImageTranslation;
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
            ->add('_edit_translations', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_edit_translations.html.twig',
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
                        'choices'                   => CcmMediaImageTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle',
                        'constraints'               => array(
                            new NotBlank()
                        )
                    ),
                    'seoTitle'       => array(
                        'attr'               => array(
                            'placeholder' => 'group.ccm.placeholder_seo_title'
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
            ->add('seoFile', 'sonata_media_type', array(
                'provider' => 'sonata.media.provider.image',
                'context'  => 'seo_file',
                'help'     => 'form.seo.helper_file',
                'required' => false
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
        if ($object instanceof CcmMediaImage) {
            foreach ($object->getTranslations() as $translation) {
                if ($translation instanceof CcmMediaImageTranslation) {
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
        if ($object instanceof CcmMediaImage) {
            foreach ($object->getTranslations() as $translation) {
                if ($translation instanceof CcmMediaImageTranslation) {
                    if ($translation->getFile()) {
                        $translation->getFile()->setUploadedFromBO(true);
                    }
                }
            }
        }
        session_write_close();
    }
}