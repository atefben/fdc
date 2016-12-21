<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\FilmFilm;

class OldFilmFestivalPosterRepository extends EntityRepository
{
    public function getLegacyFilmImage(FilmFilm $movie)
    {
        $qb = $this->createQueryBuilder('p');
        return $qb
            ->innerJoin('BaseCoreBundle:OldFilmPhoto', 'fp', 'WITH', 'fp.idposter = p.idposter')
            ->andWhere('fp.idfilm = :id_film')
            ->andWhere('fp.idfilm = :id_film')
            ->andWhere('fp.type : :type')
            ->andWhere('fp.titre = :titre OR idtypephoto IN (:type_photo)')
            ->setParameter(':id_film', $movie->getId())
            ->setParameter(':type', 'I')
            ->setParameter(':titre', 'Photo du Film')
            ->setParameter(':type_photo', [51, 14])
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}