<?php

namespace Base\AdminBundle\Controller;

use Base\CoreBundle\Component\Interfaces\NodeArticleInterface;
use Base\CoreBundle\Component\Interfaces\NodeAudioInterface;
use Base\CoreBundle\Component\Interfaces\NodeImageInterface;
use Base\CoreBundle\Component\Interfaces\NodeVideoInterface;
use Base\CoreBundle\Entity\News;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class AjaxController
 * @package Base\AdminBundle\Controller
 * @Route("/ajax")
 */
class AjaxController extends Controller
{
    /**
     * @param $type
     * @param $id
     * @param $locale
     * @param string $site
     * @return JsonResponse
     * @Route("/node-url/{type}/{id}/{locale}/{site}", options={"expose"=true})
     */
    public function nodeUrlAction($type, $id, $locale, $site = 'event')
    {
        $data = null;
        if ($type == 'news') {
            $node = $this
                ->getDoctrine()
                ->getRepository('BaseCoreBundle:News')
                ->find($id)
            ;
            if ($node) {
                $trans = $node->findTranslationByLocale($locale);
                if ($trans) {
                    if ($site == 'event') {
                        $data = $this->generateUrl('fdc_event_news_get', [
                            '_locale' => $locale,
                            'format'  => $this->getFormat($node),
                            'slug'    => $trans->getSlug(),
                        ], UrlGeneratorInterface::ABSOLUTE_URL);
                    } elseif ($site == 'corporate') {
                        $data = $this->generateUrl('fdc_corporate_news_get', [
                            '_locale' => $locale,
                            'format'  => $this->getFormat($node),
                            'slug'    => $trans->getSlug(),
                            'year'    => $node->getFestival()->getYear(),
                        ], UrlGeneratorInterface::ABSOLUTE_URL);
                    }
                }
            }
        } elseif ($type == 'info') {
            $node = $this
                ->getDoctrine()
                ->getRepository('BaseCoreBundle:Info')
                ->find($id)
            ;
            if ($node) {
                $trans = $node->findTranslationByLocale($locale);
                if ($trans) {
                    if ($site == 'event') {
                        $data = $this->generateUrl('fdc_press_news_get', [
                            '_locale' => $locale,
                            'type'    => 'info',
                            'format'  => $this->getFormat($node),
                            'slug'    => $trans->getSlug(),
                        ], UrlGeneratorInterface::ABSOLUTE_URL);
                    } elseif ($site == 'corporate') {
                        $data = $this->generateUrl('fdc_corporate_news_presssingle', [
                            '_locale' => $locale,
                            'type'    => 'info',
                            'format'  => $this->getFormat($node),
                            'slug'    => $trans->getSlug(),
                        ], UrlGeneratorInterface::ABSOLUTE_URL);
                    }
                }
            }
        } elseif ($type == 'statement') {
            $node = $this
                ->getDoctrine()
                ->getRepository('BaseCoreBundle:Statement')
                ->find($id)
            ;
            if ($node) {
                $trans = $node->findTranslationByLocale($locale);
                if ($trans) {
                    if ($site == 'event') {
                        $data = $this->generateUrl('fdc_press_news_get', [
                            '_locale' => $locale,
                            'type'    => 'communique',
                            'format'  => $this->getFormat($node),
                            'slug'    => $trans->getSlug(),
                        ], UrlGeneratorInterface::ABSOLUTE_URL);
                    } elseif ($site == 'corporate') {
                        $data = $this->generateUrl('fdc_corporate_news_presssingle', [
                            '_locale' => $locale,
                            'type'    => 'communique',
                            'format'  => $this->getFormat($node),
                            'slug'    => $trans->getSlug(),
                        ], UrlGeneratorInterface::ABSOLUTE_URL);
                    }
                }
            }
        }

        return new JsonResponse($data);
    }

    public function getFormat($node)
    {
        if ($node instanceof NodeArticleInterface) {
            return 'articles';
        } elseif ($node instanceof NodeAudioInterface) {
            return 'audios';
        } elseif ($node instanceof NodeImageInterface) {
            return 'images';
        } elseif ($node instanceof NodeVideoInterface) {
            return 'videos';
        }
    }

}