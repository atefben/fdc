<?php

namespace FDC\CourtMetrageBundle\Manager;


use Doctrine\ORM\EntityManager;
use FDC\CourtMetrageBundle\Entity\CcmShortFilmCorner;
use FDC\CourtMetrageBundle\Entity\CcmShortFilmCornerTranslation;

/**
 * Class ShortFilmCornerManager
 * @package FDC\CourtMetrageBundle\Manager
 */
class ShortFilmCornerManager
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * ShortFilmCornerManager constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @param $type
     * @param string $locale
     * @return array|CcmShortFilmCorner|null
     */
    public function getPageData($type, $locale = 'fr')
    {
        /** @var CcmShortFilmCorner|null $shortFilmCornerPage */
        $shortFilmCornerPage = $this->em->getRepository(CcmShortFilmCorner::class)->findPageByTypeAndLocale($type, $locale);

        if ($shortFilmCornerPage == null) return $shortFilmCornerPage;

        /** @var CcmShortFilmCornerTranslation $translation */
        $translation = $shortFilmCornerPage->findTranslationByLocale($locale);

        return [
            'title'       => $translation->getTitle(),
            'image'       => $shortFilmCornerPage->getImage(),
            'description' => $translation->getHeader(),
            'widgets'     => $shortFilmCornerPage->getWidgets()
        ];
    }
}