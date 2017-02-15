<?php

namespace FDC\CourtMetrageBundle\Manager;


use Doctrine\ORM\EntityManager;
use FDC\CourtMetrageBundle\Entity\CcmNews;

/**
 * Class NewsManager
 * @package FDC\CourtMetrageBundle\Manager
 */
class NewsManager
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * NewsManager constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @param string $locale
     * @return array
     */
    public function getAvailableListFilters($locale = 'fr')
    {
        /**
         * get the themes (id & name) and date for every published news article
         */
        $rawData = $this->em->getRepository(CcmNews::class)->getThemesAndDatesOfPublishedNews($locale);
        /**
         * We group the raw data by years and themes:
         *  - for each theme save the years that it contains
         *  - for each year save the theme that it contains
         */
        $themes = [];
        $years = [];
        foreach ($rawData as $data) {
            /** @var array|\DateTime[] $data */
            $year = intval($data['publishedAt']->format('Y'));
            if (!array_key_exists($data['id'], $themes)) {
                $themes[$data['id']] = [
                    'name'  => $data['name'],
                    'years' => [$year]
                ];
            } elseif (!in_array($year, $themes[$data['id']]['years'])) {
                $themes[$data['id']]['years'][] = $year;
            }
            if (!array_key_exists($year, $years)) {
                $years[$year] = [
                    'themes' => [
                        $data['id'] => $data['name']
                    ]
                ];
            } elseif(!array_key_exists($data['id'], $years[$year]['themes'])) {
                $years[$year]['themes'][$data['id']] = $data['name'];
            }
        }

        return [
            'years'  => $years,
            'themes' => $themes
        ];
    }

    /**
     * @param string $locale
     * @param null $year
     * @param null $themeId
     * @param int $offset
     * @return array
     */
    public function getNewsArticlesForListPage($locale = 'fr', $year = null, $themeId = null, $offset = 0)
    {
        /** @var CcmNews[] $newsArticles */
        $newsArticles = $this->em->getRepository(CcmNews::class)->getNewsArticlesByYearAndTheme($locale, $year, $themeId, $offset);

        return $newsArticles;
    }
}