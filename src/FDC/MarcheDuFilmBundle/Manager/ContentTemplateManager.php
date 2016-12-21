<?php

namespace FDC\MarcheDuFilmBundle\Manager;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\RequestStack;

class ContentTemplateManager
{
    protected $em;

    protected $requestStack;

    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;
    }

    public function getTitleHeaderContent($pageType) {
        return $this->em
            ->getRepository(HeaderFooterTranslation::class)
            ->findOneBy(
                [
                    'locale' => $this->requestStack->getMasterRequest()->get('_locale'),
                    'type' => $pageType
                ]
            );
    }
}