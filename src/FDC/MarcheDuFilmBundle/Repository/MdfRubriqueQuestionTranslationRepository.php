<?php

namespace FDC\MarcheDuFilmBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;

/**
 * Class MdfRubriqueQuestionTranslationRepository
 * @package FDC\MarcheDuFilmBundle\Repository
 */
class MdfRubriqueQuestionTranslationRepository extends EntityRepository
{
    public function getQuestionAnswerByLocaleAndTranslatableId($locale, $translatable)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->where('s.locale = :locale')
            ->andWhere('s.translatable = :translatable')
            ->innerJoin('s.translatable', 't')
            ->setParameter(':locale', $locale)
            ->setParameter(':translatable', $translatable)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
