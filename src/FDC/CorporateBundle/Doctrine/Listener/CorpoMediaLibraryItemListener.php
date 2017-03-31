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
        try {
            $this->corpoMediaLibraryItemManager->sync($args->getObject());
        } catch (\Exception $e) {
        }
    }


    public function postUpdate(LifecycleEventArgs $args)
    {
        try {
            $this->corpoMediaLibraryItemManager->sync($args->getObject());
        } catch (\Exception $e) {
        }
    }
}