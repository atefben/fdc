<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class MdfHeaderFooterAdmin extends Admin
{
    protected $translationDomain = 'BaseAdminBundle';
    protected $formOptions = array(
        'cascade_validation' => true,
    );

    public function configure()
    {
        $this->setTemplate('edit', 'BaseAdminBundle:CRUD:edit_polycollection.html.twig');
    }

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
            ->add('translations', 'a2lix_translations', array(
                'label'  => false,
                'fields' => array(
                    'applyChanges'      => array(
                        'field_type' => 'hidden',
                        'attr'       => array(
                            'class' => 'hidden',
                        ),
                    ),
                    'footerFacebookUrl'          => array(
                        'label'              => 'form.label.facebook_url',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'footerTwitterUrl'          => array(
                        'label'              => 'form.label.twitter_url',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'footerYoutubeUrl'          => array(
                        'label'              => 'form.label.youtube_url',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'headerBannerUrl'          => array(
                        'label'              => 'form.label.header_banner_url',
                        'translation_domain' => 'BaseAdminBundle',
                    )
                ),
            ))
            ->add('headerBanner', 'sonata_type_model_list', array(
                'label' => 'form.label.header_banner',
                'translation_domain' => 'BaseAdminBundle',
                'btn_delete' => false,
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
            ->add('footerFacebookUrl')
            ->add('footerTwitterUrl')
            ->add('footerYoutubeUrl')
        ;
    }
}
