<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 17.01.2017
 * Time: 10:31
 */

namespace Base\AdminBundle\Admin;

use FDC\MarcheDuFilmBundle\Entity\MdfSpeakers;
use FDC\MarcheDuFilmBundle\Entity\MdfSpeakersTranslation;
use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Count;

class MdfSpeakersMain extends Admin
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
            ->add('subTitle')
            ->add('createdAt', null, array(
                'template' => 'BaseAdminBundle:TranslateMain:list_created_at.html.twig',
                'sortable' => 'createdAt',
            ))
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
            ->add('translations', 'a2lix_translations', array(
                'label'  => false,
                'fields' => array(
                    'applyChanges'      => array(
                        'field_type' => 'hidden',
                        'attr'       => array(
                            'class' => 'hidden',
                        ),
                    ),
                    'subTitle'          => array(
                        'label'              => 'form.mdf.label.speakers_sub_title',
                        'translation_domain' => 'BaseAdminBundle',
                        'constraints'        => array(
                            new NotBlank(),
                        ),
                        'required' => true
                    ),
                    'description'            => array(
                        'label'              => 'form.mdf.label.speakers_description',
                        'translation_domain' => 'BaseAdminBundle',
                        'required' => false,
                        'field_type' => 'ckeditor',
                    ),
                    'createdAt'         => array(
                        'display' => false,
                    ),
                    'updatedAt'         => array(
                        'display' => false,
                    ),
                    'status'            => array(
                        'label'                     => 'form.mdf.label_status',
                        'translation_domain'        => 'BaseAdminBundle',
                        'field_type'                => 'choice',
                        'choices'                   => MdfSpeakersTranslation::getStatuses(),
                        'choice_translation_domain' => 'BaseAdminBundle',
                    ),
                ),
            ))
            ->add('isActive', 'checkbox', array(
                'label' => 'form.mdf.active',
                'required' => false
            ))
            ->add('speakersChoicesCollections', 'sonata_type_collection', array(
                'by_reference'       => false,
                'label'              => 'form.mdf.label.new_speakers_tab',
                'translation_domain' => 'BaseAdminBundle',
                'constraints'        => array(
                    new Count(
                        array(
                            'max' => 4,
                            'maxMessage' => "validation.speakers_widget_tab_max"
                        )
                    ),
                ),
            ), array(
                      'edit'     => 'inline',
                      'inline'   => 'table',
                      'sortable' => 'position',
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
            ->add('subTitle')
        ;
    }
}