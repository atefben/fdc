<?php

namespace FDC\MarcheDuFilmBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;

class ExceptionController extends Controller
{
    public function showExceptionAction(FlattenException $exception, DebugLoggerInterface $logger)
    {
        $request = $this->get('request');
        $locale = $request->getLocale();

        if($exception->getStatusCode() === 404) {
            $notFound404Manager = $this->get('mdf.manager.404');

            $headerFooterManager = $this->get('mdf.manager.header_footer');
            $banner = $headerFooterManager->getHeaderBanner($locale);

            return $this->render('FDCMarcheDuFilmBundle::exceptions/error404.html.twig', array(
                'notFound404PageContent' => $notFound404Manager->get404PageContent($locale),
                'banner' => $banner
            ));
        }
    }
}
