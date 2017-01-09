<?php

namespace Base\AdminBundle\Admin;

use Base\AdminBundle\Component\Admin\Admin;
use FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

/**
 * Class MdfIndustryProgramHomeAdmin
 *
 * @package Base\AdminBundle\Admin
 */
class MdfIndustryProgramHomeAdmin extends MdfContentTemplateAdmin
{
    protected $baseRoutePattern = 'mdfindustryprogramhome';
    protected $baseRouteName = 'mdf_industry_program_home';

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $query->andWhere(
            $query->expr()->eq($query->getRootAlias().'.type', ':type')
        );
        $query->setParameter('type', MdfContentTemplate::TYPE_INDUSTRY_PROGRAM_HOME);

        return $query;
    }

    public function prePersist($page)
    {
        parent::prePersist($page);
        $page->setType(MdfContentTemplate::TYPE_INDUSTRY_PROGRAM_HOME);
    }
}
