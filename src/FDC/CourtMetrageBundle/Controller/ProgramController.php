<?php

namespace FDC\CourtMetrageBundle\Controller;

use FDC\CourtMetrageBundle\Manager\ProgramManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProgramController extends Controller
{
    /**
     * @Route("program", name="ccm_program")
     * @param Request $request
     * @return Response
     */
    public function programAction(Request $request)
    {
        $locale = $request->get('_locale', 'fr');
        /** @var ProgramManager $programManager */
        $programManager = $this->get('ccm.manager.program');

        $filters = $programManager->getAvailableListFilters($locale);
        $program = $programManager->getProgramPage($locale);
        $programTranslatable = $program->getTranslatable();

        if (!$program || !$programTranslatable) {
            throw new NotFoundHttpException();
        }

        $orderedDays = $programManager->orderProgramDays($programTranslatable);

        $homepageManger = $this->get('ccm.manager.homepage');
        $sejour = $homepageManger->getSejouresFromProgramPage();
        $positions = $homepageManger->orderTransversModulesForPage($program);

        return $this->render('@FDCCourtMetrage/program/program.html.twig', [
            'program'    => $program,
            'filters' => $filters,
            'daysCollection' => $orderedDays,
            'sejourIsActive' => $programTranslatable->getSejourIsActive(),
            'socialIsActive' => $programTranslatable->getSocialIsActive(),
            'positions' => $positions,
            'sejour' => $sejour,
        ]);
    }
}
