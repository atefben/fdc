<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Validator\Constraints\NotBlank;

class MdfAnnualGraphicCharterAdmin extends Admin
{
    protected $translationDomain = 'BaseAdminBundle';
    protected $formOptions = array(
        'cascade_validation' => true,
    );

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
            ->add('color1', null, array(
                'label' => 'form.mdf.charte_graphique_annuelle.color1',
                'translation_domain' => 'BaseAdminBundle',
                'constraints'        => array(
                    new NotBlank(),
                ),
            ))
            ->add('color2', null, array(
                'label' => 'form.mdf.charte_graphique_annuelle.color2',
                'translation_domain' => 'BaseAdminBundle',
                'constraints'        => array(
                    new NotBlank(),
                ),
            ))
            ->add('color3', null, array(
                'label' => 'form.mdf.charte_graphique_annuelle.color3',
                'translation_domain' => 'BaseAdminBundle',
                'constraints'        => array(
                    new NotBlank(),
                ),
            ))
            ->add('color4', null, array(
                'label' => 'form.mdf.charte_graphique_annuelle.color4',
                'translation_domain' => 'BaseAdminBundle',
                'constraints'        => array(
                    new NotBlank(),
                ),
            ))
            ->add('color5', null, array(
                'label' => 'form.mdf.charte_graphique_annuelle.color5',
                'translation_domain' => 'BaseAdminBundle',
                'constraints'        => array(
                    new NotBlank(),
                ),
            ))
            ->add('color6', null, array(
                'label' => 'form.mdf.charte_graphique_annuelle.color6',
                'translation_domain' => 'BaseAdminBundle',
                'constraints'        => array(
                    new NotBlank(),
                ),
            ))
            ->add('color7', null, array(
                'label' => 'form.mdf.charte_graphique_annuelle.color7',
                'translation_domain' => 'BaseAdminBundle',
                'constraints'        => array(
                    new NotBlank(),
                ),
            ))
            ->add('color8', null, array(
                'label' => 'form.mdf.charte_graphique_annuelle.color8',
                'translation_domain' => 'BaseAdminBundle',
                'constraints'        => array(
                    new NotBlank(),
                ),
            ))
            ->add('backgroundImage1', 'sonata_type_model_list', array(
                'label' => 'form.mdf.charte_graphique_annuelle.image1',
                'translation_domain' => 'BaseAdminBundle',
                'btn_delete' => false,
                'constraints'        => array(
                    new NotBlank(),
                ),
                'required' => true
            ))
            ->add('backgroundImage2', 'sonata_type_model_list', array(
                'label' => 'form.mdf.charte_graphique_annuelle.image2',
                'translation_domain' => 'BaseAdminBundle',
                'btn_delete' => false,
                'constraints'        => array(
                    new NotBlank(),
                ),
                'required' => true
            ))
            ->add('backgroundImage3', 'sonata_type_model_list', array(
                'label' => 'form.mdf.charte_graphique_annuelle.image3',
                'translation_domain' => 'BaseAdminBundle',
                'btn_delete' => false,
                'constraints'        => array(
                    new NotBlank(),
                ),
                'required' => true
            ))
            ->add('backgroundImage4', 'sonata_type_model_list', array(
                'label' => 'form.mdf.charte_graphique_annuelle.image4',
                'translation_domain' => 'BaseAdminBundle',
                'btn_delete' => false,
                'constraints'        => array(
                    new NotBlank(),
                ),
                'required' => true
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
