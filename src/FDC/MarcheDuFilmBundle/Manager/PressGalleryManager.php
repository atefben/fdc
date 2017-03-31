<?php

namespace FDC\MarcheDuFilmBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\MarcheDuFilmBundle\Entity\MdfPressGalleryTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfPressGalleryWidgetTranslation;
use Symfony\Component\HttpFoundation\RequestStack;

class PressGalleryManager
{
    protected $em;

    protected $requestStack;

    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;
    }

    public function getPressGalleryWidgets()
    {
        return $this->em
            ->getRepository(MdfPressGalleryWidgetTranslation::class)
            ->getSortedPressGalleryWidgets($this->requestStack->getMasterRequest()->get('_locale'));
    }

    public function getPressGalleryContent()
    {
        return $this->em
            ->getRepository(MdfPressGalleryTranslation::class)
            ->findOneBy(
                array(
                    'locale' => $this->requestStack->getMasterRequest()->get('_locale')
                )
            );
    }

    public function findPressGalleryByMedia($locale, $type, $id) {
        return $this->em
            ->getRepository(MdfPressGalleryTranslation::class)
            ->getByMedia(
                $locale,
                array('id' => $id, 'type' => $type)
            );
    }
}
