<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 19.01.2017
 * Time: 12:20
 */

namespace Base\AdminBundle\Admin;


use FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram;

class MdfConferencePartnerDocCornerAdmin extends MdfConferencePartnerMain
{
    protected $baseRoutePattern = 'mdfconferencepartnerdc';
    protected $baseRouteName = 'mdf_conference_partner_dc';

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
