<?php

namespace Base\AdminBundle\Admin\CCM;


use Doctrine\ORM\QueryBuilder;
use FDC\CourtMetrageBundle\Entity\CcmShortFilmCorner;
/**
 * Class CcmShortFilmCornerReliveEditionAdmin
 *
 * @package Base\AdminBundle\Admin
 */
class CcmShortFilmCornerReliveEditionAdmin extends CcmShortFilmCornerAdmin
{
    protected $baseRoutePattern = 'ccmsfcreliveedition';
    protected $baseRouteName = 'ccm_sfc_relive_edition';

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
        $query->setParameter('type', CcmShortFilmCorner::TYPE_RELIVE_EDITION);

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
        $page->setType(CcmShortFilmCorner::TYPE_RELIVE_EDITION);
    }
}
