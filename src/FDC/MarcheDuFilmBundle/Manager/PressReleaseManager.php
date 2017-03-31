<?php

namespace FDC\MarcheDuFilmBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\MarcheDuFilmBundle\Entity\MdfPressReleaseTranslation;
use Symfony\Component\HttpFoundation\RequestStack;

class PressReleaseManager
{
    protected $em;

    protected $requestStack;

    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;
    }

    public function getPressReleasePage()
    {
        return $this->em
            ->getRepository(MdfPressReleaseTranslation::class)
            ->findOneBy(array(
                'locale' => $this->requestStack->getMasterRequest()->get('_locale')
            ));
    }
}
