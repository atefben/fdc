<?php

namespace Base\AdminBundle\Admin;

use FDC\MarcheDuFilmBundle\Entity\MdfSpeakers;
use FDC\MarcheDuFilmBundle\Entity\MdfSpeakersTranslation;
use Base\AdminBundle\Component\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class MdfSpeakersAdmin
 * @package Base\AdminBundle\Admin
 */
class MdfSpeakersAdmin extends MdfSpeakersMain
{
    protected $baseRoutePattern = 'mdfconferencespeakerspw';
    protected $baseRouteName = 'mdf_conference_speakers_pw';

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $query->andWhere(
            $query->expr()->eq($query->getRootAlias().'.type', ':type')
        );
        $query->setParameter('type', MdfSpeakers::TYPE_PRODUCERS_WORKSHOP);

        return $query;
    }

    public function prePersist($page)
    {
        parent::prePersist($page);
        $page->setType(MdfSpeakers::TYPE_PRODUCERS_WORKSHOP);
    }
}
