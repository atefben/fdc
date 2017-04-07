<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\FDCPageLaSelection;
use Doctrine\ORM\NonUniqueResultException;

/**
 * Class CorpoPalmeOrRepository
 * @package Base\CoreBundle\Repository
 */
class CorpoPalmeOrRepository extends TranslationRepository
{
    /**
     * @param $locale
     * @param $slug
     * @return FDCPageLaSelection
     * @throws NonUniqueResultException
     */
    public function getPageBySlug($locale, $slug)
    {
        $qb = $this->createQueryBuilder('p');

        $qb
            ->join('p.translations', 'pt')
        ;

        $this->addTranslationQueries($qb, 'pt', $locale, $slug);

        $output = $qb->getQuery()->getOneOrNullResult();

        return $output;
    }

    /**
     * @param $locale
     * @param $slug
     * @return FDCPageLaSelection
     * @throws NonUniqueResultException
     */
    public function getAllPagesByLocale($locale)
    {
        $qb = $this->createQueryBuilder('p');

        $qb
            ->join('p.translations', 't')
            ->andWhere('t.locale = :locale')
            ->andWhere('t.status = 1')
            ->setParameter('locale', $locale)
            ->orderBy('p.weight','ASC')
        ;

        $output = $qb->getQuery()->getResult();


        return $output;
    }
}
