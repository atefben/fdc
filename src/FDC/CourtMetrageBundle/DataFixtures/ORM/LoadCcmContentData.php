<?php

namespace FDC\CourtMetrageBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCcmContentData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        if (count($manager->getRepository(\FDC\CourtMetrageBundle\Entity\CcmMenu::class)->findAll()) == 0) {
            $menu = new \FDC\CourtMetrageBundle\Entity\CcmMenu();
            $manager->persist($menu);
        }

        $manager->flush();
    }
}