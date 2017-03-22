<?php

namespace FDC\CourtMetrageBundle\Manager;


use Doctrine\ORM\EntityManager;
use FDC\CourtMetrageBundle\Entity\CcmMediaAudioTranslation;
use FDC\CourtMetrageBundle\Entity\CcmMediaVideoTranslation;
use FDC\CourtMetrageBundle\Entity\CcmTheme;
use FDC\CourtMetrageBundle\Entity\CcmThemeTranslation;
use FDC\CourtMetrageBundle\Entity\CcmNews;
use FDC\CourtMetrageBundle\Entity\CcmNewsArticleTranslation;
use FDC\CourtMetrageBundle\Entity\CcmNewsNewsAssociated;

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
         * get the themes (id) and date for every published news article
         */
        $rawData = $this->em->getRepository(CcmNews::class)->getThemesAndDatesOfPublishedNews($locale);
        /**
         * we get the names for all the themes,
         * falling back to fr if they don't have a translation for the current locale
         */
        $themeNames = $this->getThemeNamesByIdsAndLocale(array_unique(array_map(function($item){
            return $item['id'];
        }, $rawData)), $locale);
        /**
         * We group the raw data by years and themes:
         *  - for each theme save the years that it contains
         *  - for each year save the theme that it contains
         */
        $themes = [];
        $years = [];
        foreach ($rawData as $data) {
            $themeName = isset($themeNames[$data['id']]) ? $themeNames[$data['id']] : '';
            /** @var array|\DateTime[] $data */
            $year = intval($data['publishedAt']->format('Y'));
            if (!array_key_exists($data['id'], $themes)) {
                $themes[$data['id']] = [
                    'name'  => $themeName,
                    'years' => [$year]
                ];
            } elseif (!in_array($year, $themes[$data['id']]['years'])) {
                $themes[$data['id']]['years'][] = $year;
            }
            if (!array_key_exists($year, $years)) {
                $years[$year] = [
                    'themes' => [
                        $data['id'] => $themeName
                    ]
                ];
            } elseif(!array_key_exists($data['id'], $years[$year]['themes'])) {
                $years[$year]['themes'][$data['id']] = $themeName;
            }
        }

        return [
            'years'  => $years,
            'themes' => $themes
        ];
    }

    /**
     * @param $themeIds
     * @param string $locale
     * @return array
     */
    private function getThemeNamesByIdsAndLocale($themeIds, $locale = 'fr')
    {
        /**
         * todo: move in ccm theme repository if Theme entity will be duplicated
         */
        $qb = $this->em->getRepository(CcmTheme::class)
            ->createQueryBuilder('t')
            ->select('t.id')
            ->leftJoin('t.translations', 'tt', 'with', 'tt.locale = :locale and tt.status = :status')
            ->setParameter('locale', $locale)
            ->andWhere('t.id in (:themeIds)')
            ->setParameter('themeIds', $themeIds)
        ;
        if ($locale == 'fr') {
            $qb
                ->addSelect('tt.name')
                ->setParameter('status', CcmThemeTranslation::STATUS_PUBLISHED)
            ;
        } else {
            $qb
                ->setParameter('status', CcmThemeTranslation::STATUS_TRANSLATED)
                ->leftJoin('t.translations', 'frtt', 'with', 'frtt.locale = :fr_locale and frtt.status = :fr_status')
                ->setParameter('fr_status', CcmThemeTranslation::STATUS_PUBLISHED)
                ->setParameter('fr_locale', 'fr')
                ->addSelect(
                    'case when tt.id is not null then tt.name else frtt.name end as name'
                )
            ;
        }
        $themeNames = $qb->getQuery()->getResult();

        $byIds = [];
        foreach ($themeNames as $themeName) {
            $byIds[$themeName['id']] = $themeName['name'];
        }

        return $byIds;
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

    /**
     * @param $slug
     * @param string $locale
     * @param bool $isAdmin
     * @return CcmNews|null
     */
    public function getNewsArticleBySlugAndLocale($slug, $locale = 'fr', $isAdmin = false)
    {
        $newsArticle = $this->em->getRepository(CcmNews::class)->getNewsArticleBySlugAndLocale($slug, $locale, $isAdmin);

        return $newsArticle;
    }

    /**
     * @param CcmNews $news
     * @param string $locale
     * @return array
     */
    public function getNewsFocusArticles(CcmNews $news, $locale = 'fr')
    {
        $associatedNews = $news->getAssociatedNews();
        $focusArticles = [];
        /** @var CcmNewsNewsAssociated $newsAssociation */
        foreach ($associatedNews as $newsAssociation) {
            if ($newsAssociation->getAssociation() != null) {
                $associatedArticle = $newsAssociation->getAssociation();
                /** @var CcmNewsArticleTranslation $translation */
                $translation = $associatedArticle->findTranslationByLocale($locale);
                if (
                    $translation != null &&
                    $translation->getStatus() == CcmNewsArticleTranslation::STATUS_PUBLISHED &&
                    $associatedArticle->getPublishedAt() < new \DateTime()
                ) {
                    $focusArticles[] = $newsAssociation->getAssociation();
                }
            }
        }
        
        return $focusArticles;
    }

    /**
     * @param $array
     * @param $locale
     * @param null $count
     * @param bool $hideDisplayedHome
     * @return array
     */
    public function removeUnpublishedNewsAudioVideo($array, $locale, $count = null, $hideDisplayedHome = false)
    {
        $newsTypes = ['NewsAudio', 'NewsVideo', 'InfoAudio', 'StatementAudio', 'InfoVideo', 'StatementVideo'];

        $mediaTypes = [
            'NewsAudio'      => 'getAudio',
            'NewsVideo'      => 'getVideo',
            'InfoAudio'      => 'getAudio',
            'StatementAudio' => 'getAudio',
            'InfoVideo'      => 'getVideo',
            'StatementVideo' => 'getVideo',
        ];

        foreach ($newsTypes as $newsType) {
            foreach ($array as $key => $news) {
                if (strpos(get_class($news), $newsType) !== false) {
                    if ($news->{$mediaTypes[$newsType]}() == null) {
                        unset($array[$key]);
                    } elseif ($hideDisplayedHome && $news->{$mediaTypes[$newsType]}()->getDisplayedHome()) {
                        unset($array[$key]);
                    } else {
                        $trans = $news->{$mediaTypes[$newsType]}()->findTranslationByLocale($locale);
                        $transFr = $news->{$mediaTypes[$newsType]}()->findTranslationByLocale('fr');
                        if ($this->checkMediaAudioVideoPublished($trans, $transFr) === false) {
                            if ($this->checkMediaAudioVideoPublished($transFr, $transFr) === false) {
                                unset($array[$key]);
                            }
                        }
                    }
                }
            }
        }

        $array = array_values($array);

        if ($count !== null) {
            $array = array_slice($array, 0, $count);
        }

        return $array;
    }

    /**
     * @param CCmMediaVideoTranslation|CcmMediaAudioTranslation|null $trans
     * @param CcmMediaVideoTranslation|CcmMediaAudioTranslation $transFr
     * @return bool
     */
    private function checkMediaAudioVideoPublished($trans, $transFr)
    {
        if ($trans === null || $transFr->getStatus() !== CcmMediaAudioTranslation::STATUS_PUBLISHED) {
            return false;
        }

        if (strpos(get_class($trans), 'CcmMediaAudioTranslation')) {
            if ($trans->getJobMp3State() != CcmMediaAudioTranslation::ENCODING_STATE_READY ||
                $trans->getMp3Url() === null
            ) {
                return false;
            }
        }

        if (strpos(get_class($trans), 'CcmMediaVideoTranslation')) {
            if ($trans->getJobMp4State() != CcmMediaVideoTranslation::ENCODING_STATE_READY ||
                $trans->getMp4Url() === null || $trans->getWebmUrl() === null
            ) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param \DateTime $date
     * @param $direction
     * @param string $locale
     * @return array
     */
    public function getPrevOrNextNews($date, $direction, $locale = 'fr')
    {
        $newsArticle = $this->em->getRepository(CcmNews::class)->getPrevOrNextNews($date, $direction, $locale);
        $newsArticle = $this->removeUnpublishedNewsAudioVideo($newsArticle, 'fr');
        
        return $newsArticle;
    }
}