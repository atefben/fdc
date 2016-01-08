<?php

namespace Base\CoreBundle\Listener;

use \DateTime;

use Base\CoreBundle\Entity\NewsArticleTranslation;

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
        if (method_exists($entity, 'getTranslatable') && method_exists($entity->getTranslatable(), 'setCreatedBy') &&
            $entity->getTranslatable()->getCreatedBy() === null && $this->tokenStorage->getToken()) {
            $entity->setCreatedBy($this->tokenStorage->getToken()->getUser());
        }

        if (method_exists($entity, 'setPublishedAt')) {
            $this->setPublishedAt($entity);
        }
    }


    public function preUpdate($args)
    {
        $entity = $args->getEntity();

        // TODO: update is not working

        // set updatedBy
        if (method_exists($entity, 'getTranslatable') && method_exists($entity->getTranslatable(), 'setUpdatedBy') &&
            $this->tokenStorage->getToken()) {
            $entity->getTranslatable()->setUpdatedBy($this->tokenStorage->getToken()->getUser());
        }

      //  $this->setPublishedAt($entity);
    }

    private function setPublishedAt($entity)
    {
error_log(get_class($entity->getTranslatable()));
        $entity->getTranslatable()->setPublishedAt(new DateTime());

        if (method_exists($entity, 'getTranslatable') && method_exists($entity->getTranslatable(), 'setPublishedAt') &&
            method_exists($entity, 'getStatus') && $entity->getStatus() == NewsArticleTranslation::STATUS_PUBLISHED &&
            ($entity->getTranslatable()->getPublishedAt() === null)) {
            die();
            $entity->getTranslatable()->setPublishedAt(new DateTime());
        }
    }
}