<?php

namespace Base\AdminBundle\Admin\CCM;

use Base\AdminBundle\Component\Admin\Admin;
use FDC\CourtMetrageBundle\Entity\CcmMediaImageSimple;
use FDC\CourtMetrageBundle\Entity\CcmMediaImageSimpleTranslation;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Validator\Constraints\NotBlank;

class MediaImageSimpleAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id', null, array('label' => 'filter.common.label_id'))
            ->add('name')
            ->add('alt', 'doctrine_orm_callback', array(
                'callback'   => function ($queryBuilder, $alias, $field, $value) {
                    if (!$value['value']) {
                        return;
                    }
                    $this->filterCallbackJoinTranslations($queryBuilder, $alias, $field, $value);
                    $queryBuilder->andWhere('t.alt LIKE :alt');
                    $queryBuilder->setParameter('alt', '%' . $value['value'] . '%');

                    return true;
                },
                'field_type' => 'text'
            ))
        ;

        $datagridMapper = $this->addCreatedBetweenFilters($datagridMapper);
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id', null, array('label' => 'list.common.label_id'))
            ->add('name', null, array(
                'label'    => 'list.media_image_simple.label_name',
                'sortable' => false,
            ))
            ->add('alt', null, array(
                'template' => 'BaseAdminBundle:MediaImageSimple:list_alt.html.twig',
                'label'    => 'list.media_image_simple.label_alt',
            ))
            ->add('createdAt', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_created_at.html.twig',
                'sortable' => 'createdAt',
            ))
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
        $requiredFile = ($this->subject && $this->subject->getId()) ? false : true;
        $context = ($this->getRequest()->query->get('context') !== null) ? $this->getRequest()->query->get('context') : 'media_image_simple';

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
                    'createdAt' => array(
                        'display' => false
                    ),
                    'updatedAt' => array(
                        'display' => false
                    ),
                    'file'      => array(
                        'field_type'         => 'sonata_media_type',
                        'translation_domain' => 'BaseAdminBundle',
                        'sonata_help'        => 'form.media_image_simple.helper_file',
                        'provider'           => 'sonata.media.provider.image',
                        'context'            => $context,
                        'required'           => $requiredFile,
                    ),
                    'alt'       => array(
                        'label'              => 'form.label_alt_img',
                        'translation_domain' => 'BaseAdminBundle',
                        'sonata_help'        => 'form.media.helper_alt',
						'required'			 => false,
                    ),
                    'status'         => array(
                        'label'                     => 'form.label_status',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices'                   => CcmMediaImageSimpleTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle',
                        'constraints'               => array(
                            new NotBlank()
                        )
                    ),
                )
            ))
            ->add('name')
            ->add('createdAt', null, array(
                'label' => false,
                'attr'  => array(
                    'class' => 'hidden'
                )
            ))
            ->add('createdBy', null, array(
                'label' => false,
                'attr'  => array(
                    'class' => 'hidden'
                )
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
            ->add('name')
        ;
    }

    public function configure()
    {
        $this->setTemplate('edit', 'BaseAdminBundle:CRUD:edit_form.html.twig');
    }


    public function getExportFields()
    {
        return array(
            'Id'                   => 'id',
            'Nom de l\'image'      => 'name',
            'Alt de l\'image'      => 'exportAlt',
            'Date de création'     => 'exportCreatedAt',
            'Date de modification' => 'exportUpdatedAt',
            'Statut master'        => 'exportStatusMaster',
            'Statut traduction es' => 'exportStatusEn',
            'Statut traduction en' => 'exportStatusEs',
            'Statut traduction zh' => 'exportStatusZh',
        );
    }

    public function prePersist($object)
    {
        if ($object instanceof CcmMediaImageSimple) {
            foreach ($object->getTranslations() as $translation) {
                if ($translation instanceof CcmMediaImageSimpleTranslation) {
                    if ($translation->getFile()) {
                        $translation->getFile()->setUploadedFromBO(true);
                    }
                }
            }
        }
        session_write_close();
        $object->findTranslationByLocale('fr')->setStatus(1);
        $object->preUpdate($object);
    }

    public function preUpdate($object)
    {
        if ($object instanceof CcmMediaImageSimple) {
            foreach ($object->getTranslations() as $translation) {
                if ($translation instanceof CcmMediaImageSimpleTranslation) {
                    if ($translation->getFile()) {
                        $translation->getFile()->setUploadedFromBO(true);
                    }
                }
            }
        }
        session_write_close();
        $object->findTranslationByLocale('fr')->setStatus(1);
//        $object->findTranslationByLocale('en')->setStatus(1);
//        $object->findTranslationByLocale('zh')->setStatus(1);
//        $object->findTranslationByLocale('es')->setStatus(1);
    }
}
