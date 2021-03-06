<?php

namespace Base\AdminBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class FilmPersonAdmin extends SoifAdmin
{
    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'DESC',
        '_sort_by' => 'id'
    );

    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            array('BaseAdminBundle:FilmPerson:edit.html.twig')
        );
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('selfkit')
            ->add('lastname')
            ->add('firstname')
            ->add('asianName')
            ->add('nationality')
            ->add('nationality2')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('soifUpdatedAt')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('duplicate', null, array(
                'template' => 'BaseAdminBundle:FilmPerson:list_duplicate.html.twig',
                'sortable' => false,
                'label'    => 'list.person_duplicates'
            ))
            ->add('selfkit', null, array(
                'template' => 'BaseAdminBundle:FilmPerson:list_selfkit.html.twig',
                'sortable' => false,
                'label'    => 'list.person_selfkit'
            ))
            ->add('lastname')
            ->add('firstname')
            ->add('asianName')
            ->add('nationality')
            ->add('nationality2')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('soifUpdatedAt')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit'         => array(),
                    'soif_refresh' => array('template' => 'BaseAdminBundle:CRUD:list__action_soif_refresh.html.twig')
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
            ->with('form.film_person.general', array(
                'translation_domain' => 'BaseAdminBundle',
            ))
                ->add('portraitImage', 'sonata_type_model_list', array(
                    'label'    => 'form.film_person.label_portrait_image',
                    'help'     => 'form.film_person.helper_portrait_image',
                    'required' => false,
                ), array(
                    'link_parameters' => array('context' => 'film_poster'),
                ))
                ->add('landscapeImage', 'sonata_type_model_list', array(
                    'label'    => 'form.film_person.label_landscape_image',
                    'help'     => 'form.film_person.helper_landscape_image',
                    'required' => false,
                ))
                ->add('displayedImage', new ChoiceType(), array(
                    'choices'                   => array(
                        false => 'form.film_person.label_chose_portrait_image',
                        true  => 'form.film_person.label_chose_landscape_image',
                    ),
                    'label'                     => 'form.film_person.label_displayed_image',
                    'help'                      => 'form.film_person.help_displayed_image',
                    'translation_domain'        => 'BaseAdminBundle',
                    'choice_translation_domain' => 'BaseAdminBundle',
                    'required'                  => true,
                    'expanded'                  => true,
                ))
                ->add('credits','text', array(
                    'label' =>'form.label_copyright',
                    'required' => false
                ))
            ->end()
            ->with('form.film_person.president_jury', array(
                'translation_domain' => 'BaseAdminBundle',
            ))
                ->add('presidentJuryImage', 'sonata_type_model_list', array(
                    'label'    => 'form.film_person.label_president_jury_image',
                    'help'     => 'form.film_person.help_president_jury_image',
                    'required' => true,
                ), array(
                    'link_parameters' => array('context' => 'film_poster'),
                ))
                ->add('presidentJuryCredits','text', array(
                    'label' =>'form.label_copyright',
                    'required' => false
                ))
            ->end()
        ;


    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('lastname')
            ->add('firstname')
            ->add('asianName')
            ->add('nationality')
            ->add('nationality2')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('soifUpdatedAt')
        ;
    }

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $query->andWhere(
            $query->expr()->eq($query->getRootAliases()[0] . '.duplicate', ':duplicate')
        );
        $query->setParameter('duplicate', false);
        return $query;

    }
}
