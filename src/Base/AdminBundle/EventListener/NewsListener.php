<?php

namespace Base\AdminBundle\EventListener;

use \DateTime;

use Base\CoreBundle\Entity\NewsArticleTranslation;

use Doctrine\ORM\Event\LifecycleEventArgs;

use Doctrine\ORM\Event\PostFlushEventArgs;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

/**
 * Class NewsListener
 * @package Base\CoreBundle\Listener
 */
class NewsListener
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
        $this->flush = false;
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        
        // set createdBy
        if (method_exists($entity, 'getTranslatable') && method_exists($entity->getTranslatable(), 'setCreatedBy') &&
            $entity->getTranslatable()->getCreatedBy() === null && $this->tokenStorage->getToken()) {
            $entity->getTranslatable()->setCreatedBy($this->tokenStorage->getToken()->getUser());
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
            if (is_object($this->tokenStorage->getToken()->getUser())) {
            $entity->getTranslatable()->setUpdatedBy($this->tokenStorage->getToken()->getUser());
            $this->flush = true;
            }
        }
    }

    /**
     * @param PostFlushEventArgs $eventArgs
     */
    public function postFlush(PostFlushEventArgs $eventArgs)
    {
        if ($this->flush === true) {
            $this->flush = false;
            $eventArgs->getEntityManager()->flush();
        }
    }
}