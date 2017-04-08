<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\FilmFilm;
use Base\CoreBundle\Entity\FilmJury;
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
            ->setParameter(':id_film', $movie->getId())
            ->setParameter(':type', 'I')
            ->andWhere('fp.internet = :internet')
            ->setParameter(':internet', 'O')
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
     * @param int|null $firstResult
     * @param int|null $maxResults
     * @param FilmFilm $movie
     * @return OldFilmPhoto[]
     */
    public function getLegacyFilmImages(FilmFilm $movie = null, $firstResult = null, $maxResults = null)
    {
        $qb = $this->createQueryBuilder('fp');
        $qb
            ->andWhere('fp.type = :type')
            ->setParameter(':type', 'I')
            ->andWhere('fp.internet = :internet')
            ->setParameter(':internet', 'O')
            ->addOrderBy('fp.idtypephoto', 'desc')
            ->addOrderBy('fp.idphoto', 'desc')
        ;

        if ($movie) {
            $qb
                ->andWhere('fp.idfilm = :id_film')
                ->setParameter(':id_film', $movie->getId())
            ;
        } else {
            $qb->andWhere('fp.idfilm is not null');
        }

        if ($firstResult) {
            $qb->setFirstResult($firstResult);
        }

        if ($maxResults) {
            $qb->setMaxResults($maxResults);
        }

        return $qb->getQuery()->getResult();
    }


    /**
     * @param FilmFilm $movie
     * @return int
     */
    public function getLegacyFilmImagesCount(FilmFilm $movie = null)
    {
        $qb = $this->createQueryBuilder('fp');
        $qb
            ->select('count(fp)')
            ->andWhere('fp.type = :type')
            ->setParameter(':type', 'I')
            ->andWhere('fp.internet = :internet')
            ->setParameter(':internet', 'O')
            ->addOrderBy('fp.idtypephoto', 'desc')
            ->addOrderBy('fp.idphoto', 'desc')
        ;

        if ($movie) {
            $qb
                ->andWhere('fp.idfilm = :id_film')
                ->setParameter(':id_film', $movie->getId())
            ;
        } else {
            $qb->andWhere('fp.idfilm is not null');
        }

        return (int)$qb->getQuery()->getSingleScalarResult();
    }

    /**
     * @param FilmFilm $movie
     * @param int|null $firstResult
     * @param int|null $maxResults
     * @param FilmFilm $movie
     * @return OldFilmPhoto[]
     */
    public function getLegacyFilmPdf(FilmFilm $movie = null, $firstResult = null, $maxResults = null)
    {
        $qb = $this->createQueryBuilder('fp');
        $qb
            ->andWhere('fp.type = :type')
            ->andWhere('fp.titre like :dossierDePresse')
            ->setParameter(':type', 'P')
            ->setParameter(':dossierDePresse', '%Dossier de presse%')
        ;

        if ($movie) {
            $qb
                ->andWhere('fp.idfilm = :id_film')
                ->setParameter(':id_film', $movie->getId())
            ;
        } else {
            $qb->andWhere('fp.idfilm is not null');
        }

        if ($firstResult) {
            $qb->setFirstResult($firstResult);
        }

        if ($maxResults) {
            $qb->setMaxResults($maxResults);
        }

        return $qb->getQuery()->getResult();
    }


    /**
     * @param FilmFilm $movie
     * @return int
     */
    public function getLegacyFilmPdfCount(FilmFilm $movie = null)
    {
        $qb = $this->createQueryBuilder('fp');
        $qb
            ->select('count(fp)')
            ->andWhere('fp.type = :type')
            ->andWhere('fp.titre like :dossierDePresse')
            ->setParameter(':type', 'P')
            ->setParameter(':dossierDePresse', '%Dossier de presse%')
        ;

        if ($movie) {
            $qb
                ->andWhere('fp.idfilm = :id_film')
                ->setParameter(':id_film', $movie->getId())
            ;
        } else {
            $qb->andWhere('fp.idfilm is not null');
        }
        return (int)$qb->getQuery()->getSingleScalarResult();
    }

    /**
     * @param FilmPerson|null $filmPerson
     * @param int|null $firstResult
     * @param int|null $maxResults
     * @return OldFilmPhoto[]
     */
    public function getLegacyPersonImages(FilmPerson $filmPerson = null, $firstResult = null, $maxResults = null)
    {
        $qb = $this
            ->createQueryBuilder('fp')
            ->andWhere('fp.internet = :internet')
            ->setParameter(':internet', 'O')
        ;

        if ($filmPerson) {
            $qb
                ->andWhere('fp.idpersonne = :idperson')
                ->setParameter(':idperson', $filmPerson->getId())
            ;
        } else {
            $qb->andWhere('fp.idpersonne IS NOT NULL');
        }

        if ($firstResult) {
            $qb->setFirstResult($firstResult);
        }

        if ($maxResults) {
            $qb->setMaxResults($maxResults);
        }

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @param FilmPerson|null $filmPerson
     * @return integer
     */
    public function getLegacyPersonImagesCount(FilmPerson $filmPerson = null)
    {
        $qb = $this
            ->createQueryBuilder('fp')
            ->select('count(fp)')
            ->andWhere('fp.internet = :internet')
            ->setParameter(':internet', 'O')
        ;

        if ($filmPerson) {
            $qb
                ->andWhere('fp.idpersonne = :idperson')
                ->setParameter(':idperson', $filmPerson->getId())
            ;
        } else {
            $qb->andWhere('fp.idpersonne IS NOT NULL');
        }

        return (int)$qb
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }

    /**
     * @param FilmJury|null $filmJury
     * @return int
     */
    public function getLegacyJuriesImagesCount(FilmJury $filmJury = null)
    {
        $qb = $this
            ->createQueryBuilder('fp')
            ->select('count(fp)')
            ->andWhere('fp.internet = :internet')
            ->setParameter(':internet', 'O')
        ;

        if ($filmJury) {
            $qb
                ->andWhere('fp.idjury = :idjury')
                ->setParameter(':idjury', $filmJury->getId())
            ;
        } else {
            $qb->andWhere('fp.idjury IS NOT NULL');
        }

        return (int)$qb
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }

    /**
     * @param FilmJury|null $filmJury
     * @param null $firstResult
     * @param null $maxResults
     * @return OldFilmPhoto[]
     */
    public function getLegacyJuriesImages(FilmJury $filmJury = null, $firstResult = null, $maxResults = null)
    {
        $qb = $this
            ->createQueryBuilder('fp')
            ->andWhere('fp.internet = :internet')
            ->setParameter(':internet', 'O')
        ;

        if ($filmJury) {
            $qb
                ->andWhere('fp.idjury = :idjury')
                ->setParameter(':idjury', $filmJury->getId())
            ;
        } else {
            $qb->andWhere('fp.idjury IS NOT NULL');
        }

        if ($firstResult) {
            $qb->setFirstResult($firstResult);
        }

        if ($maxResults) {
            $qb->setMaxResults($maxResults);
        }

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }
}