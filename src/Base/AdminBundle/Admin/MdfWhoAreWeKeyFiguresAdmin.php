<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class MdfWhoAreWeKeyFiguresAdmin extends MdfContentTemplateAdmin
{
    protected $baseRoutePattern = 'mdfwhoarewekeyfigures';
    protected $baseRouteName = 'mdf_who_are_we_key_figures';

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $query->andWhere(
            $query->expr()->eq($query->getRootAlias().'.type', ':type')
        );
        $query->setParameter('type', MdfContentTemplate::TYPE_WHO_ARE_WE_KEY_FIGURES);

        return $query;
    }

    public function prePersist($page)
    {
        parent::prePersist($page);
        $page->setType(MdfContentTemplate::TYPE_WHO_ARE_WE_KEY_FIGURES);
    }
}
