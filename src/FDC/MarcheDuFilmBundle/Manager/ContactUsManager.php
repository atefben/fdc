<?php

namespace FDC\MarcheDuFilmBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\MarcheDuFilmBundle\Entity\MdfContactPage;
use FDC\MarcheDuFilmBundle\Entity\MdfContactPageTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfContactBlock;
use FDC\MarcheDuFilmBundle\Entity\MdfContactBlockTranslation;
use FDC\MarcheDuFilmBundle\Entity\MdfContactSubjectsCollection;
use FDC\MarcheDuFilmBundle\Entity\MdfContactSubject;
use FDC\MarcheDuFilmBundle\Entity\MdfContactSubjectTranslation;
use Symfony\Component\HttpFoundation\RequestStack;

class ContactUsManager
{
    protected $em;

    protected $requestStack;

    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;
    }

    public function getContactUsPage()
    {
        return $this->em
            ->getRepository(MdfContactPageTranslation::class)
            ->getByLocaleAndStatus($this->requestStack->getMasterRequest()->get('_locale')
            );
    }

    public function getContactBlocks($contactPage)
    {
        if ($contactPage) {
            $contactBlockRepo = $this->em->getRepository(MdfContactBlock::class);
            $contactBlockTranslationRepo = $this->em->getRepository(MdfContactBlockTranslation::class);

            $contactBlocks = $contactBlockRepo
                ->getWidgetsDependingOnPostion(
                    $contactPage->getTranslatable()->getId()
                );

            if ($contactBlocks) {
                $contactBlocksResult = [];
                foreach ($contactBlocks as $widget) {
                    $block = $contactBlockTranslationRepo
                        ->getBlockByLocaleAndTranslatableId(
                            $this->requestStack->getMasterRequest()->get('_locale'), $widget->getId()
                        );

                    if ($block) {
                        $contactBlocksResult[] = $block;
                    }
                }
                return $contactBlocksResult;
            }
            return [];
        }
        return [];
    }

    public function getContactSubjects($contactPage)
    {
        if ($contactPage) {
            $contactSubjectsCollectionRepo = $this->em->getRepository(MdfContactSubjectsCollection::class);
            $contactSubjectsRepo = $this->em->getRepository(MdfContactSubjectTranslation::class);

            $contactSubjectsCollection = $contactSubjectsCollectionRepo
                ->getWidgetsDependingOnPostion(
                    $contactPage->getTranslatable()->getId()
                );


            if ($contactSubjectsCollection) {
                $contactSubjects = [];
                foreach ($contactSubjectsCollection as $widget) {
                    $contactSubject = $contactSubjectsRepo
                        ->getSubjectByLocaleAndTranslatableId(
                            $this->requestStack->getMasterRequest()->get('_locale'), $widget->getContactSubject()
                        );

                    if ($contactSubject) {
                        $contactSubjects[$contactSubject->getSlug()] = $contactSubject->getContactTheme();
                    }
                }
                return $contactSubjects;
            }
            return [];
        }
        return [];
    }
}
