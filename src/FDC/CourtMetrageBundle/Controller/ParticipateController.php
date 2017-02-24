<?php

namespace FDC\CourtMetrageBundle\Controller;

use FDC\CourtMetrageBundle\Entity\CcmFilmRegisterTranslation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Base\CoreBundle\Entity\FilmPerson;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class ParticipateController
 *
 * @package FDC\CourtMetrageBundle\Controller
 */
class ParticipateController extends Controller
{
    /**
     * @Route("participer/inscrire-un-film", name="fdc_court_metrage_register_movie")
     *
     * @return Response
     */
    public function registerMovieAction()
    {
        $filmRegisterManager = $this->get('ccm.manager.participate');

        $filmRegisterPage = $filmRegisterManager->getRegisterMoviePage();

        if($filmRegisterPage->getStatus() != CcmFilmRegisterTranslation::STATUS_PUBLISHED && $filmRegisterPage->getStatus() != CcmFilmRegisterTranslation::STATUS_TRANSLATED)
        {
            throw new NotFoundHttpException();
        }

        $registerProcedures = $filmRegisterManager->getRegisterProcedures($filmRegisterPage);

        return $this->render('FDCCourtMetrageBundle:Participate:registerMovie.html.twig', array(
            'filmRegisterPage' => $filmRegisterPage,
            'registerProcedures' => $registerProcedures
        ));
    }

    /**
     * @Route("participer/detail-des-caracteristiques-techniques/{slug}", name="fdc_court_metrage_technical_characteristics")
     * @Route("participer/detail-du-reglement/{slug}", name="fdc_court_metrage_regulation_detail")
     *
     * @param Request $slug
     *
     * @return Response
     */
    public function technicalCharacteristicsAction(Request $request, $slug)
    {
        $filmRegisterManager = $this->get('ccm.manager.participate');

        $filmRegisterPage = $filmRegisterManager->getRegisterMoviePage();

        $registerProcedure = $filmRegisterManager->getRegisterProcedure($slug);

        $routeName = $request->get('_route');

        if($routeName == 'fdc_court_metrage_technical_characteristics')
        {
            return $this->render('FDCCourtMetrageBundle:Participate:registerUploadMovie.html.twig', array(
                'filmRegisterPage' => $filmRegisterPage,
                'registerProcedure' => $registerProcedure
            ));
        }

        return $this->render('FDCCourtMetrageBundle:Participate:registerRegulationDetail.html.twig', array(
            'filmRegisterPage' => $filmRegisterPage,
            'registerProcedure' => $registerProcedure
        ));
    }

    /**
     * @Route("participer/label", name="fdc_court_metrage_label")
     *
     * @return Response
     */
    public function labelAction()
    {
        return $this->render('FDCCourtMetrageBundle:Participate:label.html.twig');
    }

    /**
     * Participate pages with associated layers
     *
     * @param Request $request
     * @param $slug
     *
     * @Route("participer/{slug}", name="fdc_court_metrage_participer_page")
     */
    public function participerPageAction(Request $request, $slug)
    {
        $participateManager = $this->get('ccm.manager.participate');

        $participatePage = $participateManager->getParticipatePage($slug);

        if (!$participatePage) {
            throw new NotFoundHttpException();
        }
        $pageLayers = $participateManager->getPageLayers($participatePage);
        $layerModules = $participateManager->getLayerModules($pageLayers);

        return $this->render('FDCCourtMetrageBundle:Participate:participatePage.html.twig', [
                'page' => $participatePage,
                'layers' => $pageLayers,
                'modules' => $layerModules,
            ]
        );
    }


}
