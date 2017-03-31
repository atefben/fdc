<?php

namespace Base\AdminBundle\Admin;

use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate;

/**
 * Class MdfEditionPresentationAdmin
 *
 * @package Base\AdminBundle\Admin
 */
class MdfEditionPresentationAdmin extends MdfContentTemplateAdmin
{
    protected $baseRoutePattern = 'mdfeditionpresentation';
    protected $baseRouteName = 'mdf_edition_presentation';

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $query->andWhere(
            $query->expr()->eq($query->getRootAlias().'.type', ':type')
        );
        $query->setParameter('type', MdfContentTemplate::TYPE_EDITION_PRESENTATION);

        return $query;
    }

    public function prePersist($page)
    {
        parent::prePersist($page);
        $page->setType(MdfContentTemplate::TYPE_EDITION_PRESENTATION);
    }
}
