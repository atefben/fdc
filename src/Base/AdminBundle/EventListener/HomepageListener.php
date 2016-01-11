<?php

namespace Base\AdminBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;

/**
 * Class HomepageListener
 * @package Base\CoreBundle\Listener
 */
class HomepageListener
{
    /**
     * @var bool
     */
    private $flush;

    /**
     *
     */
    public function __construct()
    {
        $this->flush  = false;
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (get_class($entity) == 'Base\CoreBundle\Entity\HomepageTranslation') {
            $em = $args->getEntityManager();
            $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
            $entity->getTranslatable()->setFestival($settings->getFestival());
            $this->flush = true;
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