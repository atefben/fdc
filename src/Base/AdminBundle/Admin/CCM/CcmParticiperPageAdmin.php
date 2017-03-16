<?php

namespace Base\AdminBundle\Admin\CCM;

use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Debug\Exception\FatalErrorException;
use Symfony\Component\Routing\Router;
use Symfony\Component\Validator\Constraints\NotBlank;
use FDC\CourtMetrageBundle\Entity\CcmParticiperPageTranslation;

class CcmParticiperPageAdmin extends Admin
{
    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'DESC',
        '_sort_by' => 'id'
    );

    protected $translationDomain = 'BaseAdminBundle';

    protected $ccmDomain;

    /**
     * @var Router
     */
    protected $router;

    /**
     * @param string $domain
     */
    public function setCcmDomain($domain)
    {
        $this->ccmDomain = $domain;
    }

    /**
     * @param Router $router
     */
    public function setRouter($router)
    {
        $this->router = $router;
    }


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
                    'edit' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        /** @var CcmParticiperPageTranslation $trans */
        $trans = $this->getSubject()->findTranslationByLocale('fr');
        $slug = $trans ? $trans->getSlug() : null;
        $url = 'http://' . $this->ccmDomain . $this->router->generate('fdc_court_metrage_participer_page', ['slug' => $slug ? $slug : 'page-slug']);

        $formMapper
            ->add('image', 'sonata_type_model_list',array(
                    'label' => 'form.ccm.label.participer.page_image',
                    'constraints'        => array(
                        new NotBlank(),
                    ),
                    'required' => true
                )
            )
            ->add('translations', 'a2lix_translations', array(
                    'locales' => ['fr','en'],
                    'label'  => false,
                    'fields' => array(
                        'applyChanges'      => array(
                            'field_type' => 'hidden',
                            'attr'       => array(
                                'class' => 'hidden',
                            ),
                        ),
                        'title'          => array(
                            'label'              => 'form.ccm.label.participer.page_title',
                            'translation_domain' => 'BaseAdminBundle',
                            'constraints'        => array(
                                new NotBlank(),
                            ),
                            'required' => true
                        ),
                        'name'          => array(
                            'label'              => 'form.ccm.label.participer.page_name',
                            'translation_domain' => 'BaseAdminBundle',
                            'constraints'        => array(
                                new NotBlank(),
                            ),
                            'required' => true
                        ),
                        'slug'          => array(
                            'label'              => 'form.ccm.label.participer.page_slug',
                            'sonata_help'        => 'L\'url sera: ' . $url,
                            'translation_domain' => 'BaseAdminBundle',
                            'constraints'        => array(
                                new NotBlank(),
                            ),
                            'required' => true
                        ),
                        'createdAt'         => array(
                            'display' => false,
                        ),
                        'updatedAt'         => array(
                            'display' => false,
                        ),
                        'status'            => array(
                            'label'                     => 'form.ccm.label_status',
                            'translation_domain'        => 'BaseAdminBundle',
                            'field_type'                => 'choice',
                            'choices'                   => CcmParticiperPageTranslation::getStatuses(),
                            'choice_translation_domain' => 'BaseAdminBundle',
                        ),
                    ),
                )
            )
            ->add('pageLayersCollection', 'sonata_type_collection', array(
                'by_reference'       => false,
                'required' => false,
                'label'              => 'form.ccm.label.participer.layers_list',
                'translation_domain' => 'BaseAdminBundle',
            ), array(
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