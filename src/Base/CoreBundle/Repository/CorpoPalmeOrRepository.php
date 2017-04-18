<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Component\Repository\EntityRepository;
use Base\CoreBundle\Entity\FDCPageLaSelection;
use Base\CoreBundle\Entity\NewsArticleTranslation;
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
            ->where('t.locale = :locale')
            ->setParameter('published',NewsArticleTranslation::STATUS_PUBLISHED)
            ->join('p.translations', 't')
            ->setParameter('locale', $locale)
        ;
        if ($locale != 'fr') {
            $qb
                ->andWhere('t.status = :translated')
                ->setParameter('translated',NewsArticleTranslation::STATUS_TRANSLATED)
                ->join('p.translations', 'tt')
                ->andWhere('tt.locale = :locale_fr and tt.status = :published')
                ->setParameter('locale_fr', 'fr')
            ;
        } else {
            $qb
                ->andWhere('t.status = :published')
            ;
        }

        return $qb->getQuery()->getResult();
    }
}
