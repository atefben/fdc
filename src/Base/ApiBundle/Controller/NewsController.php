<?php

namespace Base\ApiBundle\Controller;

use Base\CoreBundle\Entity\FilmProjection;
use Base\CoreBundle\Entity\Info;
use Base\CoreBundle\Entity\MediaImage;
use Base\CoreBundle\Entity\News;
use Base\CoreBundle\Entity\Statement;
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
     * @Rest\QueryParam(name="time", description="Timestamp of the day to display")
     *
     * @param ParamFetcher $paramFetcher
     * @return View
     */
    public function getNewsAction(ParamFetcher $paramFetcher)
    {
        // coremanager shortcut
        $coreManager = $this->get('base.api.core_manager');

        // get festival year / version
        $festival = $coreManager->getApiFestivalYear();
        $version = ($paramFetcher->get('version') !== null) ? $paramFetcher->get('version') : $this->container->getParameter('api_version');
        $lang = $paramFetcher->get('lang');
        $dateTime = new \DateTime();

        $time = $paramFetcher->get('time');
        if ($time) {
            $dateTime->setTimestamp($time);
        }

        $settings = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:Settings')
            ->findOneBySlug('fdc-year')
        ;

        if ($settings === null) {
            throw $this->createNotFoundException();
        }

        // news
        $news = $this->getApiSameDayNews($festival, $lang, $dateTime);
        $infos = $this->getApiSameDayInfos($festival, $lang, $dateTime);
        $statements = $this->getApiSameDayStatements($festival, $lang, $dateTime);

        // projections
        $projections = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:FilmProjection')
            ->getNewsApiProjections($festival, $dateTime)
        ;

        $images = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:MediaImage')
            ->getNewsApiImages($lang, $festival, $dateTime)
        ;

        $items = array_merge($news, $infos, $statements, $projections, $images);

        $items = $this->buildDays($items);
        // set context view
        $groups = array('news_list');
        $context = $coreManager->setContext($groups, $paramFetcher);
        $context->addExclusionStrategy(new TranslationExclusionStrategy($lang));
        $context->setVersion($version);

        // create view
        $view = $this->view($items, 200);
        $view->setSerializationContext($context);

        return $view;
    }

    public function getApiSameDayNews($festival, $locale, $dateTime)
    {
        $items = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:News')
            ->getNewsApiSameDayNews($locale, $festival, $dateTime)
        ;
        return $items ? $items : array();
    }

    public function getApiSameDayInfos($festival, $locale, $dateTime)
    {
        $items = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:Info')
            ->getNewsApiSameDayInfos($locale, $festival, $dateTime)
        ;
        return $items ? $items : array();
    }

    public function getApiSameDayStatements($festival, $locale, $dateTime)
    {
        $items = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:Statement')
            ->getNewsApiSameDayStatements($locale, $festival, $dateTime)
        ;
        return $items ? $items : array();
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

    protected function buildDaysGroup($items)
    {
        $days = array();
        foreach ($items as $item) {
            $dayKey = $item->getPublishedAt()->format("Y-m-d");
            if (!array_key_exists($dayKey, $days)) {
                $dateTime = $item->getPublishedAt();
                $dayTime = clone $dateTime;
                $days[$dayKey] = array(
                    'date' => $dayTime,
                    'news' => array(),
                );
            }
            $itemKey = $item->getPublishedAt()->format('Y-m-d-H-i-s-') . $item->getId() . '-' . strtolower(get_class($item));
            $days[$dayKey]['news'][$itemKey] = $item;
        }

        foreach ($days as $key => $value) {
            krsort($days[$key]['news']);
            $days[$key]['news'] = array_values($days[$key]['news']);
        }
        ksort($days);
        return array_values($days);
    }

    protected function buildDays($items)
    {
        $days = array();
        foreach ($items as $item) {
            if ($item instanceof News || $item instanceof Info || $item instanceof Statement || $item instanceof MediaImage) {
                $timeMethod = 'getPublishedAt';
            }
            elseif ($item instanceof FilmProjection) {
                $timeMethod = 'getStartsAt';
            }
            $dayKey = $item->{$timeMethod}()->format("Y-m-d");
            if (!array_key_exists($dayKey, $days)) {
                $dateTime = $item->{$timeMethod}();
                $dayTime = clone $dateTime;
                $days[$dayKey] = array(
                    'date' => $dayTime,
                    'items' => array(),
                );
            }
            $itemKey = $item->{$timeMethod}()->format('Y-m-d-H-i-s-') . $item->getId() . '-' . strtolower(get_class($item));
            $days[$dayKey]['items'][$itemKey] = $item;
        }

        foreach ($days as $key => $value) {
            krsort($days[$key]['items']);
            $days[$key]['items'] = array_values($days[$key]['items']);
        }
        ksort($days);
        return array_values($days);
    }

}
