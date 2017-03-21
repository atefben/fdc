<?php

namespace Base\CoreBundle\Doctrine\Listener;

use Base\CoreBundle\Component\Interfaces\NodeAudioInterface;
use Base\CoreBundle\Component\Interfaces\NodeImageInterface;
use Base\CoreBundle\Component\Interfaces\NodeInterface;
use Base\CoreBundle\Component\Interfaces\NodeTranslationInterface;
use Base\CoreBundle\Component\Interfaces\NodeVideoInterface;
use Base\CoreBundle\Entity\Node;
use Base\CoreBundle\Entity\NodeTranslation;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Event\PostFlushEventArgs;

class NodeListener
{

    private $needsFlush = false;

    private $nodes;
    private $nodeTranslations;

    public function postFlush(PostFlushEventArgs $eventArgs)
    {
        if ($this->needsFlush) {
            $this->needsFlush = false;
            $eventArgs->getEntityManager()->flush();
        }
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        if ($args->getObject() instanceof NodeInterface || $args->getObject() instanceof NodeTranslationInterface) {
            $this->syncNode($args);
        }
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        if ($args->getObject() instanceof NodeInterface || $args->getObject() instanceof NodeTranslationInterface) {
            $this->syncNode($args);
        }
    }

    private function syncNode(LifecycleEventArgs $args)
    {
        $manager = $args->getObjectManager();
        $object = $args->getObject();

        if ($object instanceof NodeTranslationInterface) {
            $object = $object->getTranslatable();
        }

        $node = $this->getNode($manager, get_class($object), $object->getId());

        $node
            ->setFestival($object->getFestival())
            ->setPublishedAt($object->getPublishedAt())
            ->setPublishEndedAt($object->getPublishEndedAt())
            ->setCreatedBy($object->getCreatedBy())
            ->setUpdatedBy($object->getUpdatedBy())
            ->setDisplayedHome($object->getDisplayedHome())
            ->setDisplayedMobile($object->getDisplayedMobile())
            ->setDisplayedOnCorpoHome($object->isDisplayedOnCorpoHome())
            ->setSignature($object->getSignature())
            ->setMainImage($object->getHeader())
            ->setTypeClone($object->getTypeClone())
        ;

        if ($object instanceof NodeAudioInterface) {
            $node->setMainAudio($object->getAudio());
        }

        if ($object instanceof NodeImageInterface) {
            $node->setMainGallery($object->getGallery());
        }

        if ($object instanceof NodeVideoInterface) {
            $node->setMainVideo($object->getVideo());
        }

        foreach ($object->getSites() as $site) {
            $node->addSite($site);
        }

        foreach ($object->getTranslations() as $translation) {
            if ($translation instanceof NodeTranslationInterface) {
                $nodeTranslation = $this->getNodeTranslation($manager, get_class($translation), $translation->getId(), $node);
                $nodeTranslation
                    ->setTitle($translation->getTitle())
                    ->setIntroduction($translation->getIntroduction())
                    ->setSlug($translation->getSlug())
                    ->setStatus($translation->getStatus())
                    ->setLocale($translation->getLocale())
                ;
            }
        }

        $this->needsFlush = true;
    }

    /**
     * @param ObjectManager $manager
     * @param $class
     * @param $id
     * @return Node
     */
    private function getNode(ObjectManager $manager, $class, $id)
    {
        if (empty($this->nodes[$class][$id])) {
            $node = $manager
                ->getRepository('BaseCoreBundle:Node')
                ->findOneBy([
                    'entityClass' => $class,
                    'entityId'    => $id,
                ])
            ;
        }
        else {
            $node = $this->nodes[$class][$id];
        }


        if (!$node) {
            $node = new Node();
            $node
                ->setEntityClass($class)
                ->setEntityId($id)
            ;
            $manager->persist($node);
        }
        $this->nodes[$class][$id] = $node;
        return $node;
    }

    /**
     * @param ObjectManager $manager
     * @param $class
     * @param $id
     * @param Node $node
     * @return NodeTranslation
     */
    private function getNodeTranslation(ObjectManager $manager, $class, $id, Node $node)
    {
        if (empty($this->nodeTranslations[$class][$id])) {
            $nodeTranslation = $manager
                ->getRepository('BaseCoreBundle:NodeTranslation')
                ->findOneBy([
                    'entityClass' => $class,
                    'entityId'    => $id,
                    'translatable' => $node->getId(),
                ])
            ;
        }
        else {
            $nodeTranslation = $this->nodeTranslations[$class][$id];
        }


        if (!$nodeTranslation) {
            $nodeTranslation = new NodeTranslation();
            $nodeTranslation
                ->setEntityClass($class)
                ->setEntityId($id)
            ;

            $node->addTranslation($nodeTranslation);
        }
        $this->nodeTranslations[$class][$id] = $nodeTranslation;

        return $nodeTranslation;
    }

}
