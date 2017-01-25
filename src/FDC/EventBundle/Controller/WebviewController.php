<?php
namespace FDC\EventBundle\Controller;

use Base\CoreBundle\Interfaces\TranslateChildInterface;
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
        $repositories = [
            'news'       => [
                'article' => 'BaseCoreBundle:NewsArticle',
                'image'   => 'BaseCoreBundle:NewsImage',
                'audio'   => 'BaseCoreBundle:NewsAudio',
                'video'   => 'BaseCoreBundle:NewsVideo',
            ],
            'info'       => [
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


        $timestamp = time();
        $trans = $this->getTranslation($object, $request->getLocale());
        $trans = $trans && $trans->getStatus() === TranslateChildInterface::STATUS_PUBLISHED;
        $trans = $trans && $object->getPublishedAt();
        $trans = $trans && $timestamp >= $object->getPublishedAt()->getTimestamp();
        $trans = $trans && (!$object->getPublishEndedAt() || $timestamp <= $object->getPublishEndedAt()->getTimestamp());

        if (!$trans) {
            throw $this->createNotFoundException("$repository ($id) not found");
        }

        dump($object);

        return $this->render('FDCEventBundle:Webview:article.html.twig', [
            'type'    => $type,
            'variant' => $variant,
            'object'  => $object,
            'trans'   => $trans,
        ]);
    }
}