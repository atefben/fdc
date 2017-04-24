<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\FDCPageLaSelection;
use Doctrine\ORM\NonUniqueResultException;

/**
 * Class CorpoWhoAreWeRepository
 * @package Base\CoreBundle\Repository
 */
class CorpoWhoAreWeRepository extends TranslationRepository
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

        return $qb->getQuery()->getOneOrNullResult();
    }
}
