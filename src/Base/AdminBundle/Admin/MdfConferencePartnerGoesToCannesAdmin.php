<?php

namespace Base\AdminBundle\Admin;

use FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram;

/**
 * Class MdfConferencePartnerGoesToCannesAdmin
 *
 * @package Base\AdminBundle\Admin
 */
class MdfConferencePartnerGoesToCannesAdmin extends MdfConferencePartnerMain
{
    protected $baseRoutePattern = 'mdfconferencepartnergtc';
    protected $baseRouteName = 'mdf_conference_partner_gtc';

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $query->andWhere(
            $query->expr()->eq($query->getRootAlias().'.type', ':type')
        );
        $query->setParameter('type', MdfConferenceProgram::TYPE_GOES_TO_CANNES);

        return $query;
    }

    public function prePersist($page)
    {
        parent::prePersist($page);
        $page->setType(MdfConferenceProgram::TYPE_GOES_TO_CANNES);
    }
}
