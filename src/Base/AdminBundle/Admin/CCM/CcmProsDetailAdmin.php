<?php

namespace Base\AdminBundle\Admin\CCM;

use FDC\CourtMetrageBundle\Entity\CcmDomainTranslation;
use FDC\CourtMetrageBundle\Entity\CcmProsDetailTranslation;
use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CcmProsDetailAdmin extends Admin
{
    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'DESC',
        '_sort_by' => 'id'
    );

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
        $formMapper
            ->add('image', 'sonata_type_model_list',array(
                'label' => 'form.ccm.label.pros.detail_image',
                'required' => false
            ))
            ->add('isShortFilmCorner', 'checkbox', array(
                'label' => 'form.ccm.label.pros.detail_is_sfc',
                'required' => false
            ))
            ->add('translations', 'a2lix_translations', array(
                'label'  => false,
                'fields' => array(
                    'applyChanges'      => array(
                        'field_type' => 'hidden',
                        'attr'       => array(
                            'class' => 'hidden',
                        ),
                    ),
                    'name'          => array(
                        'label'              => 'form.ccm.label.pros.detail_name',
                        'translation_domain' => 'BaseAdminBundle',
                        'constraints'        => array(
                            new NotBlank(),
                        ),
                        'required' => true
                    ),
                    'domain'            => array(
                        'label' => 'form.ccm.label.pros.domain',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices' => $this->getDomains(),
                        'choice_translation_domain' => 'BaseAdminBundle',
                    ),
                    'quote'          => array(
                        'label'              => 'form.ccm.label.pros.detail_quote',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                    ),
                    'country'          => array(
                        'label'              => 'form.ccm.label.pros.detail_country',
                        'translation_domain' => 'BaseAdminBundle',
                        'constraints'        => array(
                            new NotBlank(),
                        ),
                        'required' => true
                    ),
                    'url'          => array(
                        'label'              => 'form.ccm.label.pros.detail_url',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false
                    ),
                    'description'            => array(
                        'label'              => 'form.ccm.label.pros.page_description',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                        'field_type' => 'ckeditor',
                        'attr' => array(
                            'class' => 'ckeditor'
                        ),
                        'config_name' => 'widget'
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
                        'choices'                   => CcmProsDetailTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle',
                    ),
                ),
            ))
            ->add('activitiesCollection', 'sonata_type_collection', array(
                    'by_reference'       => false,
                    'label'              => 'form.ccm.label.pros.detail_activities_list',
                    'translation_domain' => 'BaseAdminBundle',
                ), array(
                    'edit'     => 'inline',
                    'inline'   => 'table',
                    'sortable' => 'position',
                )
            )
            ->add('contactsCollection', 'sonata_type_collection', array(
                    'by_reference'       => false,
                    'label'              => 'form.ccm.label.pros.detail_contacts_list',
                    'translation_domain' => 'BaseAdminBundle',
                ), array(
                    'edit'     => 'inline',
                    'inline'   => 'table',
                    'sortable' => 'position',
                )
            )
        ;
    }

    protected function getDomains()
    {
        $em = $this->getConfigurationPool()->getContainer()->get('Doctrine')->getManager();

        $domainsCollection = $em->getRepository(CcmDomainTranslation::class)
            ->findBy(
                array(
                    'locale' => $this->request->getLocale()
                )
            );

        if ($domainsCollection) {
            $domains = [];
            foreach ($domainsCollection as $item) {
                $domains[$item->getSlug()] = $item->getName();
             }

            return $domains;
        }

        return [];
    }

//    /**
//     * @param RouteCollection $collection
//     */
//    protected function configureRoutes(RouteCollection $collection)
//    {
//        $collection->clearExcept(['edit', 'list']);
//    }
}