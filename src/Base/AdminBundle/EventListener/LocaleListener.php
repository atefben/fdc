<?php

namespace Base\AdminBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class LocaleListener implements EventSubscriberInterface
{
    private $defaultLocale;

    public function __construct($defaultLocale)
    {
        $this->defaultLocale = $defaultLocale;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        if (!$request->hasPreviousSession()) {
            return;
        }

        // try to see if the locale has been set as a _locale routing parameter
        // only set fr for admin
        if (false !== strpos($request->getPathInfo(), '/cn')) {
            $event->setResponse(new RedirectResponse(str_replace('/cn', '/zh', $request->getPathInfo()), 301));
        }
        if ('cn' == $request->attributes->get('_locale')) {
            dump($request->attributes->get('_route'));
            dump($request->attributes->get('_route_params'));
            die;
        }
        if ($locale = $request->attributes->get('_locale')) {
            $request->getSession()->set('_locale', 'fr');
        } else {
            // if no explicit locale has been set on this request, use one from the session
            $request->setLocale($request->getSession()->get('_locale', $this->defaultLocale));
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            // must be registered before the default Locale listener
            KernelEvents::REQUEST => [['onKernelRequest', 17]],
        ];
    }
}