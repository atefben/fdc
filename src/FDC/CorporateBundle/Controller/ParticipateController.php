<?php

namespace FDC\CorporateBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use FDC\EventBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @Route("/participer")
 */
class ParticipateController extends Controller
{
    /**
     * @Route("/inscription")
     * @param Request $request
     * @return Response
     */
    public function inscriptionAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $locale = $this->getRequest()->getLocale();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            throw new NotFoundHttpException();
        }

        // GET ACCREDIT PAGE
        $accredit = $em->getRepository('BaseCoreBundle:CorpoMovieInscription')->findOneById($this->getParameter('admin_corpo_movie_inscription_id'));
        if ($accredit === null) {
            throw new NotFoundHttpException();
        }

        // SEO
//        $this->get('base.manager.seo')->setFDCPressPagePressAccreditSeo($accredit, $locale);

        $headerInfo = array(
            'title' => 'S\'accréditer',
            'description' => 'Le Festival de Cannes est réservé aux professionels du Cinéma. Pour y participer, ceux-ci
                              doivent être accrédités. Les accréditations sont attribuées en fonction de l’activité
                              professionnelle.'
        );

        return $this->render('FDCCorporateBundle:Participate:register-movie.html.twig',array(
            'headerInfo' => $headerInfo,
            'accredit' => $accredit,
        ));
    }

    /**
     * @Route("/rules")
     * @param Request $request
     * @return Response
     */
    public function rulesAction(Request $request)
    {
       $id = $request->get('id');

        if($id) {
            $procedure = $this->getDoctrineManager()->getRepository('BaseCoreBundle:CorpoMovieInscriptionProcedure')->find($id);
        } else {
            return $this->createNotFoundException();
        }

        return $this->render('FDCCorporateBundle:Participate:rules.html.twig',array(
            'procedure' => $procedure,
        ));
    }
}
