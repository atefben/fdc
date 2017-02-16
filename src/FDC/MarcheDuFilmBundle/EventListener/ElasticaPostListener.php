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

                if ($widget && $widget->isWidgetVideo()) {
                    $this->updateElasticaIndexes(
                        $entity->getTranslatable()->getContentTemplate(),
                        self::$ELASTICA_RESOURCES['MdfContentTemplateWidgetVideoTranslation']
                    );

                    break;
                }
                break;
            case 'MdfContentTemplateWidgetFile':
                $this->updateElasticaIndexes(
                    $entity->getFile(),
                    self::$ELASTICA_RESOURCES['MediaMdfPdfTranslation']
                );
                break;
            case 'MdfContentTemplateWidgetGallery':
                $this->updateElasticaIndexes(
                    $entity->getGallery(),
                    self::$ELASTICA_RESOURCES['GalleryMdfTranslation']
                );
                break;
            case 'MdfContentTemplateWidgetImage':
                $this->updateElasticaIndexes(
                    $entity->getImage(),
                    self::$ELASTICA_RESOURCES['MediaMdfImageTranslation']
                );
                break;
            case 'MdfContentTemplateWidgetTextTranslation':
                if ($entity->getTranslatable()->getContentTemplate()) {
                    $this->updateElasticaIndexes(
                        $entity->getTranslatable()->getContentTemplate(),
                        self::$ELASTICA_RESOURCES['MdfContentTemplateTranslation']
                    );
                    break;
                }

                if ($entity->getTranslatable()->getConferenceProgram()) {
                    $this->updateElasticaIndexes(
                        $entity->getTranslatable()->getConferenceProgram(),
                        self::$ELASTICA_RESOURCES['MdfConferenceProgramTranslation']
                    );
                    break;
                }
                break;
            case 'MdfContentTemplateWidgetText':
                if ($entity->getContentTemplate()) {
                    $this->updateElasticaIndexes(
                        $entity->getContentTemplate(),
                        self::$ELASTICA_RESOURCES['MdfContentTemplateTranslation']
                    );
                    break;
                }

                if ($entity->getConferenceProgram()) {
                    $this->updateElasticaIndexes(
                        $entity->getConferenceProgram(),
                        self::$ELASTICA_RESOURCES['MdfConferenceProgramTranslation']
                    );
                    break;
                }
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
                foreach ($entity->getTranslatable()->getWidgetsCollection() as $widget) {
                    $this->updateElasticaIndexes(
                        $widget->getService(),
                        self::$ELASTICA_RESOURCES['ServiceTranslation']
                    );
                }
                break;
            case 'ServiceWidgetProductTranslation':
                foreach ($entity->getTranslatable()->getProductsCollections() as $product) {
                    foreach ($product->getServiceWidget()->getWidgetsCollection() as $widget) {
                        $this->updateElasticaIndexes(
                            $widget->getService(),
                            self::$ELASTICA_RESOURCES['ServiceTranslation']
                        );
                    }
                }
                break;
            case 'MdfConferenceProgramEventTranslation':
                foreach ($entity->getTranslatable()->getProgramEventCollection() as $programEvent) {
                    foreach ($programEvent->getConferenceProgramDay()->getProgramDayCollection() as $programDay) {
                        $this->updateElasticaIndexes(
                            $programDay->getConferenceProgram(),
                            self::$ELASTICA_RESOURCES['MdfConferenceProgramTranslation']
                        );
                    }
                }
                break;
            case 'MdfProgramSpeakerTranslation':
                foreach ($entity->getTranslatable()->getProgramSpeakerCollection() as $programSpeaker) {
                    foreach ($programSpeaker->getProgramEvent()->getProgramEventCollection() as $programEvent) {
                        foreach ($programEvent->getConferenceProgramDay()->getProgramDayCollection() as $programDay) {
                            $this->updateElasticaIndexes(
                                $programDay->getConferenceProgram(),
                                self::$ELASTICA_RESOURCES['MdfConferenceProgramTranslation']
                            );
                        }
                    }
                }
                break;
            case 'MdfSpeakersChoicesTranslation':
                foreach ($entity->getTranslatable()->getSpeakersChoicesCollection() as $speakersChoice) {
                    $this->updateElasticaIndexes(
                        $speakersChoice
                            ->getSpeakersPage(),
                        self::$ELASTICA_RESOURCES['MdfSpeakersTranslation']
                    );
                }
                break;
            case 'MdfSpeakersDetailsTranslation':
                foreach ($entity->getTranslatable()->getSpeakersDetailsCollection() as $speakersDetail) {
                    foreach ($speakersDetail->getSpeakersChoiceTab()->getSpeakersChoicesCollection() as $speakersChoice) {
                        $this->updateElasticaIndexes(
                            $speakersChoice->getSpeakersPage(),
                            self::$ELASTICA_RESOURCES['MdfSpeakersTranslation']
                        );
                    }
                }
                break;
            case 'MdfConferencePartnerTabTranslation':
                foreach ($entity->getTranslatable()->getConferencePartnerTabCollection() as $conferencePartnerTab) {
                    $this->updateElasticaIndexes(
                        $conferencePartnerTab
                            ->getConferencePartner(),
                        self::$ELASTICA_RESOURCES['MdfConferencePartnerTranslation']
                    );
                }
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
                foreach ($entity->getTranslatable()->getRubriquesCollection() as $rubrique) {
                    $this->updateElasticaIndexes(
                        $rubrique
                            ->getInformationPage(),
                        self::$ELASTICA_RESOURCES['MdfInformationsTranslation']
                    );
                }
                break;
            case 'MdfRubriqueQuestionTranslation':
                foreach ($entity->getTranslatable()->getRubriqueQuestionsCollection() as $rubriquesQuestion) {
                    foreach ($rubriquesQuestion->getRubrique()->getRubriquesCollection() as $rubrique) {
                        $this->updateElasticaIndexes(
                            $rubrique
                                ->getInformationPage(),
                            self::$ELASTICA_RESOURCES['MdfInformationsTranslation']
                        );
                    }
                }
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
        // fos_elastica.object_persister.<index_name>.<type_name>
        $this->objectPersisterPost = $this->container->get('fos_elastica.object_persister.fdc_mdf.' . $index);
    }
}