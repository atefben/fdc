<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use Base\CoreBundle\Entity\FDCPageWaiting;
use Base\CoreBundle\Entity\FDCPageWebTvLive;
use Base\CoreBundle\Entity\FDCPageWebTvLiveTranslation;
use Base\CoreBundle\Repository\FDCEventRoutesRepository;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Validator\Constraints\NotBlank;

class FDCPageWaitingAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('enabled')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('translate')
            ->add('translateOptions')
            ->add('priorityStatus')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('page')
            ->add('enabled')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
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
        $requiredFile = ($this->subject && $this->subject->getId()) ? false : true;
        $formMapper
            ->add('translations', 'a2lix_translations', array(
                'label' => false,
                'translation_domain' => 'BaseAdminBundle',
                'required_locales' => array(),
                'fields' => array(
                    'title' => array(
                        'label' => 'form.label_title',
                    ),
                    'text' => array(
                        'label' => 'form.label_text',
                        'field_type' => 'ckeditor',
                        'config_name' => 'widget'
                    ),
                    'createdAt' => array(
                        'display' => false
                    ),
                    'updatedAt' => array(
                        'display' => false
                    ),
                    'banner' => array(
                        'required'           => $requiredFile,
                        'field_type'         => 'sonata_media_type',
                        'translation_domain' => 'BaseAdminBundle',
                        'sonata_help'        => 'form.media_image.helper_file',
                        'provider'           => 'sonata.media.provider.image',
                        'context'            => 'media_image',
                        'constraints'        => array(
                            new NotBlank()
                        )
                    ),
                    'status'         => array(
                        'label'                     => 'form.label_status',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices'                   => FDCPageWebTvLiveTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle'
                    ),
                )
            ))
            ->add('page', 'entity', array(
                'class' => 'BaseCoreBundle:FDCEventRoutes',
                'query_builder' => function(FDCEventRoutesRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.hasWaitingPage = 1');
                }
            ))

            ->add('enabled')
            ->add('translate')
            ->add('translateOptions', 'choice', array(
                'choices'            => FDCPageWebTvLive::getAvailableTranslateOptions(),
                'translation_domain' => 'BaseAdminBundle',
                'multiple'           => true,
                'expanded'           => true
            ))
            ->add('priorityStatus', 'choice', array(
                'choices'                   => FDCPageWebTvLive::getPriorityStatuses(),
                'choice_translation_domain' => 'BaseAdminBundle',
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
            ->add('enabled')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('translate')
            ->add('translateOptions')
            ->add('priorityStatus')
        ;
    }

    public function configure()
    {
        $this->setTemplate('edit', 'BaseAdminBundle:CRUD:edit_form.html.twig');
    }
}
