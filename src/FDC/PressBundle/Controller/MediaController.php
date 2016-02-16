<?php

namespace FDC\PressBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class MediaController extends Controller
{
    /**
     * @Route("/media")
     * @Template("FDCPressBundle:Media:main.html.twig")
     * @return array
     */
    public function mainAction( )
    {
        $headerInfo = array(
            'title' => 'Médiathèque films',
            'description' => 'Vous trouverez ci-dessous les dossiers de presse, photos, et bandes annonces pour
                              faciliter le traitement des films sur vos propres médias.'
        );


        $em = $this->getDoctrine()->getManager();
        $locale = $this->getRequest()->getLocale();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            throw new NotFoundHttpException();
        }

        $films = $em->getRepository('BaseCoreBundle:FilmFilm')
            ->findByFestival($settings->getFestival()->getId());

        $i = 0;
        $filmSection = array();
        $section = array();
        foreach ($films as $film) {

            if (!in_array($film->getSelectionSection()->findTranslationByLocale($locale)->getSlug(), $section)) {
                $filmSection[$i]['slug'] = $film->getSelectionSection()->findTranslationByLocale($locale)->getSlug();
                $filmSection[$i]['name'] = $film->getSelectionSection()->findTranslationByLocale($locale)->getName();

                $section[] = $film->getSelectionSection()->findTranslationByLocale($locale)->getSlug();
            }

            $i++;
        }

        return array(
            'headerInfo' => $headerInfo,
            'filmSection' => $filmSection,
            'films' => $films
        );
    }

    /**
     * @Route("/download")
     * @Template("FDCPressBundle:Media:download.html.twig")
     * @return array
     */
    public function downloadAction()
    {
        $headerInfo = array(
            'title' => 'À télécharger',
            'description' => 'Ces élements visuels sont à usage exclusif de la presse et des médias qui couvrent
                              le Festival de Cannes. Aucune utilisation commerciale ou promotionnelle de ces visuels
                              n’est autorisée.'
        );

        $em = $this->getDoctrine()->getManager();
        $locale = $this->getRequest()->getLocale();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            throw new NotFoundHttpException();
        }

        $section = $em->getRepository('BaseCoreBundle:PressDownload')
            ->findOneByFestival($settings->getFestival()->getId());

        $downloads = $section->getDownloadSection();

        return array(
            'headerInfo' => $headerInfo,
            'pressDownloads' => $downloads
        );
    }


}
