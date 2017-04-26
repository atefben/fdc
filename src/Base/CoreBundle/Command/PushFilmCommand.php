<?php

namespace Base\CoreBundle\Command;

use Base\CoreBundle\Entity\PushFilmMobile;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PushFilmCommand extends ContainerAwareCommand
{
    protected $messages = [];

    protected function configure()
    {
        $this->setName('base:core:push-film');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $pushes = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:PushFilmMobile')
            ->getByDailyFilms()
        ;

        $this->messages = [
            'fr' => $this->getContainer()->get('base.variable')->get('push_film_fr_message'),
            'en' => $this->getContainer()->get('base.variable')->get('push_film_en_message'),
        ];

        dump($pushes);

        foreach ($pushes as $push) {
            $this->sendMobileNotification($push);
        }
    }

    public function sendMobileNotification(PushFilmMobile $push)
    {
        $message = $this->messages[$push->getLocale()] . ' ' .$push->getFilm()->getTitleVO();

        if (strtolower($push->getOs()) == 'android') {
            $payLoad = $this->getAndroidNewMessagePayload($message);
            $this->sendPushAndroid([$push->getUuid()], $payLoad);
        } else {
            $conn = $this->getApnsConnection();
            $conn->add($this->setNewMessage(trim($device->getUuid()), $translation->getDescription(), 1));
            $this->sendPushIos($conn);
        }
    }


    private function getAndroidNewMessagePayload($message)
    {

        $payload = ['type'    => 'MESSAGE',
                    'message' => $message];

        return $payload;
    }

    /**
     * @return \ApnsPHP_Push
     */
    private function getApnsConnection()
    {

        if ($this->getContainer()->getParameter('instancemobile') == 'preprod') {
            $env = \ApnsPHP_Abstract::ENVIRONMENT_SANDBOX;
        } else {
            $env = \ApnsPHP_Abstract::ENVIRONMENT_PRODUCTION;
        }

        $conn = new \ApnsPHP_Push($env, $this->getContainer()->getParameter('apns'));
        $conn->setRootCertificationAuthority($this->getContainer()->getParameter('app'));
        $conn->setProviderCertificatePassphrase('FestivaLDeCanneS2016');
        $conn->connect();

        return $conn;
    }

    private function sendPushIos(\ApnsPHP_Push $conn)
    {
        $conn->send();
        $conn->disconnect();
    }

    private function sendPushAndroid($tokens, $payload)
    {
        $fields = [
            'registration_ids' => $tokens,
            'data'             => $payload
        ];

        $headers = [
            'Authorization: key=AIzaSyCaNXVnhrbVeATqMAgyeOSDOK5iT8G0tcY',
            'Content-Type: application/json'
        ];

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
     * @return ObjectManager
     */
    private function getDoctrineManager()
    {
        return $this->getContainer()->get('doctrine')->getManager();
    }
}