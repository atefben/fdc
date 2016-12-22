<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\FilmFilm;
use Base\CoreBundle\Entity\FilmFilmMedia;
use Base\CoreBundle\Entity\FilmPerson;
use Base\CoreBundle\Entity\OldFilmPhoto;

class OldFilmPhotoRepository extends EntityRepository
{
    /**
     * @param \Base\CoreBundle\Entity\FilmFilm $movie
     * @return OldFilmPhoto
     */
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

    /**
     * @param FilmFilm $movie
     * @return OldFilmPhoto[]
     */
    public function getLegacyFilmImages(FilmFilm $movie = null)
    {
        $qb = $this->createQueryBuilder('fp');
        $qb
            ->andWhere('fp.type = :type')
            ->andWhere('fp.titre = :titre OR fp.idtypephoto IN (:type_photo)')
            ->setParameter(':type', 'I')
            ->setParameter(':titre', 'Photo du Film')
            ->setParameter(':type_photo', [51, 14])
            ->addOrderBy('fp.idtypephoto', 'desc')
            ->addOrderBy('fp.idphoto', 'desc')
        ;

        if ($movie) {
            $qb
                ->andWhere('fp.idfilm = :id_film')
                ->setParameter(':id_film', $movie->getId())
            ;
        }
        else {
            $qb->andWhere('fp.idfilm is not null');
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * @param \Base\CoreBundle\Entity\FilmPerson|null $filmPerson
     * @return OldFilmPhoto[]
     */
    public function getLegacyPersonImages(FilmPerson $filmPerson = null)
    {
        $types = [
            FilmFilmMedia::TYPE_JURY,
            FilmFilmMedia::TYPE_DIRECTOR,
            FilmFilmMedia::TYPE_PERSON,
        ];

        $qb = $this->createQueryBuilder('fp');

        $qb
            ->andWhere('fp.idtypephoto in (:types)')
            ->setParameter(':types', $types)
        ;

        if ($filmPerson) {
            $qb
                ->andWhere('fp.idpersonne = :idperson')
                ->setParameter(':idperson', $filmPerson->getId())
            ;
        } else {
            $qb->andWhere('fp.idpersonne IS NOT NULL');
        }

        return $qb
            ->getQuery()
            ->getResult()
        ;
    }
}