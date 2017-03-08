<?php

namespace FDC\CourtMetrageBundle\Controller;


use FDC\CourtMetrageBundle\Entity\CcmContactPage;
use FDC\CourtMetrageBundle\Entity\CcmContactSubjectTranslation;
use FDC\CourtMetrageBundle\Form\Type\CcmContactFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class FooterContentController
 * @package FDC\CourtMetrageBundle\Controller
 */
class FooterContentController extends Controller
{
    /**
     * Retrieve data for Mentions Légales / Crédits / Politique de confidentialité page
     * @param Request $request
     *
     * @Route("/mentions-legales", name="fdc_court_metrage_footer_mentions_legales")
     * @Route("/credits", name="fdc_court_metrage_footer_credits")
     * @Route("/politique-de-confidentialite", name="fdc_court_metrage_footer_politique_de_confidentialite")
     */
    public function showAction(Request $request)
    {
        $footerContentManager = $this->get('ccm.manager.footer_content');
        $routeName = $request->get('_route');
        $pageContent = $footerContentManager->getPageContent($routeName);
        
        if (!$pageContent) {
            throw new NotFoundHttpException();
        }
        
        $pageDescription = $footerContentManager->getPageDescription($pageContent);

        return $this->render('FDCCourtMetrageBundle:Footer:footerContentPage.html.twig', [
                'pageContent' => $pageContent,
                'pageDescription' => $pageDescription,
                'route' => $routeName,
            ]
        );
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/contact", name="fdc_court_metrage_contact")
     */
    public function contactAction(Request $request)
    {
        $locale = $request->get('_locale', 'fr');
        $contactManager = $this->get('ccm.manager.contact_page');
        /** @var CcmContactPage $contactPage */
        $contactPage = $contactManager->getContactPage();

        if ($contactPage == null) {
            throw $this->createNotFoundException();
        }
        
        $contactSubjects = $contactManager->getContactPageSubjects($contactPage, $locale);
        
        $form = $this->createForm(new CcmContactFormType($contactSubjects));
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $contactManager->validateFormData($form, $locale);
            if ($form->isValid()) {
                $formData = $form->getData();
                /** @var CcmContactSubjectTranslation $subjectTranslation */
                $subjectTranslation = $contactManager->getSubjectTranslationBySlugAndLocale($formData['select'], $locale);
                $contactManager->sendEmail([
                    'to'      => $subjectTranslation->getReceiverEmail(),
                    'from'    => $formData['email'],
                    'name'    => $formData['name'],
                    'email'   => $formData['email'],
                    'theme'   => $subjectTranslation->getContactTheme(),
                    'subject' => $formData['object'],
                    'message' => $formData['message']
                ]);
                $this->addFlash('success', '');

                return $this->redirectToRoute('fdc_court_metrage_contact');
            }
        }

        return $this->render('@FDCCourtMetrage/Footer/contact.html.twig', [
            'form'  => $form->createView()
        ]);
    }

    /**
     * @Route("/sitemap", name="fdc_court_metrage_site_plan")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function sitePlanAction()
    {
        $menuManager = $this->get('ccm.manager.menu');

        $menuPage = $menuManager->getMenuPage();
        $mainNavs = $menuManager->getMainNavs($menuPage);
        $subNavs = $menuManager->getSubNavs($mainNavs);
        $participatePages = $menuManager->getParticipatePages();

        return $this->render('FDCCourtMetrageBundle::site_plan/index.html.twig', array(
                 'menuPage' => $menuPage,
                 'mainNavs' => $mainNavs,
                 'subNavs' => $subNavs,
                 'participatePages' => $participatePages,
             )
        );
    }
}
