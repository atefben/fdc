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
            $published = $published || $translation->getStatus() === MobileNotificationTranslation::STATUS_TRANSLATED;

            if ($published) {

                if ($object->getToken() && !$object->getSendToAll()) {
                    $uuids = explode(',', $object->getToken());
                    foreach ($uuids as $uuid) {
                        if (!trim($uuid)) {
                            continue;
                        }

						if(strlen($uuid) == '64') {
                            $conn = $this->getApnsConnection();
                            $conn->add($this->setNewMessage(trim($uuid), $translation->getDescription(), 1));
							$this->sendPushIos($conn);
						} else if(strlen($uuid) == '162') {
                            $payload = $this->setAndroidNewMessagePayload($translation->getDescription());
                            $this->sendPushAndroid(trim($uuid), $payload);
						}
                        
                    }
                } elseif ($object->getSendToAll()) {

                    $tokenandroids = array();
                    $androidDevices = $this->getDevices('android', $translation->getLocale());
                    if(count($androidDevices) > 0) {
                        foreach ($androidDevices as $device) {
                            $tokenandroids[] = trim($device->getUuid());
                        }
                        $payload = $this->setAndroidNewMessagePayload($translation->getDescription());
                        $this->sendPushAndroid($tokenandroids, $payload);
                    }

                    $iosDevices = $this->getDevices('ios', $translation->getLocale());
                    if(count($iosDevices) > 0) {
                        $conn = $this->getApnsConnection();
                        foreach ($iosDevices as $device) {
                            $conn->add($this->setNewMessage(trim($device->getUuid()), $translation->getDescription(), 1));
                        }
                        $this->sendPushIos($conn);
                    }
                }


            }
        }
    }

    /**
     * @param string $os
     * @param string $locale
     * @return mixed
     */
    private function getDevices($os = 'android', $locale = 'fr')
    {
        return $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:PushMobile')
            ->findBy(array('os' => $os, 'lang' => $locale))
            ;
    }


    private function setAndroidNewMessagePayload($message) {

        $payload = array('type'    => 'MESSAGE',
            'message' => $message);

        return $payload;
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

    private function sendPushAndroid($tokens, $payload)
    {
        $fields = array(
            'registration_ids' => $tokens,
            'data' => $payload
        );

        $headers = array(
            'Authorization: key=AIzaSyCaNXVnhrbVeATqMAgyeOSDOK5iT8G0tcY',
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            error_log('ERROR - Curl failed : ' . curl_error($ch));
        }

        curl_close($ch);
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