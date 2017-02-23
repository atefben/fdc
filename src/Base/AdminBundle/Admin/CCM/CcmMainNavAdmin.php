<?php

namespace Base\AdminBundle\Admin\CCM;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Validator\Constraints\NotBlank;
use FDC\CourtMetrageBundle\Entity\CcmMainNavTranslation;

class CcmMainNavAdmin extends Admin
{

    protected $translationDomain = 'BaseAdminBundle';

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
            ->add('id', null, array('label' => 'filter.common.label_id'))
            ->add('name')
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
        $formMapper
            ->add('translations', 'a2lix_translations', array(
                'label'              => false,
                'translation_domain' => 'BaseAdminBundle',
                'fields'             => array(
                    'applyChanges'   => array(
                        'field_type' => 'hidden',
                        'attr'       => array(
                            'class' => 'hidden',
                        ),
                    ),
                    'name'          => array(
                        'label'              => 'form.ccm.label.menu.main_nav_name',
                        'translation_domain' => 'BaseAdminBundle',
                        'sonata_help'        => 'form.news.helper_title',
                        'constraints'        => array(
                            new NotBlank(),
                        ),
                    ),
                    'route'          => array(
                        'label'              => 'form.ccm.label.menu.main_nav_route',
                        'translation_domain' => 'BaseAdminBundle',
                        'sonata_help'        => 'form.ccm.label.menu.main_nav_help',
                        'constraints'        => array(
                            new NotBlank(),
                        ),
                    ),
                    'createdAt'      => array(
                        'display' => false,
                    ),
                    'updatedAt'      => array(
                        'display' => false,
                    ),
                    'status'         => array(
                        'label'                     => 'form.label_status',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices'                   => CcmMainNavTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle',
                    ),
                ),
            ))
            ->add('isActive', 'checkbox', array(
                    'label' => 'form.ccm.label.menu.main_nav_is_active',
                    'required' => false,
                )
            )
            ->add('subNavsCollection', 'sonata_type_collection', array(
                    'by_reference'       => false,
                    'label'              => 'form.ccm.label.menu.sub_nav_list',
                    'translation_domain' => 'BaseAdminBundle',
                ),
                array(
                    'edit'     => 'inline',
                    'inline'   => 'table',
                    'sortable' => 'position',
                )
            )
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('name');
    }
}
