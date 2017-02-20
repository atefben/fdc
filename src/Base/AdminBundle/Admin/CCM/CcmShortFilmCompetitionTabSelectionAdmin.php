<?php

namespace Base\AdminBundle\Admin\CCM;


use FDC\CourtMetrageBundle\Entity\CcmShortFilmCompetitionTab;

/**
 * Class CcmShortFilmCompetitionTabSelectionAdmin
 *
 * @package Base\AdminBundle\Admin\CCM
 */
class CcmShortFilmCompetitionTabSelectionAdmin extends CcmShortFilmCompetitionTabAdmin
{
    protected $baseRoutePattern = 'ccmcompetitionselection';
    protected $baseRouteName = 'ccm_competition_selection';

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $query->andWhere(
            $query->expr()->eq($query->getRootAlias().'.type', ':type')
        );
        $query->setParameter('type', CcmShortFilmCompetitionTab::TYPE_SELECTION);

        return $query;
    }

    public function prePersist($page)
    {
        parent::prePersist($page);
        $page->setType(CcmShortFilmCompetitionTab::TYPE_SELECTION);
    }
}
