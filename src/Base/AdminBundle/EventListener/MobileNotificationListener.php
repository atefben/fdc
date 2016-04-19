<?php

namespace Base\AdminBundle\EventListener;

use Base\CoreBundle\Entity\MobileNotification;
use Base\CoreBundle\Entity\MobileNotificationTranslation;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

require __DIR__ . '/../ApnsPHP/Autoload.php';

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
                $this->sendMobileNotification($object);
            }
        } elseif ($object instanceof MobileNotificationTranslation) {
            $mobileNotification = $object->getTranslatable();
            if ($mobileNotification->getSendTest()) {
                $mobileNotification->setSendTest(false);
                $this->sendMobileNotification($mobileNotification);
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
                $this->sendMobileNotification($object);
            }
        } elseif ($object instanceof MobileNotificationTranslation) {
            $mobileNotification = $object->getTranslatable();
            if ($mobileNotification->getSendTest()) {
                $mobileNotification->setSendTest(false);
                $this->sendMobileNotification($mobileNotification);
            }
        }
    }

    public function sendMobileNotification(MobileNotification $object)
    {
        foreach ($object->getTranslations() as $translation) {
            $published = $translation->getStatus() === MobileNotificationTranslation::STATUS_PUBLISHED;
            $published = $published || $translation->getStatus() === MobileNotificationTranslation::STATUS_TRANSLATION_VALIDATING;

            if ($published) {
                if ($object->getToken() && !$object->getSendToAll()) {
                    $uuids = explode(',', $object->getToken());
                    foreach ($uuids as $uuid) {
                        if (!trim($uuid)) {
                            continue;
                        }
                        $conn = $this->getApnsConnection();
                        $conn->add($this->setNewMessage(trim($uuid), $translation->getDescription(), 1));
						if(strlen($uuid) == '65') {
							$this->sendPushIos($conn);
						} else {
							 $this->sendPushAndroid($conn);
						}
                        
                    }
                } elseif ($object->getSendToAll()) {

                    $androidDevices = $this->getDevices('android');
                    foreach ($androidDevices as $device) {
                        $conn = $this->getApnsConnection();
                        $conn->add($this->setNewMessage(trim($device->getUuid()), $translation->getDescription(), 1));
                        $this->sendPushAndroid($conn);
                    }

                    $iosDevices = $this->getDevices('ios');
                    foreach ($iosDevices as $device) {
                        $conn = $this->getApnsConnection();
                        $conn->add($this->setNewMessage(trim($device->getUuid()), $translation->getDescription(), 1));
                        $this->sendPushIos($conn);
                    }

                }


            }
        }
    }

    /**
     * @param string $os
     * @return mixed
     */
    private function getDevices($os = 'android')
    {
        return $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:PushMobile')
            ->findBy(array('os' => $os))
            ;
    }


    private function getApnsConnection()
    {
        
        if ($this->container->getParameter('instancemobile') == 'preprod')
		{
            $env = \ApnsPHP_Abstract::ENVIRONMENT_SANDBOX;
        }
		else
		{
        	$env = \ApnsPHP_Abstract::ENVIRONMENT_PRODUCTION;
        }

        $conn = new \ApnsPHP_Push($env, $this->container->getParameter('apns'));
        $conn->setRootCertificationAuthority($this->container->getParameter('app'));
		$conn->setProviderCertificatePassphrase('FestivaLDeCanneS2016');
        $conn->connect();

        return $conn;
    }

    private function sendPushIos($conn)
    {
        $conn->send();
        $conn->disconnect();
    }

    private function sendPushAndroid($conn)
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

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager|object
     */
    private function getDoctrineManager()
    {
        return $this->container->get('doctrine')->getManager();
    }

}