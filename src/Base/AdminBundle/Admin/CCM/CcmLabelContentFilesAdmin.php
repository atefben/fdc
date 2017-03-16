<?php

namespace Base\AdminBundle\Admin\CCM;

use Base\AdminBundle\Component\Admin\Admin;
use FDC\CourtMetrageBundle\Entity\CcmLabelContentFilesTranslation;
use FDC\CourtMetrageBundle\Entity\CcmLabelContentFilesTranslations;
use FDC\CourtMetrageBundle\Entity\CcmLabelTranslation;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Validator\Constraints\NotBlank;

class CcmLabelContentFilesAdmin extends Admin
{
    public function configure()
    {
        $this->setTemplate('edit', 'BaseAdminBundle:CRUD:edit_polycollection.html.twig');
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
            ->add('boName', null, array(
                    'label' => 'list.ccm.label.files_group_name'
                )
            )
            ->add('_edit_translations', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_edit_translations.html.twig',
                'label' => 'list.ccm.label.edit'
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
                'label'  => false,
                'locales' => ['fr','en'],
                'fields' => array(
                    'applyChanges'      => array(
                        'field_type' => 'hidden',
                        'attr'       => array(
                            'class' => 'hidden',
                        ),
                    ),
                    'boName'          => array(
                        'label'              => 'form.ccm.graphical_charter.bo_name',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'status'         => array(
                        'label'                     => 'form.mdf.label_status',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices'                   => CcmLabelContentFilesTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle',
                        'constraints'               => array(
                            new NotBlank()
                        )
                    )
                )
            ))
            ->add('labelContentFileWidgetCollection', 'sonata_type_collection', array(
                'by_reference'       => false,
                'label'              => 'form.ccm.graphical_charter.label_content_file_widget_collection',
                'translation_domain' => 'BaseAdminBundle',
            ), array(
               'edit'     => 'inline',
               'inline'   => 'table',
               'sortable' => 'position',
           ))
        ;
    }
}
