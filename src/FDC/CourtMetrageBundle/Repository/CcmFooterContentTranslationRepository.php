<?php

namespace FDC\CourtMetrageBundle\Repository;

use FDC\MarcheDuFilmBundle\Component\Doctrine\EntityRepository;
use FDC\CourtMetrageBundle\Entity\CcmFooterContentTranslation;

/**
 * Class CcmFooterContentTranslationRepository
 * @package FDC\CourtMetrageBundle\Repository
 */
class CcmFooterContentTranslationRepository extends EntityRepository
{
    public function getPageByTypeAndLocale($type, $locale)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->where('s.locale = :locale_fr')
            ->join('s.translatable', 't', 'WITH', 't.type = :type')
            ->andWhere('s.status = :statusPublished')
            ->setParameter('statusPublished',CcmFooterContentTranslation::STATUS_PUBLISHED)
            ->setParameter(':locale_fr', 'fr')
            ->setParameter(':type', $type)
        ;
        if ($locale != 'fr') {
            $qb
                ->join('t.translations', 'tr')
                ->andWhere('tr.locale = :locale and tr.status = :statusTranslated')
                ->setParameter(':locale', $locale)
                ->setParameter('statusTranslated', CcmFooterContentTranslation::STATUS_TRANSLATED)
            ;
        }

        return $qb->getQuery()->getOneOrNullResult();
    }
}
