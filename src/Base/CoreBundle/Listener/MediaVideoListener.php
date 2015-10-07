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
            $settings = $em->getRepository('BaseCoreBundle:Settings')->getFestivalSettings();

            if ($settings !== null) {
                $festival = $em->getRepository('BaseCoreBundle:FilmFestival')->findOneBy(array(
                    'year' => $settings->getYear()
                ));
                $entity->setFestival($festival);
            }
        }
    }
}