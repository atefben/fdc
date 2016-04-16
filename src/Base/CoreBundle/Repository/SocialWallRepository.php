<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Entity\FilmFestival;
use Base\CoreBundle\Entity\FilmFilm;
use Base\CoreBundle\Entity\FilmFilmMediaInterface;
use Base\CoreBundle\Entity\NewsArticleTranslation;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * SocialWallRepository class.
 *
 * \@extends EntityRepository
 * @author   Antoine Mineau
 * \@company Ohwee
 */
class SocialWallRepository extends EntityRepository
{
    public function getApiSocialWallTwitter($festival)
    {
        $query = $this->createQueryBuilder('f')
            ->where('f.festival = :festival')
            ->andWhere('f.enabledDesktop = 1')
            ->andWhere('f.network = :network')
            ->orderBy('f.updatedAt', 'ASC')
            ->setParameter('network', constant('Base\\CoreBundle\\Entity\\SocialWall::NETWORK_TWITTER'))
            ->setParameter('festival', $festival)
        ;

        return $query;
    }

    public function getApiSocialWallInstagram($festival)
    {
        $query = $this->createQueryBuilder('f')
            ->where('f.festival = :festival')
            ->andWhere('f.enabledDesktop = 1')
            ->andWhere('f.network = :network')
            ->orderBy('f.updatedAt', 'ASC')
            ->setParameter('network', constant('Base\\CoreBundle\\Entity\\SocialWall::NETWORK_INSTAGRAM'))
            ->setParameter('festival', $festival)
        ;

        return $query;
    }

    /**
     * @param FilmFestival $festival
     * @param \DateTime $dateTime
     * @param bool $mobile
     * @param $maxResults
     * @param $page
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getApiSocialWall(FilmFestival $festival, \DateTime $dateTime, $mobile = true, $maxResults, $page)
    {

        $qb = $this->createQueryBuilder('s')
            ->where('s.festival = :festival')
            ->andWhere('s.enabledMobile = :enabledMobile')
            ->orderBy('s.updatedAt', 'ASC')
            ->setParameter('festival', $festival)
            ->setParameter('enabledMobile', $mobile)
            ->setMaxResults($maxResults)
            ->setFirstResult(($page - 1) * $maxResults)
        ;

        if ($festival->getFestivalStartsAt() > $dateTime || $festival->getFestivalEndsAt() < $dateTime) {
            $this->addMasterQueries($qb, 's', $festival, false);
        } else {
            $morning = clone $dateTime;
            $morning->setTime(0, 0, 0);
            $midnight = clone $dateTime;
            $midnight->setTime(23, 59, 59);
            $now = new \DateTime();

            $qb
                ->andWhere('s.publishedAt BETWEEN :morning AND :midnight')
                ->andWhere('s.publishedAt <= :now')
                ->andWhere('(s.publishEndedAt IS NULL OR s.publishEndedAt >= :now)')
                ->setParameter('now', $now)
                ->setParameter('morning', $morning)
                ->setParameter('midnight', $midnight)
            ;
        }

        return $qb;
    }

}