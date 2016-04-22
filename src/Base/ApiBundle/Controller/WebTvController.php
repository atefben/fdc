<?php

namespace Base\ApiBundle\Controller;

use Base\ApiBundle\Exclusion\TranslationExclusionStrategy;
use Base\CoreBundle\Entity\MediaVideo;
use Base\CoreBundle\Entity\MediaVideoTranslation;
use \DateTime;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;

use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * WebTVController class.
 *
 * \@extends FOSRestController
 *
 */
class WebTvController extends FOSRestController
{
    private $repository = 'BaseCoreBundle:WebTv';

    /**
     * Return an array of web tvs, can be filtered with page / offset parameters
     *
     * @Rest\Get("/live")
     * @Rest\View()
     * @ApiDoc(
     *   resource = true,
     *   description = "Get web tvs",
     *   section="Web Tvs",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *   },
     *  output={
     *      "class"="Base\CoreBundle\Entity\WebTv",
     *      "groups"={"live"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     * @Rest\QueryParam(name="lang", requirements="(fr|en)", default="fr", description="The lang")
     *
     * @param ParamFetcher $paramFetcher
     * @return View
     */
    public function getLiveAction(ParamFetcher $paramFetcher)
    {
        // coremanager shortcut
        $coreManager = $this->get('base.api.core_manager');

        // get festival year / version
        $festival = $coreManager->getApiFestivalYear()->getId();
        $version = ($paramFetcher->get('version') !== null) ? $paramFetcher->get('version') : $this->container->getParameter('api_version');
        $lang = $paramFetcher->get('lang');

        // create query
        $live = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:FDCPageWebTvLive')
            ->find($this->getParameter('admin_fdc_page_web_tv_live_id'))
        ;
        foreach ($live->getAssociatedMediaVideos() as $associatedMediaVideo) {
            $mediaVideo = $associatedMediaVideo->getAssociation();
            if ($mediaVideo instanceof MediaVideo) {
                $translation = $mediaVideo->findTranslationByLocale($lang);
                if ($translation instanceof MediaVideoTranslation) {
                    if ($lang != 'fr' && $translation->getStatus() !== MediaVideoTranslation::STATUS_TRANSLATED) {
                        $live->getAssociatedMediaVideos()->removeElement($associatedMediaVideo);
                        continue;
                    }
                    if ($translation->getJobMp4State() !== MediaVideoTranslation::ENCODING_STATE_READY) {
                        $live->getAssociatedMediaVideos()->removeElement($associatedMediaVideo);
                        continue;
                    }
                    if ($translation->getJobWebmState() !== MediaVideoTranslation::ENCODING_STATE_READY) {
                        $live->getAssociatedMediaVideos()->removeElement($associatedMediaVideo);
                        continue;
                    }
                    if (!$translation->getWebmUrl() || !$translation->getMp4Url()) {
                        $live->getAssociatedMediaVideos()->removeElement($associatedMediaVideo);
                        continue;
                    }
                } else {
                    $live->getAssociatedMediaVideos()->removeElement($associatedMediaVideo);
                    continue;
                }
            }

        }
        $live->setAssociatedMediaVideos(array_values($live->getAssociatedMediaVideos()->toArray()));

        $webTvs = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:WebTv')
            ->getWebTvByLocale($lang, $festival)
        ;

        foreach ($webTvs as $key => &$webTv) {
            foreach ($webTv->getMediaVideos() as $mediaVideo) {
                if ($mediaVideo->getTranslations()) {
                    $translation = $mediaVideo->findTranslationByLocale($lang);
                    if ($translation instanceof MediaVideoTranslation) {
                        if ($lang != 'fr' && $translation->getStatus() !== MediaVideoTranslation::STATUS_TRANSLATED) {
                            $webTv->getMediaVideos()->removeElement($mediaVideo);
                            continue;
                        }
                        if ($translation->getJobMp4State() !== MediaVideoTranslation::ENCODING_STATE_READY) {
                            $webTv->getMediaVideos()->removeElement($mediaVideo);
                            continue;
                        }
                        if ($translation->getJobWebmState() !== MediaVideoTranslation::ENCODING_STATE_READY) {
                            $webTv->getMediaVideos()->removeElement($mediaVideo);
                            continue;
                        }
                        if (!$translation->getWebmUrl() || !$translation->getMp4Url()) {
                            $webTv->getMediaVideos()->removeElement($mediaVideo);
                            continue;
                        }
                        $webTv->setMediaVideos(array_values($webTv->getMediaVideos()->toArray()));
                    }
                }
            }
            if (!$webTv->getMediaVideos()->count()) {
                unset($webTvs[$key]);
            }
        }
        $webTvs = array_values($webTvs);


        $videos = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:MediaVideo')
            ->getApiLiveMediaVideos($festival, $lang)
        ;

        $item = array(
            'live'    => $live,
            'web_tvs' => $webTvs,
            'videos'  => $videos,
        );

        // set context view
        $groups = array('live');
        $context = $coreManager->setContext($groups, $paramFetcher);
//        //$context->addExclusionStrategy(new TranslationExclusionStrategy($lang));
        $context->setVersion($version);

        // create view
        $view = $this->view($item, 200);
        $view->setSerializationContext($context);

        return $view;
    }

    /**
     * Return a single web tv by $id
     *
     * @Rest\Get("/webtvs/{id}")
     * @Rest\View()
     * @ApiDoc(
     *  resource = true,
     *  description = "Get a web tv by id",
     *  section="Web Tvs",
     *  statusCodes = {
     *     200 = "Returned when successful",
     *     204 = "Returned when no film is found"
     *  },
     *  requirements={
     *      {
     *          "name"="id",
     *          "requirement"="[\d+]",
     *          "dataType"="string",
     *          "description"="The web tv identifier"
     *      }
     *  },
     *  output={
     *      "class"="Base\CoreBundle\Entity\WebTv",
     *      "groups"={"web_tv_show"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     * @Rest\QueryParam(name="lang", requirements="(fr|en)", default="fr", description="The lang")
     *
     * @param ParamFetcher $paramFetcher
     * @param int $id
     * @return View
     */
    public function getWebTvAction(ParamFetcher $paramFetcher, $id)
    {
        // coremanager shortcut
        $coreManager = $this->get('base.api.core_manager');

        // get festival year / version
        $festival = $coreManager->getApiFestivalYear();
        $version = ($paramFetcher->get('version') !== null) ? $paramFetcher->get('version') : $this->container->getParameter('api_version');
        $lang = $paramFetcher->get('lang');

        // create query
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository($this->repository)->getApiWebTv($id, $festival, new DateTime(), $lang);
        // set context view
        $groups = array('web_tv_show');
        $context = $coreManager->setContext($groups, $paramFetcher);
        //$context->addExclusionStrategy(new TranslationExclusionStrategy($lang));
        $context->setVersion($version);

        // create view
        $statusCode = ($entity !== null) ? 200 : 204;
        $view = $this->view($entity, $statusCode);
        $view->setSerializationContext($context);

        return $view;
    }

}