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
     * @param $page
     * @return array|null
     */
    public function getDomains($pros, $page)
    {
        if ($pros) {
            $domains = [];
            $pageDomains = [];
            $repo = $this->em->getRepository(CcmDomainTranslation::class);
            $domainsRepo = $this->em->getRepository(CcmDomainCollection::class);
            $domainsCollectionPage = $domainsRepo
                ->findBy(
                    array(
                        'prosPage' => $page->getTranslatable()->getId()
                    )
                );

            foreach ($pros as $pro) {
                $domainsCollectionPro = $domainsRepo
                    ->findBy(
                        array(
                            'prosDetail' => $pro->getTranslatable()->getId()
                        )
                    );

                if ($domainsCollectionPro) {
                    foreach ($domainsCollectionPro as $domainPro) {
                        $domain = $repo
                            ->findOneBy(
                                array(
                                    'locale' => $this->requestStack->getMasterRequest()->getLocale(),
                                    'translatable' => $domainPro->getDomain()
                                )
                            );

                        if ($domain) {
                            $domains[$domain->getSlug()] = $domain->getName();
                        }
                    }
                }
            }

            if ($domainsCollectionPage) {
                foreach ($domainsCollectionPage as $pd) {
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
            }

            return array_intersect_key($domains, $pageDomains);
        }

        return null;
    }

    /**
     * @param $pros
     * @return array|null
     */
    public function getProsDomains($pros)
    {
        if ($pros) {
            $domains = [];
            $repo = $this->em->getRepository(CcmDomainTranslation::class);
            $domainsRepo = $this->em->getRepository(CcmDomainCollection::class);

            foreach ($pros as $pro) {
                $domainsCollectionPro = $domainsRepo
                    ->findBy(
                        array(
                            'prosDetail' => $pro->getTranslatable()->getId()
                        )
                    );

                if ($domainsCollectionPro) {
                    $domains[$pro->getTranslatable()->getId()] = [];
                    foreach ($domainsCollectionPro as $domainPro) {
                        $domain = $repo
                            ->findOneBy(
                                array(
                                    'locale' => $this->requestStack->getMasterRequest()->getLocale(),
                                    'translatable' => $domainPro->getDomain()
                                )
                            );

                        if ($domain) {
                            $domains[$pro->getTranslatable()->getId()][$domain->getSlug()] = $domain->getName();
                        }
                    }
                }
            }

           return $domains;
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
