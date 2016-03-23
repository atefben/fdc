<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\NewsArticleTranslation;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * Created by PhpStorm.
 * User: piebel
 * Date: 21/03/2016
 * Time: 14:40
 */

class HomepageSlideRepository extends EntityRepository
{

    public function getAllSlide($locale, $dateTime)
    {
        $qb = $this
            ->createQueryBuilder('hs')
            ->leftJoin('hs.news', 'n')
            ->leftJoin('hs.statement', 's')
            ->leftJoin('hs.infos', 'i')

            ->leftjoin('Base\CoreBundle\Entity\NewsArticle', 'na1', 'WITH', 'na1.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\NewsAudio', 'na2', 'WITH', 'na2.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\NewsImage', 'na3', 'WITH', 'na3.id = n.id')
            ->leftjoin('Base\CoreBundle\Entity\NewsVideo', 'na4', 'WITH', 'na4.id = n.id')
            ->leftjoin('na1.translations', 'na1t')
            ->leftjoin('na2.translations', 'na2t')
            ->leftjoin('na3.translations', 'na3t')
            ->leftjoin('na4.translations', 'na4t')

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

            ->andWhere(
                '(na1t.locale = :locale AND na1t.isPublishedOnFDCEvent = 1) OR
                 (na2t.locale = :locale AND na2t.isPublishedOnFDCEvent = 1) OR
                 (na3t.locale = :locale AND na3t.isPublishedOnFDCEvent = 1) OR
                 (na4t.locale = :locale AND na4t.isPublishedOnFDCEvent = 1) OR
                 (s1t.locale = :locale AND s1t.isPublishedOnFDCEvent = 1) OR
                 (s2t.locale = :locale AND s2t.isPublishedOnFDCEvent = 1) OR
                 (s3t.locale = :locale AND s3t.isPublishedOnFDCEvent = 1) OR
                 (s4t.locale = :locale AND s4t.isPublishedOnFDCEvent = 1) OR
                 (i1t.locale = :locale AND i1t.isPublishedOnFDCEvent = 1) OR
                 (i2t.locale = :locale AND i2t.isPublishedOnFDCEvent = 1) OR
                 (i3t.locale = :locale AND i3t.isPublishedOnFDCEvent = 1) OR
                 (i4t.locale = :locale AND i4t.isPublishedOnFDCEvent = 1)'
            )
            ->andWhere(
                '(n.publishedAt IS NULL OR n.publishedAt <= :datetime) AND (n.publishEndedAt IS NULL OR n.publishEndedAt >= :datetime) OR
                 (s.publishedAt IS NULL OR s.publishedAt <= :datetime) AND (s.publishEndedAt IS NULL OR s.publishEndedAt >= :datetime) OR
                 (i.publishedAt IS NULL OR i.publishedAt <= :datetime) AND (i.publishEndedAt IS NULL OR i.publishEndedAt >= :datetime)'
            )


            ->setParameter('locale', $locale)
            ->setParameter('datetime', $dateTime)
        ;

        $qb = $qb
            ->getQuery()
            ->getResult()
        ;

        return $qb;
    }

}