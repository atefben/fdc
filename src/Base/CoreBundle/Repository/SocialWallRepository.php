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
    public function getIdsByNetwork($network)
    {
        $results = $this->createQueryBuilder('f')
            ->select('f.id')
            ->where('f.network = :network')
            ->setParameter('network', $network)
            ->orderBy('f.createdAt', 'DESC')
            ->getQuery()
            ->getScalarResult();
        ;
        $results = array_map('current', $results);

        return $results;
    }

    public function getApiSocialWallTwitter($festival)
    {
        $query = $this->createQueryBuilder('f')
            ->where('f.festival = :festival')
            ->andWhere('f.enabledDesktop = 1')
            ->andWhere('f.network = :network')
            ->orderBy('f.updatedAt', 'DESC')
            ->setParameter('network', constant('Base\\CoreBundle\\Entity\\SocialWall::NETWORK_TWITTER'))
            ->setParameter('festival', $festival)
        ;

        return $query;
    }

    public function countTweets($festival,$date) {
        $query = $this->createQueryBuilder('f')
            ->select('COUNT(f.id)')
            ->where('f.festival = :festival')
            ->andWhere('f.date = :date')
            ->andWhere('f.network = :network')
            ->setParameter('network', constant('Base\\CoreBundle\\Entity\\SocialWall::NETWORK_TWITTER'))
            ->setParameter('festival', $festival)
            ->setParameter('date', $date)
        ;

        return $query->getQuery()->getResult();;
    }

    public function getApiSocialWallInstagram($festival)
    {
        $query = $this->createQueryBuilder('f')
            ->where('f.festival = :festival')
            ->andWhere('f.enabledDesktop = 1')
            ->andWhere('f.network = :network')
            ->orderBy('f.updatedAt', 'DESC')
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
            ->orderBy('s.updatedAt', 'DESC')
            ->setParameter('festival', $festival)
            ->setParameter('enabledMobile', $mobile)
        ;

        if ($festival->getFestivalStartsAt() >= $dateTime) {
            $qb
                ->andWhere(':festivalStartAt > s.date')
                ->setParameter('festivalStartAt', $festival->getFestivalStartsAt()->format('Y-m-d'))
            ;
        } else if ($festival->getFestivalEndsAt() <= $dateTime) {
            $qb
                ->andWhere(':festivalEndAt < s.date')
                ->setParameter('festivalEndAt', $festival->getFestivalEndsAt()->format('Y-m-d'))
            ;
        } else {
            $morning = clone $dateTime;
            $morning->setTime(0, 0, 0);
            $midnight = clone $dateTime;
            $midnight->setTime(23, 59, 59);
            $qb
                ->andWhere('s.date BETWEEN :morning AND :midnight')
                ->setParameter('morning', $morning->format('Y-m-d'))
                ->setParameter('midnight', $midnight->format('Y-m-d'))
            ;
        }
        $qb
            ->setMaxResults($maxResults)
            ->setFirstResult(($page - 1) * $maxResults)
        ;

        return $qb;
    }

}