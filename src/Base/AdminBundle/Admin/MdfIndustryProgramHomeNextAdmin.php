<?php

namespace Base\AdminBundle\Admin;


use FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram;

class MdfIndustryProgramHomeNextAdmin extends MdfContentTemplateAdmin
{
    protected $baseRoutePattern = 'mdfindustryprogramhomenext';
    protected $baseRouteName = 'mdf_industry_program_home_next';

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $query->andWhere(
            $query->expr()->eq($query->getRootAlias().'.type', ':type')
        );
        $query->setParameter('type', MdfConferenceProgram::TYPE_NEXT);

        return $query;
    }

    public function prePersist($page)
    {
        parent::prePersist($page);
        $page->setType(MdfConferenceProgram::TYPE_NEXT);
    }
}
