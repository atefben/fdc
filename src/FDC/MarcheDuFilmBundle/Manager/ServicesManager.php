<?php

namespace FDC\MarcheDuFilmBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\MarcheDuFilmBundle\Entity\Service;
use FDC\MarcheDuFilmBundle\Entity\ServiceTranslation;
use FDC\MarcheDuFilmBundle\Entity\ServiceWidgetCollection;
use FDC\MarcheDuFilmBundle\Entity\ServiceWidget;
use FDC\MarcheDuFilmBundle\Entity\ServiceWidgetTranslation;
use FDC\MarcheDuFilmBundle\Entity\ServiceWidgetProductCollection;
use FDC\MarcheDuFilmBundle\Entity\ServiceWidgetProduct;
use FDC\MarcheDuFilmBundle\Entity\ServiceWidgetProductTranslation;
use Symfony\Component\HttpFoundation\RequestStack;

class ServicesManager
{
    protected $em;

    protected $requestStack;

    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;
    }
    
    public function getNavServices() {
        $services = $this->em->getRepository(ServiceTranslation::class)
            ->findBy(
                array(
                    'locale' => $this->requestStack->getMasterRequest()->get('_locale')    
                )
            );
        
        if ($services) {
            $navServices = [];
            foreach ($services as $service) {
                $navServices[$service->getUrl()] = $service->getTitle();
            }
            
            return $navServices;
        }
        
        return [];
    }
    
    public function getNavArrowsServices($navServices)
    {
        if ($navServices) {
            $navArrowsServices = [];

            $position = 0;
            $navArrowsServices[0] = [];
            $navArrowsServices[1] = [];
            foreach ($navServices as $url => $service) {
                $navArrowsServices[0][$url] = $position++;
                $navArrowsServices[1][] = $url;
            }
            
            return $navArrowsServices;
        }
        
        return [];
    }

    public function getService($slug)
    {
        return $this->em->getRepository(ServiceTranslation::class)
            ->getServiceByLocaleAndSlug($this->requestStack->getMasterRequest()->get('_locale'), $slug);
    }

    /**
     * @param /FDC\MarcheDuFilmBundle\Entity\Service $service
     *
     * @return ServiceWidget
     */
    public function getServiceWidgets($service)
    {
        if ($service) {
            $serviceWidgetCollectionRepo = $this->em->getRepository(ServiceWidgetCollection::class);
            $serviceWidgetRepo = $this->em->getRepository(ServiceWidgetTranslation::class);

            $serviceWidgetCollection = $serviceWidgetCollectionRepo
                ->getWidgetsDependingOnPostion(
                    $service->getTranslatable()->getId()
                );

            if ($serviceWidgetCollection) {
                $serviceWidgets = [];
                foreach ($serviceWidgetCollection as $widget) {
                    $serviceWidget = $serviceWidgetRepo
                        ->getServiceWidgetByLocaleAndWidgetId(
                            $this->requestStack->getMasterRequest()->get('_locale'), $widget->getWidget()
                        );

                    if ($serviceWidget) {
                        $serviceWidgets[] = $serviceWidget;
                    }
                }
                return $serviceWidgets;
            }
            return [];
        }
        return [];
    }

    /**
     * @param \FDC\MarcheDuFilmBundle\Entity\ServiceWidget $widgets
     *
     * @return ServiceWidgetProduct
     */
    public function getServiceWidgetProducts($widgets)
    {

        if ($widgets) {
            $productsCollection = [];
            $serviceWidgetProductCollectionRepo = $this->em->getRepository(ServiceWidgetProductCollection::class);
            $serviceWidgetProductRepo = $this->em->getRepository(ServiceWidgetProductTranslation::class);

            foreach ($widgets as $widget) {
                $translatableId = $widget->getTranslatable()->getId();
                $productCollection = $serviceWidgetProductCollectionRepo
                    ->findBy(
                        array(
                            'serviceWidget' => $translatableId
                        )
                    );

                if ($productCollection) {
                    $productsCollection[$translatableId] = [];

                    foreach ($productCollection as $productCollectionItem) {
                        $product = $serviceWidgetProductRepo
                            ->getServiceWidgetProductByLocaleAndProductId(
                                $this->requestStack->getMasterRequest()->get('_locale'),
                                $productCollectionItem->getProduct()
                            );

                        if ($product) {
                            $productsCollection[$translatableId][] = $product;
                        }
                    }
                }
            }
            return $productsCollection;
        }
        return [];
    }
}
