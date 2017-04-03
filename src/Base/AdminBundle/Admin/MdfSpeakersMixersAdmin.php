<?php

namespace Base\AdminBundle\Admin;

use FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram;

/**
 * Class MdfSpeakersMixersAdmin
 *
 * @package Base\AdminBundle\Admin
 */
class MdfSpeakersMixersAdmin extends MdfSpeakersMain
{
    protected $baseRoutePattern = 'mdfconferencespeakersmixers';
    protected $baseRouteName = 'mdf_conference_speakers_mixers';

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $query->andWhere(
            $query->expr()->eq($query->getRootAlias().'.type', ':type')
        );
        $query->setParameter('type', MdfConferenceProgram::TYPE_MIXERS);

        return $query;
    }

    public function prePersist($page)
    {
        parent::prePersist($page);
        $page->setType(MdfConferenceProgram::TYPE_MIXERS);
    }
}
