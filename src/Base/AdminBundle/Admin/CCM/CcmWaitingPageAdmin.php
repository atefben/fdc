<?php

namespace Base\AdminBundle\Admin\CCM;

use FDC\CourtMetrageBundle\Entity\CcmShortFilmCompetitionTab;
use FDC\CourtMetrageBundle\Entity\CcmShortFilmCompetitionTabTranslation;
use Base\AdminBundle\Component\Admin\Admin;
use FDC\CourtMetrageBundle\Entity\CcmWaitingPageTranslation;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class CcmWaitingPageAdmin
 *
 * @package Base\AdminBundle\Admin\CCM
 */
class CcmWaitingPageAdmin extends Admin
{
    public function configure()
    {
        $this->setTemplate('edit', 'BaseAdminBundle:CRUD:edit_polycollection.html.twig');
    }

    /**
     * @return array
     */
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
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit'   => array(),
                ),
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
                'fields' => array(
                    'applyChanges'      => array(
                        'field_type' => 'hidden',
                        'attr'       => array(
                            'class' => 'hidden',
                        ),
                    ),
                    'title'          => array(
                        'label'              => 'form.ccm.waiting_page.title',
                        'translation_domain' => 'BaseAdminBundle',
                        'constraints'        => array(
                            new NotBlank(),
                        )
                    ),
                    'content'          => array(
                        'label'              => 'form.ccm.waiting_page.content',
                        'translation_domain' => 'BaseAdminBundle',
                        'constraints'        => array(
                            new NotBlank(),
                        ),
                        'attr' => array(
                            'class' => 'ckeditor'
                        ),
                        'field_type' => 'ckeditor',
                        'config_name' => 'widget',
                        'input_sync' => true
                    ),
                    'status'         => array(
                        'label'                     => 'form.label_status',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices'                   => CcmWaitingPageTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle'
                    )
                )
            ))
            ->add('image', 'sonata_type_model_list', array(
                'label' => 'form.ccm.waiting_page.image',
                'translation_domain' => 'BaseAdminBundle',
                'btn_delete' => false,
                'required' => true
            ))
            ->add('page', 'entity', array(
                'class' => 'FDCCourtMetrageBundle:CcmShortFilmCompetitionTab'
            ), ['admin_code' => 'base.admin.ccm_competition_tab'])
            ->add('enabled', 'checkbox', array(
                'label' => 'form.ccm.waiting_page.enabled',
                'required' => false
            ))
        ;
    }
}
