<?php

namespace Base\AdminBundle\Admin\CCM;


use FDC\CourtMetrageBundle\Entity\CcmShortFilmCompetitionTab;

class CcmShortFilmCompetitionTabPalmaresAdmin extends CcmShortFilmCompetitionTabAdmin
{
    protected $baseRoutePattern = 'ccmcompetitionpalmares';
    protected $baseRouteName = 'ccm_competition_palmares';

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $query->andWhere(
            $query->expr()->eq($query->getRootAlias().'.type', ':type')
        );
        $query->setParameter('type', CcmShortFilmCompetitionTab::TYPE_PALMARES);

        return $query;
    }

    public function prePersist($page)
    {
        parent::prePersist($page);
        $page->setType(CcmShortFilmCompetitionTab::TYPE_PALMARES);
    }
}
