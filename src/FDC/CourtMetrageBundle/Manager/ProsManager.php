<?php

namespace FDC\CourtMetrageBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\CourtMetrageBundle\Entity\CcmDomainTranslation;
use FDC\CourtMetrageBundle\Entity\CcmProsDetailTranslation;
use FDC\CourtMetrageBundle\Entity\CcmProsPageTranslation;
use Symfony\Component\HttpFoundation\RequestStack;

class ProsManager
{
    protected $em;

    protected $requestStack;

    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;
    }

    public function getProsPageByLocale()
    {
        return $this->em->getRepository(CcmProsPageTranslation::class)
            ->getByLocaleAndStatus($this->requestStack->getMasterRequest()->getLocale());
    }

    public function getProsByLocale()
    {
        return $this->em->getRepository(CcmProsDetailTranslation::class)
            ->getByLocaleAndStatus($this->requestStack->getMasterRequest()->getLocale());
    }

    public function getDomains($pros)
    {
        if ($pros) {
            $domains = [];
            $repo = $this->em->getRepository(CcmDomainTranslation::class);
            
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
            
            return $domains;
        }
        
        return null;
    }

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
}
