<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\FilmFilm;

class OldFilmPhotoRepository extends EntityRepository
{
    public function getLegacyFilmImage(FilmFilm $movie)
    {
        $qb = $this->createQueryBuilder('fp');
        $output = $qb
            ->andWhere('fp.idfilm = :id_film')
            ->andWhere('fp.idfilm = :id_film')
            ->andWhere('fp.type = :type')
            ->andWhere('fp.titre = :titre OR fp.idtypephoto IN (:type_photo)')
            ->setParameter(':id_film', $movie->getId())
            ->setParameter(':type', 'I')
            ->setParameter(':titre', 'Photo du Film')
            ->setParameter(':type_photo', [51, 14])
            ->addOrderBy('fp.idtypephoto', 'desc')
            ->addOrderBy('fp.idphoto', 'desc')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
        return $output;
    }
}