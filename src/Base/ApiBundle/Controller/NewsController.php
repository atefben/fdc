<?php

namespace Base\ApiBundle\Controller;

use Base\CoreBundle\Entity\News;
use \DateTime;

use Base\ApiBundle\Exclusion\TranslationExclusionStrategy;
use Base\ApiBundle\Component\FOSRestController;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Routing\ClassResourceInterface;

use FOS\RestBundle\View\View;
use JMS\SecurityExtraBundle\Annotation\Secure;
use JMS\Serializer\SerializationContext;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * NewsController class.
 *
 * \@extends FOSRestController
 */
class NewsController extends FOSRestController
{
    private $repository = 'BaseCoreBundle:News';

    /**
     * Return an array of news, can be filtered with page / offset parameters
     *
     * @Rest\View()
     * @ApiDoc(
     *   resource = true,
     *   description = "Get all news",
     *   section="News",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *   },
     *  output={
     *      "class"="Base\CoreBundle\Entity\News",
     *      "groups"={"news_list"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     * @Rest\QueryParam(name="lang", requirements="(fr|en)", default="fr", description="The lang")
     * @Rest\QueryParam(name="page", requirements="\d+", default=1, description="The page number")
     * @Rest\QueryParam(name="offset", requirements="\d+", default=10, description="The offset number, maximum 10")
     *
     * @return View
     */
    public function getNewsAction(Paramfetcher $paramFetcher)
    {
        // coremanager shortcut
        $coreManager = $this->get('base.api.core_manager');

        // get festival year / version
        $festival = $coreManager->getApiFestivalYear();
        $version = ($paramFetcher->get('version') !== null) ? $paramFetcher->get('version') : $this->container->getParameter('api_version');
        $lang = $paramFetcher->get('lang');

        $settings = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:Settings')
            ->findOneBySlug('fdc-year')
        ;

        if ($settings === null) {
            throw $this->createNotFoundException();
        }

        $start = $settings->getFestival()->getFestivalStartsAt();
        $end = $settings->getFestival()->getFestivalEndsAt();
        $now = new \DateTime();

        $results = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:News')
            ->getApiNews($festival, $lang, $start, $end)
            ->getResult()
        ;

        $items = array();
        foreach ($results as $item) {
            if ($item instanceof News) {
                $key = $item->getPublishedAt()->format('Y-m-d');
                if (!array_key_exists($key, $items)) {
                    $items[$key] = array(
                        'date' => $item->getPublishedAt(),
                        'news' => array(),
                    );
                }
                $items[$key]['news'] = $item;
            }
        }



        // set context view
        $groups = array('news_list');
        $context = $coreManager->setContext($groups, $paramFetcher);
        $context->addExclusionStrategy(new TranslationExclusionStrategy($lang));
        $context->setVersion($version);

        // create view
        $view = $this->view(array_values($items), 200);
        $view->setSerializationContext($context);

        return $view;
    }


    /**
     * Return a single news by $id
     *
     * @Rest\View()
     * @ApiDoc(
     *  resource = true,
     *  description = "Get a news by $id",
     *  section="News",
     *  statusCodes = {
     *     200 = "Returned when successful",
     *     204 = "Returned when no news is found"
     *  },
     *  requirements={
     *      {
     *          "name"="id",
     *          "requirement"="[\s-+]",
     *          "dataType"="string",
     *          "description"="The news identifier"
     *      }
     *  },
     *  output={
     *      "class"="Base\CoreBundle\Entity\News",
     *      "groups"={"news_show"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     * @Rest\QueryParam(name="lang", requirements="(fr|en)", default="fr", description="The lang")
     *
     * @param ParamFetcher $paramFetcher
     * @return View
     */
    public function getNewAction(ParamFetcher $paramFetcher, $id)
    {
        // core manager shortcut
        $coreManager = $this->get('base.api.core_manager');

        // get festival year / version
        $festival = $coreManager->getApiFestivalYear();
        $version = ($paramFetcher->get('version') !== null) ? $paramFetcher->get('version') : $this->container->getParameter('api_version');
        $lang = $paramFetcher->get('lang');

        // create query
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository($this->repository)->getApiNewsById($id, $festival, new DateTime(), $lang);

        if ($entity !== null) {
            // add query for audio / video encoder
            $array = array();
            if (strpos(get_class($entity), 'NewsAudio') !== false) {
                $array = $this->removeUnpublishedNewsAudioVideo(array($entity), $lang);
            } else if (strpos(get_class($entity), 'NewsVideo') !== false) {
                $array = $this->removeUnpublishedNewsAudioVideo(array($entity), $lang);
            }
            if (count($array)) {
                $entity = $array[0];
            }
        }

        // set context view
        $groups = array('news_show');
        $context = $coreManager->setContext($groups, $paramFetcher);
        $context->addExclusionStrategy(new TranslationExclusionStrategy($lang));
        $context->setVersion($version);

        $view = $this->view($entity, 200);
        $view->setSerializationContext($context);

        return $view;
    }

}
