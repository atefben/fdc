<?php

namespace Base\AdminBundle\Admin\CCM;

use Base\AdminBundle\Admin\CCM\CcmFooterContentAdmin;
use FDC\CourtMetrageBundle\Entity\CcmFooterContent;
use Sonata\AdminBundle\Route\RouteCollection;

class CcmLegalAdmin extends CcmFooterContentAdmin
{
    protected $baseRoutePattern = 'ccmlegalmentions';
    protected $baseRouteName = 'ccm_legal_mentions';

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $query->andWhere(
            $query->expr()->eq($query->getRootAlias().'.type', ':type')
        );
        $query->setParameter('type', CcmFooterContent::FOOTER_MENTIONES_LEGALES);

        return $query;
    }

    public function prePersist($page)
    {
        parent::prePersist($page);
        $page->setType(CcmFooterContent::FOOTER_MENTIONES_LEGALES);
    }

    /**
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(['edit', 'list']);
    }
}
