<?php

namespace Base\AdminBundle\Admin;

use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate;

/**
 * Class MdfEditionProjectionsAdmin
 *
 * @package Base\AdminBundle\Admin
 */
class MdfEditionProjectionsAdmin extends MdfContentTemplateAdmin
{
    protected $baseRoutePattern = 'mdfeditionprojections';
    protected $baseRouteName = 'mdf_edition_projections';

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $query->andWhere(
            $query->expr()->eq($query->getRootAlias().'.type', ':type')
        );
        $query->setParameter('type', MdfContentTemplate::TYPE_EDITION_PROJECTIONS);

        return $query;
    }

    public function prePersist($page)
    {
        parent::prePersist($page);
        $page->setType(MdfContentTemplate::TYPE_EDITION_PROJECTIONS);
    }
}
