<?php

namespace FDC\MarcheDuFilmBundle\Manager;

use Doctrine\ORM\EntityManager;
use FDC\MarcheDuFilmBundle\Entity\Contact;
use FDC\MarcheDuFilmBundle\Entity\ContactTranslation;
use Symfony\Component\HttpFoundation\RequestStack;

class ContactManager
{
    protected $em;

    protected $requestStack;

    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->em = $entityManager;
        $this->requestStack = $requestStack;
    }

    public function getContactInfo() {
        $contact = $this->em
            ->getRepository(ContactTranslation::class)
            ->findOneBy(
                [
                    'locale' => $this->requestStack->getMasterRequest()->get('_locale')
                ]
            );


        $pageTranslationStatus = $contact->getStatus();
        if(($pageTranslationStatus != ContactTranslation::STATUS_TRANSLATED) && ($pageTranslationStatus != ContactTranslation::STATUS_PUBLISHED))
        {
            $contact = null;
        }

        return $contact;
    }
}
