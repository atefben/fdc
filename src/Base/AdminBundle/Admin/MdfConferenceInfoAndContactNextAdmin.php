<?php

namespace Base\AdminBundle\Admin;

use FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram;

class MdfConferenceInfoAndContactNextAdmin extends MdfConferenceInfoAndContactMain
{
    protected $baseRoutePattern = 'mdfconferenceinfoandcontactn';
    protected $baseRouteName = 'mdf_conference_info_and_contact_n';

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
