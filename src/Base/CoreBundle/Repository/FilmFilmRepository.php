<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\FilmFilm;
use Base\CoreBundle\Entity\MediaAudio;
use Base\CoreBundle\Entity\MediaVideo;

/**
 * Class FilmFilmRepository
 * @package Base\CoreBundle\Repository
 */
class FilmFilmRepository extends EntityRepository
{
    public function getApiFilms($festival, $selection)
    {
        $query = $this->createQueryBuilder('f')
            ->where('f.festival = :festival')
            ->setParameter('festival', $festival)
        ;

        if ($selection !== null) {
            $query = $query->andWhere('f.selection = :selection')
                ->setParameter('selection', $selection)
            ;
        }

        return $query;
    }

    /**
     * @param $id
     * @param $festival
     * @return FilmFilm
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getApiFilm($id, $festival)
    {
        return $this->createQueryBuilder('f')
            ->where('f.festival = :festival')
            ->andWhere('f.id = :id')
            ->setParameter('festival', $festival)
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function getApiFilmTrailers($festival, $locale)
    {
        $qb = $this->createQueryBuilder('f')
            ->join('f.associatedMediaVideos', 'fa')
            ->join('fa.mediaVideo', 'mv')
            ->join('mv.translations', 'mvt')
            ->where('mv.displayedTrailer = :displayedTrailer')
            ->setParameter('displayedTrailer', true)
        ;

        $qb = $this->addMasterQueries($qb, 'mv', $festival);
        $qb = $this->addTranslationQueries($qb, 'mvt', $locale);
        $qb = $this->addMobileQueries($qb, 'mv');

        return $qb->getQuery();
    }

    public function getApiTrailers($id, $festival, $locale)
    {
        $qb = $this->createQueryBuilder('f')
            ->join('f.associatedMediaVideos', 'fa')
            ->join('fa.mediaVideo', 'mv')
            ->join('mv.translations', 'mvt')
            ->where('f.id = :id')
            ->andWhere('mv.displayedTrailer = :displayed_trailer')
            ->setParameter('id', $id)
            ->setParameter('displayed_trailer', true)
        ;

        $qb = $this->addMasterQueries($qb, 'mv', $festival);
        $qb = $this->addTranslationQueries($qb, 'mvt', $locale);
        $qb = $this->addMobileQueries($qb, 'mv');


        return $qb->getQuery()->getOneOrNullResult();
    }

    public function getFilmsThatHaveTrailers($festival, $locale, $selectionSection = null)
    {
        $qb = $this->createQueryBuilder('f')
            ->join('f.translations', 't')
            ->join('f.associatedMediaVideos', 'fa')
            ->join('fa.mediaVideo', 'mv')
            ->join('mv.sites', 's')
            ->join('mv.translations', 'mvt')
            ->where('mv.displayedTrailer = :displayed_trailer')
            ->andWhere('t.slug IS NOT NULL')
            ->andWhere("t.slug != ''")
            ->setParameter('displayed_trailer', true)
        ;

        $this->addMasterQueries($qb, 'mv', $festival);
        $this->addTranslationQueries($qb, 'mvt', $locale);
        $this->addFDCEventQueries($qb, 's');
        $qb->orderBy('t.title', 'asc');


        if ($selectionSection) {
            $qb
                ->andWhere('f.selectionSection = :selectionSection')
                ->setParameter('selectionSection', $selectionSection)
            ;
        }

        return $qb->getQuery()->getResult();
    }

    public function getFilmsByIds($ids)
    {
        $qb = $this->createQueryBuilder('f');

        $qb
            ->where('f.id  IN (:ids)')
            ->setParameter(':ids', $ids)
            ->orderBy('f.titleVO', 'asc')
        ;

        return $qb->getQuery()->getResult();

    }

    /**
     * @param $festival
     * @param $locale
     * @param $selectionSection
     * @param integer|null $idBanned
     * @return array
     */
    public function getFilmsBySelectionSection($festival, $locale, $selectionSection, $idBanned = null)
    {
        $qb = $this->createQueryBuilder('f');

        $qb
            ->where('f.selectionSection = :selectionSection')
            ->setParameter('selectionSection', $selectionSection)
        ;

        if ($idBanned !== null) {
            $qb
                ->andWhere('f.id != :idBanned')
                ->setParameter('idBanned', $idBanned)
            ;
        }

        $this->addMasterQueries($qb, 'f', $festival, false);

        $qb->orderBy('f.titleVO', 'asc');

        return $qb->getQuery()->getResult();
    }

    /**
     * @param $locale
     * @param string $site
     * @param null $now
     * @return FilmFilm[]
     */
    public function getFilmsReleases($locale, $site = 'site-evenementiel', $now = null)
    {
        if (!$now) {
            $now = new \DateTime();
        }
        $qb = $this
            ->createQueryBuilder('f')
            ->select('f')
            ->andWhere('MONTH(f.publishedAt) = :month')
            ->setParameter(':month', (int)$now->format('m'))
            ->innerJoin('f.videoMain', 'mv')
            ->andWhere('mv.publishedAt <= :now')
            ->andWhere('mv.publishEndedAt is null or mv.publishEndedAt >= :now')
            ->setParameter(':now', $now)
            ->innerJoin('mv.sites', 's')
            ->innerJoin('mv.translations', 'videotranslations')
            ->andWhere('s.slug = :slugSite')
            ->setParameter(':slugSite', $site)
            ->addOrderBy('f.publishedAt', 'asc')
        ;

        $this->addTranslationQueries($qb, 'videotranslations', $locale);

        $films = $qb->getQuery()->getResult();

        $day = date('w');
        $weekStart = strtotime('-' . $day . ' days');
        $weekEnd = strtotime('+' . (6 - $day) . ' days');
        $start = new \DateTime();
        $start->setTimestamp($weekStart);
        $start->setTime(0, 0, 0);
        $start = $start->getTimestamp();
        $end = new \DateTime();
        $end->setTimestamp($weekEnd);
        $end->setTime(23, 59, 59);
        $end = $end->getTimestamp();

        $previousWeek = strtotime("-1 week +1 day");

        $previousWeekStart = strtotime("last sunday midnight",$previousWeek);
        $previousWeekEnd = strtotime("next saturday",$previousWeekStart);

        $previousStart = new \DateTime();
        $previousStart->setTimestamp($previousWeekStart);
        $previousStart->setTime(0, 0, 0);
        $previousStart = $start->getTimestamp();
        $previousEnd = new \DateTime();
        $previousEnd->setTimestamp($previousWeekEnd);
        $previousEnd->setTime(23, 59, 59);
        $previousEnd = $previousEnd->getTimestamp();

        $currentWeek = [];
        $previous = [];
        $old = [];
        $others = [];

        foreach ($films as $film) {
            if ($film instanceof FilmFilm) {
                $time = $film->getPublishedAt()->getTimestamp();
                if ($time >= $start && $time <= $end) {
                    $currentWeek[] = $film;
                } elseif ($time >= $previousStart && $time <= $previousEnd) {
                    $previous[] = $film;
                }  elseif ($time < $start) {
                    $old[] = $film;
                } else {
                    $others[] = $film;
                }
            }
        }

        return array_merge($currentWeek, $others, $old, $previous);
    }

    /**
     * @param int $festival
     * @param string $category
     * @return array
     */
    public function getFilmsByCategoryWithAward($festival, $category)
    {
        $qb = $this
            ->createQueryBuilder('f')
            ->select('f')
            ->join('f.translations', 't')
            ->join('f.selectionSection', 'ss')
            ->join('f.medias', 'm')
            ->join('f.awards', 'aa')
            ->join('aa.award', 'a')
            ->join('a.prize', 'p')
            ->join('p.translations', 'pt')
            ->andWhere('pt.category = :category')
            ->setParameter('category', $category)
            ->addOrderBy('ss.position', 'asc')
            ->addOrderBy('p.position', 'asc')
        ;

        $this->addMasterQueries($qb, 'f', $festival, false);

        return $qb->getQuery()->getResult();
    }

    /**
     * @param integer $festival
     * @param array $exclude
     * @return array
     */
    public function getCamerDOrFilms($festival, array $selectionsSections, array $exclude)
    {
        $qb = $this
            ->createQueryBuilder('f')
            ->select('f')
            ->join('f.translations', 't')
            ->join('f.selectionSection', 'ss')
            ->join('f.medias', 'm')
            ->join('f.awards', 'aa')
            ->join('aa.award', 'a')
            ->join('a.prize', 'p')
            ->join('p.translations', 'pt')
            ->andWhere('f.directorFirst = :true')
            ->setParameter('true', true)
            ->andWhere('f.selectionSection IN (:selectionsSections)')
            ->setParameter('selectionsSections', $selectionsSections)
            ->andWhere('f.id NOT IN (:exclude)')
            ->setParameter('exclude', $exclude)
            ->addOrderBy('ss.position', 'asc')
            ->addOrderBy('p.position', 'asc')
        ;

        $this->addMasterQueries($qb, 'f', $festival, false);

        return $qb->getQuery()->getResult();
    }

    public function getPalmaresCameraDOr($festival, $selectionSectionIds = [], $exclude = [])
    {
        $qb = $this
            ->createQueryBuilder('f')
            ->select('f')
            ->join('f.translations', 't')
            ->join('f.selectionSection', 'ss')
            ->join('f.medias', 'm')
            ->andWhere('f.directorFirst = :true')
            ->setParameter('true', true)
            ->andWhere('f.selectionSection IN (:selectionsSections)')
            ->setParameter('selectionsSections', $selectionSectionIds)
            ->addOrderBy('ss.position', 'asc')
            ->addOrderBy('f.titleVO', 'asc')
        ;
        if ($exclude) {
            $qb
                ->andWhere('f.id NOT IN (:exclude)')
                ->setParameter('exclude', $exclude)
            ;
        }
        $this->addMasterQueries($qb, 'f', $festival, false);
        return $qb->getQuery()->getResult();
    }

    /**
     * Get Films by courtYear and order randomly.
     *
     * @param $year
     * @return array
     */
    public function getFilmsByFestivalAndSelectionRandom($festival, $selection)
    {
        $qb = $this
            ->createQueryBuilder('f')
            ->select('f, RAND() as HIDDEN r')
            ->where('f.festival = :festival')
            ->andWhere('f.selectionSection = :selectionSection')
            ->setParameter(':festival', $festival)
            ->setParameter(':selectionSection', $selection)
            ->orderBy('r')
        ;

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @param MediaVideo $mediaVideo
     * @return FilmFilm[]
     */
    public function getFilmsByMediaVideo(MediaVideo $mediaVideo)
    {
        return $this
            ->createQueryBuilder('f')
            ->innerJoin('f.associatedMediaVideos', 'amv')
            ->innerJoin('amv.mediaVideo', 'mv')
            ->andWhere('mv.id = :id')
            ->setParameter(':id', $mediaVideo->getId())
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @param MediaAudio $mediaAudio
     * @return FilmFilm[]
     */
    public function getFilmsByMediaAudio(MediaAudio $mediaAudio)
    {
        return $this
            ->createQueryBuilder('f')
            ->innerJoin('f.associatedMediaAudios', 'ama')
            ->innerJoin('ama.mediaAudio', 'ma')
            ->andWhere('ma.id = :id')
            ->setParameter(':id', $mediaAudio->getId())
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @param MediaVideo $mediaVideo
     * @return FilmFilm[]
     */
    public function getFilmsByMainVideo(MediaVideo $mediaVideo)
    {
        return $this
            ->createQueryBuilder('f')
            ->innerJoin('f.videoMain', 'mv')
            ->andWhere('mv.id = :id')
            ->setParameter(':id', $mediaVideo->getId())
            ->getQuery()
            ->getResult()
            ;
    }

}
