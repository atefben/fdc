<?php

namespace FDC\CourtMetrageBundle\Repository;

use FDC\CourtMetrageBundle\Component\Doctrine\EntityRepository;

/**
 * Class CcmRubriqueQuestionTranslationRepository
 * @package FDC\CourtMetrageBundle\Repository
 */
class CcmRubriqueQuestionTranslationRepository extends EntityRepository
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
