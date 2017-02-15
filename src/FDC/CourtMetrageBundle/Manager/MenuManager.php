<?php

namespace FDC\CourtMetrageBundle\Manager;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\RequestStack;
use FDC\CourtMetrageBundle\Entity\CcmMenu;
use FDC\CourtMetrageBundle\Entity\CcmMainNavCollection;
use FDC\CourtMetrageBundle\Entity\CcmMainNav;
use FDC\CourtMetrageBundle\Entity\CcmSubNavCollection;
use FDC\CourtMetrageBundle\Entity\CcmSubNav;

class MenuManager
{
    protected $em;

    protected $requestStack;

    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;
    }

    public function getMenuPage()
    {
        $menuPage = $this->em->getRepository(CcmMenu::class)
            ->findAll();

        if (count($menuPage)) {
            return $menuPage[0];
        }

        return null;
    }

    public function getMainNavs($menuPage)
    {
        if ($menuPage) {
            $mainNavCollection = $this->em->getRepository(CcmMainNavCollection::class)
                ->findBy(
                    array(
                        'menu' => $menuPage->getId()
                    ),
                    array(
                        'position' => 'ASC'
                    )
                );

            if ($mainNavCollection) {
                $mainNavs = [];

                foreach ($mainNavCollection as $item) {
                    $tab = $this->em->getRepository(CcmMainNav::class)
                        ->find($item->getMainNav());

                    if ($tab) {
                        $mainNavs[] = $tab;
                    }
                }

                return $mainNavs;
            }

            return null;
        }

        return null;
    }

    public function getSubNavs($mainNavs)
    {
        if ($mainNavs) {
            $subNavs = [];
            foreach ($mainNavs as $key => $nav) {
                $subNavCollection = $this->em->getRepository(CcmSubNavCollection::class)
                    ->findBy(
                            array(
                                'mainNav' => $nav->getId(),
                        ),
                        array(
                            'position' => 'ASC'
                        )
                    );

                if ($subNavCollection) {
                    $subNavs[$key] = [];

                    foreach ($subNavCollection as $item) {
                        $subTab = $this->em->getRepository(CcmSubNav::class)
                            ->find($item->getSubNav());

                        if ($subTab) {
                            $subNavs[$key][] = $subTab;
                        }
                    }
                }
            }
            return $subNavs;
        }

        return null;
    }
}
