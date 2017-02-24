<?php

namespace FDC\CourtMetrageBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use FDC\CourtMetrageBundle\Entity\CcmShortFilmCorner;

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

        if (count($manager->getRepository(\FDC\CourtMetrageBundle\Entity\CcmFaqPage::class)->findAll()) == 0) {
            $faqPage = new \FDC\CourtMetrageBundle\Entity\CcmFaqPage();
            $manager->persist($faqPage);
        }

        if (count($manager->getRepository(\FDC\CourtMetrageBundle\Entity\CcmContactPage::class)->findAll()) == 0) {
            $contactPage = new \FDC\CourtMetrageBundle\Entity\CcmContactPage();
            $manager->persist($contactPage);
        }

        if (count($manager->getRepository(CcmShortFilmCorner::class)
                ->findBy(['type' => CcmShortFilmCorner::TYPE_WHO_ARE_WE])) == 0) {
            $whoAreWe = new CcmShortFilmCorner();
            $whoAreWe->setType(CcmShortFilmCorner::TYPE_WHO_ARE_WE);
            $manager->persist($whoAreWe);
        }
        
        if (count($manager->getRepository(CcmShortFilmCorner::class)
                ->findBy(['type' => CcmShortFilmCorner::TYPE_RELIVE_EDITION])) == 0) {
            $reliveEdition = new CcmShortFilmCorner();
            $reliveEdition->setType(CcmShortFilmCorner::TYPE_RELIVE_EDITION);
            $manager->persist($reliveEdition);
        }
        
        if (count($manager->getRepository(CcmShortFilmCorner::class)
                ->findBy(['type' => CcmShortFilmCorner::TYPE_OUR_EVENTS])) == 0) {
            $ourEvents = new CcmShortFilmCorner();
            $ourEvents->setType(CcmShortFilmCorner::TYPE_OUR_EVENTS);
            $manager->persist($ourEvents);
        }

        if (count($manager->getRepository(\FDC\CourtMetrageBundle\Entity\CcmFooterContent::class)
                ->findBy(['type' => \FDC\CourtMetrageBundle\Entity\CcmFooterContent::FOOTER_MENTIONES_LEGALES])) == 0) {
            $legalePage = new \FDC\CourtMetrageBundle\Entity\CcmFooterContent();
            $legalePage->setType(\FDC\CourtMetrageBundle\Entity\CcmFooterContent::FOOTER_MENTIONES_LEGALES);
            $manager->persist($legalePage);
        }

        if (count($manager->getRepository(\FDC\CourtMetrageBundle\Entity\CcmFooterContent::class)
                ->findBy(['type' => \FDC\CourtMetrageBundle\Entity\CcmFooterContent::FOOTER_CREDITS])) == 0) {
            $creditsPage = new \FDC\CourtMetrageBundle\Entity\CcmFooterContent();
            $creditsPage->setType(\FDC\CourtMetrageBundle\Entity\CcmFooterContent::FOOTER_CREDITS);
            $manager->persist($creditsPage);
        }

        if (count($manager->getRepository(\FDC\CourtMetrageBundle\Entity\CcmFooterContent::class)
                ->findBy(['type' => \FDC\CourtMetrageBundle\Entity\CcmFooterContent::FOOTER_CONFIDENTIALITE])) == 0) {
            $confidentialitePage = new \FDC\CourtMetrageBundle\Entity\CcmFooterContent();
            $confidentialitePage->setType(\FDC\CourtMetrageBundle\Entity\CcmFooterContent::FOOTER_CONFIDENTIALITE);
            $manager->persist($confidentialitePage);
        }

        $manager->flush();
    }
}