<?php

namespace FDC\MarcheDuFilmBundle\Controller;

use FDC\MarcheDuFilmBundle\Entity\Accreditation;
use FDC\MarcheDuFilmBundle\Entity\DispatchDeService;
use FDC\MarcheDuFilmBundle\Entity\GalleryMdf;
use FDC\MarcheDuFilmBundle\Entity\MdfConferenceInfoAndContact;
use FDC\MarcheDuFilmBundle\Entity\MdfConferencePartner;
use FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram;
use FDC\MarcheDuFilmBundle\Entity\MdfContactPage;
use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate;
use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateWidgetVideo;
use FDC\MarcheDuFilmBundle\Entity\MdfHomepage;
use FDC\MarcheDuFilmBundle\Entity\MdfInformations;
use FDC\MarcheDuFilmBundle\Entity\MdfPressGallery;
use FDC\MarcheDuFilmBundle\Entity\MdfPressGraphicalCharter;
use FDC\MarcheDuFilmBundle\Entity\MdfPressRelease;
use FDC\MarcheDuFilmBundle\Entity\MdfSpeakers;
use FDC\MarcheDuFilmBundle\Entity\MdfWhoAreWeTeam;
use FDC\MarcheDuFilmBundle\Entity\MediaMdfImage;
use FDC\MarcheDuFilmBundle\Entity\MediaMdfPdf;
use FDC\MarcheDuFilmBundle\Entity\PressCoverage;
use FDC\MarcheDuFilmBundle\Entity\Service;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends Controller
{
    /**
     * @Route("/search", name="fdc_marche_du_film_search")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchAction(Request $request)
    {
        $searchTerm = $request->query->get('term');
        $locale = $request->getLocale();
        $items = array(
            'contentResults' => array(),
            'mediaResults' => array(),
            'documentResults' => array(),
        );

        /** FOS\ElasticaBundle\Manager\RepositoryManager */
        $repositoryManager = $this->container->get('fos_elastica.manager');

        if ($searchTerm) {
            // contentResults
            $items['contentResults'] = $this->searchContent($repositoryManager, $searchTerm, $locale);

            // documentResults
            $items['documentResults'] = $repositoryManager
                ->getRepository(MediaMdfPdf::class)
                ->findWithCustomQuery($locale, $searchTerm);

            // mediaResults
            $items['mediaResults'] = $this->searchMedia($repositoryManager, $searchTerm, $locale);
        }

        return $this->render('FDCMarcheDuFilmBundle::search/index.html.twig', array(
            'searchTerm' => $searchTerm,
            'items' => $items,
        ));
    }

    protected function searchContent($repositoryManager, $searchTerm, $locale)
    {
        $contentTemplateResults = $repositoryManager
            ->getRepository(MdfContentTemplate::class)
            ->findWithCustomQuery($locale, $searchTerm);

        $homepageResults = $repositoryManager
            ->getRepository(MdfHomepage::class)
            ->findWithCustomQuery($locale, $searchTerm);

        $accreditationResults = $repositoryManager
            ->getRepository(Accreditation::class)
            ->findWithCustomQuery($locale, $searchTerm);

        $dispatchDeServiceResults = $repositoryManager
            ->getRepository(DispatchDeService::class)
            ->findWithCustomQuery($locale, $searchTerm);

        $serviceResults = $repositoryManager
            ->getRepository(Service::class)
            ->findWithCustomQuery($locale, $searchTerm);

        $conferenceProgramResults = $repositoryManager
            ->getRepository(MdfConferenceProgram::class)
            ->findWithCustomQuery($locale, $searchTerm);

        $conferenceSpeakerResults = $repositoryManager
            ->getRepository(MdfSpeakers::class)
            ->findWithCustomQuery($locale, $searchTerm);

        $conferencePartnerResults = $repositoryManager
            ->getRepository(MdfConferencePartner::class)
            ->findWithCustomQuery($locale, $searchTerm);

        $conferenceInfoAndContactResults = $repositoryManager
            ->getRepository(MdfConferenceInfoAndContact::class)
            ->findWithCustomQuery($locale, $searchTerm);

        $whoAreWeResults = $repositoryManager
            ->getRepository(MdfWhoAreWeTeam::class)
            ->findWithCustomQuery($locale, $searchTerm);

        $pressReleaseResults = $repositoryManager
            ->getRepository(MdfPressRelease::class)
            ->findWithCustomQuery($locale, $searchTerm);

        $pressCoverageResults = $repositoryManager
            ->getRepository(PressCoverage::class)
            ->findWithCustomQuery($locale, $searchTerm);

        $pressGalleryResults = $repositoryManager
            ->getRepository(MdfPressGallery::class)
            ->findWithCustomQuery($locale, $searchTerm);

        $pressGraphicalCharterResults = $repositoryManager
            ->getRepository(MdfPressGraphicalCharter::class)
            ->findWithCustomQuery($locale, $searchTerm);

        $informationResults = $repositoryManager
            ->getRepository(MdfInformations::class)
            ->findWithCustomQuery($locale, $searchTerm);

        $contactResults = $repositoryManager
            ->getRepository(MdfContactPage::class)
            ->findWithCustomQuery($locale, $searchTerm);

        return $this
            ->mergeContent(
                $contentTemplateResults,
                $homepageResults,
                $accreditationResults,
                $dispatchDeServiceResults,
                $serviceResults,
                $conferenceProgramResults,
                $conferenceSpeakerResults,
                $conferencePartnerResults,
                $conferenceInfoAndContactResults,
                $whoAreWeResults,
                $pressReleaseResults,
                $pressCoverageResults,
                $pressGalleryResults,
                $pressGraphicalCharterResults,
                $informationResults,
                $contactResults,
                $locale
            );
    }

    protected function searchMedia($repositoryManager, $searchTerm, $locale)
    {
        $imageResults = $repositoryManager
            ->getRepository(MediaMdfImage::class)
            ->findWithCustomQuery($locale, $searchTerm);
        $videoResults = $repositoryManager
            ->getRepository(MdfContentTemplateWidgetVideo::class)
            ->findWithCustomQuery($locale, $searchTerm);

        $galleryResults = $repositoryManager
            ->getRepository(GalleryMdf::class)
            ->findWithCustomQuery($locale, $searchTerm);

        return $this->mergeMedia($imageResults, $videoResults, $galleryResults, $locale);
    }

    protected function mergeMedia($imageResults, $videoResults, $galleryResults, $locale)
    {
        $output = array();

        foreach ($imageResults as $imageResult) {
            $translation = $imageResult->findTranslationByLocale($locale);
            if ($translation) {
                $output[] = array(
                    'title' => $translation->getLegend(),
                    'id' => $translation->getId(),
                    'type' => 'image',
                    'image' => $imageResult,
                    'alt' => $translation->getAlt()
                );
            }
        }

        foreach ($videoResults as $videoResult) {
            $translation = $videoResult->findTranslationByLocale($locale);
            if ($translation) {
                $output[] = array(
                    'title' => $translation->getTitle(),
                    'id' => $translation->getId(),
                    'type' => 'video',
                    'image' => $videoResult->getImage(),
                    'alt' => $videoResult->getImage()->findTranslationByLocale($locale)->getAlt()
                );
            }

            continue;
        }

        foreach ($galleryResults as $galleryResult) {
            $translation = $galleryResult->findTranslationByLocale($locale);
            $image = $galleryResult->getMedias()[0]->getMedia();
            if ($translation && $image) {
                $output[] = array(
                    'title' => $translation->getName(),
                    'id' => $galleryResult->getId(),
                    'type' => 'gallery',
                    'image' => $image,
                    'alt' => $image->findTranslationByLocale($locale)->getAlt()
                );
            }
        }

        //order by created at

        return $output;
    }

    protected function mergeContent(
        $contentTemplateResults,
        $homepageResults,
        $accreditationResults,
        $dispatchDeServiceResults,
        $serviceResults,
        $conferenceProgramResults,
        $conferenceSpeakerResults,
        $conferencePartnerResults,
        $conferenceInfoAndContactResults,
        $whoAreWeResults,
        $pressReleaseResults,
        $pressCoverageResults,
        $pressGalleryResults,
        $pressGraphicalCharterResults,
        $informationResults,
        $contactResults,
        $locale
    ) {
        $output = array();
        $router = $this->container->get('router');
        $translator = $this->container->get('translator');

        foreach ($contentTemplateResults as $contentTemplateResult) {
            $translation = $contentTemplateResult->findTranslationByLocale($locale);
            $image = $theme = null;
            //search for first image in the page
            foreach ($contentTemplateResult->getContentTemplateWidgets() as $widget) {
                if ($widget->isWidgetImage() && $widget->getImage()->findTranslationByLocale($locale)) {
                    $image = $widget->getImage();

                    break;
                }
            }
            //find url of page and theme if exists
            if (in_array($contentTemplateResult->getType(), MdfContentTemplate::$CONTENT_TEMPLATE_OPTIONS)) {

                if ($contentTemplateResult->getType() == MdfContentTemplate::TYPE_NEWS_DETAILS) {
                    $url = $router->generate('fdc_marche_du_film_news_details', array(
                        'slug' => $translation->getSlug(),
                    ));
                    $theme = $contentTemplateResult->getTheme()->findTranslationByLocale($locale)->getTitle();
                } else {
                    $url = $router->generate('fdc_marche_du_film_' . $contentTemplateResult->getType());
                }
            } else {
                $url = $router->generate('fdc_marche_du_film_conference_program', array(
                    'slug' => $contentTemplateResult->getType(),
                ));
                $theme = str_replace('-', ' ', $contentTemplateResult->getType());//hope is ok
            }

            $output[] = array(
                'title' => $translation->getTitle(),
                'theme' => $theme,//posibil sa fie si pt MdfConferenceProgram
                'date' => $contentTemplateResult->getPublishedAt(),
                'icon' => 'text',
                'image' => $image,
                'url' => $url
            );
        }

        foreach ($homepageResults as $homepageResult) {
            $image = null;
            //search for first image in the page
            foreach ($homepageResult->getGallery()->getMedias() as $widget) {
                if ($widget->getMedia()->findTranslationByLocale($locale)) {
                    $image = $widget->getMedia();

                    break;
                }
            }
            $output[] = array(
                'title' => $homepageResult->findTranslationByLocale($locale)->getTitle(),
                'theme' => null,
                'date' => $homepageResult->getPublishedAt(),
                'icon' => 'text',
                'image' => $image,
                'url' => $router->generate('fdc_marche_du_film_homepage')
            );
        }

        foreach ($accreditationResults as $accreditationResult) {
            $output[] = array(
                'title' => $accreditationResult->findTranslationByLocale($locale)->getTitle(),
                'theme' => null,
                'date' => null,//no createdAt
                'icon' => 'text',
                'image' => null,//no image
                'url' => $router->generate('fdc_marche_du_film_accreditations')
            );
        }

        foreach ($dispatchDeServiceResults as $dispatchDeServiceResult) {
            $image = null;
            //search for first image in the page
            foreach ($dispatchDeServiceResult->getDispatchDeServiceWidgets() as $widget) {
                if ($widget->getImage()->findTranslationByLocale($locale)) {
                    $image = $widget->getImage();

                    break;
                }
            }
            $output[] = array(
                'title' => $dispatchDeServiceResult->findTranslationByLocale($locale)->getTitle(),
                'theme' => null,
                'date' => null,//no createdAt
                'icon' => 'text',
                'image' => $image,
                'url' => $router->generate('fdc_marche_du_film_services')
            );
        }

        foreach ($serviceResults as $serviceResult) {
            //find translation
            $translation = $serviceResult->findTranslationByLocale($locale);
            $image = null;
            //search for first image in the page
            foreach ($serviceResult->getWidgetCollections() as $widget) {
                foreach ($widget->getWidget()->getProductCollections() as $product) {
                    if ($product->getProduct()->getGallery()) {
                        foreach ($product->getProduct()->getGallery()->getMedias() as $media) {
                            if ($media->getMedia()->findTranslationByLocale($locale)) {
                                $image = $media->getMedia();

                                break 3;
                            }
                        }
                    }
                }
            }
            $output[] = array(
                'title' => $translation->getTitle(),
                'theme' => null,
                'date' => $serviceResult->getPublishedAt(),
                'icon' => 'text',
                'image' => $image,
                'url' => $router->generate('fdc_marche_du_film_services_widgets', array(
                    'slug' => $translation->getUrl(),
                ))
            );
        }

        foreach ($conferenceProgramResults as $conferenceProgramResult) {
            $image = null;
            //search for first image in the page
            foreach ($conferenceProgramResult->getContentTemplateConferenceWidgets() as $widget) {
                if ($widget->isWidgetImage() && $widget->getImage() && $widget->getImage()->findTranslationByLocale($locale)) {
                    $image = $widget->getImage();

                    break;
                }
            }
            $output[] = array(
                'title' => $conferenceProgramResult->findTranslationByLocale($locale)->getSubTitle(),
                'theme' => str_replace('-', ' ', $conferenceProgramResult->getType()),//hope is ok
                'date' => null,//no createdAt
                'icon' => 'text',
                'image' => $image,
                'url' => $router->generate('fdc_marche_du_film_conference_program', array(
                    'slug' => $conferenceProgramResult->getType(),
                ))
            );
        }

        foreach ($conferenceSpeakerResults as $conferenceSpeakerResult) {
            $image = null;
            //search for first image in the page
            foreach ($conferenceSpeakerResult->getSpeakersChoicesCollections() as $choice) {
                foreach ($choice->getSpeakersChoice()->getSpeakersDetailsCollections() as $details) {
                    if ($details->getSpeakersDetails()->getImage() && $details->getSpeakersDetails()->getImage()->findTranslationByLocale($locale)) {
                        $image = $details->getSpeakersDetails()->getImage();

                        break 2;
                    }
                }
            }
            $output[] = array(
                'title' => $conferenceSpeakerResult->findTranslationByLocale($locale)->getSubTitle(),
                'theme' => str_replace('-', ' ', $conferenceSpeakerResult->getType()),//hope is ok
                'date' => $conferenceSpeakerResult->getCreatedAt(),
                'icon' => 'text',
                'image' => $image,
                'url' => $router->generate('fdc_marche_du_film_conference_speakers', array(
                    'slug' => $conferenceSpeakerResult->getType(),
                ))
            );
        }

        foreach ($conferencePartnerResults as $conferencePartnerResult) {
            $image = null;
            //search for first image in the page
            foreach ($conferencePartnerResult->getPartnerTabCollection() as $tab) {
                foreach ($tab->getConferencePartnerTab()->getPartnerLogoCollection() as $logo) {
                    if ($logo->getConferencePartnerLogo()->getImage() && $logo->getConferencePartnerLogo()->getImage()->findTranslationByLocale($locale)) {
                        $image = $logo->getConferencePartnerLogo()->getImage();

                        break 2;
                    }
                }
            }
            $output[] = array(
                'title' => $conferencePartnerResult->findTranslationByLocale($locale)->getSubTitle(),
                'theme' => str_replace('-', ' ', $conferencePartnerResult->getType()),//hope is ok
                'date' => $conferencePartnerResult->getCreatedAt(),
                'icon' => 'text',
                'image' => $image,
                'url' => $router->generate('fdc_marche_du_film_conference_partners', array(
                    'slug' => $conferencePartnerResult->getType(),
                ))
            );
        }


        foreach ($conferenceInfoAndContactResults as $conferenceInfoAndContactResult) {
            $image = null;
            //search for first image in the page
            foreach ($conferenceInfoAndContactResult->getConferenceInfoAndContactWidgets() as $widget) {
                if ($widget->getImage() && $widget->getImage()->findTranslationByLocale($locale)) {
                    $image = $widget->getImage();

                    break;
                }
            }

            $output[] = array(
                'title' => $conferenceInfoAndContactResult->findTranslationByLocale($locale)->getTitle(),
                'theme' => str_replace('-', ' ', $conferenceInfoAndContactResult->getType()),//hope is ok
                'date' => null,//no createdAt
                'icon' => 'text',
                'image' => $image,
                'url' => $router->generate('fdc_marche_du_film_conference_infos_and_contacts', array(
                    'slug' => $conferenceInfoAndContactResult->getType(),
                ))
            );
        }

        foreach ($whoAreWeResults as $whoAreWeResult) {
            $image = null;
            //search for first image in the page
            foreach ($whoAreWeResult->getWhoAreWeTeamWidgets() as $widget) {
                if ($widget->getImage() && $widget->getImage()->findTranslationByLocale($locale)) {
                    $image = $widget->getImage();

                    break;
                }
            }

            $output[] = array(
                'title' => $whoAreWeResult->findTranslationByLocale($locale)->getTitle(),
                'theme' => null,
                'date' => null,//no createdAt
                'icon' => 'text',
                'image' => $image,
                'url' => $router->generate('fdc_marche_du_film_who_are_we_team')
            );
        }

        foreach ($pressReleaseResults as $pressReleaseResult) {
            $output[] = array(
                'title' =>  $pressReleaseResult->findTranslationByLocale($locale)->getSubtitle(),
                'theme' => null,
                'date' => null,//no createdAt
                'icon' => 'press-release',
                'image' => null,
                'url' => $router->generate('fdc_marche_du_film_press_releases')
            );
        }

        foreach ($pressCoverageResults as $pressCoverageResult) {
            $output[] = array(
                'title' => $pressCoverageResult->findTranslationByLocale($locale)->getTitle(),
                'theme' => null,
                'date' => null,//no createdAt
                'icon' => 'press-release',
                'image' => null,
                'url' => $router->generate('fdc_marche_du_film_press_coverage')
            );
        }

        foreach ($pressGalleryResults as $pressGalleryResult) {
            $image = null;
            //search for first image in the page
            foreach ($pressGalleryResult->getPressGalleryWidgets() as $widget) {
                if ($widget->getImage() && $widget->getImage()->findTranslationByLocale($locale)) {
                    $image = $widget->getImage();

                    break;
                }
            }

            $output[] = array(
                'title' => $pressGalleryResult->findTranslationByLocale($locale)->getTitle(),
                'theme' => null,
                'date' => null,//no createdAt
                'icon' => 'press-release',
                'image' => $image,
                'url' => $router->generate('fdc_marche_du_film_press_gallery')
            );
        }

        foreach ($pressGraphicalCharterResults as $pressGraphicalCharterResult) {
            $image = null;
            //search for first image in the page
            foreach ($pressGraphicalCharterResult->getPressGraphicalCharterWidgets() as $widget) {
                if ($widget->getImage() && $widget->getImage()->findTranslationByLocale($locale)) {
                    $image = $widget->getImage();

                    break;
                }
            }

            $output[] = array(
                'title' => $pressGraphicalCharterResult->findTranslationByLocale($locale)->getTitle(),
                'theme' => null,
                'date' => null,//no createdAt
                'icon' => 'press-release',
                'image' => $image,
                'url' => $router->generate('fdc_marche_du_film_press_graphical_charter')
            );
        }

        foreach ($informationResults as $informationResult) {
            $output[] = array(
                'title' => $translator->trans('menu.faq'),//hope is ok
                'theme' => null,
                'date' => null,//no createdAt
                'icon' => 'text',
                'image' => null,
                'url' => $router->generate('fdc_marche_du_film_infos_utiles')
            );
        }

        foreach ($contactResults as $contactResult) {
            $output[] = array(
                'title' => $contactResult->findTranslationByLocale($locale)->getTitle(),
                'theme' => null,
                'date' => null,//no createdAt
                'icon' => 'text',
                'image' => null,
                'url' => $router->generate('fdc_marche_du_film_contact_us')
            );
        }

        return $output;
    }

    /**
     * @Route("/media-source/{type}/{id}", name="fdc_marche_du_film_get_media_source")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getMediaSourceAction($type, $id, Request $request)
    {
        $locale = $request->getLocale();
        $finalSource = array('route' => 'fdc_marche_du_film_homepage');

        switch ($type) {
            case 'image':
                //check source in MdfContentTemplate
                $source = $this->getContentTemplateSource($id, $type, $locale);
                if ($source) {
                    $finalSource = $source;

                    continue;
                }

                //if don't have source in MdfContentTemplate then check source in Homepage
                $source = $this->getHomepageSource($id, $type, $locale);
                if ($source) {
                    $finalSource = $source;

                    continue;
                }

                //if don't have source in Homepage then check source in DispatchDeService
                $source = $this->getDispatchDeServiceSource($id, $type, $locale);
                if ($source) {
                    $finalSource = $source;

                    continue;
                }

                //if don't have source in DispatchDeService then check source in MdfConferenceProgram
                $source = $this->getConferenceProgramSource($id, $type, $locale);
                if ($source) {
                    $finalSource = $source;

                    continue;
                }

                //if don't have source in MdfConferenceProgram then check source in MdfSpeakers
                $source = $this->getSpeakersSource($id, $type, $locale);
                if ($source) {
                    $finalSource = $source;

                    continue;
                }

                //if don't have source in MdfSpeakers then check source in ConferencePartner
                $source = $this->getConferencePartnerSource($id, $type, $locale);
                if ($source) {
                    $finalSource = $source;

                    continue;
                }

                //if don't have source in ConferencePartner then check source in ConferenceInfoAndContact
                $source = $this->getConferenceInfoAndContactSource($id, $type, $locale);
                if ($source) {
                    $finalSource = $source;

                    continue;
                }

                //if don't have source in ConferenceInfoAndContact then check source in WhoAreWeTeam
                $source = $this->getWhoAreWeTeamSource($id, $type, $locale);
                if ($source) {
                    $finalSource = $source;

                    continue;
                }

                //if don't have source in WhoAreWeTeam then check source in PressGallery
                $source = $this->getPressGallerySource($id, $type, $locale);
                if ($source) {
                    $finalSource = $source;

                    continue;
                }

                //if don't have source in PressGallery then check source in PressGraphicalCharter
                $source = $this->getPressGraphicalCharterSource($id, $type, $locale);
                if ($source) {
                    $finalSource = $source;

                    continue;
                }

                //if don't have source in PressGraphicalCharter then check source in Service
                $source = $this->getServiceSource($id, $type, $locale);
                if ($source) {
                    $finalSource = $source;

                    continue;
                }

                //if don't have source in Service then check source in SliderAccreditation
                $source = $this->getSliderAccreditationSource($id, $type, $locale);
                if ($source) {
                    $finalSource = $source;

                    continue;
                }

                break;
            case 'video':
                //check source in MdfContentTemplate
                $source = $this->getContentTemplateSource($id, $type, $locale);
                if ($source) {
                    $finalSource = $source;

                    continue;
                }

                //if don't have source in MdfContentTemplate then check source in MdfConferenceProgram
                $source = $this->getConferenceProgramSource($id, $type, $locale);
                if ($source) {
                    $finalSource = $source;

                    continue;
                }

                break;
            case 'gallery':
                //check source in MdfContentTemplate
                $source = $this->getContentTemplateSource($id, $type, $locale);
                if ($source) {
                    $finalSource = $source;

                    continue;
                }

                //if don't have source in MdfContentTemplate then check source in MdfConferenceProgram
                $source = $this->getConferenceProgramSource($id, $type, $locale);
                if ($source) {
                    $finalSource = $source;

                    continue;
                }
                //if don't have source in MdfConferenceProgram then check source in Homepage
                $source = $this->getHomepageSource($id, $type, $locale);
                if ($source) {
                    $finalSource = $source;

                    continue;
                }

            default:
                break;
        }

        return $this->redirectToRoute(
            $finalSource['route'],
            array_key_exists('args', $finalSource) ? $finalSource['args'] : array(),
            301
        );
    }

    private function getContentTemplateSource($id, $type, $locale)
    {
        //get pages of type MdfContentTemplate containing media $id of type $type
        $manager = $this->get('mdf.manager.content_template');
        $contentTemplates = $manager->findContentTemplateByWidget($locale, $type, $id);

        if (!$contentTemplates) {
            return;
        }

        $contentType = $contentTemplates[0]->getTranslatable()->getType();

        if (in_array($contentType, MdfContentTemplate::$CONTENT_TEMPLATE_OPTIONS)) {
            $source = array('route' => 'fdc_marche_du_film_' . $contentType);

            if ($contentType == MdfContentTemplate::TYPE_NEWS_DETAILS) {
                $source['args'] = array('slug' => $contentTemplates[0]->getSlug());
            }
        } else {
            $source = array(
                'route' => 'fdc_marche_du_film_conference_home',
                'args' => array('slug' => $contentType)
            );
        }

        return $source;
    }

    private function getConferenceProgramSource($id, $type, $locale)
    {
        //get pages of type MdfConferenceProgram containing media $id of type $type
        $manager = $this->get('mdf.manager.conference_program');
        $contentTemplates = $manager->findConferenceProgramByMedia($locale, $type, $id);

        if (!$contentTemplates) {
            return;
        }

        $source = array(
            'route' => 'fdc_marche_du_film_conference_program',
            'args' => array('slug' => $contentTemplates[0]->getTranslatable()->getType())
        );

        return $source;
    }

    private function getHomepageSource($id, $type, $locale)
    {
        //get pages of type Homepage containing media $id of type $type
        $manager = $this->get('mdf.manager.homepage');
        $contentTemplates = $manager->findHomepageByMedia($locale, $type, $id);

        if (!$contentTemplates) {
            return;
        }

        $source = array(
            'route' => 'fdc_marche_du_film_homepage',
        );

        return $source;
    }

    private function getDispatchDeServiceSource($id, $type, $locale)
    {
        //get pages of type DispatchDeService containing media $id of type $type
        $manager = $this->get('mdf.manager.dispatch_de_service');
        $contentTemplates = $manager->findDispatchDeServiceByMedia($locale, $type, $id);

        if (!$contentTemplates) {
            return;
        }

        $source = array(
            'route' => 'fdc_marche_du_film_services',
        );

        return $source;
    }

    private function getSpeakersSource($id, $type, $locale)
    {
        //get pages of type Speakers containing media $id of type $type
        $manager = $this->get('mdf.manager.speakers');
        $contentTemplates = $manager->findSpeakerByMedia($locale, $type, $id);

        if (!$contentTemplates) {
            return;
        }

        $source = array(
            'route' => 'fdc_marche_du_film_conference_speakers',
            'args' => array('slug' => $contentTemplates[0]->getType())
        );

        return $source;
    }

    private function getConferencePartnerSource($id, $type, $locale)
    {
        //get pages of type ConferencePartner containing media $id of type $type
        $manager = $this->get('mdf.manager.conference_partner');
        $contentTemplates = $manager->findConferencePartnerByMedia($locale, $type, $id);

        if (!$contentTemplates) {
            return;
        }

        $source = array(
            'route' => 'fdc_marche_du_film_conference_partners',
            'args' => array('slug' => $contentTemplates[0]->getType())
        );

        return $source;
    }

    private function getConferenceInfoAndContactSource($id, $type, $locale)
    {
        //get pages of type ConferenceInfoAndContact containing media $id of type $type
        $manager = $this->get('mdf.manager.conference_info_and_contact');
        $contentTemplates = $manager->findConferenceInfoAndContactByMedia($locale, $type, $id);

        if (!$contentTemplates) {
            return;
        }

        $source = array(
            'route' => 'fdc_marche_du_film_conference_infos_and_contacts',
            'args' => array('slug' => $contentTemplates[0]->getType())
        );

        return $source;
    }

    private function getWhoAreWeTeamSource($id, $type, $locale)
    {
        //get pages of type WhoAreWeTeam containing media $id of type $type
        $manager = $this->get('mdf.manager.who_are_we_team');
        $contentTemplates = $manager->findWhoAreWeTeamByMedia($locale, $type, $id);

        if (!$contentTemplates) {
            return;
        }

        $source = array(
            'route' => 'fdc_marche_du_film_who_are_we_team',
        );

        return $source;
    }

    private function getPressGallerySource($id, $type, $locale)
    {
        //get pages of type PressGallery containing media $id of type $type
        $manager = $this->get('mdf.manager.press_gallery');
        $contentTemplates = $manager->findPressGalleryByMedia($locale, $type, $id);

        if (!$contentTemplates) {
            return;
        }

        $source = array(
            'route' => 'fdc_marche_du_film_press_gallery',
        );

        return $source;
    }

    private function getPressGraphicalCharterSource($id, $type, $locale)
    {
        //get pages of type PressGraphicalCharter containing media $id of type $type
        $manager = $this->get('mdf.manager.press_graphical_charter');
        $contentTemplates = $manager->findPressGraphicalCharterByMedia($locale, $type, $id);

        if (!$contentTemplates) {
            return;
        }

        $source = array(
            'route' => 'fdc_marche_du_film_press_graphical_charter',
        );

        return $source;
    }

    private function getServiceSource($id, $type, $locale)
    {
        //get pages of type Service containing media $id of type $type
        $manager = $this->get('mdf.manager.services');
        $contentTemplates = $manager->findServiceByMedia($locale, $type, $id);

        if (!$contentTemplates) {
            return;
        }

        $source = array(
            'route' => 'fdc_marche_du_film_services_widgets',
        );

        return $source;
    }

    private function getSliderAccreditationSource($id, $type, $locale)
    {
        //get pages of type SliderAccreditation containing media $id of type $type
        $manager = $this->get('mdf.manager.slider_accreditation');
        $contentTemplates = $manager->findSliderAccreditationByMedia($locale, $type, $id);

        if (!$contentTemplates) {
            return;
        }

        $source = array(
            'route' => 'fdc_marche_du_film_services',
        );

        return $source;
    }
}
