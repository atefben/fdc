<?php

namespace Base\AdminBundle\Admin\CCM;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Validator\Constraints\NotBlank;

class CcmYoutubeAdmin extends Admin
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
            ->add('title')
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
                    'translation_domain' => 'BaseAdminBundle',
                    'locales' => ['fr','en'],
                    'required_locales' => array('fr'),
                    'fields' => array(
                        'applyChanges' => array(
                            'field_type' => 'hidden',
                            'attr'       => array(
                                'class' => 'hidden',
                            ),
                        ),
                        'title'        => array(
                            'label'              => 'form.ccm.label.a_propos.youtube.title',
                            'translation_domain' => 'BaseAdminBundle',
                            'constraints'        => array(
                                new NotBlank(),
                            ),
                            'required' => true
                        ),
                        'url'        => array(
                            'label'              => 'form.ccm.label.a_propos.youtube.url',
                            'translation_domain' => 'BaseAdminBundle',
                            'constraints'        => array(
                                new NotBlank(),
                            ),
                            'required' => true
                        ),
                    ),
                )
            )
            ->add('theme', 'sonata_type_model_list',array(
                'label' => 'form.ccm.label.a_propos.youtube.theme',
                'required' => true
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
            ->add('title');
    }
}
