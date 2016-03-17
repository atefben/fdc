<?php

namespace FDC\PressBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

use Base\CoreBundle\Entity\FilmFilm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class MediaController extends Controller
{
    /**
     * @Route("/media/{sectionId}")
     * @Template("FDCPressBundle:Media:main.html.twig")
     * @param int $sectionId
     * @return array
     */
    /* TODO ! add press_media_section_id to parameters.yml  */
    public function mainAction($sectionId = 7)
    {
        $em = $this->getDoctrine()->getManager();
        $locale = $this->getRequest()->getLocale();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            throw new NotFoundHttpException();
        }

        $sectionFilms = $em->getRepository('BaseCoreBundle:FilmFilm')
            ->findBy(array('festival' => $settings->getFestival()->getId()), array('selectionSection' => 'DESC'));
        $i = 0;

        $filmSection = array();
        $sections = array();

        $i = 0;

        foreach ($sectionFilms as $film) {

            //Construct sections
            $empty = true;
            foreach ($film->getMedias() as $media) {
                if ($media->getType() == '14' || $media->getType() == '18') {
                    $empty = false;
                }
            }
            foreach ($film->getAssociatedMediaVideos() as $mediaVideo ) {
                if (isset($mediaVideo)){
                    $empty = false;
                }
            }

            if ($empty == false && $film->getSelectionSection() !== null && !in_array($film->getSelectionSection()->getId(), $sections)) {

                $filmSection[$i]['id'] = $film->getSelectionSection()->getId();
                $filmSection[$i]['name'] = $film->getSelectionSection()->findTranslationByLocale($locale)->getName();

                $sections[] = $film->getSelectionSection()->getId();
                $i++;
            }



        }

        $films = $em->getRepository('BaseCoreBundle:FilmFilm')
            ->findBy(array(
                'festival' => $settings->getFestival()->getId(),
                'selectionSection' => $sectionId,
            ));

        $i=0;
        foreach ($films as $film) {
            $empty = true;
            foreach ($film->getMedias() as $media) {
                if ($media->getType() == '14' || $media->getType() == '18') {
                    $empty = false;
                }
            }
            foreach ($film->getAssociatedMediaVideos() as $mediaVideo ) {
                if (isset($mediaVideo)){
                    $empty = false;
                }
            }
            if ($empty == true) {
                unset($films[$i]);
            }
            $i++;
        }

        $pressMediaLibrary = $em->getRepository('BaseCoreBundle:PressMediaLibrary')->findOneById($this->getParameter('admin_press_medialibrary_id'));
        if ($pressMediaLibrary === null) {
            throw new NotFoundHttpException();
        }

        // SEO
        $this->get('base.manager.seo')->setFDCPressPagePressMediaLibrarySeo($pressMediaLibrary, $locale, $sectionId);

        return array(
            'filmSection' => $filmSection,
            'films' => $films
        );
    }

    /**
     * @Route("/media-section", options={"expose"=true})
     * @Template("FDCPressBundle:Media:components/content.html.twig")
     * @param Request $request
     * @return array
     */
    public function mediaSectionAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $locale = $this->getRequest()->getLocale();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            throw new NotFoundHttpException();
        }

        if ($request->isXmlHttpRequest()){

            $mainSectionId = $request->get('id');
            $films = $em->getRepository('BaseCoreBundle:FilmFilm')
                ->findBy(array(
                    'festival' => $settings->getFestival()->getId(),
                    'selectionSection' => $mainSectionId,
                ));
            $i = 0;

            $filmSection = array();
            $section = array();
            foreach ($films as $film) {
                if ( $film->getSelectionSection()->getId() !== null ){
                    $section['id'] = $film->getSelectionSection()->getId();
                    $section['name'] = $film->getSelectionSection()->findTranslationByLocale($locale)->getName();
                    break;
                }
            }

        }
        $i=0;

        foreach ($films as $film) {
            $empty = true;
            foreach ($film->getMedias() as $media) {
                if ($media->getType() == '14' || $media->getType() == '18') {
                    $empty = false;
                }
            }
            foreach ($film->getAssociatedMediaVideos() as $mediaVideo ) {
                if (isset($mediaVideo)){
                    $empty = false;
                }
            }
            if ($empty == true) {
                unset($films[$i]);
            }
            $i++;
        }

        return array(
            'films' => $films,
            'section' => $section
        );
    }

    /**
     * @Route("/media/film/{id}/archive")
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function filmArchiveAction(Request $request, $id)
    {
        // GET FDC SETTINGS
        $em = $this->getDoctrine()->getManager();
        $translator = $this->get('translator');

        $film = $em->getRepository('BaseCoreBundle:FilmFilm')
            ->findOneById($id);

        $filmPhotos = array();

        $zipName = $film->getId().'-'.$film->getUpdatedAt()->format('YmdHis').".zip";
        $zipPath = $this->get('kernel')->getRootDir()."/../web/uploads/archive/film/".$zipName;
        $zip = new \ZipArchive();

        if (!file_exists($zipPath)) {
            $zip->open($zipPath, \ZipArchive::CREATE);

            foreach ($film->getMedias() as $media ) {
                if ($media->getType() == 14) {
                    array_push($filmPhotos,$media->getMedia()->getFile());
                    $provider = $this->container->get($media->getMedia()->getFile()->getProviderName());
                    $fUrl = $provider->getCdn()->getPath($provider->getReferenceImage($media->getMedia()->getFile(), true), $provider);
                    if (@file_get_contents($fUrl) !== false) {
                        $zip->addFromString(basename($media->getMedia()->getFile()), file_get_contents($fUrl));
                    }
                }
            }
            $zip->close();

        }

        // Generate response
        $response = new Response();
        // Set headers
        $response->headers->set('Cache-Control', 'private');
        $response->headers->set('Content-type', mime_content_type($zipPath));
        $response->headers->set('Content-Disposition', 'archive; filename="' . basename($zipPath) . '";');
        $response->headers->set('Content-length', filesize($zipPath));

        // Send headers before outputting anything
        $response->sendHeaders();

        $response->setContent(file_get_contents($zipPath));

        return $response;


    }

    /**
     * @Route("/media/gallery/{id}/archive")
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function galleryArchiveAction(Request $request, $id)
    {
        // GET FDC SETTINGS
        $em = $this->getDoctrine()->getManager();
        $locale = $this->getRequest()->getLocale();

        $translator = $this->get('translator');


        $gallery = $em->getRepository('BaseCoreBundle:Gallery')
            ->findOneById($id);

        $galleryImage = $em->getRepository('BaseCoreBundle:MediaImageTranslation')
            ->getGalleryImage($id,$locale);

        $galleryPhotos = array();

        $zipName = $gallery->getId().'-'.$gallery->getUpdatedAt()->format('YmdHis').".zip";
        $zipPath = $this->get('kernel')->getRootDir()."/../web/uploads/archive/gallery/".$zipName;
        $zip = new \ZipArchive();

        if (!file_exists($zipPath)) {
            $zip->open($zipPath, \ZipArchive::CREATE);

            foreach ($galleryImage as $media ) {
                array_push($galleryPhotos,$media->getFile());
                $provider = $this->container->get($media->getFile()->getProviderName());
                $fUrl = $provider->getCdn()->getPath($provider->getReferenceImage($media->getMedia()->getFile(), true), $provider);
                if (@file_get_contents($fUrl) !== false) {
                    $zip->addFromString(basename($media->getFile()), file_get_contents($fUrl));
                }
            }
            $zip->close();

        }

        $response = new Response();

        // Set headers
        $response->headers->set('Cache-Control', 'private');
        $response->headers->set('Content-type', mime_content_type($zipPath));
        $response->headers->set('Content-Disposition', 'archive; filename="' . basename($zipPath) . '";');
        $response->headers->set('Content-length', filesize($zipPath));

        // Send headers before outputting anything
        $response->sendHeaders();
        $response->setContent(file_get_contents($zipPath));
        return $response;

    }

    /**
     * @Route("/download")
     * @Template("FDCPressBundle:Media:download.html.twig")
     * @return array
     */
    public function downloadAction()
    {

        $em = $this->getDoctrine()->getManager();
        $locale = $this->getRequest()->getLocale();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            throw new NotFoundHttpException();
        }

        //GET PRESS DOWNLOADPAGE
        $section = $em->getRepository('BaseCoreBundle:PressDownload')->findOneById($this->getParameter('admin_press_download_id'));
        if ($section === null || $section->getDownloadSection() === null) {
            throw new NotFoundHttpException();
        }
        // SEO
        $this->get('base.manager.seo')->setFDCPressPagePressDownloadSeo($section, $locale);

        $downloads = $section->getDownloadSection();

        return array(
            'pressDownloads' => $downloads
        );
    }

    /**
     * @Route("/trailer-download", options={"expose"=true})
     * @Template("FDCPressBundle:Global:components/popinDownload.html.twig")
     * @param Request $request
     * @return array
     */
    public function trailerDownloadAction(Request $request)
    {

        // GET FDC SETTINGS
        $em = $this->getDoctrine()->getManager();
        $translator = $this->get('translator');
        $film = new FilmFilm();

        if ($request->isXmlHttpRequest()){

            $id = $request->get('id');
            $film = $em->getRepository('BaseCoreBundle:FilmFilm')
                ->findOneById($id);

        }

        return array(
            'film' => $film
        );
    }

}
