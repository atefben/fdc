<?php

namespace Base\AdminBundle\Admin;


use FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram;

/**
 * Class MdfIndustryProgramHomeFrontieresAdmin
 * @package Base\AdminBundle\Admin
 */
class MdfIndustryProgramHomeFrontieresAdmin extends MdfContentTemplateAdmin
{
    protected $baseRoutePattern = 'mdfindustryprogramhomefr';
    protected $baseRouteName = 'mdf_industry_program_home_fr';

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $query->andWhere(
            $query->expr()->eq($query->getRootAlias().'.type', ':type')
        );
        $query->setParameter('type', MdfConferenceProgram::TYPE_FRONTIERES);

        return $query;
    }

    public function prePersist($page)
    {
        parent::prePersist($page);
        $page->setType(MdfConferenceProgram::TYPE_FRONTIERES);
    }
}
