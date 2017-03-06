<?php

namespace FDC\CourtMetrageBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\CourtMetrageBundle\Entity\CcmDomainCollection;
use FDC\CourtMetrageBundle\Entity\CcmDomainTranslation;
use FDC\CourtMetrageBundle\Entity\CcmProsDescription;
use FDC\CourtMetrageBundle\Entity\CcmProsDetailTranslation;
use FDC\CourtMetrageBundle\Entity\CcmProsPageTranslation;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class ProsManager
 * @package FDC\CourtMetrageBundle\Manager
 */
class ProsManager
{
    /**
     * @var EntityManager
     */
    protected $em;
    
    /**
     * @var RequestStack
     */
    protected $requestStack;

    /**
     * ProsManager constructor.
     * @param EntityManager $entityManager
     * @param RequestStack $requestStack
     */
    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;
    }

    /**
     * @return mixed
     */
    public function getProsPageByLocale()
    {
        return $this->em->getRepository(CcmProsPageTranslation::class)
            ->findOneBy(
                array(
                    'locale' => $this->requestStack->getMasterRequest()->getLocale()
                )
            );
    }

    /**
     * @return mixed
     */
    public function getProsByLocale()
    {
        return $this->em->getRepository(CcmProsDetailTranslation::class)
            ->getByLocaleAndStatus($this->requestStack->getMasterRequest()->getLocale());
    }

    /**
     * @param $pros
     * @return array|null
     */
    public function getDomains($pros, $page)
    {
        if ($pros) {
            $domains = [];
            $pageDomains = [];
            $repo = $this->em->getRepository(CcmDomainTranslation::class);
            $domainsCollection = $this->em->getRepository(CcmDomainCollection::class)
                ->findBy(
                    array(
                        'prosPage' => $page->getTranslatable()->getId()
                    )
                );
            
            foreach ($pros as $pro) {
                $domain = $repo
                    ->findOneBy(
                        array(
                            'locale' => $this->requestStack->getMasterRequest()->getLocale(),
                            'slug' => $pro->getDomain()
                        )
                    );

                if ($domain) {
                    $domains[$domain->getSlug()] = $domain->getName();
                }
            }

            foreach ($domainsCollection as $pd) {
                $pageDomain = $this->em->getRepository(CcmDomainTranslation::class)
                    ->findOneBy(
                        array(
                            'locale' => $this->requestStack->getMasterRequest()->getLocale(),
                            'translatable' => $pd->getDomain(),
                        )
                    );

                if ($pageDomain) {
                    $pageDomains[$pageDomain->getSlug()] = $pageDomain->getName();
                }
            }

            return array_intersect_key($domains, $pageDomains);
        }
        
        return null;
    }

    /**
     * @param $pros
     * @return bool
     */
    public function hasSFC($pros)
    {
        $hasSFC = false;

        foreach ($pros as $pro) {
            if ($hasSFC = $pro->getTranslatable()->isIsShortFilmCorner()) {
                break;
            }
        }
        
        return $hasSFC;
    }

    /**
     * @param $id
     * @return null|object
     */
    public function getProById($id)
    {
        return $this->em->getRepository(CcmProsDetailTranslation::class)
            ->find($id);
    }

    public function getProDescription($id)
    {
        return $this->em->getRepository(CcmProsDescription::class)
            ->findby(
                array(
                    'prosDetail' => $id
                ),
                array(
                    'position' => 'ASC'
                )
            );
    }
}
