<?php

namespace Base\AdminBundle\Admin;

use FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram;

/**
 * Class MdfConferenceInfoAndContactFrontieresAdmin
 * @package Base\AdminBundle\Admin
 */
class MdfConferenceInfoAndContactFrontieresAdmin extends MdfConferenceInfoAndContactMain
{
    protected $baseRoutePattern = 'mdfconferenceinfoandcontactfr';
    protected $baseRouteName = 'mdf_conference_info_and_contact_fr';

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
