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

        if (count($manager->getRepository(\FDC\CourtMetrageBundle\Entity\CcmProsPage::class)->findAll()) == 0) {
            $prosPage = new \FDC\CourtMetrageBundle\Entity\CcmProsPage();
            $manager->persist($prosPage);
        }

        $manager->flush();
    }
}