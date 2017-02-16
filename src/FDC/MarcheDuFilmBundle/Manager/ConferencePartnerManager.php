<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18.01.2017
 * Time: 13:12
 */

namespace FDC\MarcheDuFilmBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\MarcheDuFilmBundle\Entity\MdfConferencePartnerLogo;
use FDC\MarcheDuFilmBundle\Entity\MdfConferencePartnerLogoCollection;
use FDC\MarcheDuFilmBundle\Entity\MdfConferencePartnerLogoTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfConferencePartnerTab;
use FDC\MarcheDuFilmBundle\Entity\MdfConferencePartnerTabCollection;
use FDC\MarcheDuFilmBundle\Entity\MdfConferencePartnerTabTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfConferencePartnerTranslation;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class ConferencePartnerManager
 *
 * @package FDC\MarcheDuFilmBundle\Manager
 */
class ConferencePartnerManager
{
    protected $em;

    protected $requestStack;

    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;
    }

    public function getConferencePartnerPageBySlug($slug)
    {
        return $this->em
            ->getRepository(MdfConferencePartnerTranslation::class)
            ->getConferencePartnerPageByLocaleAndSlug($this->requestStack->getMasterRequest()->get('_locale'), $slug);
    }

    public function getConferencePartnerTabWidgets($page)
    {
        if ($page) {
            $programTabCollectionRepo = $this->em->getRepository(MdfConferencePartnerTabCollection::class);
            $partnerTabRepo = $this->em->getRepository(MdfConferencePartnerTabTranslation::class);

            $partnerTabCollection = $programTabCollectionRepo
                ->findBy(
                    array(
                        'conferencePartner' => $page->getTranslatable()->getId()
                    )
                );

            if ($partnerTabCollection) {
                $partnerTabs = [];
                foreach ($partnerTabCollection as $widget) {
                    $tabWidget = $partnerTabRepo->getPartnerTabByLocaleAndTabId(
                        $this->requestStack->getMasterRequest()->get('_locale'),
                        $widget->getConferencePartnerTab()
                    );

                    if ($tabWidget) {
                        $partnerTabs[] = $tabWidget;
                    }
                }

                return $partnerTabs;
            }
            return [];
        }
        return [];
    }

    public function getLogosPerTabs($tabs)
    {
        if ($tabs) {
            $logosCollection = [];
            $logoCollectionRepo = $this->em->getRepository(MdfConferencePartnerLogoCollection::class);
            $logoRepo = $this->em->getRepository(MdfConferencePartnerLogoTranslation::class);

            foreach ($tabs as $tab) {
                $tabId = $tab->getTranslatable()->getId();
                $logoCollection = $logoCollectionRepo
                    ->findBy(
                        array(
                            'conferencePartnerTab' => $tabId
                        )
                    );

                if ($logoCollection) {
                    $logosCollection[$tabId] = [];

                    foreach ($logoCollection as $logoCollectionItem) {
                        $logo = $logoRepo
                            ->getLogoByLocaleAndLogoId(
                                $this->requestStack->getMasterRequest()->get('_locale'),
                                $logoCollectionItem->getConferencePartnerLogo()
                            );

                        if ($logo) {
                            $logosCollection[$tabId][] = $logo;
                        } else {
                            $logo = $this->em->getRepository(MdfConferencePartnerLogo::class)
                                 ->findOneBy(
                                     array(
                                         'id' => $logoCollectionItem->getConferencePartnerLogo()->getId()
                                     )
                                 );
                            if ($logo) {
                                $logosCollection[$tabId][] = $logo;
                            }
                        }
                    }
                }
            }
            return $logosCollection;
        }
        return [];
    }

    public function findConferencePartnerByMedia($locale, $type, $id) {
        return $this->em
            ->getRepository(MdfConferencePartnerTranslation::class)
            ->getByMedia(
                $locale,
                array('id' => $id, 'type' => $type)
            );
    }
}
