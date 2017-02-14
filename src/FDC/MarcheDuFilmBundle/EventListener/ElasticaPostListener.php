<?php

namespace FDC\MarcheDuFilmBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ElasticaPostListener
{
    private static $ELASTICA_RESOURCES = array(
        'MediaMdfPdfTranslation'                    => 'document',
        'MdfContentTemplateWidgetVideoTranslation'  => 'video',
        'GalleryMdfTranslation'                     => 'gallery',
        'MediaMdfImageTranslation'                  => 'image',
        'MdfContactPageTranslation'                 => 'content_contact_us',
        'MdfInformationsTranslation'                => 'content_infos_utiles',
        'MdfPressGraphicalCharterTranslation'       => 'content_press_graphical_charte',
        'MdfPressGalleryTranslation'                => 'content_press_gallery',
        'PressCoverageTranslation'                  => 'content_press_coverage',
        'MdfPressReleaseTranslation'                => 'content_press_release',
        'MdfWhoAreWeTeamTranslation'                => 'content_who_are_we_team',
        'MdfConferenceInfoAndContactTranslation'    => 'content_conference_info_and_contact',
        'MdfConferencePartnerTranslation'           => 'content_conference_partner',
        'MdfSpeakersTranslation'                    => 'content_conference_speaker',
        'MdfConferenceProgramTranslation'           => 'content_conference_program',
        'ServiceTranslation'                        => 'content_service',
        'DispatchDeServiceTranslation'              => 'content_dispatch_de_service',
        'AccreditationTranslation'                  => 'content_accreditation',
        'MdfHomepageTranslation'                    => 'content_homepage',
        'MdfContentTemplateTranslation'             => 'content_template',
    );

    private $container;
    private $objectPersisterPost;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->objectPersisterPost = null;
    }

    /**
     * @param \Doctrine\ORM\Event\LifecycleEventArgs $eventArgs
     */
    public function postUpdate(LifecycleEventArgs $eventArgs)
    {
        $this->checkAndUpdate($eventArgs);
    }

    protected function checkAndUpdate(LifecycleEventArgs $eventArgs)
    {
        $entity = $eventArgs->getEntity();
        $className = new \ReflectionClass(get_class($entity));

        switch ($className->getShortName()) {
            case array_key_exists($className->getShortName(), self::$ELASTICA_RESOURCES):
                $this->updateElasticaIndexes(
                    $entity->getTranslatable(),
                    self::$ELASTICA_RESOURCES[$className->getShortName()]
                );
                break;
            case'MdfHomeServiceTranslation':
                $this->updateElasticaIndexes(
                    $entity->getTranslatable()->getHomepage(),
                    self::$ELASTICA_RESOURCES['MdfHomepageTranslation']
                );
                break;
            case 'MdfThemeTranslation':
                $widget = $entity->getTranslatable()->getContentTemplate();

                if ($widget && $widget->isWidgetText()) {
                    $this->updateElasticaIndexes(
                        $entity->getTranslatable()->getContentTemplate(),
                        self::$ELASTICA_RESOURCES['MdfHomepageTranslation']
                    );

                    break;
                }

                if ($widget && $widget->isWidgetVideo()) {
                    $this->updateElasticaIndexes(
                        $entity->getTranslatable()->getContentTemplate(),
                        self::$ELASTICA_RESOURCES['MdfContentTemplateWidgetVideoTranslation']
                    );

                    break;
                }
                break;
            case 'MdfContentTemplateWidgetTextTranslation':
                $this->updateElasticaIndexes(
                    $entity->getTranslatable()->getContentTemplate(),
                    self::$ELASTICA_RESOURCES['MdfHomepageTranslation']
                );
                $this->updateElasticaIndexes(
                    $entity->getTranslatable()->getConferenceProgram(),
                    self::$ELASTICA_RESOURCES['MdfConferenceProgramTranslation']
                );
                break;
            case 'AccreditationWidgetTranslation':
                $this->updateElasticaIndexes(
                    $entity->getTranslatable()->getAccreditation(),
                    self::$ELASTICA_RESOURCES['AccreditationTranslation']
                );
                break;
            case 'DispatchDeServiceWidgetTranslation':
                $this->updateElasticaIndexes(
                    $entity->getTranslatable()->getDispatchDeService(),
                    self::$ELASTICA_RESOURCES['DispatchDeServiceTranslation']
                );
                break;
            case 'ServiceWidgetCollectionTranslation':
                $this->updateElasticaIndexes(
                    $entity->getTranslatable()->getService(),
                    self::$ELASTICA_RESOURCES['ServiceTranslation']
                );
                break;
            case 'ServiceWidgetTranslation':
                $this->updateElasticaIndexes(
                    $entity->getTranslatable()->getWidgetsCollection()->getService(),
                    self::$ELASTICA_RESOURCES['ServiceTranslation']
                );
                break;
            case 'ServiceWidgetProductTranslation':
                $this->updateElasticaIndexes(
                    $entity
                        ->getTranslatable()
                        ->getProductsCollections()
                        ->getServiceWidget()
                        ->getWidgetsCollection()
                        ->getService(),
                    self::$ELASTICA_RESOURCES['ServiceTranslation']
                );
                break;
            case 'MdfConferenceProgramEventTranslation':
                $this->updateElasticaIndexes(
                    $entity
                        ->getTranslatable()
                        ->getProgramEventCollection()
                        ->getConferenceProgramDay()
                        ->getProgramDayCollection()
                        ->getConferenceProgram(),
                    self::$ELASTICA_RESOURCES['MdfConferenceProgramTranslation']
                );
                break;
            case 'MdfProgramSpeakerTranslation':
                $this->updateElasticaIndexes(
                    $entity
                        ->getTranslatable()
                        ->getProgramSpeakerCollection()
                        ->getProgramEvent()
                        ->getProgramEventCollection()
                        ->getConferenceProgramDay()
                        ->getProgramDayCollection()
                        ->getConferenceProgram(),
                    self::$ELASTICA_RESOURCES['MdfConferenceProgramTranslation']
                );
                break;
            case 'MdfSpeakersChoicesTranslation':
                $this->updateElasticaIndexes(
                    $entity
                        ->getTranslatable()
                        ->getSpeakersChoicesCollection()
                        ->getSpeakersPage(),
                    self::$ELASTICA_RESOURCES['MdfSpeakersTranslation']
                );
                break;
            case 'MdfSpeakersDetailsTranslation':
                $this->updateElasticaIndexes(
                    $entity
                        ->getTranslatable()
                        ->getSpeakersDetailsCollection()
                        ->getSpeakersChoiceTab()
                        ->getSpeakersChoicesCollection()
                        ->getSpeakersPage(),
                    self::$ELASTICA_RESOURCES['MdfSpeakersTranslation']
                );
                break;
            case 'MdfConferencePartnerTabTranslation':
                $this->updateElasticaIndexes(
                    $entity
                        ->getTranslatable()
                        ->getConferencePartnerTabCollection()
                        ->getConferencePartner(),
                    self::$ELASTICA_RESOURCES['MdfConferencePartnerTranslation']
                );
                break;
            case 'MdfConferenceInfoAndContactWidgetTranslation':
                $this->updateElasticaIndexes(
                    $entity
                        ->getTranslatable()
                        ->getConferenceInfoAndContact(),
                    self::$ELASTICA_RESOURCES['MdfConferenceInfoAndContactTranslation']
                );
                break;
            case 'MdfWhoAreWeTeamContactWidgetTranslation':
                $this->updateElasticaIndexes(
                    $entity
                        ->getTranslatable()
                        ->getWhoAreWeTeam(),
                    self::$ELASTICA_RESOURCES['MdfWhoAreWeTeamTranslation']
                );
                break;
            case 'MdfWhoAreWeTeamWidgetTranslation':
                $this->updateElasticaIndexes(
                    $entity
                        ->getTranslatable()
                        ->getWhoAreWeTeam(),
                    self::$ELASTICA_RESOURCES['MdfWhoAreWeTeamTranslation']
                );
                break;
            case 'PressCoverageWidgetTranslation':
                $this->updateElasticaIndexes(
                    $entity
                        ->getTranslatable()
                        ->getPressCoverage(),
                    self::$ELASTICA_RESOURCES['PressCoverageTranslation']
                );
                break;
            case 'MdfPressGalleryWidgetTranslation':
                $this->updateElasticaIndexes(
                    $entity
                        ->getTranslatable()
                        ->getPressGallery(),
                    self::$ELASTICA_RESOURCES['MdfPressGalleryTranslation']
                );
                break;
            case 'MdfPressGraphicalCharterWidgetTranslation':
                $this->updateElasticaIndexes(
                    $entity
                        ->getTranslatable()
                        ->getPressGraphicalCharter(),
                    self::$ELASTICA_RESOURCES['MdfPressGraphicalCharterTranslation']
                );
                break;
            case 'MdfRubriqueTranslation':
                $this->updateElasticaIndexes(
                    $entity
                        ->getTranslatable()
                        ->getRubriquesCollection()
                        ->getInformationPage(),
                    self::$ELASTICA_RESOURCES['MdfInformationsTranslation']
                );
                break;
            case 'MdfRubriqueQuestionTranslation':
                $this->updateElasticaIndexes(
                    $entity
                        ->getTranslatable()
                        ->getRubriqueQuestionsCollection()
                        ->getRubrique()
                        ->getRubriquesCollection()
                        ->getInformationPage(),
                    self::$ELASTICA_RESOURCES['MdfInformationsTranslation']
                );
                break;
            case 'TagTranslation':
                $this->updateElasticaIndexes(
                    $entity
                        ->getTranslatable()
                        ->getRubriqueQuestionsCollection()
                        ->getRubrique()
                        ->getRubriquesCollection()
                        ->getInformationPage(),
                    self::$ELASTICA_RESOURCES['MdfInformationsTranslation']
                );
                break;

        }
    }

    protected function updateElasticaIndexes($entity, $index)
    {
        $this->initPostPersister($index);
        $this->objectPersisterPost->replaceMany(array($entity));
    }

    protected function initPostPersister($index)
    {
        if (null === $this->objectPersisterPost) {
            // fos_elastica.object_persister.<index_name>.<type_name>
            $this->objectPersisterPost = $this->container->get('fos_elastica.object_persister.fdc_mdf.' . $index);
        }
    }
}