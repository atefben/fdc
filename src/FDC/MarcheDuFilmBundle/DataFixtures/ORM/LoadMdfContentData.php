<?php

namespace FDC\MarcheDuFilmBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadMdfContentData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\Accreditation::class)->findAll()) == 0) {
            $accreditation = new \FDC\MarcheDuFilmBundle\Entity\Accreditation();
            $manager->persist($accreditation);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\Contact::class)->findAll()) == 0) {
            $contactBlock = new \FDC\MarcheDuFilmBundle\Entity\Contact();
            $manager->persist($contactBlock);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\DispatchDeService::class)->findAll()) == 0) {
            $dispatchDeService = new \FDC\MarcheDuFilmBundle\Entity\DispatchDeService();
            $manager->persist($dispatchDeService);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\HeaderFooter::class)->findAll()) == 0) {
            $headerFooter = new \FDC\MarcheDuFilmBundle\Entity\HeaderFooter();
            $manager->persist($headerFooter);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\Mdf404::class)->findAll()) == 0) {
            $error404 = new \FDC\MarcheDuFilmBundle\Entity\Mdf404();
            $manager->persist($error404);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceInfoAndContact::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_PRODUCERS_WORKSHOP])) == 0) {
            $conferencePWinfo = new \FDC\MarcheDuFilmBundle\Entity\MdfConferenceInfoAndContact();
            $conferencePWinfo->setType(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_PRODUCERS_WORKSHOP);
            $manager->persist($conferencePWinfo);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceInfoAndContact::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_PRODUCERS_NETWORK])) == 0) {
            $conferencePNinfo = new \FDC\MarcheDuFilmBundle\Entity\MdfConferenceInfoAndContact();
            $conferencePNinfo->setType(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_PRODUCERS_NETWORK);
            $manager->persist($conferencePNinfo);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceInfoAndContact::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_DOC_CORNER])) == 0) {
            $conferenceDCinfo = new \FDC\MarcheDuFilmBundle\Entity\MdfConferenceInfoAndContact();
            $conferenceDCinfo->setType(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_DOC_CORNER);
            $manager->persist($conferenceDCinfo);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceInfoAndContact::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_NEXT])) == 0) {
            $conferenceNinfo = new \FDC\MarcheDuFilmBundle\Entity\MdfConferenceInfoAndContact();
            $conferenceNinfo->setType(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_NEXT);
            $manager->persist($conferenceNinfo);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceInfoAndContact::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_MIXERS])) == 0) {
            $conferenceMinfo = new \FDC\MarcheDuFilmBundle\Entity\MdfConferenceInfoAndContact();
            $conferenceMinfo->setType(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_MIXERS);
            $manager->persist($conferenceMinfo);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceInfoAndContact::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_GOES_TO_CANNES])) == 0) {
            $conferenceGCinfo = new \FDC\MarcheDuFilmBundle\Entity\MdfConferenceInfoAndContact();
            $conferenceGCinfo->setType(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_GOES_TO_CANNES);
            $manager->persist($conferenceGCinfo);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceNewsPage::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_PRODUCERS_WORKSHOP])) == 0) {
            $conferencePWnews = new \FDC\MarcheDuFilmBundle\Entity\MdfConferenceNewsPage();
            $conferencePWnews->setType(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_PRODUCERS_WORKSHOP);
            $manager->persist($conferencePWnews);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceNewsPage::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_PRODUCERS_NETWORK])) == 0) {
            $conferencePNnews = new \FDC\MarcheDuFilmBundle\Entity\MdfConferenceNewsPage();
            $conferencePNnews->setType(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_PRODUCERS_NETWORK);
            $manager->persist($conferencePNnews);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceNewsPage::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_DOC_CORNER])) == 0) {
            $conferenceDCnews = new \FDC\MarcheDuFilmBundle\Entity\MdfConferenceNewsPage();
            $conferenceDCnews->setType(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_DOC_CORNER);
            $manager->persist($conferenceDCnews);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceNewsPage::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_NEXT])) == 0) {
            $conferenceNnews = new \FDC\MarcheDuFilmBundle\Entity\MdfConferenceNewsPage();
            $conferenceNnews->setType(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_NEXT);
            $manager->persist($conferenceNnews);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceNewsPage::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_MIXERS])) == 0) {
            $conferenceMnews = new \FDC\MarcheDuFilmBundle\Entity\MdfConferenceNewsPage();
            $conferenceMnews->setType(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_MIXERS);
            $manager->persist($conferenceMnews);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceNewsPage::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_GOES_TO_CANNES])) == 0) {
            $conferenceGCnews = new \FDC\MarcheDuFilmBundle\Entity\MdfConferenceNewsPage();
            $conferenceGCnews->setType(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_GOES_TO_CANNES);
            $manager->persist($conferenceGCnews);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfConferencePartner::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_PRODUCERS_WORKSHOP])) == 0) {
            $conferencePWpartner = new \FDC\MarcheDuFilmBundle\Entity\MdfConferencePartner();
            $conferencePWpartner->setType(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_PRODUCERS_WORKSHOP);
            $manager->persist($conferencePWpartner);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfConferencePartner::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_PRODUCERS_NETWORK])) == 0) {
            $conferencePNpartner = new \FDC\MarcheDuFilmBundle\Entity\MdfConferencePartner();
            $conferencePNpartner->setType(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_PRODUCERS_NETWORK);
            $manager->persist($conferencePNpartner);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfConferencePartner::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_DOC_CORNER])) == 0) {
            $conferenceDCpartner = new \FDC\MarcheDuFilmBundle\Entity\MdfConferencePartner();
            $conferenceDCpartner->setType(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_DOC_CORNER);
            $manager->persist($conferenceDCpartner);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfConferencePartner::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_NEXT])) == 0) {
            $conferenceNpartner = new \FDC\MarcheDuFilmBundle\Entity\MdfConferencePartner();
            $conferenceNpartner->setType(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_NEXT);
            $manager->persist($conferenceNpartner);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfConferencePartner::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_MIXERS])) == 0) {
            $conferenceMpartner = new \FDC\MarcheDuFilmBundle\Entity\MdfConferencePartner();
            $conferenceMpartner->setType(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_MIXERS);
            $manager->persist($conferenceMpartner);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfConferencePartner::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_GOES_TO_CANNES])) == 0) {
            $conferenceGCpartner = new \FDC\MarcheDuFilmBundle\Entity\MdfConferencePartner();
            $conferenceGCpartner->setType(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_GOES_TO_CANNES);
            $manager->persist($conferenceGCpartner);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_PRODUCERS_WORKSHOP])) == 0) {
            $conferencePWprogram = new \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram();
            $conferencePWprogram->setType(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_PRODUCERS_WORKSHOP);
            $manager->persist($conferencePWprogram);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_PRODUCERS_NETWORK])) == 0) {
            $conferencePNprogram = new \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram();
            $conferencePNprogram->setType(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_PRODUCERS_NETWORK);
            $manager->persist($conferencePNprogram);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_DOC_CORNER])) == 0) {
            $conferenceDCprogram = new \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram();
            $conferenceDCprogram->setType(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_DOC_CORNER);
            $manager->persist($conferenceDCprogram);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_NEXT])) == 0) {
            $conferenceNprogram = new \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram();
            $conferenceNprogram->setType(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_NEXT);
            $manager->persist($conferenceNprogram);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_MIXERS])) == 0) {
            $conferenceMprogram = new \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram();
            $conferenceMprogram->setType(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_MIXERS);
            $manager->persist($conferenceMprogram);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_GOES_TO_CANNES])) == 0) {
            $conferenceGCprogram = new \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram();
            $conferenceGCprogram->setType(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_GOES_TO_CANNES);
            $manager->persist($conferenceGCprogram);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate::TYPE_EDITION_PRESENTATION])) == 0) {
            $presentation = new \FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate();
            $presentation->setType(\FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate::TYPE_EDITION_PRESENTATION);
            $manager->persist($presentation);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate::TYPE_EDITION_PROJECTIONS])) == 0) {
            $projections = new \FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate();
            $projections->setType(\FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate::TYPE_EDITION_PROJECTIONS);
            $manager->persist($projections);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate::TYPE_GENERAL_CONDITIONS])) == 0) {
            $conditions = new \FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate();
            $conditions->setType(\FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate::TYPE_GENERAL_CONDITIONS);
            $manager->persist($conditions);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfGlobalEvents::class)) == 0) {
            $globalEvents = new \FDC\MarcheDuFilmBundle\Entity\MdfGlobalEvents();
            $manager->persist($globalEvents);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfHomepage::class)) == 0) {
            $homepage = new \FDC\MarcheDuFilmBundle\Entity\MdfHomepage();
            $manager->persist($homepage);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_PRODUCERS_WORKSHOP])) == 0) {
            $conferencePWhomepage = new \FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate();
            $conferencePWhomepage->setType(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_PRODUCERS_WORKSHOP);
            $manager->persist($conferencePWhomepage);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_PRODUCERS_NETWORK])) == 0) {
            $conferencePNhomepage = new \FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate();
            $conferencePNhomepage->setType(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_PRODUCERS_NETWORK);
            $manager->persist($conferencePNhomepage);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_DOC_CORNER])) == 0) {
            $conferenceDChomepage = new \FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate();
            $conferenceDChomepage->setType(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_DOC_CORNER);
            $manager->persist($conferenceDChomepage);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_NEXT])) == 0) {
            $conferenceNhomepage = new \FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate();
            $conferenceNhomepage->setType(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_NEXT);
            $manager->persist($conferenceNhomepage);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_MIXERS])) == 0) {
            $conferenceMhomepage = new \FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate();
            $conferenceMhomepage->setType(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_MIXERS);
            $manager->persist($conferenceMhomepage);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_GOES_TO_CANNES])) == 0) {
            $conferenceGChomepage = new \FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate();
            $conferenceGChomepage->setType(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_GOES_TO_CANNES);
            $manager->persist($conferenceGChomepage);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfInformations::class)->findAll()) == 0) {
            $faq = new \FDC\MarcheDuFilmBundle\Entity\MdfInformations();
            $manager->persist($faq);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate::TYPE_LEGAL_MENTIONS])) == 0) {
            $mentions = new \FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate();
            $mentions->setType(\FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate::TYPE_LEGAL_MENTIONS);
            $manager->persist($mentions);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfNewsPage::class)->findAll()) == 0) {
            $news = new \FDC\MarcheDuFilmBundle\Entity\MdfNewsPage();
            $manager->persist($news);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\PressCoverage::class)->findAll()) == 0) {
            $pressCoverage = new \FDC\MarcheDuFilmBundle\Entity\PressCoverage();
            $manager->persist($pressCoverage);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfPressGallery::class)->findAll()) == 0) {
            $pressGallery = new \FDC\MarcheDuFilmBundle\Entity\MdfPressGallery();
            $manager->persist($pressGallery);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfPressGraphicalCharter::class)->findAll()) == 0) {
            $pressGraphic = new \FDC\MarcheDuFilmBundle\Entity\MdfPressGraphicalCharter();
            $manager->persist($pressGraphic);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfPressRelease::class)->findAll()) == 0) {
            $pressRelease = new \FDC\MarcheDuFilmBundle\Entity\MdfPressRelease();
            $manager->persist($pressRelease);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfSitePlan::class)->findAll()) == 0) {
            $sitePlan = new \FDC\MarcheDuFilmBundle\Entity\MdfSitePlan();
            $manager->persist($sitePlan);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfSpeakers::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_PRODUCERS_WORKSHOP])) == 0) {
            $conferencePWspeakers = new \FDC\MarcheDuFilmBundle\Entity\MdfSpeakers();
            $conferencePWspeakers->setType(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_PRODUCERS_WORKSHOP);
            $manager->persist($conferencePWspeakers);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfSpeakers::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_PRODUCERS_NETWORK])) == 0) {
            $conferencePNspeakers = new \FDC\MarcheDuFilmBundle\Entity\MdfSpeakers();
            $conferencePNspeakers->setType(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_PRODUCERS_NETWORK);
            $manager->persist($conferencePNspeakers);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfSpeakers::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_DOC_CORNER])) == 0) {
            $conferenceDCspeakers = new \FDC\MarcheDuFilmBundle\Entity\MdfSpeakers();
            $conferenceDCspeakers->setType(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_DOC_CORNER);
            $manager->persist($conferenceDCspeakers);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfSpeakers::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_NEXT])) == 0) {
            $conferenceNspeakers = new \FDC\MarcheDuFilmBundle\Entity\MdfSpeakers();
            $conferenceNspeakers->setType(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_NEXT);
            $manager->persist($conferenceNspeakers);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfSpeakers::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_MIXERS])) == 0) {
            $conferenceMspeakers = new \FDC\MarcheDuFilmBundle\Entity\MdfSpeakers();
            $conferenceMspeakers->setType(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_MIXERS);
            $manager->persist($conferenceMspeakers);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfSpeakers::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_GOES_TO_CANNES])) == 0) {
            $conferenceGCspeakers = new \FDC\MarcheDuFilmBundle\Entity\MdfSpeakers();
            $conferenceGCspeakers->setType(\FDC\MarcheDuFilmBundle\Entity\MdfConferenceProgram::TYPE_GOES_TO_CANNES);
            $manager->persist($conferenceGCspeakers);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate::TYPE_WHO_ARE_WE_ENVIRONMENTAL_APPROACHES])) == 0) {
            $environment = new \FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate();
            $environment->setType(\FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate::TYPE_WHO_ARE_WE_ENVIRONMENTAL_APPROACHES);
            $manager->persist($environment);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate::TYPE_WHO_ARE_WE_HISTORY])) == 0) {
            $history = new \FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate();
            $history->setType(\FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate::TYPE_WHO_ARE_WE_HISTORY);
            $manager->persist($history);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate::TYPE_WHO_ARE_WE_KEY_FIGURES])) == 0) {
            $figures = new \FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate();
            $figures->setType(\FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate::TYPE_WHO_ARE_WE_KEY_FIGURES);
            $manager->persist($figures);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfWhoAreWeTeam::class)->findAll()) == 0) {
            $team = new \FDC\MarcheDuFilmBundle\Entity\MdfWhoAreWeTeam();
            $manager->persist($team);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfContactPage::class)->findAll()) == 0) {
            $contact = new \FDC\MarcheDuFilmBundle\Entity\MdfContactPage();
            $manager->persist($contact);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate::class)
                ->findBy(['type' => \FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate::TYPE_INDUSTRY_PROGRAM_HOME])) == 0) {
            $industry = new \FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate();
            $industry->setType(\FDC\MarcheDuFilmBundle\Entity\MdfContentTemplate::TYPE_INDUSTRY_PROGRAM_HOME);
            $manager->persist($industry);
        }
        if (count($manager->getRepository(\FDC\MarcheDuFilmBundle\Entity\MdfAnnualGraphicCharter::class)->findAll()) == 0) {
            $charter = new \FDC\MarcheDuFilmBundle\Entity\MdfAnnualGraphicCharter();
            $manager->persist($charter);
        }

        $manager->flush();
    }
}