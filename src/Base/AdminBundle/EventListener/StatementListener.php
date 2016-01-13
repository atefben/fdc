<?php

namespace Base\AdminBundle\EventListener;

use \DateTime;

use Base\CoreBundle\Entity\StatementArticleTranslation;

use Doctrine\ORM\Event\LifecycleEventArgs;

use Doctrine\ORM\Event\PostFlushEventArgs;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

/**
 * Class StatementListener
 * @package Base\CoreBundle\Listener
 */
class StatementListener
{
    /**
     * @var TokenStorage
     */
    private $tokenStorage;

    /**
     * @var bool
     */
    private $flush;

    /**
     * @param TokenStorage $tokenStorage
     */
    public function __construct(TokenStorage $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
        $this->flush  = false;
    }

    /**
     * @param LifecycleEventArgs $args
     */
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
        if (method_exists($entity, 'getTranslatable') && method_exists($entity, 'setCreatedBy') &&
            $entity->getCreatedBy() === null && $this->tokenStorage->getToken()) {
            $entity->setCreatedBy($this->tokenStorage->getToken()->getUser());
        }

        if (method_exists($entity, 'getTranslatable') && method_exists($entity->getTranslatable(), 'setPublishedAt')) {
            $this->setPublishedAt($entity, false);
        }
    }


    /**
     * @param $args
     */
    public function preUpdate($args)
    {
        $entity = $args->getEntity();

        // set updatedBy
        if (method_exists($entity, 'getTranslatable') && method_exists($entity->getTranslatable(), 'setUpdatedBy') &&
            $this->tokenStorage->getToken()) {
            $entity->getTranslatable()->setUpdatedBy($this->tokenStorage->getToken()->getUser());
            $this->flush = true;
        }

        if (method_exists($entity, 'getTranslatable') && method_exists($entity->getTranslatable(), 'setPublishedAt')) {
            $this->setPublishedAt($entity);
        }
    }

    /**
     * @param $entity
     * @param bool $update
     */
    private function setPublishedAt($entity, $update = true)
    {
        if (method_exists($entity->getTranslatable(), 'setPublishedAt') &&
            method_exists($entity, 'getStatus') && $entity->getStatus() == StatementArticleTranslation::STATUS_PUBLISHED &&
            ($entity->getTranslatable()->getPublishedAt() === null)) {
            $entity->getTranslatable()->setPublishedAt(new DateTime());
            if ($update == true) {
                $this->flush = true;
            }
        }

    }

    /**
     * @param PostFlushEventArgs $eventArgs
     */
    public function postFlush(PostFlushEventArgs $eventArgs)
    {
        if ($this->flush == true) {
            $this->flush = false;
            $eventArgs->getEntityManager()->flush();
        }
    }
}