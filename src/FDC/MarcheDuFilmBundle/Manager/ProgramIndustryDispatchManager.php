<?php

namespace FDC\MarcheDuFilmBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\MarcheDuFilmBundle\Entity\ProgramIndustryDispatchTranslation;
use FDC\MarcheDuFilmBundle\Entity\ProgramIndustryDispatchWidgetTranslation;
use Symfony\Component\HttpFoundation\RequestStack;

class ProgramIndustryDispatchManager
{
    protected $em;

    protected $requestStack;

    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;
    }

    public function getDispatchWidgets()
    {
        return $this->em
            ->getRepository(ProgramIndustryDispatchWidgetTranslation::class)
            ->getSortedServices($this->requestStack->getMasterRequest()->get('_locale'));
    }

    public function getDispatchContent()
    {
        return $this->em
            ->getRepository(ProgramIndustryDispatchTranslation::class)
            ->findOneBy(
                array(
                    'locale' => $this->requestStack->getMasterRequest()->get('_locale')
                )
            );
    }

    public function findProgramIndustryDispatchByMedia($locale, $type, $id) {
        return $this->em
            ->getRepository(ProgramIndustryDispatchTranslation::class)
            ->getByMedia(
                $locale,
                array('id' => $id, 'type' => $type)
            );
    }
}
