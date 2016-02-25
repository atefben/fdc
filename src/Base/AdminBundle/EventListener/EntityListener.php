<?php

namespace Base\AdminBundle\EventListener;

use Application\Sonata\MediaBundle\Entity\Media;
use Application\Sonata\MediaBundle\Model\MediaInterface;
use Base\CoreBundle\Entity\MediaAudio;
use Base\CoreBundle\Entity\MediaAudioTranslation;
use Base\CoreBundle\Entity\MediaVideoTranslation;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use \DateTime;

use Base\CoreBundle\Entity\NewsArticleTranslation;

use Doctrine\ORM\Event\LifecycleEventArgs;

use Doctrine\ORM\Event\PostFlushEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
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

    private $toTranslate = array();

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

        if (method_exists($entity, 'getTranslate')) {
            $languages = array('en', 'zh', 'es');
            if ($entity->getTranslate()) {
                foreach ($entity->getTranslateOptions() as $option) {
                    if (array_key_exists($option, $languages)) {
                        $translation = $entity->findTranslationByLocale($languages[$option]);
                        $translation->setStatus(TranslateChildInterface::STATUS_TRANSLATION_PENDING);
                        $args->getEntityManager()->persist($translation);
                    }
                }
            }
        }


    }

    /**
     * @param $args
     */
    public function preUpdate(PreUpdateEventArgs $args)
    {

        $entity = $args->getEntity();
        if (method_exists($entity, 'getTranslate')) {
            if ($args->hasChangedField('translateOptions')) {
                $languages = array('en', 'zh', 'es');
                foreach ($args->getNewValue('translateOptions') as $newOption) {
                    if (!in_array($newOption, $args->getOldValue('translateOptions'))) {
                        $translation = $entity->findTranslationByLocale($languages[$newOption]);
                        if (!$translation->getStatus()) {
                            $this->toTranslate[] = $translation; // go to the post flush function to see the next operations
                        }
                    }
                }
            }
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
            method_exists($entity, 'getStatus') && $entity->getStatus() == NewsArticleTranslation::STATUS_PUBLISHED &&
            ($entity->getTranslatable()->getPublishedAt() === null)
        ) {
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

        if ($this->toTranslate) {
            $mustPersist = false;
            foreach ($this->toTranslate as $translation) {
                if (!$translation->getStatus()) {
                    $translation->setStatus(TranslateChildInterface::STATUS_TRANSLATION_PENDING);
                    $eventArgs->getEntityManager()->persist($translation);
                    $mustPersist = true;
                }

            }
            $this->toTranslate = array();
            if ($mustPersist) {
                $eventArgs->getEntityManager()->flush();
            }
        }
    }

    public function postUpdate(LifecycleEventArgs $eventArgs) {
        $object =  $eventArgs->getObject();
        if ($object instanceof Media) {
            if ($object->getParentAudioTranslation() || $object->getParentVideoTranslation()) {
                $this->flush = true;
            }
        }
    }

    public function postPersist(LifecycleEventArgs $eventArgs)
    {
        $object =  $eventArgs->getObject();
        if ($object instanceof Media) {
            if ($object->getParentAudioTranslation() || $object->getParentVideoTranslation()) {
                $this->flush = true;
            }
        }
    }
}