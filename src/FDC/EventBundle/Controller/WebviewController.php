<?php
namespace FDC\EventBundle\Controller;

use Base\CoreBundle\Entity\Info;
use Base\CoreBundle\Entity\News;
use Base\CoreBundle\Entity\Statement;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use DateTime;
use FDC\EventBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/webview")
 * Class WebviewController
 * @package FDC\EventBundle\Controller
 */
class WebviewController extends Controller
{

    /**
     * @Route("/article/{type}/{variant}/{id}")
     * @param Request $request
     * @param string $type
     * @param string $variant
     * @param int $id
     * @return Response
     */
    public function articleAction(Request $request, $type, $variant, $id)
    {
        $festival = $this->getFestival();
        $locale = $request->getLocale();
        $repositories = [
            'news'      => [
                'article' => 'BaseCoreBundle:NewsArticle',
                'image'   => 'BaseCoreBundle:NewsImage',
                'audio'   => 'BaseCoreBundle:NewsAudio',
                'video'   => 'BaseCoreBundle:NewsVideo',
            ],
            'info'      => [
                'article' => 'BaseCoreBundle:InfoArticle',
                'image'   => 'BaseCoreBundle:InfoImage',
                'audio'   => 'BaseCoreBundle:InfoAudio',
                'video'   => 'BaseCoreBundle:InfoVideo',
            ],
            'statement' => [
                'article' => 'BaseCoreBundle:StatementArticle',
                'image'   => 'BaseCoreBundle:StatementImage',
                'audio'   => 'BaseCoreBundle:StatementAudio',
                'video'   => 'BaseCoreBundle:StatementVideo',
            ],
        ];

        $repository = $repositories[$type][$variant];

        $object = $this->getDoctrineManager()->getRepository($repository)->find($id);

        if (!$object) {
            throw $this->createNotFoundException("$repository ($id) not found");
        }

        $isPublished = false;
        $fr = $this->getTranslation($object, 'fr');
        if ($fr) {
            $isPublished = $fr->getStatus() === TranslateChildInterface::STATUS_PUBLISHED;
        }
        $trans = $this->getTranslation($object, $locale);
        if ($trans && 'fr' != $trans->getLocale()) {
            $isPublished = $isPublished && $trans->getStatus() === TranslateChildInterface::STATUS_TRANSLATED;
        }

        $timestamp = time();
        $trans = $trans && $isPublished;
        $trans = $trans && $object->getPublishedAt();
        $trans = $trans && $timestamp >= $object->getPublishedAt()->getTimestamp();
        $trans = $trans && (!$object->getPublishEndedAt() || $timestamp <= $object->getPublishEndedAt()->getTimestamp());

        if (!$trans) {
            throw $this->createNotFoundException("$repository ($id) not found");
        }

        $samedDayDateTime = $object->getPublishedAt();
        $news = $this->getSameDayNews($festival, $locale, $samedDayDateTime, 3, $object->getId());
        $infos = $this->getSameDayInfo($festival, $locale, $samedDayDateTime, 3, $object->getId());
        $statements = $this->getSameDayStatement($festival, $locale, $samedDayDateTime, 3, $object->getId());
        $sameDayObjects = $this->orderAndSlice(array_merge($news, $infos, $statements), 3);

        return $this->render('FDCEventBundle:Webview:article.html.twig', [
            'type'           => $type,
            'variant'        => $variant,
            'object'         => $object,
            'trans'          => $trans,
            'sameDayObjects' => $sameDayObjects,
        ]);
    }

    /**
     * @param mixed $festival
     * @param string $locale
     * @param DateTime $dateTime
     * @param integer $count
     * @param integer $id
     * @return News[]
     */
    private function getSameDayNews($festival, $locale, DateTime $dateTime, $count, $id)
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
     * @param mixed $festival
     * @param string $locale
     * @param DateTime $dateTime
     * @param integer $count
     * @param integer $id
     * @return Info[]
     */
    private function getSameDayInfo($festival, $locale, DateTime $dateTime, $count, $id)
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
     * @param mixed $festival
     * @param string $locale
     * @param DateTime $dateTime
     * @param integer $count
     * @param integer $id
     * @return Statement[]
     */
    private function getSameDayStatement($festival, $locale, DateTime $dateTime, $count, $id)
    {
        $news = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('BaseCoreBundle:Statement')
            ->getSameDayStatement($festival, $locale, $dateTime, $count, $id, true)
        ;
        return $news;
    }

    /**
     * @param $items
     * @param int $count
     * @return array
     */
    private function orderAndSlice($items, $count = 3)
    {
        $toSort = [];
        foreach ($items as $item) {
            $key = $item->getPublishedAt()->getTimestamp();
            if ($item instanceof News) {
                $key .= '-3';
            }
            if ($item instanceof Info) {
                $key .= '-2';
            }
            if ($item instanceof Statement) {
                $key .= '-1';
            }
            $toSort[$key] = $item;
        }

        krsort($toSort);
        return array_values(array_slice($toSort, 0, $count));
    }
}