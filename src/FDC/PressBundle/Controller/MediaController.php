<?php

namespace FDC\PressBundle\Controller;

use Base\CoreBundle\Entity\FilmFilmMediaInterface;
use Base\CoreBundle\Entity\FilmSelectionSection;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
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
    public function mainAction($sectionId)
    {
        $em = $this->getDoctrine()->getManager();
        $locale = $this->getRequest()->getLocale();

        // GET FDC SETTINGS
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        if ($settings === null || $settings->getFestival() === null) {
            throw new NotFoundHttpException();
        }

        $sectionFilms = $em->getRepository('BaseCoreBundle:FilmFilm')
            ->findBy(array('festival' => $settings->getFestival()->getId()), array('selectionSection' => 'DESC'))
        ;

        $filmSection = array();
        $sections = array();
        $i = 0;

        foreach ($sectionFilms as $film) {

            //Construct sections
            $empty = true;
            foreach ($film->getMedias() as $media) {
                if ($media->getType() == FilmFilmMediaInterface::TYPE_POSTER ||
                    $media->getType() == FilmFilmMediaInterface::TYPE_MAIN ||
                    $media->getType() == FilmFilmMediaInterface::TYPE_FILM) {
                    $empty = false;
                    break;
                }
            }
            foreach ($film->getAssociatedMediaVideos() as $mediaVideo) {
                if (isset($mediaVideo)) {
                    $empty = false;
                    break;
                }
            }

            if ($empty == false && $film->getSelectionSection() !== null &&
                !in_array($film->getSelectionSection()->getId(), $sections) &&
                $film->getSelectionSection()->getId() != FilmSelectionSection::FILM_SELECTION_SECTION_QUINZAINEDESREALISATEURS) {
                $filmSection[$i]['id'] = $film->getSelectionSection()->getId();
                if ($film->getSelectionSection()->findTranslationByLocale($locale)) {
                    $filmSection[$i]['name'] = $film->getSelectionSection()->findTranslationByLocale($locale)->getName();
                } else {
                    $filmSection[$i]['name'] = $film->getSelectionSection()->findTranslationByLocale('en')->getName();
                }

                $filmSection[$i]['position'] = $film->getSelectionSection()->getPosition();

                $sections[] = $film->getSelectionSection()->getId();
                $i++;
            }
        }

        usort($filmSection, function (array $a, array $b) {
            return $a["position"] - $b["position"];
        });

        $films = $em->getRepository('BaseCoreBundle:FilmFilm')
            ->findBy(array(
                'festival'         => $settings->getFestival()->getId(),
                'selectionSection' => $sectionId,
            ), array('titleVO' => 'asc'))
        ;

        $i = 0;
        foreach ($films as $film) {
            $empty = true;
            foreach ($film->getMedias() as $media) {
                if ($media->getType() == FilmFilmMediaInterface::TYPE_POSTER ||
                    $media->getType() == FilmFilmMediaInterface::TYPE_MAIN ||
                    $media->getType() == FilmFilmMediaInterface::TYPE_FILM) {
                    $empty = false;
                    break;
                }
            }
            foreach ($film->getAssociatedMediaVideos() as $mediaVideo) {
                if (isset($mediaVideo)) {
                    $empty = false;
                    break;
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
            'films'       => $films,
            'sectionId'   => $sectionId
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

        if ($request->isXmlHttpRequest()) {

            $mainSectionId = $request->get('id');
            $films = $em->getRepository('BaseCoreBundle:FilmFilm')
                ->findBy(array(
                    'festival'         => $settings->getFestival()->getId(),
                    'selectionSection' => $mainSectionId,
                ), array('titleVO' => 'asc'))
            ;
            $i = 0;

            $filmSection = array();
            $section = array();
            foreach ($films as $film) {
                if ($film->getSelectionSection()->getId() !== null) {
                    $section['id'] = $film->getSelectionSection()->getId();
                    $section['name'] = $film->getSelectionSection()->findTranslationByLocale($locale)->getName();
                    break;
                }
            }

        }
        $i = 0;

        foreach ($films as $film) {
            $empty = true;
            foreach ($film->getMedias() as $media) {
                if ($media->getType() == '14' || $media->getType() == '18') {
                    $empty = false;
                }
            }
            foreach ($film->getAssociatedMediaVideos() as $mediaVideo) {
                if (isset($mediaVideo)) {
                    $empty = false;
                }
            }
            if ($empty == true) {
                unset($films[$i]);
            }
            $i++;
        }

        return array(
            'films'   => $films,
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
            ->findOneById($id)
        ;

        $filmPhotos = array();

        $zipName = $film->getId() . '-' . $film->getUpdatedAt()->format('YmdHis') . ".zip";
        $zipPath = $this->get('kernel')->getRootDir() . "/../web/uploads/archive/film/" . $zipName;

        $rootDirectory = $this->get('kernel')->getRootDir() . '/../web/uploads';
        $folders = array(
            $rootDirectory,
            $rootDirectory . '/archive',
            $rootDirectory . '/archive/film',
        );

        foreach ($folders as $folder) {
            if (!is_dir($folder)) {
                $this->get('filesystem')->mkdir($folder);
            }
        }

        $zip = new \ZipArchive();

        // @TODO : mettre en cache
        //if (!file_exists($zipPath)) {
            $zip->open($zipPath, \ZipArchive::CREATE);

            foreach ($film->getMedias() as $media) {
                if ($media->getType() == 14 || $media->getType() == 17 || $media->getType() == 51) {
                    array_push($filmPhotos, $media->getMedia()->getFile());
                    $provider = $this->container->get($media->getMedia()->getFile()->getProviderName());
                    $fUrl = $provider->getCdn()->getPath($provider->getReferenceImage($media->getMedia()->getFile(), true), $provider);
                    if (@file_get_contents($fUrl) !== false) {
                        $zip->addFromString(basename($media->getMedia()->getFile()), file_get_contents($fUrl));
                    }
                }
            }
            $zip->close();

        //}

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
            ->findOneById($id)
        ;

        $galleryImage = $em->getRepository('BaseCoreBundle:MediaImageTranslation')
            ->getGalleryImage($id, $locale)
        ;

        $galleryPhotos = array();

        $zipName = $gallery->getId() . '-' . $gallery->getUpdatedAt()->format('YmdHis') . ".zip";

        $zipPath = $this->get('kernel')->getRootDir() . "/../web/uploads/archive/gallery/" . $zipName;

        $rootDirectory = $this->get('kernel')->getRootDir() . '/../web/uploads';
        $folders = array(
            $rootDirectory,
            $rootDirectory . '/archive',
            $rootDirectory . '/archive/gallery',
        );

        foreach ($folders as $folder) {
            if (!is_dir($folder)) {
                $this->get('filesystem')->mkdir($folder);
            }
        }

        $zip = new \ZipArchive();
        // @TODO : mettre en cache
        //if (!file_exists($zipPath)) {
            $zip->open($zipPath, \ZipArchive::CREATE);

            foreach ($galleryImage as $media) {
                array_push($galleryPhotos, $media->getFile());
                $provider = $this->container->get($media->getFile()->getProviderName());
                $fUrl = $provider->getCdn()->getPath($provider->getReferenceImage($media->getFile(), true), $provider);
                if (@file_get_contents($fUrl) !== false) {
                    $zip->addFromString(basename($media->getFile()), file_get_contents($fUrl));
                }
            }
            $zip->close();

        //}

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

        if ($request->isXmlHttpRequest()) {

            $id = $request->get('id');
            $film = $em->getRepository('BaseCoreBundle:FilmFilm')
                ->findOneById($id)
            ;

        }

        return array(
            'film' => $film
        );
    }


    /**
     * @Route("/force-trailer-download/{id}/{format}")
     * @param Request $request
     * @param $id
     * @param string $format
     * @return Response
     */
    public function forceDownloadAction(Request $request, $id, $format)
    {
        $response = new Response();

        $trans = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:MediaVideoTranslation')
            ->find($id)
        ;

        if (!$trans || !in_array($format, array('mp4', 'webm', 'source'))) {
            return $response;
        }

        $bucket = $this->getParameter('s3_video_bucket_name');
        $region = $this->getParameter('s3_video_region');
        $url = "http://$bucket.s3-website-$region.amazonaws.com/";

        if ($format == 'mp4') {
            $url .= $trans->getMp4Url();
        } elseif ($format == 'webm') {
            $url .= $trans->getMp4Url();
        } elseif ($format == 'source') {
            if ($trans->getAmazonRemoteFile()) {
                $url .= $trans->getAmazonRemoteFile()->getUrl();
            } elseif ($trans->getFile()) {
                $provider = $this->container->get($trans->getFile()->getProviderName());
                $format = $provider->getFormatName($trans->getFile(), 'reference');
                $url = $provider->generatePublicUrl($trans->getFile(), $format);
            }
        }

        $filename = substr(strrchr($url, "/"), 1);
        $url = substr($url, 0, strlen($url) - strlen($filename)). rawurlencode($filename);

        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('Content-Transfer-Encoding', 'Binary');
        $response->headers->set('Content-disposition', 'attachment; filename="' . $filename . '"');
        $response->headers->set('Expires', '0');
        $response->headers->set('Cache-Control', 'must-revalidate');
        $response->headers->set('Pragma', 'public');
        $response->sendHeaders();
        readfile($url);

        return $response;
    }


}
