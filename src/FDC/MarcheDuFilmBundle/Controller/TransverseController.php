<?php

namespace FDC\MarcheDuFilmBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Request;
use FDC\MarcheDuFilmBundle\Form\Type\ContactFormType;

class TransverseController extends Controller
{
    public function headerAction($routeName, $routeParams)
    {
        $headerFooterManager = $this->get('mdf.manager.header_footer');
        $banner = $headerFooterManager->getHeaderBanner();

        return $this->render(
            'FDCMarcheDuFilmBundle::shared/header.html.twig',
            [
                'banner' => $banner,
                'routeName' => $routeName,
                'routeParams' => $routeParams
            ]
        );
    }

    public function footerAction()
    {
        $headerFooterManager = $this->get('mdf.manager.header_footer');

        return $this->render(
            'FDCMarcheDuFilmBundle::shared/footer.html.twig',
            [
                'footerUrls' => $headerFooterManager->getFooterUrls()
            ]
        );
    }

    /**
     * @Route("contact-us", name="fdc_marche_du_film_contact_us")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function contactAction(Request $request)
    {

        $contactUsManager = $this->get('mdf.manager.contact_us');

        $contactPage = $contactUsManager->getContactUsPage();
        $contactBlocks = $contactUsManager->getContactBlocks($contactPage);
        $contactSubjects = $contactUsManager->getContactSubjects($contactPage);
        $formContact = $this->createForm(new ContactFormType($contactSubjects));

        $formContact->handleRequest($request);
        if ($formContact->isSubmitted() && $formContact->isValid()) {
            $emailData = $formContact->getData();
            $emailData['emailFrom'] = $request->request->get('email');
            $emailData['emailTo'] = $contactPage->getReceiverEmail();
            $this->get('mdf.manager.mailer')->sendMessage($emailData);
        }

        return $this->render('FDCMarcheDuFilmBundle::shared/contact/contactUs.html.twig', array(
                'contactPage' => $contactPage,
                'contactBlocks' => $contactBlocks,
                'contactSubjects' => $contactSubjects,
                'formContact' => $formContact->createView(),
            )
        );
    }

    public function annualGraphicCharterAction()
    {
        $annualGraphicCharterManager = $this->get('mdf.manager.annual_graphic_charter');

        return $this->render(
            'FDCMarcheDuFilmBundle::shared/annual_graphic_charter.html.twig',
            [
                'graphicCharter' => $annualGraphicCharterManager->getCurrentGraphicCharter()
            ]
        );
    }
}
