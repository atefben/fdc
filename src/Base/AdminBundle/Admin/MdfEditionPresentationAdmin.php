<?php

namespace Base\AdminBundle\Admin;

use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

/**
 * Class MdfEditionPresentationAdmin
 *
 * @package Base\AdminBundle\Admin
 */
class MdfEditionPresentationAdmin extends MdfContentTemplateAdmin
{
    protected $baseRoutePattern = 'mdfeditionpresentation';
    protected $baseRouteName = 'mdf_edition_presentation';

//    /**
//     * @param RouteCollection $collection
//     */
//    protected function configureRoutes(RouteCollection $collection)
//    {
//        $collection->clearExcept(['edit', 'list']);
//    }

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
