<?php

namespace FDC\CourtMetrageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProsController extends Controller
{

    /**
     * @Route("/pros-du-court", name="fdc_ccm_pros_du_court")
     * @param Request $request
     */
    public function showAction(Request $request)
    {
        $homepageManger = $this->get('ccm.manager.homepage');
        $prosManager = $this->get('ccm.manager.pros');

        $sejour = $homepageManger->getSejouresFromProsPage();
        $prosPage = $prosManager->getProsPageByLocale();

        if (!$prosPage) {
            throw new NotFoundHttpException();
        }

        $positions = $homepageManger->orderTransversModulesForPage($prosPage);
        $sejourIsActive = $prosPage->getTranslatable()->getSejourIsActive();
        $socialIsActive = $prosPage->getTranslatable()->getSocialIsActive();
        $catalogIsActive = $prosPage->getTranslatable()->getCatalogIsActive();
        $actualiteIsActive = $prosPage->getTranslatable()->getActualiteIsActive();
        $prosList = $prosManager->getProsByLocale();
        $prosDomains = $prosManager->getDomains($prosList, $prosPage);
        $hasSFC = $prosManager->hasSFC($prosList);
        
        return $this->render('FDCCourtMetrageBundle:Pros:show.html.twig', [
                'prosPage' => $prosPage,
                'prosList' => $prosList,
                'prosDomains' => $prosDomains,
                'hasSFC' => $hasSFC,
                'sejour' => $sejour,
                'sejourIsActive' => $sejourIsActive,
                'socialIsActive' => $socialIsActive,
                'positions' => $positions,
                'catalogIsActive' => $catalogIsActive,
                'actualiteIsActive' => $actualiteIsActive,
            ]
        );
    }

    /**
     * @param Request $request
     * @param $id
     * 
     * @Route("/pros-du-court/{id}", options={"expose" = true}, name="fdc_ccm_pros_du_court_modal")
     * @return JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function showModalAction(Request $request, $id)
    {
        if ($id) {
            $prosManager = $this->get('ccm.manager.pros');
            $pro = $prosManager->getProById($id);

            if ($pro) {
                $proDescription = $prosManager->getProDescription($pro->getTranslatable()->getId());

                return $this->render('FDCCourtMetrageBundle:Pros:partials/modal.html.twig', [
                        'pro' => $pro,
                        'proDescription' => $proDescription,
                    ]
                );
            } else {
                return new JsonResponse(
                    array(
                        'message' => 'Pro doesn\'t exist!'
                    ),
                    555
                );
            }
        } else {
            return new JsonResponse(
                array(
                    'message' => 'Id not sent!'
                ),
                444
            );
        }
    }
}
