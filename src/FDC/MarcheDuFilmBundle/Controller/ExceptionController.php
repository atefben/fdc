<?php

namespace FDC\MarcheDuFilmBundle\Controller;

use FDC\CourtMetrageBundle\Manager\ExceptionManager;
use FDC\MarcheDuFilmBundle\Manager\HeaderFooterManager;
use FDC\MarcheDuFilmBundle\Manager\NotFoundExceptionManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Templating\TemplateReference;
use Symfony\Component\HttpKernel\Exception\FlattenException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;

class ExceptionController extends \Symfony\Bundle\TwigBundle\Controller\ExceptionController
{
    protected $notFound404Manager;
    protected $headerFooterManager;
    protected $mdfDomain;
    protected $ccmDomain;
    /**
     * @var ExceptionManager
     */
    protected $ccmExceptionManager;

    public function __construct(\Twig_Environment $twig, $debug, NotFoundExceptionManager $notFound404Manager, HeaderFooterManager $headerFooterManager, $mdfDomain)
    {
        parent::__construct($twig, $debug);

        $this->notFound404Manager = $notFound404Manager;
        $this->headerFooterManager = $headerFooterManager;
        $this->mdfDomain = $mdfDomain;

    }

    public function showAction(Request $request, FlattenException $exception, DebugLoggerInterface $logger = null)
    {
        $requestHeaders = $request->server->getHeaders();

        if($requestHeaders['HOST'] == $this->mdfDomain)
        {
            $locale = $request->getLocale();

            if($exception->getStatusCode() === 404) {
                $banner = $this->headerFooterManager->getHeaderBanner($locale);
                $availableMenu = $this->headerFooterManager->getMenuAvailability();

                return new Response($this->twig->render('FDCMarcheDuFilmBundle::exceptions/error404.html.twig', array(
                    'notFound404PageContent' => $this->notFound404Manager->get404PageContent($locale),
                    'banner' => $banner,
                    'availableMenu' => $availableMenu,
                )));
            }
        } elseif ($requestHeaders['HOST'] == $this->ccmDomain /*&& $this->debug == false*/) {
            $locale = $request->getLocale();

            if ($exception->getStatusCode() === 404) {

                return $this->ccmExceptionManager->render404Page($locale);
            }
            
            if ($exception->getStatusCode() === 500) {
                
                return $this->ccmExceptionManager->render500Page($locale);
            }
        }

        $currentContent = $this->getAndCleanOutputBuffering($request->headers->get('X-Php-Ob-Level', -1));
        $showException = $request->attributes->get('showException', $this->debug); // As opposed to an additional parameter, this maintains BC

        $code = $exception->getStatusCode();

        return new Response($this->twig->render(
            (string) $this->findTemplate($request, $request->getRequestFormat(), $code, $showException),
            array(
                'status_code' => $code,
                'status_text' => isset(Response::$statusTexts[$code]) ? Response::$statusTexts[$code] : '',
                'exception' => $exception,
                'logger' => $logger,
                'currentContent' => $currentContent,
            )
        ));
    }

    protected function findTemplate(Request $request, $format, $code, $showException)
    {
        $name = $showException ? 'exception' : 'error';
        if ($showException && 'html' == $format) {
            $name = 'exception_full';
        }

        // For error pages, try to find a template for the specific HTTP status code and format
        if (!$showException) {
            $template = new TemplateReference('TwigBundle', 'Exception', $name.$code, $format, 'twig');
            if ($this->templateExists($template)) {
                return $template;
            }
        }

        // try to find a template for the given format
        $template = new TemplateReference('TwigBundle', 'Exception', $name, $format, 'twig');
        if ($this->templateExists($template)) {
            return $template;
        }

        // default to a generic HTML exception
        $request->setRequestFormat('html');

        return new TemplateReference('TwigBundle', 'Exception', $showException ? 'exception_full' : $name, 'html', 'twig');
    }
    
    /**
     * @param string $ccmDomain
     */
    public function setCcmDomain($ccmDomain)
    {
        $this->ccmDomain = $ccmDomain;
    }

    /**
     * @param ExceptionManager $ccmExceptionManager
     */
    public function setCcmExceptionManager($ccmExceptionManager)
    {
        $this->ccmExceptionManager = $ccmExceptionManager;
    }
}
