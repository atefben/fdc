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
            ->where('s.locale = :locale')
            ->join('s.translatable', 't', 'WITH', 't.type = :type')
            ->setParameter(':locale', $locale)
            ->setParameter(':type', $type)
            ->setParameter('statusPublished',CcmFooterContentTranslation::STATUS_PUBLISHED)
        ;
        if ($locale != 'fr') {
            $qb
                ->andWhere('s.status = :statusTranslated')
                ->setParameter('statusTranslated', CcmFooterContentTranslation::STATUS_TRANSLATED)
                ->join('t.translations', 'tr')
                ->andWhere('tr.locale = :locale_fr and tr.status = :statusPublished')
                ->setParameter('locale_fr', 'fr')
            ;
        } else {
            $qb
                ->andWhere('s.status = :statusPublished')
            ;
        }

        return $qb->getQuery()->getOneOrNullResult();
    }
}
