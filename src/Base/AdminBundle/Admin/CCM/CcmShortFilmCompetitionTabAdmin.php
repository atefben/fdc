<?php

namespace Base\AdminBundle\Admin\CCM;

use FDC\CourtMetrageBundle\Entity\CcmShortFilmCompetitionTab;
use FDC\CourtMetrageBundle\Entity\CcmShortFilmCompetitionTabTranslation;
use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CcmShortFilmCompetitionTabAdmin extends Admin
{
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
            ->add('name')
            ->add('_action', 'actions', array(
                    'actions' => array(
                        'edit'   => array(),
                    ),
                )
            )
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
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
                        'name'          => array(
                            'label'              => 'form.ccm.label.competition_tab_name',
                            'translation_domain' => 'BaseAdminBundle',
                        ),
                        'status'         => array(
                            'label'                     => 'form.label_status',
                            'translation_domain'        => 'BaseAdminBundle',
                            'field_type'                => 'choice',
                            'choices'                   => CcmShortFilmCompetitionTabTranslation::getStatuses(),
                            'choice_translation_domain' => 'BaseAdminBundle'
                        )
                    )
                )
            )
            ->add('image', 'sonata_type_model_list', array(
                    'label' => 'form.ccm.label.image',
                    'translation_domain' => 'BaseAdminBundle',
                    'btn_delete' => false,
                    'required' => true
                )
            )
            ->add('date', 'choice', array(
                    'label'    => 'form.ccm.label.film_date',
                    'required' => true,
                    'choices' => $this->buildYearChoices()
                )
            );
        ;
    }

    protected function buildYearChoices() {
        $distance = 5;
        $yearsBefore = date('Y', mktime(0, 0, 0, date("m"), date("d"), date("Y") - $distance));
        $yearsAfter = date('Y', mktime(0, 0, 0, date("m"), date("d"), date("Y") + $distance));
        return array_combine(range($yearsBefore, $yearsAfter), range($yearsBefore, $yearsAfter));
    }
}
