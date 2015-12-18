<?php

namespace Base\CoreBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;

use Base\CoreBundle\Entity\NewsArticle;
use Base\CoreBundle\Entity\NewsAudio;
use Base\CoreBundle\Entity\NewsImage;
use Base\CoreBundle\Entity\NewsVideo;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class NewsListener
{
    private $tokenStorage;

    public function __construct(TokenStorage $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof NewsArticle || $entity instanceof NewsAudio ||
            $entity instanceof NewsImage || $entity instanceof NewsVideo) {
            // set festival year
            $em = $args->getEntityManager();
            $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
            $entity->setFestival($settings->getFestival());

            // set createdBy
            if ($this->tokenStorage->getToken()) {
                $entity->setUpdatedBy($this->tokenStorage->getToken()->getUser());
            }
        }
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof NewsArticle || $entity instanceof NewsAudio ||
            $entity instanceof NewsImage || $entity instanceof NewsVideo) {
            // set updatedby
            var_dump(get_class($this->tokenStorage->getToken()));
            die();
            $entity->setUpdatedBy($this->tokenStorage->getToken());
        }
    }

}