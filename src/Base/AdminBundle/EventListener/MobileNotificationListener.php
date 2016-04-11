<?php
/**
 * Created by PhpStorm.
 * User: jeapet
 * Date: 11/04/2016
 * Time: 17:05
 */

namespace Base\AdminBundle\EventListener;

use Base\CoreBundle\Entity\MobileNotification;
use Base\CoreBundle\Entity\MobileNotificationTranslation;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
/**
 * Class MobileNotificationListener
 * @package Base\AdminBundle\EventListener
 */
class MobileNotificationListener
{

    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $object = $args->getObject();

        if ($object instanceof MobileNotification) {
            $this->sendTestMobileNotification($object);
        } elseif ($object instanceof MobileNotificationTranslation) {
            $this->sendTestMobileNotification($object->getTranslatable());
        }

    }

    /**
     * @param $args
     */
    public function preUpdate(PreUpdateEventArgs $args)
    {
        $object = $args->getObject();

        if ($object instanceof MobileNotification) {
            $this->sendTestMobileNotification($object);
        } elseif ($object instanceof MobileNotificationTranslation) {
            $this->sendTestMobileNotification($object->getTranslatable());
        }
    }

    public function sendTestMobileNotification(MobileNotification $object)
    {
        $token = $object->getToken();

        foreach ($object->getTranslations() as $translation) {
            $published  = $translation->getStatus() === MobileNotificationTranslation::STATUS_PUBLISHED;
            $published = $published || MobileNotificationTranslation::STATUS_TRANSLATION_VALIDATING;
            $title = $translation->getTitle();
            $message = $translation->getDescription();

        }
    }

}