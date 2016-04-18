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
            } elseif ($item instanceof FilmProjection) {
                $timeMethod = 'getStartsAt';
            }
            $dayKey = $item->{$timeMethod}()->format("Y-m-d");
            if (!array_key_exists($dayKey, $days)) {
                $dateTime = $item->{$timeMethod}();
                $dayTime = clone $dateTime;
                $days[$dayKey] = array(
                    'date'  => $dayTime,
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
     *      "class"="Base\CoreBundle\Entity\News|Base\CoreBundle\Entity\Info|Base\CoreBundle\Entity\Statement",
     *      "groups"={"news_show"}
     *  }
     * )
     *
     * @Rest\QueryParam(name="version", description="Api Version number")
     * @Rest\QueryParam(name="lang", requirements="(fr|en)", default="fr", description="The lang")
     * @Rest\QueryParam(name="type", requirements="(news|info|statement)", default="news", description="The news type")
     *
     * @param ParamFetcher $paramFetcher
     * @param integer $id
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
        $type = $paramFetcher->get('type');

        $dateTime = new DateTime;
        $entityFunction = 'getSingle' . ucfirst($type);
        $sameDayFunction = 'getSameDayForSingle' . ucfirst($type);
        if (method_exists($this, $entityFunction)) {
            $entity = $this->$entityFunction($id, $festival, $lang, $dateTime);
        }

        $output = array();
        if ($entity) {
            $output['news'] = $entity;
            $count = 3;
            $dateTime = $entity->getPublishedAt();
            $output['same_day'] = $this->$sameDayFunction($festival, $lang, $dateTime, $count, $entity->getId());
        }

        // set context view
        $groups = array('news_show');
        $context = $coreManager->setContext($groups, $paramFetcher);
        $context->addExclusionStrategy(new TranslationExclusionStrategy($lang));
        $context->setVersion($version);

        $view = $this->view($output, $output ? 200 : 204);
        $view->setSerializationContext($context);

        return $view;
    }

    /**
     * @param $id
     * @param $festival
     * @param $lang
     * @param DateTime $dateTime
     * @return News|null
     */
    protected function getSingleNews($id, $festival, $lang, DateTime $dateTime)
    {
        $news = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:News')
            ->getApiNewsById($id, $festival, $dateTime, $lang)
        ;
        return $news;
    }

    /**
     * @param mixed $festival
     * @param string $locale
     * @param DateTime $dateTime
     * @param integer $count
     * @param integer $id
     * @return array
     */
    protected function getSameDayForSingleNews($festival, $locale, DateTime $dateTime, $count, $id)
    {
        $news = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:News')
            ->getSameDayNews($festival, $locale, $dateTime, $count, $id, true)
        ;
        return $news;
    }

    /**
     * @param $id
     * @param $festival
     * @param $lang
     * @param DateTime $dateTime
     * @return Statement|null
     */
    protected function getSingleInfo($id, $festival, $lang, DateTime $dateTime)
    {
        $info = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:Info')
            ->getApiInfoById($id, $festival, $dateTime, $lang)
        ;
        return $info;
    }

    /**
     * @param mixed $festival
     * @param string $locale
     * @param DateTime $dateTime
     * @param integer $count
     * @param integer $id
     * @return array
     */
    protected function getSameDayForSingleInfo($festival, $locale, DateTime $dateTime, $count, $id)
    {
        $news = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:Info')
            ->getSameDayInfo($festival, $locale, $dateTime, $count, $id, true)
        ;
        return $news;
    }

    /**
     * @param $id
     * @param $festival
     * @param $lang
     * @param DateTime $dateTime
     * @return Statement|null
     */
    protected function getSingleStatement($id, $festival, $lang, DateTime $dateTime)
    {
        $statement = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:Statement')
            ->getApiStatementById($id, $festival, $dateTime, $lang)
        ;
        return $statement;
    }



    /**
     * @param mixed $festival
     * @param string $locale
     * @param DateTime $dateTime
     * @param integer $count
     * @param integer $id
     * @return array
     */
    protected function getSameDayForSingleStatement($festival, $locale, DateTime $dateTime, $count, $id)
    {
        $news = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:Statement')
            ->getSameDayStatement($festival, $locale, $dateTime, $count, $id, true)
        ;
        return $news;
    }

}
