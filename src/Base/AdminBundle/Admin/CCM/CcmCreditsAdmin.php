<?php

namespace Base\AdminBundle\Admin\CCM;

use Base\AdminBundle\Admin\CCM\CcmFooterContentAdmin;
use FDC\CourtMetrageBundle\Entity\CcmFooterContent;

class CcmCreditsAdmin extends CcmFooterContentAdmin
{
    protected $baseRoutePattern = 'ccmcredits';
    protected $baseRouteName = 'ccm_credits';

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $query->andWhere(
            $query->expr()->eq($query->getRootAlias().'.type', ':type')
        );
        $query->setParameter('type', CcmFooterContent::FOOTER_CREDITS);

        return $query;
    }

    public function prePersist($page)
    {
        parent::prePersist($page);
        $page->setType(CcmFooterContent::FOOTER_CREDITS);
    }
}
