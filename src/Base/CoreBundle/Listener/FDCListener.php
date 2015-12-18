<?php

namespace Base\CoreBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class FDCListener
{
    private $tokenStorage;

    public function __construct(TokenStorage $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        // set festival year
        if (method_exists($entity, 'setFestival')) {
            $em = $args->getEntityManager();
            $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
            $entity->setFestival($settings->getFestival());
        }

        // set createdBy
        if (method_exists($entity, 'setCreatedBy') && $this->tokenStorage->getToken()) {
            $entity->setCreatedBy($this->tokenStorage->getToken()->getUser());
        }
    }


    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        // set updatedBy
        if (method_exists($entity, 'setUpdatedBy') && $this->tokenStorage->getToken()) {
            $entity->setUpdatedBy($this->tokenStorage->getToken()->getUser());
        }
    }
}