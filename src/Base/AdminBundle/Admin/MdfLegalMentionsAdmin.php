<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Admin\MdfContentTemplateAdmin;

use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class MdfLegalMentionsAdmin extends MdfContentTemplateAdmin
{
    protected $baseRoutePattern = 'mdflegalmentions';
    protected $baseRouteName = 'mdf_legal_mentions';

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $query->andWhere(
            $query->expr()->eq($query->getRootAlias().'.type', ':type')
        );
        $query->setParameter('type', MdfContentTemplate::TYPE_LEGAL_MENTIONS);

        return $query;
    }

    public function prePersist($page)
    {
        parent::prePersist($page);
        $page->setType(MdfContentTemplate::TYPE_LEGAL_MENTIONS);
    }
}
