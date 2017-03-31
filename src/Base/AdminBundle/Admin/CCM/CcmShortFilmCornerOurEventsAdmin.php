<?php

namespace Base\AdminBundle\Admin\CCM;


use Doctrine\ORM\QueryBuilder;
use FDC\CourtMetrageBundle\Entity\CcmShortFilmCorner;
/**
 * Class CcmShortFilmCornerOurEventsAdmin
 *
 * @package Base\AdminBundle\Admin
 */
class CcmShortFilmCornerOurEventsAdmin extends CcmShortFilmCornerAdmin
{
    protected $baseRoutePattern = 'ccmsfcourevents';
    protected $baseRouteName = 'ccm_sfc_our_events';

    /**
     * @param string $context
     * 
     * @return QueryBuilder
     */
    public function createQuery($context = 'list')
    {
        /** @var QueryBuilder $query */
        $query = parent::createQuery($context);
        $query->andWhere(
            $query->expr()->eq($query->getRootAlias().'.type', ':type')
        );
        $query->setParameter('type', CcmShortFilmCorner::TYPE_OUR_EVENTS);

        return $query;
    }

    /**
     * @param mixed $page
     * 
     * @return mixed|void
     */
    public function prePersist($page)
    {
        parent::prePersist($page);
        $page->setType(CcmShortFilmCorner::TYPE_OUR_EVENTS);
    }
}
