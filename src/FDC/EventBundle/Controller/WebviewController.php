<?php
namespace FDC\EventBundle\Controller;

use FDC\EventMobileBundle\Component\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/webview")
 * Class WebviewController
 * @package FDC\EventBundle\Controller
 */
class WebviewController extends Controller
{

    /**
     * @Route("/article/{type}/{variant}/{id}")
     * @param string $type
     * @param string $variant
     * @param int $id
     * @return Response
     */
    public function articleAction($type, $variant, $id)
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
            'communique' => [
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
        return $this->render('FDCEventBundle:Webview:article.html.twig', [
            'type'    => $type,
            'variant' => $variant,
            'object'  => $object,
        ]);
    }
}