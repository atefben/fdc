<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\FDCPageAward;
use Doctrine\ORM\NonUniqueResultException;

/**
 * Class FDCPageFooterRepository
 * @package Base\CoreBundle\Repository
 */
class FDCPageFooterRepository extends TranslationRepository
{

    public function getPageBySlug($slug, $locale)
    {
        $qb = $this
            ->createQueryBuilder('p')
            ->leftJoin('p.translations', 'pt')
            ->andWhere('(pt.locale = :locale AND pt.slug = :slug)')
            ->setParameter('locale', $locale)
            ->setParameter('slug', $slug)
        ;


        return $qb
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
}
