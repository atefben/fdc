<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Validator\Constraints\Count;
use Sonata\AdminBundle\Route\RouteCollection;
use FDC\MarcheDuFilmBundle\Entity\MdfConferencePartnerTranslation;
use Symfony\Component\Validator\Constraints\NotBlank;

class MdfConferencePartnerMain extends Admin
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
            ->add('isActive', 'checkbox', array(
                'label' => 'form.mdf.active',
                'required' => false
            ))
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
                    'subTitle'          => array(
                        'label'              => 'form.mdf.conference_partner.subtitle',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'header'          => array(
                        'label'              => 'form.mdf.conference_partner.header',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type'         => 'ckeditor',
                    ),
                    'status'            => array(
                        'label'                     => 'form.label_status',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices'                   => MdfConferencePartnerTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle',
                        'constraints'               => array(
                            new NotBlank()
                        )
                    ),
                )
            ))
            ->add('partnerTabCollection', 'sonata_type_collection', array(
                'by_reference'       => false,
                'label'              => 'form.mdf.conference_partner.partner_tab',
                'translation_domain' => 'BaseAdminBundle',
                'constraints'        => array(
                    new Count(
                        array(
                            'max' => 4,
                            'min' => 1,
                            'minMessage' => "validation.partners_tab_min",
                            'maxMessage' => "validation.partners_tab_max",
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

    /**
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(['edit', 'list']);
    }
}
