<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;

use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate;
use FDC\MarcheDuFilmBundle\Entity\MdfEditionPresentation;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

/**
 * Class MdfEditionPresentationAdmin
 *
 * @package Base\AdminBundle\Admin
 */
class MdfEditionPresentationAdmin extends Admin
{
    protected $baseRoutePattern = 'mdfeditionpresentation';
    protected $baseRouteName = 'mdf_edition_presentation';

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
                    'title'          => array(
                        'label'              => 'form.label.title',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'header'          => array(
                        'label'              => 'form.label.header',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type'         => 'ckeditor',
                    )
                )
            ))
            ->add('contentTemplateWidgets', 'infinite_form_polycollection', array(
                'label' => false,
                'types' => array(
                    'content_template_widget_text_type',
                    'content_template_widget_image_type',
                    'content_template_widget_gallery_type',
                    'content_template_widget_file_type',
                ),
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false,
            ))
        ;

    }

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $query->andWhere(
            $query->expr()->eq($query->getRootAlias().'.type', ':type')
        );
        $query->setParameter('type', MdfContentTemplate::TYPE_EDITION_PRESENTATION);

        return $query;
    }

    public function prePersist($page)
    {
        parent::prePersist($page);
        $page->setType(MdfContentTemplate::TYPE_EDITION_PRESENTATION);
    }
}
