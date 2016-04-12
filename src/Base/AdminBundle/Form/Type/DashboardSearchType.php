<?php

namespace Base\AdminBundle\Form\Type;

use Base\CoreBundle\Entity\News;
use Base\CoreBundle\Entity\NewsArticleTranslation;

use Symfony\Component\Form\AbstractType as BaseType;
use Symfony\Component\Form\FormBuilderInterface;

class DashboardSearchType extends BaseType
{
    private $securityContext;

    public function __construct($securityContext)
    {
        $this->securityContext = $securityContext;
    }

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
        if ($this->securityContext->isGranted('ROLE_TRANSLATOR_MASTER')) {
            $builder = $builder
                ->add('status', 'choice', array(
                    'choices' => array(
                        'En attente de traduction' => NewsArticleTranslation::STATUS_TRANSLATION_PENDING,
                        'Traductions à valider' => NewsArticleTranslation::STATUS_TRANSLATION_VALIDATING,

                    ),
                    'data' => (isset($_GET['dashboard_search_type']['status'])) ? $_GET['dashboard_search_type']['status'] : NewsArticleTranslation::STATUS_TRANSLATION_PENDING,
                    'label' => 'Statut',
                    'choices_as_values' => true,
                    'required' => false,
                    'empty_value' => false
                ));
        }

        $builder = $builder
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
                    'Image' => 'images',
                    'Page' => 'pages'
                ),
                'data' => (isset($_GET['dashboard_search_type']['type'])) ? $_GET['dashboard_search_type']['type'] : false,
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
                'data' => (isset($_GET['dashboard_search_type']['priorityStatus'])) ? $_GET['dashboard_search_type']['priorityStatus'] : News::PRIORITY_STATUS_NOW,
                'choices_as_values' => true,
                'required' => false,
                'label' => 'Priorité',
                'empty_value' => false
            ));


        if ($this->securityContext->isGranted('ROLE_TRANSLATOR')) {
            $builder = $builder
                ->add('translationStatus', 'checkbox', array(
                    'required' => false,
                    'label' => 'Afficher les objets en statut "Traduction à valider"'
                ))
                    ->add('reset', 'hidden', array(
                        'data' => '0'
                    ));;
        }
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