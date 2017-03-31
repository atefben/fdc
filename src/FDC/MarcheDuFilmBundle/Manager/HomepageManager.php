<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 19.12.2016
 * Time: 10:32
 */

namespace FDC\MarcheDuFilmBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\MarcheDuFilmBundle\Entity\HomeSliderTopTranslation;
use FDC\MarcheDuFilmBundle\Entity\HomeSliderTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfHomeContentSliderTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfHomepageTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfHomeServiceTranslation;
use Symfony\Component\HttpFoundation\RequestStack;

class HomepageManager
{
    protected $em;

    protected $requestStack;

    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;
    }

    public function getSlidersTop()
    {
        return $this->em
            ->getRepository(HomeSliderTopTranslation::class)
            ->findBy(
                array(
                'locale' => $this->requestStack->getMasterRequest()->get('_locale')
                )
            );
    }

    public function getSliders()
    {
        return $this->em
            ->getRepository(HomeSliderTranslation::class)
            ->findBy(
                array(
                    'locale' => $this->requestStack->getMasterRequest()->get('_locale')
                )
            );
    }

    public function getHomepageContent()
    {
        return $this->em
            ->getRepository(MdfHomepageTranslation::class)
            ->findOneBy(
                array(
                    'locale' => $this->requestStack->getMasterRequest()->get('_locale')
                )
            );
    }

    public function getHomepageServices()
    {
        return $this->em
            ->getRepository(MdfHomeServiceTranslation::class)
            ->findBy(
                array(
                    'locale' => $this->requestStack->getMasterRequest()->get('_locale')
                )
            );
    }

    public function findHomepageByMedia($locale, $type, $id) {
        return $this->em
            ->getRepository(MdfHomepageTranslation::class)
            ->getByMedia(
                $locale,
                array('id' => $id, 'type' => $type)
            );
    }
}