<?php
namespace Base\ApiBundle\EventListener;

use Base\CoreBundle\Entity\MediaImage;
use Base\CoreBundle\Entity\MediaImageSimple;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;
use JMS\Serializer\EventDispatcher\PreSerializeEvent;
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
                'event'  => 'serializer.post_serialize',
                'class'  => 'Application\Sonata\MediaBundle\Entity\Media',
                'method' => 'onPostSerializeMedia'
            ),
            array(
                'event'  => 'serializer.post_serialize',
                'method' => 'onPostSerializeAll'
            ),
        );
    }

    public function onPostSerializeMedia(ObjectEvent $event)
    {
        global $kernel;
        $imageProvider = $kernel->getContainer()->get('sonata.media.provider.image');

        if ($event->getObject()->getContext() == 'pdf') {
            $event->getVisitor()->addData('url', str_replace(' ', '%20', $imageProvider->generatePublicUrl($event->getObject(), 'reference')));
        } else {
            $event->getVisitor()->addData('url', str_replace(' ', '%20', $imageProvider->generatePublicUrl($event->getObject(), $event->getObject()->getContext() . '_mobile')));
        }
    }

    public function onPostSerializeAll(ObjectEvent $event)
    {
        $object = $event->getObject();
        if (method_exists($object, 'getPublishedAt') && method_exists($object, 'setPublishedAt')) {
            if (!$object->getPublishedAt()) {
                $object->setPublishedAt(new \DateTime());
            }
        }
    }

    public function onPostSerializeNews(ObjectEvent $event)
    {
    }
}