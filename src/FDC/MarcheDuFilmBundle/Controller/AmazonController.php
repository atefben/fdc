<?php

namespace FDC\MarcheDuFilmBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AmazonController extends Controller
{
    /**
     * @Route("/amazon/{url}/{name}", name="fdc_marche_du_film_amazon")
     */
    public function downloadAction(Request $request, $url, $name)
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
}
