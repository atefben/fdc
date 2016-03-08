<?php

namespace Base\CoreBundle\Repository;


use Base\CoreBundle\Component\Repository\EntityRepository;

class FDCPageWebTvTrailersRepository extends EntityRepository
{
    /**
     * @param $festival
     * @param $locale
     * @return array
     */
    public function getAllTrailersPage($festival, $locale)
    {
        $qb = $this->createQueryBuilder('p');

        $qb
            ->join('p.selectionSection', 's')
            ->join('s.films', 'f')
            ->join('f.translations', 'ft')
            ->join('f.associatedMediaVideos', 'amv')
            ->join('amv.mediaVideo', 'mv')
            ->join('mv.translations', 'mvt')
            ->andWhere('ft.slug IS NOT NULL')
            ->andWhere("ft.slug != ''")
            ->join('mv.sites', 'si')
        ;

        $this->addImageQueries($qb, 'mv', 'mvt');
        $this->addMasterQueries($qb, 'mv', $festival, true);
        $this->addMasterQueries($qb, 'f', $festival, false);
        $this->addTranslationQueries($qb, 'mvt', $locale);
        $this->addFDCEventQueries($qb, 'si');
        $this->addAWSVideoEncodersQueries($qb, 'mvt');

        $qb->orderBy('s.position');

        return $qb->getQuery()->getResult();
    }

}