<?php

namespace Base\ApiBundle\Controller;

use Base\CoreBundle\Entity\PushFilmMobile;
use Base\CoreBundle\Entity\PushMobile;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Class PushMobileController
 * @package Base\ApiBundle\Controller
 */
class PushFilmMobileController extends FOSRestController
{

    /**
     * Save a mobile push
     *
     * @Rest\Route("/pushfilm")
     * @Rest\View()
     * @ApiDoc(
     *   resource = true,
     *   description = "add push film",
     *   section="Push Mobile",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     422 = "Unprocessable"
     *   }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     * @Rest\QueryParam(name="uuid", nullable=false, description="The uuid of the device")
     * @Rest\QueryParam(name="os", nullable=false, description="The operating system of the device")
     * @Rest\QueryParam(name="lang", nullable=false, description="The lang of the device")
     * @Rest\QueryParam(name="film", nullable=true, description="The film ids. Must be array.", array=true)
     * @Rest\QueryParam(name="remove", nullable=true, description="Set remove to 1 to delete the film's push", default="0")
     *
     * @param ParamFetcher $paramFetcher
     * @return View
     */
    public function postPushFilmMobileAction(ParamFetcher $paramFetcher)
    {
        $view = View::create();

        $uuid = $paramFetcher->get('uuid');
        $os = $paramFetcher->get('os');
        $locale = $paramFetcher->get('lang');
        $filmId = $paramFetcher->get('film');
        if (!$filmId) {
            $filmId = [];
        }
        if ($filmId && !is_array($filmId)) {
            $filmId = [$filmId];
        }
        $remove = $paramFetcher->get('remove');

        if ($uuid && $os && $locale && $filmId && !$remove) {
            if ($this->createPushFilmMobile($uuid, $os, $locale, $filmId)) {
                $view->setStatusCode(200)->setData(true);
            }
            else {
                $view->setStatusCode(422)->setData(false);
            }
        } elseif ($uuid && $os && $locale && $remove) {
            if ($this->deletePushFilmMobile($uuid, $os, $locale, $filmId)) {
                $view->setStatusCode(200)->setData(true);
            }
            else {
                $view->setStatusCode(422)->setData(false);
            }
        } else {
            $view->setStatusCode(422)->setData(false);
        }
        return $view;
    }


    protected function createPushFilmMobile($uuid, $os, $locale, $filmIds)
    {
        foreach ($filmIds as $filmId) {
            $film = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('BaseCoreBundle:FilmFilm')
                ->find($filmId)
            ;

            if (!$film) {
                continue;
            }

            $pushFilmMobile = $this
                ->get('doctrine')
                ->getManager()
                ->getRepository('BaseCoreBundle:PushFilmMobile')
                ->findOneBy(array(
                    'uuid' => $uuid,
                    'os'   => $os,
                    'locale' => $locale,
                    'film' => $film->getId(),
                ))
            ;

            if (!$pushFilmMobile) {
                $pushFilmMobile = new PushFilmMobile();
                $pushFilmMobile
                    ->setUuid($uuid)
                    ->setOs($os)
                    ->setLocale($locale)
                    ->setFilm($film)
                ;
                $this->getDoctrine()->getManager()->persist($pushFilmMobile);
                $this->getDoctrine()->getManager()->flush();
            }
        }
        return true;
    }



    protected function deletePushFilmMobile($uuid, $os, $locale, $filmIds = null)
    {
        if ($filmIds) {
            $pushes = [];
            foreach ($filmIds as $filmId) {
                $push = $this
                    ->getDoctrine()
                    ->getManager()
                    ->getRepository('BaseCoreBundle:PushFilmMobile')
                    ->findOneBy(array(
                        'uuid' => $uuid,
                        'os'   => $os,
                        'locale' => $locale,
                        'film' => $filmId,
                    ))
                ;
                if ($push) {
                    $pushes[] = $push;
                }
            }
        }
        else {
            $pushes = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('BaseCoreBundle:PushFilmMobile')
                ->findBy(array(
                    'uuid' => $uuid,
                    'os'   => $os,
                    'locale' => $locale,
                ))
            ;
        }

        foreach ($pushes as $push) {
            $this->getDoctrine()->getManager()->remove($push);
            $this->getDoctrine()->getManager()->flush();
        }

        return true;
    }
}