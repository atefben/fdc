<?php

namespace FDC\CourtMetrageBundle\Manager;


use Doctrine\ORM\EntityManager;
use FDC\CourtMetrageBundle\Entity\CcmShortFilmCorner;
use FDC\CourtMetrageBundle\Entity\CcmShortFilmCornerTranslation;
use FDC\CourtMetrageBundle\Entity\HomepageSejour;

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
        $positions = [];

        $sejourIsActive = $shortFilmCornerPage->getSejourIsActive();
        $socialIsActive = $shortFilmCornerPage->getSocialIsActive();

        $positions[$shortFilmCornerPage->getPositionCatalog()] = 'catalog';
        $positions[$shortFilmCornerPage->getPositionActualites()] = 'actualite';
        $positions[$shortFilmCornerPage->getPositionSejour()] = 'sejour';
        $positions[$shortFilmCornerPage->getPositionSocial()] = 'social';

        ksort($positions);

        $sejourTranslation = null;
        if ($shortFilmCornerPage->getSejourIsActive()) {
            /** @var HomepageSejour $sejour */
            $sejour = $shortFilmCornerPage->getSejoures()->first();
            if ($sejour instanceof HomepageSejour) {
                $sejourTranslation = $sejour->findTranslationByLocale($locale);
                if ($sejourTranslation == null && $locale != 'fr') { // fallback to default locale
                    $sejourTranslation = $sejour->findTranslationByLocale('fr');
                }
            }
        }
        
        $pageData = [
            'slug'        => $translation->getSlug(),
            'type'        => $type,
            'title'       => $translation->getTitle(),
            'image'       => $shortFilmCornerPage->getImage(),
            'description' => $translation->getHeader(),
            'widgets'     => $shortFilmCornerPage->getWidgets(),
            'positions'   => $positions,
            'sejour'      => $sejourTranslation,
            'sejourIsActive' => $sejourIsActive,
            'socialIsActive' => $socialIsActive,
        ];
        $pageData['sfcPages'] = $this->getTitleAndSlugsForSFCPages($type, $locale);

        return $pageData;
    }

    /**
     * @param $type
     * @param string $locale
     * @return CcmShortFilmCorner|null
     */
    public function getFirstSFCPageSlug($type, $locale = 'fr')
    {
        /** @var CcmShortFilmCorner[]|null $results */
        $results = $this->em->getRepository(CcmShortFilmCorner::class)->getSFCPagesByType($type, $locale, 1);
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
     * @param $type
     * @param string $locale
     * @return array
     */
    public function getTitleAndSlugsForSFCPages($type, $locale = 'fr')
    {
        $pages = [];
        /** @var CcmShortFilmCorner[]|null $results */
        $results = $this->em->getRepository(CcmShortFilmCorner::class)->getSFCPagesByType($type, $locale);

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