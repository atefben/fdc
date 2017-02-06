<?php

namespace FDC\MarcheDuFilmBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\MarcheDuFilmBundle\Entity\MdfAnnualGraphicCharter;

class AnnualGraphicCharterManager
{
    protected $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function getCurrentGraphicCharter()
    {
        $charters = $this->em
            ->getRepository(MdfAnnualGraphicCharter::class)
            ->findAll();

        return $charters[0];
    }
}
