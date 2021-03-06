<?php

namespace FDC\MarcheDuFilmBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Request;
use FDC\MarcheDuFilmBundle\Form\Type\ContactFormType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TransverseController extends Controller
{
    public function headerAction($routeName, $routeParams)
    {
        $headerFooterManager = $this->get('mdf.manager.header_footer');
        $banner = $headerFooterManager->getHeaderBanner();
        $availableMenu = $headerFooterManager->getMenuAvailability();

        $localeSlugs = [];
        if ($routeName == 'fdc_marche_du_film_services_widgets') {
            $localeSlugs = $this->get('mdf.manager.services')->getLocaleSlugsForService($routeParams['slug']);
        }

        if ($routeName == 'fdc_marche_du_film_news_details') {
            $localeSlugs = $this->get('mdf.manager.content_template')->getNewsPageLocales($routeParams['slug']);
        }

        return $this->render(
            'FDCMarcheDuFilmBundle::shared/header.html.twig',
            [
                'banner' => $banner,
                'routeName' => $routeName,
                'routeParams' => $routeParams,
                'availableMenu' => $availableMenu,
                'localeSlugs' => $localeSlugs
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
        $request->getSession()
            ->getFlashBag()
            ->clear()
        ;
        $contactUsManager = $this->get('mdf.manager.contact_us');
        $contactPage = $contactUsManager->getContactUsPage();

        if (!$contactPage) {
            throw new NotFoundHttpException("Page not found");
        }

        $contactBlocks = $contactUsManager->getContactBlocks($contactPage);
        $contactSubjects = $contactUsManager->getContactSubjects($contactPage);
        $formContact = $this->createForm(new ContactFormType($contactSubjects));

        $formContact->handleRequest($request);
        if ($formContact->isSubmitted() && $formContact->isValid()) {
            $emailData = $formContact->getData();
            $this->get('mdf.manager.mailer')->sendMessage($emailData);

            $request->getSession()
                ->getFlashBag()
                ->add('success','success')
            ;

            unset($formContact);
            $formContact = $this->createForm(new ContactFormType($contactSubjects));
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

    public function sliderAccreditationAction()
    {
        $sliderAccreditationManager = $this->get('mdf.manager.slider_accreditation');
        $slidersAccreditation = $sliderAccreditationManager->getAllSlidersAccreditation();

        return $this->render('FDCMarcheDuFilmBundle::partials/accreditationBlock.html.twig', array(
                'sliders' => $slidersAccreditation,
            )
        );
    }
}
