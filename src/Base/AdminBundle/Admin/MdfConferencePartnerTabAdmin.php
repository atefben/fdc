<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use FDC\MarcheDuFilmBundle\Entity\MdfConferencePartnerTabTranslation;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Validator\Constraints\Count;

/**
 * Class MdfConferencePartnerTabAdmin
 *
 * @package Base\AdminBundle\Admin
 */
class MdfConferencePartnerTabAdmin extends Admin
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
            ->add('title')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show'   => array(),
                    'edit'   => array(),
                    'delete' => array(),
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
            ->add('position', 'hidden')
            ->add('translations', 'a2lix_translations', array(
                'label' => false,
                'translation_domain' => 'BaseAdminBundle',
                'fields' => array(
                    'applyChanges' => array(
                        'field_type' => 'hidden',
                        'attr' => array (
                            'class' => 'hidden'
                        )
                    ),
                    'title'          => array(
                        'label'              => 'form.mdf.conference_partner.tab.title',
                        'translation_domain' => 'BaseAdminBundle'
                    ),
                    'subTitle'          => array(
                        'label'              => 'form.mdf.conference_partner.tab.subTitle',
                        'translation_domain' => 'BaseAdminBundle',
                        'required'           => false
                    ),
                    'status'            => array(
                        'label'                     => 'form.mdf.label_status',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices'                   => MdfConferencePartnerTabTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle',
                    )
                )
            ))
            ->add('partnerLogoCollection', 'sonata_type_collection', array(
                'by_reference'       => false,
                'label'              => 'form.mdf.conference_partner.tab.logos',
                'translation_domain' => 'BaseAdminBundle',
                'constraints'        => array(
                    new Count(
                        array(
                            'max' => 4,
                            'maxMessage' => "validation.partners_logo_max",
                            'min' => 1,
                            'minMessage' => "validation.partners_logo_min"
                        )
                    ),
                ),
            ), array(
                'edit'     => 'inline',
                'inline'   => 'table',
                'sortable' => 'position',
            ))
        ;

    }
}
