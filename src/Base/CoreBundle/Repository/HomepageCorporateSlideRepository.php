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

    /**
     * @param $locale
     * @param $dateTime
     * @return array
     */
    public function getAllSlide($locale,$dateTime)
    {
        return $this
            ->createQueryBuilder('hcs')
            ->leftJoin('hcs.statement', 's')
            ->leftJoin('hcs.info', 'i')

            ->leftJoin('i.sites', 'iss')
            ->leftJoin('s.sites', 'ss')

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
                 '(s1t.locale = :locale AND ss.slug = :siteCorpo ) OR
                 (s2t.locale = :locale AND ss.slug = :siteCorpo ) OR
                 (s3t.locale = :locale AND ss.slug = :siteCorpo ) OR
                 (s4t.locale = :locale AND ss.slug = :siteCorpo ) OR
                 (i1t.locale = :locale AND iss.slug = :siteCorpo ) OR
                 (i2t.locale = :locale AND iss.slug = :siteCorpo ) OR
                 (i3t.locale = :locale AND iss.slug = :siteCorpo ) OR
                 (i4t.locale = :locale AND iss.slug = :siteCorpo )'
            )
            ->setParameter('locale', $locale)
            ->setParameter('siteCorpo', 'site-institutionnel')

            ->andWhere(
                '(s.publishedAt <= :datetime) AND (s.publishEndedAt IS NULL OR s.publishEndedAt >= :datetime) OR
                 (i.publishedAt <= :datetime) AND (i.publishEndedAt IS NULL OR i.publishEndedAt >= :datetime)'
            )
            ->setParameter('datetime', $dateTime)

            ->orderBy('hcs.position')
            ->getQuery()
            ->getResult()
        ;
    }

}