<?php

namespace FDC\MarcheDuFilmBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class KernelRequestListener
{
    protected $host;

    protected $locales;

    protected $defaultLocale;

    public function __construct($host, $locales, $defaultLocale)
    {
        $this->host = $host;
        $this->locales = $locales;
        $this->defaultLocale = $defaultLocale;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        if ($locale = $request->get('locale')) {
            $request->getSession()->set('_locale', $locale);
        } else if ($locale = $request->attributes->get('_locale')) {
            $request->getSession()->set('_locale', $locale);
        } else {
            // if no explicit locale has been set on this request, use one from the session
            $request->setLocale($request->getSession()->get('_locale', $this->defaultLocale));
        }

        if ($request->getHost() == $this->host && !in_array($request->getLocale(), $this->locales)) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
        }
    }
}