<?php

namespace FDC\MarcheDuFilmBundle\Transformer;

use Elastica\Document;
use FOS\ElasticaBundle\Transformer\ModelToElasticaTransformerInterface;
use FOS\ElasticaBundle\Transformer\ModelToElasticaAutoTransformer;
use FDC\MarcheDuFilmBundle\Entity\MdfTheme;

class ContentToElasticaTransformer extends ModelToElasticaAutoTransformer implements ModelToElasticaTransformerInterface
{
    /**
     * Transforms an object into an elastica object having the required keys.
     *
     * @param object $object the object to convert
     * @param array  $fields the keys we want to have in the returned array
     *
     * @return Document
     **/
    public function transform($object, array $fields)
    {
        $className = new \ReflectionClass(get_class($object));

        // customize indexes taking care of MdfContentTemplateWidget type
        switch ($className->getShortName()) {
            case 'MdfContentTemplate':
                // if theme isn't set, should remove indexation
                if (!$object->getTheme()) {
                    $object->setTheme(new MdfTheme());
                    unset($fields['theme.translations']);
                }

                // create index only for ContentTemplateWidgets of type Text
                $haveTextWidget = false;

                foreach ($object->getContentTemplateWidgets() as $widget) {

                    if ($widget->isWidgetText()) {
                        $haveTextWidget = true;

                        continue;
                    }

                    if (!$widget->isWidgetText()) {
                        $object->removeContentTemplateWidget($widget);
                    }
                }

                if (!$haveTextWidget) {
                    unset($fields['contentTemplateWidgets.translations']);
                }
                break;
            case 'MdfHomepage':
                if (!$object->getServices()) {
                    unset($fields['services.service.translations']);
                }
                break;
            case 'Accreditation':
                if (!$object->getAccreditationWidgets()) {
                    unset($fields['accreditationWidgets.translations']);
                }
                break;
            case 'DispatchDeService':
                if (!$object->getDispatchDeServiceWidgets()) {
                    unset($fields['dispatchDeServiceWidgets.translations']);
                }
                break;
            case 'Service':
                if (!$object->getWidgetCollections()) {
                    unset($fields['widgetCollections.widget.translations']);
                    unset($fields['widgetCollections.widget.productCollections.product.translations']);

                    break;
                }

                foreach($object->getWidgetCollections() as $widget) {
                    if (!$widget->getWidget()) {
                        unset($fields['widgetCollections.widget.translations']);
                        unset($fields['widgetCollections.widget.productCollections.product.translations']);

                        continue;
                    }

                    if (!$widget->getWidget()->getProductCollections()) {
                        unset($fields['widgetCollections.widget.productCollections.product.translations']);

                        continue;
                    }

                    foreach($widget->getWidget()->getProductCollections() as $product) {
                       if (!$product->getProduct()) {
                           unset($fields['widgetCollections.widget.productCollections.product.translations']);
                       }
                    }
                }
                break;
            case 'MdfConferenceProgram':
                if (!$object->getDayWidgetCollections()) {
                    unset($fields['dayWidgetCollections.conferenceProgramDay.eventWidgetCollections.conferenceProgramEvent.translations']);
                    unset($fields['dayWidgetCollections.conferenceProgramDay.eventWidgetCollections.conferenceProgramEvent.speakerCollections.programSpeakers.translations']);

                    break;
                }

                foreach($object->getDayWidgetCollections() as $widget) {
                    if (!$widget->getConferenceProgramDay()) {
                        unset($fields['dayWidgetCollections.conferenceProgramDay.eventWidgetCollections.conferenceProgramEvent.translations']);
                        unset($fields['dayWidgetCollections.conferenceProgramDay.eventWidgetCollections.conferenceProgramEvent.speakerCollections.programSpeakers.translations']);

                        continue;
                    }

                    foreach($widget->getConferenceProgramDay()->getEventWidgetCollections() as $event) {
                        if (!$event->getConferenceProgramEvent()) {
                            unset($fields['dayWidgetCollections.conferenceProgramDay.eventWidgetCollections.conferenceProgramEvent.translations']);
                            unset($fields['dayWidgetCollections.conferenceProgramDay.eventWidgetCollections.conferenceProgramEvent.speakerCollections.programSpeakers.translations']);

                            continue;
                        }

                        if (!$event->getConferenceProgramEvent()->getSpeakerCollections()) {
                            unset($fields['dayWidgetCollections.conferenceProgramDay.eventWidgetCollections.conferenceProgramEvent.speakerCollections.programSpeakers.translations']);

                            continue;
                        }
                        foreach($event->getConferenceProgramEvent()->getSpeakerCollections() as $speaker) {
                            if (!$speaker->getProgramSpeakers()) {
                                unset($fields['dayWidgetCollections.conferenceProgramDay.eventWidgetCollections.conferenceProgramEvent.speakerCollections.programSpeakers.translations']);
                            }
                        }
                    }
                }
                break;
            case 'MdfSpeakers':
                if (!$object->getSpeakersChoicesCollections()) {
                    unset($fields['speakersChoicesCollections.speakersChoice.translations']);
                    unset($fields['speakersChoicesCollections.speakersChoice.speakersDetailsCollections.speakersDetails.translations']);

                    break;
                }

                foreach($object->getSpeakersChoicesCollections() as $choice) {
                    if (!$choice->getSpeakersChoice()) {
                        unset($fields['speakersChoicesCollections.speakersChoice.translations']);
                        unset($fields['speakersChoicesCollections.speakersChoice.speakersDetailsCollections.speakersDetails.translations']);

                        continue;
                    }

                    if (!$choice->getSpeakersChoice()->getSpeakersDetailsCollections()) {
                        unset($fields['speakersChoicesCollections.speakersChoice.speakersDetailsCollections.speakersDetails.translations']);

                        continue;
                    }

                    foreach($choice->getSpeakersChoice()->getSpeakersDetailsCollections() as $speaker) {
                        if (!$speaker->getspeakersDetails()) {
                            unset($fields['speakersChoicesCollections.speakersChoice.speakersDetailsCollections.speakersDetails.translations']);
                        }
                    }
                }
                break;
            case 'MdfConferencePartner':
                if (!$object->getPartnerTabCollection()) {
                    unset($fields['partnerTabCollection.conferencePartnerTab.translations']);

                    break;
                }

                foreach($object->getPartnerTabCollection() as $tab) {
                    if (!$tab->getConferencePartnerTab()) {
                        unset($fields['partnerTabCollection.conferencePartnerTab.translations']);
                    }
                }
                break;
            case 'MdfConferenceInfoAndContact':
                if (!$object->getConferenceInfoAndContactWidgets()) {
                    unset($fields['conferenceInfoAndContactWidgets.translations']);
                }
                break;
            case 'MdfWhoAreWeTeam':
                if (!$object->getWhoAreWeTeamContactWidgets()) {
                    unset($fields['whoAreWeTeamContactWidgets.translations']);
                }

                if (!$object->getWhoAreWeTeamWidgets()) {
                    unset($fields['whoAreWeTeamWidgets.translations']);
                }
                break;
            case 'PressCoverage':
                if (!$object->getPressCoverageWidgets()) {
                    unset($fields['pressCoverageWidgets.translations']);
                }
                break;
            case 'MdfPressGallery':
                if (!$object->getPressGalleryWidgets()) {
                    unset($fields['pressGalleryWidgets.translations']);
                }
                break;
            case 'MdfPressGraphicalCharter':
                if (!$object->getPressGraphicalCharterWidgets()) {
                    unset($fields['pressGraphicalCharterWidgets.translations']);
                }
                break;
            case 'MdfInformations':
                if (!$object->getRubriquesCollection()) {
                    unset($fields['rubriquesCollection.rubrique.translations']);
                    unset($fields['rubriquesCollection.rubrique.questionsCollection.rubriqueQuestion.translations']);

                    break;
                }

                if (!$object->getRubriquesCollection()) {
                    unset($fields['rubriquesCollection.rubrique.translations']);
                    unset($fields['rubriquesCollection.rubrique.questionsCollection.rubriqueQuestion.translations']);

                    break;
                }

                foreach($object->getRubriquesCollection() as $rubrique) {
                    if (!$rubrique->getRubrique()) {
                        unset($fields['rubriquesCollection.rubrique.translations']);
                        unset($fields['rubriquesCollection.rubrique.questionsCollection.rubriqueQuestion.translations']);

                        break;
                    }

                    if (!$rubrique->getRubrique()->getQuestionsCollection()) {
                        unset($fields['rubriquesCollection.rubrique.questionsCollection.rubriqueQuestion.translations']);

                        continue;
                    }

                    foreach($rubrique->getRubrique()->getQuestionsCollection() as $question) {
                        if (!$question->getRubriqueQuestion()) {
                            unset($fields['partnerTabCollection.conferencePartnerTab.translations']);
                        }
                    }
                }
                break;
            default:
                break;
        }

        //continue with parent::transform() logic 
        $document = parent::transform($object, $fields);

        return $document;
    }
}
