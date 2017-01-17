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
                ->findBy(
                    array(
                        'service' => $service->getTranslatable()->getId()
                    )
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
