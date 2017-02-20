<?php

namespace FDC\CourtMetrageBundle\Manager;

use FDC\CourtMetrageBundle\Entity\CcmFilmRegisterTranslation;
use FDC\CourtMetrageBundle\Entity\CcmRegisterProcedureTranslation;
use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\ORM\EntityManager;

class ParticipateManager
{
    protected $em;

    protected $requestStack;

    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;
    }

    public function getRegisterMoviePage()
    {
        return $this->em
            ->getRepository(CcmFilmRegisterTranslation::class)
            ->findOneBy([
                'locale' => $this->requestStack->getMasterRequest()->get('_locale')
            ]);
    }

    public function getRegisterProcedures($filmRegisterPage)
    {
        $procedures = $filmRegisterPage->getTranslatable()->getFilmRegisterProcedure();

        $registerProcedures = array();
        foreach ($procedures as $procedure)
        {
            $registerProcedure = $this->em
                ->getRepository(CcmRegisterProcedureTranslation::class)
                ->findProcedureByLocaleAndId($this->requestStack->getMasterRequest()->get('_locale'), $procedure->getProcedure()->getId());

            if($registerProcedure->getStatus() == CcmRegisterProcedureTranslation::STATUS_PUBLISHED  || $registerProcedure->getStatus() == CcmRegisterProcedureTranslation::STATUS_TRANSLATED)
            {
                $registerProcedures[] = $registerProcedure;
            }
        }

        return $registerProcedures;
    }

    public function getRegisterProcedure($slug)
    {
        return $this->em
            ->getRepository(CcmRegisterProcedureTranslation::class)
            ->findOneBy(array(
                'locale' => $this->requestStack->getMasterRequest()->get('_locale'),
                'slug' => $slug
            ));
    }
}
