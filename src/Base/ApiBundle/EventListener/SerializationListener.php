<?php
namespace Base\ApiBundle\EventListener;

use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;
use JMS\Serializer\GraphNavigator;

/**
 * Add data after serialization
 *
 * @Service("base.api.serialization_listener")
 * @Tag("jms_serializer.event_subscriber")
 */
class SerializationListener implements EventSubscriberInterface
{

    static public function getSubscribedEvents()
    {
        return array(
            array(
                'event' => 'serializer.post_serialize',
                'class' => 'Application\Sonata\MediaBundle\Entity\Media',
                'method' => 'onPostSerializeMedia'
            ),

        );
    }

    public function onPostSerializeMedia(ObjectEvent $event)
    {
        global $kernel;
        $imageProvider = $kernel->getContainer()->get('sonata.media.provider.image');

        $event->getVisitor()->addData('url', $imageProvider->generatePublicUrl($event->getObject(), $event->getObject()->getContext().'_mobile'));
    }

    public function onPostSerializeNews(ObjectEvent $event)
    {
    }
}