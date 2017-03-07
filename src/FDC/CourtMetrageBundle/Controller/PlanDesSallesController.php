<?php

namespace FDC\CourtMetrageBundle\Controller;

use Doctrine\ORM\EntityManager;
use FDC\CourtMetrageBundle\Entity\CcmPlanDesSalles;
use FDC\CourtMetrageBundle\Entity\CcmPlanDesSallesSectorCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PlanDesSallesController
 * @package FDC\CourtMetrageBundle\Controller
 */
class PlanDesSallesController extends Controller
{
    /**
     * @Route("plan-des-salles", name="fdc_court_metrage_plan_des_salles")
     */
    public function indexAction()
    {
        /** @var EntityManager $em */
        $em = $this->get('doctrine.orm.entity_manager');
        
        $planDesSalles = $em->getRepository(CcmPlanDesSalles::class)->findOneBy([]);
        
        if ($planDesSalles == null) throw $this->createNotFoundException();
        
        /** @var CcmPlanDesSallesSectorCollection[] $sectorList */
        $sectorList = $planDesSalles->getSectorList();
        
        $sectors = [];
        foreach ($sectorList as $sectorListItem) {
            if ($sectorListItem->getSector() != null) {
                $sectors[] = $sectorListItem->getSector();
            }
        }

        return $this->render('@FDCCourtMetrage/plandessalles/show.html.twig', [
            'sectors' => $sectors
        ]);
    }
}
