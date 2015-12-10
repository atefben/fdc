<?php

namespace Base\CoreBundle\Repository;

use Base\CoreBundle\Entity\NewsTranslationInterface;

use Doctrine\ORM\EntityRepository;

/**
 * ContactThemeRepository class.
 *
 * \@extends EntityRepository
 * @author   Antoine Mineau
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
        return $this->createQueryBuilder('ct')
            ->select('ct.id, ct.email, ctt.theme')
            ->join('ct.translations', 'ctt')
            ->where('ctt.locale = :locale')
            ->setParameter('locale', $locale)
            ->getQuery()
            ->getArrayResult();
    }
}