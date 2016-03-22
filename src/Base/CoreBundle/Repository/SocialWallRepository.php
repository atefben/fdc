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
            ->orderBy('f.date','ASC')
            ->setMaxResults(40)
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
            ->orderBy('f.date','ASC')
            ->setMaxResults(40)
            ->setParameter('network', constant('Base\\CoreBundle\\Entity\\SocialWall::NETWORK_INSTAGRAM'))
            ->setParameter('festival', $festival)
        ;

        return $query;
    }

    public function getApiSocialWallMobile($festival)
    {
        $query = $this->createQueryBuilder('f')
            ->where('f.festival = :festival')
            ->andWhere('f.enabledMobile = 1')
            ->orderBy('f.date','ASC')
            ->setMaxResults(40)
            ->setParameter('festival', $festival)
        ;

        return $query;
    }

}