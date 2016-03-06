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
     * @Route("/media")
     * @Template("FDCPressBundle:Media:main.html.twig")
     * @return array
     */
    public function mainAction()
    {
        $em = $this->getDoctrine()->getManager();
        $locale = $this->getRequest()->getLocale();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            throw new NotFoundHttpException();
        }

        $films = $em->getRepository('BaseCoreBundle:FilmFilm')
            ->findBy(array('festival' => $settings->getFestival()->getId()), array('selectionSection' => 'ASC'));
        $i = 0;
        $filmSection = array();
        $section = array();

        foreach ($films as $film) {
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

            if ($empty == false && $film->getSelectionSection() !== null && !in_array($film->getSelectionSection()->findTranslationByLocale($locale)->getSlug(), $section)) {

                $filmSection[$i]['slug'] = $film->getSelectionSection()->findTranslationByLocale($locale)->getSlug();
                $filmSection[$i]['name'] = $film->getSelectionSection()->findTranslationByLocale($locale)->getName();

                $section[] = $film->getSelectionSection()->findTranslationByLocale($locale)->getSlug();
            }


            $i++;
        }

        return array(
            'filmSection' => $filmSection,
            'films' => $films
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
                    $fUrl = $provider->generatePublicUrl($media->getMedia()->getFile(), $media->getMedia()->getFile()->getContext().'_reference');
                    if (@file_get_contents($fUrl) !== false) {
                        $zip->addFromString(basename($media->getMedia()->getFile()), file_get_contents($fUrl));
                    }
                }
            }
            $zip->close();

        }

        if ($zip->numFiles !== 0) {
            // Generate response
            $response = new Response();

            // Set headers
            $response->headers->set('Cache-Control', 'private');
            $response->headers->set('Content-type', mime_content_type($zipPath));
            $response->headers->set('Content-Disposition', 'attachment; filename="' . basename($zipPath) . '";');
            $response->headers->set('Content-length', filesize($zipPath));

            // Send headers before outputting anything
            $response->sendHeaders();

            $response->setContent(file_get_contents($zipPath));

            return $response;
        }
        else {

            $request->getSession()
                ->getFlashBag()
                ->add('error', $translator->trans('press.archive.error.veuillezreessayerplustard'))
            ;

            return $this->redirectToRoute('fdc_press_media_main');
        }

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
                $fUrl = $provider->generatePublicUrl($media->getFile(), $media->getFile()->getContext().'_reference');
                if (@file_get_contents($fUrl) !== false) {
                    $zip->addFromString(basename($media->getFile()), file_get_contents($fUrl));
                }
            }
            $zip->close();

        }



        if ($zip->numFiles !== 0) {
            $response = new Response();

            // Set headers
            $response->headers->set('Cache-Control', 'private');
            $response->headers->set('Content-type', mime_content_type($zipPath));
            $response->headers->set('Content-Disposition', 'attachment; filename="' . basename($zipPath) . '";');
            $response->headers->set('Content-length', filesize($zipPath));

            // Send headers before outputting anything
            $response->sendHeaders();
            $response->setContent(file_get_contents($zipPath));
            return $response;

        }
        else {

            $request->getSession()
                ->getFlashBag()
                ->add('error', $translator->trans('press.archive.error.veuillezreessayerplustard'))
            ;

            return $this->redirectToRoute('fdc_press_media_download');
        }


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

        //GET PRESS HOMEPAGE
        $section = $em->getRepository('BaseCoreBundle:PressDownload')->findOneById($this->getParameter('admin_press_download_id'));
        if ($section === null || $section->getDownloadSection() === null) {
            throw new NotFoundHttpException();
        }

        $downloads = $section->getDownloadSection();

        return array(
            'headerInfo' => $headerInfo,
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
