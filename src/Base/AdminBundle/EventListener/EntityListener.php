<?php

namespace Base\AdminBundle\EventListener;

use \DateTime;

use Base\CoreBundle\Entity\NewsArticleTranslation;

use Doctrine\ORM\Event\LifecycleEventArgs;

use Doctrine\ORM\Event\PostFlushEventArgs;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

/**
 * Class EntityListener
 * @package Base\CoreBundle\Listener
 */
class EntityListener
{
    /**
     * @var bool
     */
    private $flush;

    public function __construct()
    {
        $this->flush = false;
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
            if ($settings !== null) {
                $entity->setFestival($settings->getFestival());
            }
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
            method_exists($entity, 'getStatus') && $entity->getStatus() == NewsArticleTranslation::STATUS_PUBLISHED &&
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
        if ($this->flush === true) {
            $this->flush = false;
            $eventArgs->getEntityManager()->flush();
        }
    }
}