<?php

namespace Base\AdminBundle\Admin;

use FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram;

class MdfIndustryProgramHomeDocCornerAdmin extends MdfContentTemplateAdmin
{
    protected $baseRoutePattern = 'mdfindustryprogramhomedc';
    protected $baseRouteName = 'mdf_industry_program_home_dc';

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $query->andWhere(
            $query->expr()->eq($query->getRootAlias().'.type', ':type')
        );
        $query->setParameter('type', MdfConferenceProgram::TYPE_DOC_CORNER);

        return $query;
    }

    public function prePersist($page)
    {
        parent::prePersist($page);
        $page->setType(MdfConferenceProgram::TYPE_DOC_CORNER);
    }
}
