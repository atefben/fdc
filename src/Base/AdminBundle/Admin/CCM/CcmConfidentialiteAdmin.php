<?php

namespace Base\AdminBundle\Admin\CCM;

use Base\AdminBundle\Admin\CCM\CcmFooterContentAdmin;
use FDC\CourtMetrageBundle\Entity\CcmFooterContent;

class CcmConfidentialiteAdmin extends CcmFooterContentAdmin
{
    protected $baseRoutePattern = 'ccmconfidentialite';
    protected $baseRouteName = 'ccm_confidentialite';

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $query->andWhere(
            $query->expr()->eq($query->getRootAlias().'.type', ':type')
        );
        $query->setParameter('type', CcmFooterContent::FOOTER_CONFIDENTIALITE);

        return $query;
    }

    public function prePersist($page)
    {
        parent::prePersist($page);
        $page->setType(CcmFooterContent::FOOTER_CONFIDENTIALITE);
    }
}
