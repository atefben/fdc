<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Entity\ContactThemeTranslation;
use Base\CoreBundle\Entity\NewsTranslationInterface;

use Doctrine\ORM\EntityRepository;

/**
 * ContactThemeRepository class.
 *
 * \@extends EntityRepository
 *  @author   Antoine Mineau
 * \@company Ohwee
 */
class ContactThemeRepository extends EntityRepository
{

    /**
     * Create the select values for Footer Contact
     *
     * @param $locale
     * @return \Doctrine\ORM\Query
     */
    public function findSelectValues($locale)
    {
        $qb = $this->createQueryBuilder('ct')
            ->select('ct.id, ct.email')
            ->setParameter('locale', $locale)
            ->setParameter('status_published', ContactThemeTranslation::STATUS_PUBLISHED)
        ;
        if ($locale != 'fr') {
            $qb
                ->addSelect('case when ctt.theme is null then cttfr.theme else ctt.theme as theme')
                ->leftJoin('ct.translations', 'ctt', 'with', 'ctt.locale = :locale and ctt.status = :status_translated')
                ->setParameter('status_translated', ContactThemeTranslation::STATUS_TRANSLATED)
                ->join('ct.translations', 'cttfr', 'with', 'cttfr.locale = :locale_fr and cttfr.status = :status_published')
                ->setParameter('locale_fr', 'fr')
            ;
        } else {
            $qb
                ->addSelect('ctt.theme')
                ->join('ct.translations', 'ctt', 'with', 'ctt.locale = :locale and ctt.status = :status_published');
        }
        
        return $qb
            ->getQuery()
            ->getArrayResult()
        ;
    }
}