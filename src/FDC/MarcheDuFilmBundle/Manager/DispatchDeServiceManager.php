<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 19.12.2016
 * Time: 10:32
 */

namespace FDC\MarcheDuFilmBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\MarcheDuFilmBundle\Entity\DispatchDeServiceTranslation;
use FDC\MarcheDuFilmBundle\Entity\DispatchDeServiceWidgetTranslation;
use FDC\MarcheDuFilmBundle\Entity\DispatchDeServiceContactTranslation;
use Symfony\Component\HttpFoundation\RequestStack;

class DispatchDeServiceManager
{
    protected $em;

    protected $requestStack;

    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;
    }

    public function getDispatchDeServiceContact()
    {
        return $this->em
            ->getRepository(DispatchDeServiceContactTranslation::class)
            ->findOneBy(
                array(
                    'locale' => $this->requestStack->getMasterRequest()->get('_locale')
                )
            );
    }

    public function getDispatchDeServiceWidgets()
    {
        return $this->em
            ->getRepository(DispatchDeServiceWidgetTranslation::class)
            ->findBy(
                array(
                    'locale' => $this->requestStack->getMasterRequest()->get('_locale')
                )
            );
    }

    public function getDispatchDeServiceContent()
    {
        return $this->em
            ->getRepository(DispatchDeServiceTranslation::class)
            ->findOneBy(
                array(
                    'locale' => $this->requestStack->getMasterRequest()->get('_locale')
                )
            );
    }
}
