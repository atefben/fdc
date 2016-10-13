<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\NewsArticleTranslation;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * Created by PhpStorm.
 * User: steone
 * Date: 21/03/2016
 * Time: 14:40
 */

class HomepageCorporateSlideRepository extends EntityRepository
{

    public function getAllSlide($locale)
    {
        $qb = $this
            ->createQueryBuilder('hs')
            ->leftJoin('hs.statement', 's')
            ->leftJoin('hs.info', 'i')

            ->leftjoin('Base\CoreBundle\Entity\StatementArticle', 's1', 'WITH', 's1.id = s.id')
            ->leftjoin('Base\CoreBundle\Entity\StatementAudio', 's2', 'WITH', 's2.id = s.id')
            ->leftjoin('Base\CoreBundle\Entity\StatementImage', 's3', 'WITH', 's3.id = s.id')
            ->leftjoin('Base\CoreBundle\Entity\StatementVideo', 's4', 'WITH', 's4.id = s.id')
            ->leftjoin('s1.translations', 's1t')
            ->leftjoin('s2.translations', 's2t')
            ->leftjoin('s3.translations', 's3t')
            ->leftjoin('s4.translations', 's4t')

            ->leftjoin('Base\CoreBundle\Entity\InfoArticle', 'i1', 'WITH', 'i1.id = i.id')
            ->leftjoin('Base\CoreBundle\Entity\InfoAudio', 'i2', 'WITH', 'i2.id = i.id')
            ->leftjoin('Base\CoreBundle\Entity\InfoImage', 'i3', 'WITH', 'i3.id = i.id')
            ->leftjoin('Base\CoreBundle\Entity\InfoVideo', 'i4', 'WITH', 'i4.id = i.id')
            ->leftjoin('i1.translations', 'i1t')
            ->leftjoin('i2.translations', 'i2t')
            ->leftjoin('i3.translations', 'i3t')
            ->leftjoin('i4.translations', 'i4t')
        ;
        $qb
            ->andWhere(
                '(s1t.locale = :locale) OR
                 (s2t.locale = :locale) OR
                 (s3t.locale = :locale) OR
                 (s4t.locale = :locale) OR
                 (i1t.locale = :locale) OR
                 (i2t.locale = :locale) OR
                 (i3t.locale = :locale) OR
                 (i4t.locale = :locale)'
            )
        ;

        /*$qb
            ->andWhere(
                '(n.publishedAt <= :datetime) AND (n.publishEndedAt IS NULL OR n.publishEndedAt >= :datetime) OR
                 (s.publishedAt <= :datetime) AND (s.publishEndedAt IS NULL OR s.publishEndedAt >= :datetime) OR
                 (i.publishedAt <= :datetime) AND (i.publishEndedAt IS NULL OR i.publishEndedAt >= :datetime)'
            )*/
            $qb->orderBy('hs.position')
            ->setParameter('locale', $locale)
            //->setParameter('datetime', $dateTime)
        ;

        $qb = $qb
            ->getQuery()
            ->getResult()
        ;
        return $qb;
    }

}