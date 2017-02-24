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
     * @param null $slug
     * @return array|CcmShortFilmCorner|null
     */
    public function getPageData($type, $locale = 'fr', $slug = null)
    {
        /** @var CcmShortFilmCorner|null $shortFilmCornerPage */
        $shortFilmCornerPage = $this->em->getRepository(CcmShortFilmCorner::class)->findPageByTypeLocaleAndSlug($type, $locale, $slug);

        if ($shortFilmCornerPage == null) return $shortFilmCornerPage;

        /** @var CcmShortFilmCornerTranslation $translation */
        $translation = $shortFilmCornerPage->findTranslationByLocale($locale);
        $pageData = [
            'slug'        => $translation->getSlug(),
            'type'        => $type,
            'title'       => $translation->getTitle(),
            'image'       => $shortFilmCornerPage->getImage(),
            'description' => $translation->getHeader(),
            'widgets'     => $shortFilmCornerPage->getWidgets()
        ];
        
        if ($type == CcmShortFilmCorner::TYPE_WHO_ARE_WE) {
            $pageData['whoAreWePages'] = $this->getTitleAndSlugsForWhoAreWePages($locale);
        }

        return $pageData;
    }

    /**
     * @param string $locale
     * @return CcmShortFilmCorner|null
     */
    public function getFirstWhoAreWePageSlug($locale = 'fr')
    {
        /** @var CcmShortFilmCorner[]|null $results */
        $results = $this->em->getRepository(CcmShortFilmCorner::class)->getWhoAreWePages($locale, 1);
        if (!empty($results)) {
            /** @var CcmShortFilmCornerTranslation $translation */
            $translation = $results[0]->findTranslationByLocale($locale);
            $slug = $translation->getSlug();
        } else {
            $slug = null;
        }

        return $slug;
    }

    /**
     * @param $locale
     * @return array
     */
    public function getTitleAndSlugsForWhoAreWePages($locale = 'fr')
    {
        $pages = [];
        /** @var CcmShortFilmCorner[]|null $results */
        $results = $this->em->getRepository(CcmShortFilmCorner::class)->getWhoAreWePages($locale);

        foreach ($results as $result) {
            /** @var CcmShortFilmCornerTranslation $translation */
            $translation = $result->findTranslationByLocale($locale);
            $pages[] = [
                'slug'  => $translation->getSlug(),
                'title' => $translation->getTitle()
            ];
        }

        return $pages;
    }
}