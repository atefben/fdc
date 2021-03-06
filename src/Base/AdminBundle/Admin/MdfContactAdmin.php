<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use FDC\MarcheDuFilmBundle\Entity\ContactTranslation;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class MdfContactAdmin extends Admin
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
            ->add('title')
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
                        'label'              => 'form.mdf.label.contact_block.title',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'subTitle'          => array(
                        'label'              => 'form.mdf.label.contact_block.sub_title',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'information'          => array(
                        'label'              => 'form.mdf.label.contact_block.information',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'seeMoreUrl'          => array(
                        'label'              => 'form.mdf.label.contact_block.see_more_url',
                        'translation_domain' => 'BaseAdminBundle',
                    ),
                    'status'            => array(
                        'label'                     => 'form.mdf.label_status',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices'                   => ContactTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle',
                    )
                ),
            ))
            ->add('image', 'sonata_type_model_list', array(
                'label' => 'form.mdf.label.contact_block.image',
                'translation_domain' => 'BaseAdminBundle',
                'btn_delete' => false,
                'required' => false
            ));
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
