<?php

namespace FDC\MarcheDuFilmBundle\Controller;

use FDC\MarcheDuFilmBundle\Entity\AccreditationTranslation;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AccreditationController extends Controller
{
    /**
     * @Route("accreditations", name="fdc_marche_du_film_accreditations")
     */
    public function indexAction()
    {
        $accreditationManager = $this->get('mdf.manager.accreditation');
        $contentTemplateManager = $this->get('mdf.manager.content_template');
        $contactManager = $this->get('mdf.manager.contact');

        $accreditationContent = $accreditationManager->getAccreditationContent();

        $pageTranslationStatus = $accreditationContent->getStatus();
        if(($pageTranslationStatus != AccreditationTranslation::STATUS_TRANSLATED) && ($pageTranslationStatus != AccreditationTranslation::STATUS_PUBLISHED))
        {
            throw new NotFoundHttpException();
        }

        $accreditationWidgets = $accreditationManager->getAccreditationWidgets();
        $newsContent = $contentTemplateManager->getHomepageNewsContent();
        $contact = $contactManager->getContactInfo();

        return $this->render('FDCMarcheDuFilmBundle::accreditation/show.html.twig', array(
            'accreditationContent' => $accreditationContent,
            'accreditationWidgets' => $accreditationWidgets,
            'news' => $newsContent,
            'contact' => $contact
        ));
    }
}
