<?php

namespace FDC\CourtMetrageBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\CourtMetrageBundle\Entity\CatalogPushTranslation;
use FDC\CourtMetrageBundle\Entity\HomepageActualiteTranslation;
use FDC\CourtMetrageBundle\Entity\HomepagePushTranslation;
use FDC\CourtMetrageBundle\Entity\HomepageSejourTranslation;
use FDC\CourtMetrageBundle\Entity\HomepageSliderTranslation;
use Symfony\Component\HttpFoundation\RequestStack;
use FDC\CourtMetrageBundle\Entity\HomepageTranslation;

class HomepageManager
{
    protected $em;

    protected $requestStack;

    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;

    }

    public function getSliders()
    {
        return $this->em
            ->getRepository(HomepageSliderTranslation::class)
            ->findBy(
                array(
                    'locale' => $this->requestStack->getMasterRequest()->get('_locale')
                )
            );
    }

    public function getPushes()
    {
        return $this->em
            ->getRepository(HomepagePushTranslation::class)
            ->findBy(
                array(
                    'locale' => $this->requestStack->getMasterRequest()->get('_locale')
                )
            );
    }

    public function getHomepageTranslation()
    {
        return $this
            ->em
            ->getRepository(HomepageTranslation::class)
            ->findOneBy(
                array(
                    'locale' => $this->requestStack->getMasterRequest()->get('_locale')
                )
            );
    }
    /**
     * @param $festivalId
     *
     * @return mixed
     */
    public function getFilmsByCourtYear()
    {
        $homepage = $this->getHomepageTranslation();

        if($homepage) {
            $year = $homepage->getTranslatable()->getCourtYear();

            $films = $this
                ->em
                ->getRepository('BaseCoreBundle:FilmFilm')
                ->findBy(['productionYear' => $year]);

            return $films;
        }
    }

    public function getCatalogPushes()
    {
        return $this->em
            ->getRepository(CatalogPushTranslation::class)
            ->findBy(
                array(
                    'locale' => $this->requestStack->getMasterRequest()->get('_locale')
                )
            );
    }

    public function getCatalogImage()
    {
        $homepage = $this->getHomepageTranslation();

        if($homepage) {

            return $homepage->getTranslatable()->getCatalogImage();
        }
    }

    public function getActualite()
    {
        return $this->em
            ->getRepository(HomepageActualiteTranslation::class)
            ->findBy(
                array(
                    'locale' => $this->requestStack->getMasterRequest()->get('_locale')
                )
            );
    }

    public function getSejour()
    {
        return $this->em
            ->getRepository(HomepageSejourTranslation::class)
            ->findOneBy(
                array(
                    'locale' => $this->requestStack->getMasterRequest()->get('_locale')
                )
            );
    }
}
