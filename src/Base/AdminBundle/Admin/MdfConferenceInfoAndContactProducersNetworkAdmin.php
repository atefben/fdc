<?php

namespace Base\AdminBundle\Admin;

use FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram;

class MdfConferenceInfoAndContactProducersNetworkAdmin extends MdfConferenceInfoAndContactMain
{
    protected $baseRoutePattern = 'mdfconferenceinfoandcontactpn';
    protected $baseRouteName = 'mdf_conference_info_and_contact_pn';

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $query->andWhere(
            $query->expr()->eq($query->getRootAlias().'.type', ':type')
        );
        $query->setParameter('type', MdfConferenceProgram::TYPE_PRODUCERS_NETWORK);

        return $query;
    }

    public function prePersist($page)
    {
        parent::prePersist($page);
        $page->setType(MdfConferenceProgram::TYPE_PRODUCERS_NETWORK);
    }
}
