<?php

namespace FDC\MarcheDuFilmBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class KernelRequestListener
{
    protected $host;

    protected $locales;

    public function __construct($host, $locales)
    {
        $this->host = $host;
        $this->locales = $locales;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if ($event->getRequest()->getHost() == $this->host && !in_array($event->getRequest()->getLocale(), $this->locales)) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
        }
    }
}