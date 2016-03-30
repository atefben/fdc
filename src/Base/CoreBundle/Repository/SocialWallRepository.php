<?php

namespace Base\CoreBundle\Repository;

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
            ->orderBy('f.updatedAt','ASC')
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
            ->orderBy('f.updatedAt','ASC')
            ->setParameter('network', constant('Base\\CoreBundle\\Entity\\SocialWall::NETWORK_INSTAGRAM'))
            ->setParameter('festival', $festival)
        ;

        return $query;
    }

    public function getApiSocialWallMobile($festival, $dateTime)
    {

        if ($festival->getFestivalStartsAt() > $dateTime || $festival->getFestivalEndsAt() < $dateTime) {
            $this->addMasterQueries($qb, 'n', $festival, true);
        } else {
            $morning = clone $dateTime;
            $morning->setTime(0, 0, 0);
            $midnight = clone $dateTime;
            $midnight->setTime(23, 59, 59);

            $qb
                ->andWhere('n.festival = :festival')
                ->andWhere('n.publishedAt BETWEEN :morning AND :midnight')
                ->andWhere('n.publishedAt <= :datetime')
                ->andWhere('(n.publishEndedAt IS NULL OR n.publishEndedAt >= :datetime)')
                ->setParameter('datetime', $dateTime)
                ->setParameter('morning', $morning)
                ->setParameter('midnight', $midnight)
            ;
        }

        $query = $this->createQueryBuilder('f')
            ->where('f.festival = :festival')
            ->andWhere('f.enabledMobile = 1')
            ->orderBy('f.updatedAt','ASC')
            ->setParameter('festival', $festival)
        ;

        return $query;
    }

}