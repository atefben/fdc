<?php

namespace Base\AdminBundle\Admin;

use FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram;

/**
 * Class MdfIndustryProgramHomeAdmin
 *
 * @package Base\AdminBundle\Admin
 */
class MdfIndustryProgramHomeAdmin extends MdfContentTemplateAdmin
{
    protected $baseRoutePattern = 'mdfindustryprogramhomepw';
    protected $baseRouteName = 'mdf_industry_program_home_pw';

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $query->andWhere(
            $query->expr()->eq($query->getRootAlias().'.type', ':type')
        );
        $query->setParameter('type', MdfConferenceProgram::TYPE_PRODUCERS_WORKSHOP);

        return $query;
    }

    public function prePersist($page)
    {
        parent::prePersist($page);
        $page->setType(MdfConferenceProgram::TYPE_PRODUCERS_WORKSHOP);
    }
}
