<?php

namespace Base\CoreBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;

use Base\CoreBundle\Entity\MediaVideo;

class MediaVideoListener
{
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof MediaVideo) {
            $em = $args->getEntityManager();
            $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
            $entity->setFestival($settings->getFestival());
        }
    }
}