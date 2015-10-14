<?php

namespace Base\CoreBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;

use Base\CoreBundle\Entity\NewsArticle;
use Base\CoreBundle\Entity\NewsAudio;
use Base\CoreBundle\Entity\NewsImage;
use Base\CoreBundle\Entity\NewsVideo;

class NewsListener
{
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof NewsArticle || $entity instanceof NewsAudio ||
            $entity instanceof NewsImage || $entity instanceof NewsVideo) {
            $em = $args->getEntityManager();
            $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
            $entity->setFestival($settings->getFestival());
        }
    }
}