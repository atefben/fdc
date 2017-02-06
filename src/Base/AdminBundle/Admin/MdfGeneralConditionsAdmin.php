<?php

namespace Base\AdminBundle\Admin;

use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate;

/**
 * Class MdfGeneralConditionsAdmin
 *
 * @package Base\AdminBundle\Admin
 */
class MdfGeneralConditionsAdmin extends MdfContentTemplateAdmin
{
    protected $baseRoutePattern = 'mdfgeneralconditions';
    protected $baseRouteName = 'mdf_general_conditions';

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $query->andWhere(
            $query->expr()->eq($query->getRootAlias().'.type', ':type')
        );
        $query->setParameter('type', MdfContentTemplate::TYPE_GENERAL_CONDITIONS);

        return $query;
    }

    public function prePersist($page)
    {
        parent::prePersist($page);
        $page->setType(MdfContentTemplate::TYPE_GENERAL_CONDITIONS);
    }
}