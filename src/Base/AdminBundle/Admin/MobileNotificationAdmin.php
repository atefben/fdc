<?php

namespace Base\AdminBundle\Admin;

use Base\CoreBundle\Entity\MobileNotification;
use Base\CoreBundle\Entity\MobileNotificationTranslation;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Validator\Constraints\NotBlank;

class MobileNotificationAdmin extends Admin
{

    public function configure()
    {
        $this->setTemplate('edit', 'BaseAdminBundle:CRUD:edit_form.html.twig');
    }
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('translation_title', null, array(
                'template'           => 'BaseAdminBundle:MobileNotification:list_title.html.twig',
                'label'              => 'list.label_title',
                'translation_domain' => 'BaseAdminBundle',
            ))
            ->add('token',  'boolean', array(
                'label' => 'form.mobile_notification.label_token',
            ))
            ->add('sendAt', null, array(
                'template' => 'BaseAdminBundle:MobileNotification:list_send_at.html.twig',
                'sortable' => 'sendAt',
                'label' => 'form.mobile_notification.label_send_at',
            ))
            ->add('_edit_translations', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_edit_translations.html.twig',
                'locales' => array('fr', 'en')
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
                'locales' => array('fr', 'en'),
                'label' => false,
                'translation_domain' => 'BaseAdminBundle',
                'fields' => array(
                    'applyChanges' => array(
                        'field_type' => 'hidden',
                        'attr' => array (
                            'class' => 'hidden'
                        )
                    ),
                    'title' => array(
                        'label' => 'form.label_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'constraints' => array(
                            new NotBlank()
                        )
                    ),
                    'description' => array(
                        'label' => 'form.mobile_notification.label_description',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false
                    ),
                    'status' => array(
                        'label' => 'form.label_status',
                        'translation_domain' => 'BaseAdminBundle',
                        'field_type' => 'choice',
                        'choices' => MobileNotificationTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle'
                    )
                )
            ))
            ->add('sendAt', 'sonata_type_datetime_picker', array(
                'format'   => 'dd/MM/yyyy HH:mm',
                'required' => false,
                'label' => false,
                'attr'     => array(
                    'data-date-format' => 'dd/MM/yyyy HH:mm',
                ),
            ))
            ->add('token', null, array(
                'label' => 'form.mobile_notification.label_token',
                'help' => 'form.mobile_notification.help_token',
            ))
            ->add('sendToAll', null, array(
                'label' => 'form.mobile_notification.label_send_to_all',
            ))
            ->add('sendTest', 'hidden', array(
                'data' => false,
            ))
            ->add('translate')
            ->add('translateOptions', 'choice', array(
                'choices' => MobileNotification::getAvailableTranslateOptions(),
                'translation_domain' => 'BaseAdminBundle',
                'multiple' => true,
                'expanded' => true
            ))
            ->add('priorityStatus', 'choice', array(
                'choices' => MobileNotification::getPriorityStatuses(),
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
            ->add('token')
            ->add('sendAt')
            ->add('translate')
            ->add('translateOptions')
            ->add('priorityStatus')
        ;
    }

    public function prePersist($object)
    {
        session_write_close();
    }

    public function preUpdate($object)
    {
        session_write_close();
    }
}
