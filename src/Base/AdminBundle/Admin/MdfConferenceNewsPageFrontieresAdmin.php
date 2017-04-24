<?php

namespace Base\AdminBundle\Admin;

use FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram;

/**
 * Class MdfConferenceNewsPageFrontieresAdmin
 * @package Base\AdminBundle\Admin
 */
class MdfConferenceNewsPageFrontieresAdmin extends MdfConferenceNewsPageMain
{
    protected $baseRoutePattern = 'mdfconferencenewspagefr';
    protected $baseRouteName = 'mdf_conference_news_page_fr';

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
