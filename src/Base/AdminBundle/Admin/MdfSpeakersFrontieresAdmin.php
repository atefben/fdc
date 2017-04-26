<?php

namespace Base\AdminBundle\Admin;

use FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram;

/**
 * Class MdfSpeakersFrontieresAdmin
 * @package Base\AdminBundle\Admin
 */
class MdfSpeakersFrontieresAdmin extends MdfSpeakersMain
{
    protected $baseRoutePattern = 'mdfconferencespeakersfr';
    protected $baseRouteName = 'mdf_conference_speakers_fr';

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
