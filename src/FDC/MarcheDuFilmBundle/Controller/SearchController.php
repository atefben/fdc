<?php

namespace FDC\MarcheDuFilmBundle\Controller;

use FDC\MarcheDuFilmBundle\Entity\GalleryMdf;
use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate;
use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplateWidgetVideo;
use FDC\MarcheDuFilmBundle\Entity\MediaMdfImage;
use FDC\MarcheDuFilmBundle\Entity\MediaMdfPdf;
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
            $items['contentResults'] = $repositoryManager
                ->getRepository(MdfContentTemplate::class)
                ->findWithCustomQuery($locale, $searchTerm);

            // documentResults
            $items['documentResults'] = $repositoryManager
                ->getRepository(MediaMdfPdf::class)
                ->findWithCustomQuery($locale, $searchTerm);

            // mediaResults
            $imageResults = $repositoryManager
                ->getRepository(MediaMdfImage::class)
                ->findWithCustomQuery($locale, $searchTerm);
            $videoResults = $repositoryManager
                ->getRepository(MdfContentTemplateWidgetVideo::class)
                ->findWithCustomQuery($locale, $searchTerm);

            $galleryResults = $repositoryManager
                ->getRepository(GalleryMdf::class)
                ->findWithCustomQuery($locale, $searchTerm);
            $items['mediaResults'] = $this->mergeMedia($imageResults, $videoResults, $galleryResults, $locale);
        }

        return $this->render('FDCMarcheDuFilmBundle::search/index.html.twig', array(
            'searchTerm' => $searchTerm,
            'items' => $items,
        ));
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
