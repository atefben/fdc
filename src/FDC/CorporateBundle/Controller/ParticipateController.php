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
     * @Route("/accredit")
     * @param Request $request
     * @return Response
     */
    public function accreditAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $locale = $this->getRequest()->getLocale();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            throw new NotFoundHttpException();
        }

        // GET ACCREDIT PAGE
        $accredit = $em->getRepository('BaseCoreBundle:CorpoAccredit')->findOneById($this->getParameter('admin_press_accredit_id'));
        if ($accredit === null) {
            throw new NotFoundHttpException();
        }

        // SEO
        //$this->get('base.manager.seo')->setFDCPressPagePressAccreditSeo($accredit, $locale);

        $headerInfo = array(
            'title' => 'S\'accréditer',
            'description' => 'Le Festival de Cannes est réservé aux professionels du Cinéma. Pour y participer, ceux-ci
                              doivent être accrédités. Les accréditations sont attribuées en fonction de l’activité
                              professionnelle.'
        );


        return $this->render('FDCCorporateBundle:Participate:accredit.html.twig',array(
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
        $em = $this->getDoctrine()->getManager();


        if($id) {
            $procedure = $this->getDoctrineManager()->getRepository('BaseCoreBundle:CorpoMovieInscriptionProcedure')->find($id);
        } else {
            return $this->createNotFoundException();
        }

        $registerMovie = $em->getRepository('BaseCoreBundle:CorpoMovieInscription')->findOneById($this->getParameter('admin_corpo_movie_inscription_id'));

        return $this->render('FDCCorporateBundle:Participate:rules.html.twig',array(
            'procedure'     => $procedure,
            'registerMovie' => $registerMovie,
        ));
    }

    /**
     * @Route("/guide")
     * @param Request $request
     * @return Response
     */
    public function guideAction(Request $request)
    {
        $this->isPageEnabled($request->get('_route'));
        $em = $this->getDoctrine()->getManager();
        $locale = $this->getRequest()->getLocale();

        // GET PARTICIPATE PAGE
        $content = $em->getRepository('BaseCoreBundle:FDCPagePrepare')->findOneById($this->getParameter('admin_fdc_page_prepare_id'));
        if ($content === null) {
            throw new NotFoundHttpException();
        }

        // GET PARTICIPATE PAGE
        $datas = $em
            ->getRepository('BaseCoreBundle:FDCPageParticipate')
            ->findAll();

        // SEO
        $this->get('base.manager.seo')->setFDCPagePrepareSeo($content, $locale);

        return $this->render('FDCCorporateBundle:Participate:prepare.html.twig',array(
            'content' => $content,
            'datas' => $datas
        ));
    }
}
