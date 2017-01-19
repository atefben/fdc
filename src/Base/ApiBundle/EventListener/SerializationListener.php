<?php
namespace Base\ApiBundle\EventListener;

use Application\Sonata\MediaBundle\Provider\ImageProvider;
use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;

/**
 * Add data after serialization

 */
class SerializationListener implements EventSubscriberInterface
{

    /**
     * @var ImageProvider
     */
    private $imageProvider;

    static public function getSubscribedEvents()
    {
        return array(
            array(
                'event'  => 'serializer.post_serialize',
                'class'  => 'Application\Sonata\MediaBundle\Entity\Media',
                'method' => 'onPostSerializeMedia',
            ),
            array(
                'event'  => 'serializer.post_serialize',
                'method' => 'onPostSerializeAll',
            ),
        );
    }

    public function setMediaImageProvider(ImageProvider $imageProvider)
    {
        $this->imageProvider = $imageProvider;
    }

    public function onPostSerializeMedia(ObjectEvent $event)
    {
        if ($event->getObject()->getContext() == 'pdf') {
            $event->getVisitor()->addData('url', str_replace(' ', '%20', $this->imageProvider->generatePublicUrl($event->getObject(), 'reference')));
        } else {
            $event->getVisitor()->addData('url', str_replace(' ', '%20', $this->imageProvider->generatePublicUrl($event->getObject(), $event->getObject()->getContext() . '_mobile')));
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