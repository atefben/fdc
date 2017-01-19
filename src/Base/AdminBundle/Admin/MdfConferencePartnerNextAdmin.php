<?php

namespace Base\AdminBundle\Admin;

use FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram;

/**
 * Class MdfConferencePartnerNextAdmin
 *
 * @package Base\AdminBundle\Admin
 */
class MdfConferencePartnerNextAdmin extends MdfConferencePartnerMain
{
    protected $baseRoutePattern = 'mdfconferencepartnernext';
    protected $baseRouteName = 'mdf_conference_partner_next';

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
