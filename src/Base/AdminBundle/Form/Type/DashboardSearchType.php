<?php

namespace Base\AdminBundle\Form\Type;

use Base\CoreBundle\Entity\News;
use Symfony\Component\Form\AbstractType as BaseType;
use Symfony\Component\Form\FormBuilderInterface;

class DashboardSearchType extends BaseType
{
    /**
     * buildForm function.
     *
     * @access public
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', 'choice', array(
                'choices' => array(
                    'Actualité' => 'news',
                    'Vidéo' => 'videos',
                    'Audio' => 'audios',
                    'Photo' => 'photos',
                    'Communiqué' => 'statements',
                    'Info' => 'infos',
                    'Thème' => 'themes',
                    'Tag' => 'tags',
                    'Chaîne WebTV' => 'webtvs',
                    'Image' => 'images'
                ),
                'choices_as_values' => true,
                'required' => false,
                'empty_value' => false
            ))
            ->add('title', 'text', array(
                'required' => false,
                'label' => 'Titre'
            ))
            ->add('id', 'integer', array(
                'required' => false,
                'label' => 'Identifiant'
            ))
            ->add('priorityStatus', 'choice', array(
                'choices' => array(
                    'Toutes' => 'all',
                    'Immédiate' => News::PRIORITY_STATUS_NOW,
                    'Haute' => News::PRIORITY_STATUS_URGENT,
                    'Moyenne' => News::PRIORITY_STATUS_AVERAGE,
                    'Basse' => News::PRIORITY_STATUS_LOW
                ),
                'choices_as_values' => true,
                'required' => false,
                'label' => 'Priorité',
                'empty_value' => false
            ))
            ->add('translationStatus', 'checkbox', array(
                'required' => false,
                'label' => 'Afficher les objets en statut "Traduction à valider"'
            ))
        ;
    }

    /**
     * getName function.
     *
     * @access public
     * @return void
     */
    public function getName()
    {
        return 'dashboard_search_type';
    }
}