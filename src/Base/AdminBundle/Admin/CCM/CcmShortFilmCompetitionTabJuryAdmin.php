<?php

namespace Base\AdminBundle\Admin\CCM;


use FDC\CourtMetrageBundle\Entity\CcmShortFilmCompetitionTab;

/**
 * Class CcmShortFilmCompetitionTabJuryAdmin
 *
 * @package Base\AdminBundle\Admin\CCM
 */
class CcmShortFilmCompetitionTabJuryAdmin extends CcmShortFilmCompetitionTabAdmin
{
    protected $baseRoutePattern = 'ccmcompetitionjury';
    protected $baseRouteName = 'ccm_competition_jury';

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $query->andWhere(
            $query->expr()->eq($query->getRootAlias().'.type', ':type')
        );
        $query->setParameter('type', CcmShortFilmCompetitionTab::TYPE_JURY);

        return $query;
    }

    public function prePersist($page)
    {
        parent::prePersist($page);
        $page->setType(CcmShortFilmCompetitionTab::TYPE_JURY);
    }
}
