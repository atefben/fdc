<?php

namespace Base\AdminBundle\EventListener;

use Base\CoreBundle\Entity\Info;
use Base\CoreBundle\Entity\News;
use Base\CoreBundle\Entity\Statement;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
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
            $entity->getTranslatable()->getCreatedBy() === null && $this->tokenStorage->getToken()
        ) {
            $entity->getTranslatable()->setCreatedBy($this->tokenStorage->getToken()->getUser());
        }

        if ($entity instanceof News || $entity instanceof Info || $entity instanceof Statement) {
            if ($entity->getMobileDisplay() == 'main') {
                $this->removeMain($args->getObjectManager(), $entity);
            }
        }
    }


    /**
     * @param $args
     */
    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();
        // set updatedBy
        if (method_exists($entity, 'getTranslatable') && method_exists($entity->getTranslatable(), 'setUpdatedBy') &&
            $this->tokenStorage->getToken()
        ) {
            if (is_object($this->tokenStorage->getToken()->getUser())) {
                $entity->getTranslatable()->setUpdatedBy($this->tokenStorage->getToken()->getUser());
                $this->flush = true;
            }
        }

        if ($entity instanceof News || $entity instanceof Info || $entity instanceof Statement) {
            if ($args->hasChangedField('mobileDisplay') && 'main' == $args->getNewValue('mobileDisplay')) {
                $this->removeMain($args->getObjectManager(), $entity);
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


    /**
     * Set previous main news/info/statement as null.
     * @param ObjectManager $manager
     * @param $entity
     */
    private function removeMain(ObjectManager $manager, $entity)
    {
        $newsQb = $manager
            ->getRepository('BaseCoreBundle:News')
            ->createQueryBuilder('n')
            ->andWhere('n.mobileDisplay = :main')
            ->setParameter(':main', 'main')
        ;
        if ($entity instanceof News && $entity->getId()) {
            $newsQb
                ->andWhere('n.id != :id')
                ->setParameter(':id', $entity->getId())
            ;
        }
        $news = $newsQb->getQuery()->getResult();

        $infoQb = $manager
            ->getRepository('BaseCoreBundle:Info')
            ->createQueryBuilder('n')
            ->andWhere('n.mobileDisplay = :main')
            ->setParameter(':main', 'main')
        ;
        if ($entity instanceof Info && $entity->getId()) {
            $infoQb
                ->andWhere('n.id != :id')
                ->setParameter(':id', $entity->getId())
            ;
        }
        $infos = $infoQb->getQuery()->getResult();

        $statementQb = $manager
            ->getRepository('BaseCoreBundle:Statement')
            ->createQueryBuilder('n')
            ->andWhere('n.mobileDisplay = :main')
            ->setParameter(':main', 'main')
        ;
        if ($entity instanceof Statement && $entity->getId()) {
            $statementQb
                ->andWhere('n.id != :id')
                ->setParameter(':id', $entity->getId())
            ;
        }
        $statements = $statementQb->getQuery()->getResult();

        $items = array_merge($news, $infos, $statements);

        foreach ($items as $item) {
            $item->setMobileDisplay(null);
        }
    }
}