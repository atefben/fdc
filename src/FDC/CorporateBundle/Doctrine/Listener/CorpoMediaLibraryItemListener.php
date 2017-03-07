<?php

namespace FDC\CorporateBundle\Doctrine\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use FDC\CorporateBundle\Manager\CorpoMediaLibraryItemManager;

class CorpoMediaLibraryItemListener
{
    /**
     * @var CorpoMediaLibraryItemManager
     */
    private $corpoMediaLibraryItemManager;

    public function setCorpoMediaLibraryItemManager(CorpoMediaLibraryItemManager $manager)
    {
        $this->corpoMediaLibraryItemManager = $manager;
    }


    public function postPersist(LifecycleEventArgs $args)
    {
        $this->corpoMediaLibraryItemManager->sync($args->getObject());
    }


    public function postUpdate(LifecycleEventArgs $args)
    {
        $this->corpoMediaLibraryItemManager->sync($args->getObject());
    }
}