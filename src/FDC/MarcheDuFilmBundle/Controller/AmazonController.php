<?php

namespace FDC\MarcheDuFilmBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AmazonController extends Controller
{
    /**
     * @Route("/download-pdf/{url}/{name}", name="fdc_marche_du_film_download_pdf")
     */
    public function downloadPdfAction(Request $request, $url, $name)
    {
        $url = urldecode($url);
        $file = file_get_contents(trim($url));

        $response = new Response($file);
        if (strpos($url, '.pdf')) {
            $response->headers->set('Content-Type', 'application/pdf');
        } else {
            $response->headers->set('Content-Type', 'application/eps');
        }
        $response->headers->set( 'Content-Disposition', 'attachment; filename=' . $name);

        return $response;
    }
    /**
     * @Route("/download-image/{url}/{name}", name="fdc_marche_du_film_download_image")
     */
    public function downloadImageAction(Request $request, $url, $name)
    {
        $url = urldecode($url);
        $file = file_get_contents(trim($url));
        $ext = pathinfo($url, PATHINFO_EXTENSION);

        $response = new Response($file);
        switch ($ext) {
            case 'jpg':
            case 'jpeg':
                $response->headers->set('Content-Type', 'image/jpeg');
                break;
            case 'png':
                $response->headers->set('Content-Type', 'image/png');
            case 'gif':
                $response->headers->set('Content-Type', 'image/gif');
            case 'tif':
            case 'tiff':
                $response->headers->set('Content-Type', 'image/tiff');
        }

        $response->headers->set( 'Content-Disposition', 'attachment; filename=' . $name);

        return $response;
    }
}
