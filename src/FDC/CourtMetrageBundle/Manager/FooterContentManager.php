<?php

namespace FDC\CourtMetrageBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\CourtMetrageBundle\Entity\CcmFooterContent;
use FDC\CourtMetrageBundle\Entity\CcmFooterContentText;
use Symfony\Component\HttpFoundation\RequestStack;
use FDC\CourtMetrageBundle\Entity\CcmFooterContentTranslation;
use FDC\CourtMetrageBundle\Entity\CcmFooterContentTextTranslation;

/**
 * Class FooterContentManager
 * @package FDC\CourtMetrageBundle\Manager
 */
class FooterContentManager
{
    /**
     * @var EntityManager
     */
    protected $em;
    
    /**
     * @var RequestStack
     */
    protected $requestStack;

    protected $routes = [
        'fdc_ccm_footer_credits' => CcmFooterContent::FOOTER_CREDITS,
        'fdc_court_metrage_footer_mentions_legales' => CcmFooterContent::FOOTER_MENTIONES_LEGALES,
        'fdc_ccm_footer_politique_de_confidentialite' => CcmFooterContent::FOOTER_CONFIDENTIALITE
    ];

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
    
    public function getPageContent($route)
    {
        if (isset($this->routes[$route])) {
            $type = $this->routes[$route];

            return $this->em->getRepository(CcmFooterContentTranslation::class)
                ->getPageByTypeAndLocale(
                    $type,
                    $this->requestStack->getMasterRequest()->getLocale()
                );
        }

        return null;
    }
    
    public function getPageDescription($page)
    {
        if ($page) {
            $pageDescriptionsTranslatable = $this->em->getRepository(CcmFooterContentText::class)
                ->findBy(
                    array(
                        'footerContent' => $page->getTranslatable()->getId()
                    ),
                    array(
                        'position' => 'ASC'
                    )
                );

            if ($pageDescriptionsTranslatable) {
                $descriptions = [];

                foreach ($pageDescriptionsTranslatable as $item) {
                    $description = $this->em->getRepository(CcmFooterContentTextTranslation::class)
                        ->findOneBy(
                            array(
                                'locale' => $this->requestStack->getMasterRequest()->getLocale(),
                                'translatable' => $item->getId()
                        )
                    );

                    if ($description) {
                        $descriptions[] = $description;
                    }
                }

                return $descriptions;
            }

            return null;
        }

        return null;
    }
}
