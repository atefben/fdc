<?php

namespace FDC\MarcheDuFilmBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\MarcheDuFilmBundle\Entity\MdfConferenceNewsPageTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfConferencePartnerTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgramTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfSpeakersTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfConferenceInfoAndContactTranslation;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class ConferencePagesManager
 *
 * @package FDC\MarcheDuFilmBundle\Manager
 */
class ConferencePagesManager
{
    protected $em;

    protected $requestStack;

    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;
    }

    public function getPagesStatus($slug)
    {
        $programIsActive = false;
        $speakersIsActive = false;
        $newsIsActive = false;
        $partnersIsActive = false;
        $infoAndContactIsActive = false;

        $programPage = $this->em
            ->getRepository(MdfConferenceProgramTranslation::class)
            ->getConferenceProgramPageByLocaleAndSlug($this->requestStack->getMasterRequest()->get('_locale'), $slug);

        $speakersPage = $this->em
            ->getRepository(MdfSpeakersTranslation::class)
            ->getSpeakersPageByLocaleAndSlug($this->requestStack->getMasterRequest()->get('_locale'), $slug);


        $newsPage = $this->em
            ->getRepository(MdfConferenceNewsPageTranslation::class)
            ->getConferenceNewsPageByLocaleAndSlug($this->requestStack->getMasterRequest()->get('_locale'), $slug);

        $partnersPage = $this->em
            ->getRepository(MdfConferencePartnerTranslation::class)
            ->getConferencePartnerPageByLocaleAndSlug($this->requestStack->getMasterRequest()->get('_locale'), $slug);

        $infoAndContactPage = $this->em
            ->getRepository(MdfConferenceInfoAndContactTranslation::class)
            ->getConferenceInfoAndContactPageByLocaleAndSlug($this->requestStack->getMasterRequest()->get('_locale'), $slug);

        if($programPage) {
            $programIsActive = $programPage->getTranslatable()->isIsActive();
        }

        if($speakersPage) {
            $speakersIsActive = $speakersPage->getTranslatable()->isIsActive();
        }

        if($newsPage) {
            $newsIsActive = $newsPage->getTranslatable()->isIsActive();
        }

        if($partnersPage) {
            $partnersIsActive = $partnersPage->getTranslatable()->isIsActive();
        }

        if($infoAndContactPage) {
            $infoAndContactIsActive = $infoAndContactPage->getTranslatable()->isIsActive();
        }

        return array(
            'programIsActive' => $programIsActive,
            'speakersIsActive' => $speakersIsActive,
            'newsIsActive' => $newsIsActive,
            'partnersIsActive' => $partnersIsActive,
            'infoAndContactIsActive' => $infoAndContactIsActive,
            'slug' => $slug
        );
    }

    public function getHomeNextUrl($pagesStatus)
    {
        $nextRouteName = null;
        $nextRouteLabel = null;

        foreach($pagesStatus as $key => $value)
        {
            if($value)
            {
                switch($key) {
                    case 'programIsActive':
                        $nextRouteName = 'fdc_marche_du_film_conference_program';
                        $nextRouteLabel = 'conférences';
                        break;
                    case 'speakersIsActive':
                        $nextRouteName = 'fdc_marche_du_film_conference_speakers';
                        $nextRouteLabel = 'intervenants';
                        break;
                    case 'newsIsActive':
                        $nextRouteName = 'fdc_marche_du_film_conference_news';
                        $nextRouteLabel = 'news';
                        break;
                    case 'partnersIsActive':
                        $nextRouteName = 'fdc_marche_du_film_conference_partners';
                        $nextRouteLabel = 'partenaires';
                        break;
                }
                break;
            }
        }

        return array(
            'nextRouteName' => $nextRouteName,
            'nextRouteLabel' => $nextRouteLabel
        );
    }

    public function getNextAndBackUrl($pagesStatus, $currentPage)
    {
        $nextRouteName = null;
        $nextRouteLabel = null;
        $backRouteName = null;
        $backRouteLabel = null;

        $found = false;
        foreach($pagesStatus as $key => $value)
        {
            if($value && $found)
            {
                switch($key) {
                    case 'programIsActive':
                        $nextRouteName = 'fdc_marche_du_film_conference_program';
                        $nextRouteLabel = 'conférences';
                        break;
                    case 'speakersIsActive':
                        $nextRouteName = 'fdc_marche_du_film_conference_speakers';
                        $nextRouteLabel = 'intervenants';
                        break;
                    case 'newsIsActive':
                        $nextRouteName = 'fdc_marche_du_film_conference_news';
                        $nextRouteLabel = 'news';
                        break;
                    case 'partnersIsActive':
                        $nextRouteName = 'fdc_marche_du_film_conference_partners';
                        $nextRouteLabel = 'partenaires';
                        break;
                    case 'infoAndContactIsActive':
                        $nextRouteName = 'fdc_marche_du_film_conference_infos_and_contacts';
                        $nextRouteLabel = 'infos et contacts';
                        break;
                }
                break;
            }

            if($key == $currentPage)
            {
                $found = true;
            }
        }

        if($currentPage == 'programIsActive')
        {
            $backRouteName = 'fdc_marche_du_film_conference_home';
            $backRouteLabel = 'accueil';
        } else {

            $pagesStatusReversed = $this->reverseArray($pagesStatus);

            $found = false;
            foreach ($pagesStatusReversed as $key => $value) {
                if ($value && $found) {
                    switch ($key) {
                        case 'programIsActive':
                            $backRouteName = 'fdc_marche_du_film_conference_program';
                            $backRouteLabel = 'conférences';
                            break;
                        case 'speakersIsActive':
                            $backRouteName = 'fdc_marche_du_film_conference_speakers';
                            $backRouteLabel = 'intervenants';
                            break;
                        case 'newsIsActive':
                            $backRouteName = 'fdc_marche_du_film_conference_news';
                            $backRouteLabel = 'news';
                            break;
                        case 'partnersIsActive':
                            $backRouteName = 'fdc_marche_du_film_conference_partners';
                            $backRouteLabel = 'partenaires';
                            break;
                        case 'infoAndContactIsActive':
                            $backRouteName = 'fdc_marche_du_film_conference_infos_and_contacts';
                            $backRouteLabel = 'infos-et-contacts';
                            break;
                    }
                    break;
                }

                if ($key == $currentPage) {
                    $found = true;
                }
            }
        }

        return array(
            'nextRouteName' => $nextRouteName,
            'nextRouteLabel' => $nextRouteLabel,
            'backRouteName' => $backRouteName,
            'backRouteLabel' => $backRouteLabel
        );
    }

    public function reverseArray($pagesStatus)
    {
        $keys = array_keys($pagesStatus);
        $reversedKeys = array_reverse($keys);

        $reversedArray = [];

        foreach ($reversedKeys as $key)
        {
            $reversedArray[$key] = $pagesStatus[$key];
        }

        return $reversedArray;
    }
}
