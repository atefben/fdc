<?php

namespace Base\AdminBundle\Admin\CCM;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Validator\Constraints\NotBlank;
use FDC\CourtMetrageBundle\Entity\CcmSubNavTranslation;

class CcmSubNavAdmin extends Admin
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
                'locales' => ['fr','en'],
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
                        'label'              => 'form.ccm.label.menu.sub_nav_name',
                        'translation_domain' => 'BaseAdminBundle',
                        'sonata_help'        => 'form.news.helper_title',
                        'constraints'        => array(
                            new NotBlank(),
                        ),
                    ),
                    'route'          => array(
                        'label'              => 'form.ccm.label.menu.sub_nav_route',
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
                        'choices'                   => CcmSubNavTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle',
                    ),
                ),
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
            ->add('name');
    }
}
