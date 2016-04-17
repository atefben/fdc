<?php

namespace Base\AdminBundle\EventListener;

use Base\CoreBundle\Entity\MobileNotification;
use Base\CoreBundle\Entity\MobileNotificationTranslation;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

require __DIR__.'/../ApnsPHP/Autoload.php';

/**
 * Class MobileNotificationListener
 * @package Base\AdminBundle\EventListener
 */
class MobileNotificationListener
{
	
    /**
     * @var ContainerInterface
     */
    private $container;
	
    public function __construct($container)
    {
        $this->container = $container;
    }

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
        foreach ($object->getTranslations() as $translation) {
            $published = $translation->getStatus() === MobileNotificationTranslation::STATUS_PUBLISHED;
            $published = $published || $translation->getStatus() === MobileNotificationTranslation::STATUS_TRANSLATION_VALIDATING;
			
			$conn = $this->getApnsConnection();
			$conn->add($this->setNewMessage($object->getToken(), $translation->getDescription() , 1));
			$this->sendPush($conn);
		}
    }
	
	private function getApnsConnection()
	{
		$env = \ApnsPHP_Abstract::ENVIRONMENT_PRODUCTION;
		if ($this->container->getParameter('instancemobile') == 'preprod') {
			$env = \ApnsPHP_Abstract::ENVIRONMENT_SANDBOX;
		}
		
		$conn = new \ApnsPHP_Push($env, $this->container->getParameter('apns'));
		$conn->setRootCertificationAuthority($this->container->getParameter('app'));
		$conn->connect();
		
		return $conn;
	}
	
	private function sendPush($conn)
	{
		$conn->send();
		$conn->disconnect();
	}
	
	private function setNewMessage($token, $text, $badges)
	{	
		$message = new \ApnsPHP_Message_Custom($token);
		$message->setBadge($badges);
		$message->setText($text);
		$message->setExpiry(30);
		$message->setSound();
		
		return $message;
	}

}