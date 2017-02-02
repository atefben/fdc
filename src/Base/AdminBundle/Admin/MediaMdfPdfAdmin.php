<?php
namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use FDC\MarcheDuFilmBundle\Entity\MediaMdfPdf;
use FDC\MarcheDuFilmBundle\Entity\MediaMdfPdfTranslation;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * MediaMdfPdfAdmin class.
 *
 * \@extends Admin
 */
class MediaMdfPdfAdmin extends Admin
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
            ->add('name', 'doctrine_orm_callback', array(
                'callback'   => function ($queryBuilder, $alias, $field, $value) {
                    if (!$value['value']) {
                        return;
                    }
                    $queryBuilder->join("{$alias}.translations", 't');
                    $queryBuilder->andWhere('t.locale = :locale');
                    $queryBuilder->setParameter('locale', 'fr');
                    $queryBuilder->andWhere('t.legend LIKE :name');
                    $queryBuilder->setParameter('name', '%' . $value['value'] . '%');
                    return true;
                },
                'field_type' => 'text',
                'label'      => 'filter.media_pdf.name'
            ))
        ;

        $datagridMapper = $this->addCreatedBetweenFilters($datagridMapper);
        $datagridMapper = $this->addPublishedBetweenFilters($datagridMapper);
        $datagridMapper = $this->addStatusFilter($datagridMapper);
        $datagridMapper = $this->addPriorityFilter($datagridMapper);
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id', null, array('label' => 'list.common.label_id'))
            ->add('name', null, array(
                'label'    => 'list.label_name',
                'template' => 'BaseAdminBundle:MediaMdfPdf:list_pdf.html.twig',
            ))
            ->add('createdAt', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_created_at.html.twig',
                'sortable' => 'createdAt',
            ))
            ->add('publishedInterval', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_published_interval.html.twig',
                'sortable' => 'publishedAt',
            ))
            ->add('priorityStatus', 'choice', array(
                'choices'   => MediaMdfPdf::getPriorityStatusesList(),
                'catalogue' => 'BaseAdminBundle'
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
                        'sonata_help'        => 'form.media_pdf.helper_file',
                        'provider'           => 'sonata.media.provider.pdf',
                        'context'            => 'media_pdf',
                        'constraints'        => array(
                            new NotBlank()
                        )
                    ),
                    'name'         => array(
                        'label'              => 'form.label_name',
                        'translation_domain' => 'BaseAdminBundle',
                        'constraints'        => array(
                            new NotBlank()
                        )
                    ),
                    'status'         => array(
                        'label'                     => 'form.label_status',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices'                   => MediaMdfPdfTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle',
                        'constraints'               => array(
                            new NotBlank()
                        )
                    ),
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
            ->add('translate')
            ->add('translateOptions', 'choice', array(
                'choices'            => MediaMdfPdf::getAvailableTranslateOptions(),
                'translation_domain' => 'BaseAdminBundle',
                'multiple'           => true,
                'expanded'           => true
            ))
            ->add('priorityStatus', 'choice', array(
                'choices'                   => MediaMdfPdf::getPriorityStatuses(),
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
            'Nom'                                                 => 'exportName',
            'Id créateur'                                         => 'exportAuthor',
            'Date de création'                                    => 'exportCreatedAt',
            'Dates de publication'                                => 'exportPublishDates',
            'Date de modification'                                => 'exportUpdatedAt',
            'Statut master'                                       => 'exportStatusMaster',
            'Statut traduction es'                                => 'exportStatusEn',
            'Statut traduction en'                                => 'exportStatusEs',
            'Statut traduction zh'                                => 'exportStatusZh',
            'Publié sur'                                          => 'exportSites',
        );
    }

    public function prePersist($object)
    {
        session_write_close();
    }

    public function preUpdate($object)
    {
        session_write_close();
    }
}