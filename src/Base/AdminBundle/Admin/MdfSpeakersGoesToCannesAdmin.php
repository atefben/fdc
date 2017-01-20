<?php

namespace Base\AdminBundle\Admin;

use FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram;

/**
 * Class MdfSpeakersGoesToCannesAdmin
 *
 * @package Base\AdminBundle\Admin
 */
class MdfSpeakersGoesToCannesAdmin extends MdfSpeakersMain
{
    protected $baseRoutePattern = 'mdfconferencespeakersgtc';
    protected $baseRouteName = 'mdf_conference_speakers_gtc';

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
