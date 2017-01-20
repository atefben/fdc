<?php

namespace FDC\MarcheDuFilmBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\MarcheDuFilmBundle\Entity\MdfConferenceNewsPageTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfConferencePartnerTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgramTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfSpeakersTranslation;
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

        return array(
            'programIsActive' => $programIsActive,
            'speakersIsActive' => $speakersIsActive,
            'newsIsActive' => $newsIsActive,
            'partnersIsActive' => $partnersIsActive,
            'slug' => $slug
        );
    }
}
