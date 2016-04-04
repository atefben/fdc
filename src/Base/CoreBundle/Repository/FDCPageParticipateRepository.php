<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\FilmFestival;
use Base\CoreBundle\Entity\News;
use Base\CoreBundle\Entity\NewsArticleTranslation;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * FDCPageParticipateRepository class.
 *
 * \@extends EntityRepository
 * @author   Antoine Mineau
 * \@company Ohwee
 */
class FDCPageParticipateRepository extends EntityRepository
{


    public function getFDCPageParticipateBySlug($slug, $locale)
    {

        $qb = $this
            ->createQueryBuilder('e')
            ->join('e.translations', 't')
        ;

        $this->addTranslationQueries($qb, 't', $locale, $slug);

        return $qb->getQuery()->getOneOrNullResult();
    }

}