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
            if ($object->getSendTest()) {
                $object->setSendTest(false);
                $this->sendTestMobileNotification($object);
            }
        } elseif ($object instanceof MobileNotificationTranslation) {
            $mobileNotification = $object->getTranslatable();
            if ($mobileNotification->getSendTest()) {
                $mobileNotification->setSendTest(false);
                $this->sendTestMobileNotification($mobileNotification);
            }
        }

    }

    /**
     * @param $args
     */
    public function preUpdate(PreUpdateEventArgs $args)
    {
        $object = $args->getObject();

        if ($object instanceof MobileNotification) {
            if ($object->getSendTest()) {
                $object->setSendTest(false);
                $this->sendTestMobileNotification($object);
            }
        } elseif ($object instanceof MobileNotificationTranslation) {
            $mobileNotification = $object->getTranslatable();
            if ($mobileNotification->getSendTest()) {
                $mobileNotification->setSendTest(false);
                $this->sendTestMobileNotification($mobileNotification);
            }
        }
    }

    public function sendTestMobileNotification(MobileNotification $object)
    {
        $token = $object->getToken();

        foreach ($object->getTranslations() as $translation) {
            $published = $translation->getStatus() === MobileNotificationTranslation::STATUS_PUBLISHED;
            $published = $published || $translation->getStatus() === MobileNotificationTranslation::STATUS_TRANSLATION_VALIDATING;
            $title = $translation->getTitle();
            $message = $translation->getDescription();
			//TODO CODE NOTIFICATION ICI
        }
    }

}