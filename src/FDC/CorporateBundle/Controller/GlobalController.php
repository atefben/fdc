<?php

namespace FDC\CorporateBundle\Controller;

use Base\CoreBundle\Entity\FilmPerson;
use Base\CoreBundle\Entity\Newsletter;
use Base\CoreBundle\Interfaces\FDCEventRoutesInterface;
use FDC\EventBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use \DateTime;
use \Exception;

use FDC\EventBundle\Form\Type\ShareEmailType;
use FDC\EventBundle\Form\Type\NewsletterType;
use FDC\EventBundle\Form\Type\SearchType;

use Guzzle\Http\Exception\BadResponseException;
use Guzzle\Http\Client;

/**
 * @Route("/")
 */
class GlobalController extends Controller {
    /**
     * @Route("/share-email/", options={"expose"=true})
     * @Template("FDCCorporateBundle:Global:share-email.html.twig")
     * @param Request $request
     * @param $section
     * @param $detail
     * @param $title
     * @param $description
     * @return array
     */
    public function shareEmailAction(Request $request, $section = null, $detail = null, $title = null, $description = null, $url = null, $artist = null, $color = false) {
        $email = array(
            'section' => $section,
            'detail' => $detail,
            'title' => $title,
            'description' => $description,
            'url' => $url
        );

        $translator = $this->get('translator');
        $hasErrors  = false;

        $form = $this->createForm(new ShareEmailType($translator, $artist));
        if ($request->isMethod('POST')) {
            $form->submit($request);
            if ($form['email']->isValid()) {
                $emails = explode(',', $form['email']->getData());
                foreach ($emails as $email) {
                    if (!filter_var(trim($email), FILTER_VALIDATE_EMAIL)) {
                        $error = new FormError('email.invalid');
                        $form['email']->addError($error);
                        break;
                    }
                }
            }

            if ($form->isValid()) {
                foreach ($emails as $email){
                    $data    = $form->getData();
                    $artist = $request->get('artist');
                    $message = \Swift_Message::newInstance()->setSubject($data['title'])->setFrom($data['user'])->setTo($email)->setBody($this->renderView('FDCCorporateBundle:Emails:share.html.twig', array(
                        'message' => $data['message'],
                        'section' => $data['section'],
                        'title' => $data['title'],
                        'description' => strip_tags($data['description'], '<p><em>'),
                        'detail' => $data['detail'],
                        'url' => $data['url'],
                        'artist' => ($artist != null) ? $this->getDoctrineManager()->getRepository('BaseCoreBundle:FilmPerson')->find($artist) : null
                    )), 'text/html');
                    $mailer  = $this->get('mailer');
                    $mailer->send($message);

                    $response['success'] = true;

                    //send mail copy
                    if ($data['copy']) {
                        $message = \Swift_Message::newInstance()->setSubject($data['title'])->setFrom($data['user'])->setTo($data['user'])->setBody($this->renderView('FDCEventBundle:Emails:share.html.twig', array(
                            'message' => $data['message'],
                            'section' => $data['section'],
                            'title' => $data['title'],
                            'description' => strip_tags($data['description'], '<p><em>'),
                            'detail' => $data['detail'],
                            'url' => $data['url'],
                            'artist' => ($artist != null) ? $this->getDoctrineManager()->getRepository('BaseCoreBundle:FilmPerson')->find($artist) : null
                        )), 'text/html');
                        $mailer  = $this->get('mailer');
                        $mailer->send($message);
                    }

                    // subscribe to newsletter
                    if ($data['newsletter']) {
                        $locale = ($request->getLocale() == 'fr') ? 'fr' : 'en';
                        $exist = $this->newsletterEmailExists($data['user']);
                        if ($exist == false) {
                            $subscribed = $this->newsletterEmailSubscribe($data['email'], $locale);
                        }
                    }
                }
            } else {
                dump($form->getErrorsAsString());exit;
                $response['success'] = false;
            }
            return new JsonResponse($response);
        }

        if ($artist) {
            return array(
                'share_email' => $email,
                'form' => $form,
                'hasErrors' => $hasErrors,
                'artist' => $this->getDoctrineManager()->getRepository('BaseCoreBundle:FilmPerson')->find($artist),
                'color'  => $color
            );
        } else {
            return array(
                'share_email' => $email,
                'form' => $form,
                'hasErrors' => $hasErrors,
                'color'  => $color
            );
        }

    }

    /**
     * @Route("/landing")
     * @Template("FDCCorporateBundle:Global:landing.html.twig")
     * @return array
     */
    public function landingAction() {
        $em = $this->get('doctrine')->getManager();
        $homepage = $em->getRepository('BaseCoreBundle:HomepageCorporate')->find(1);
        if ($homepage === null) {
            throw new NotFoundHttpException();
        }

        return array(
            'date' => $homepage->getFestivalStartsAt(),
            'homepage' => $homepage
        );
    }

    /**
     * @Route("/timer")
     * @Template("FDCCorporateBundle:Global:timer.html.twig")
     * @return array
     */
    public function timerAction() {
        $em = $this->get('doctrine')->getManager();
        $homepage = $em->getRepository('BaseCoreBundle:HomepageCorporate')->find(1);
        if ($homepage === null) {
            throw new NotFoundHttpException();
        }

        return array(
            'homepage' => $homepage
        );
    }

    /**
     * @Route("/menu")
     * @Template("FDCCorporateBundle:Global:nav.html.twig")
     * @return array
     */
    public function menuAction($route) {

        $em = $this->get('doctrine')->getManager();
        $menus = $em->getRepository('BaseCoreBundle:FDCEventRoutes')->childrenHierarchy();

        // Menu Participer
        $participatePage = $em->getRepository('BaseCoreBundle:FDCPageParticipate')->findAll();
        $preparePage = $em->getRepository('BaseCoreBundle:FDCPagePrepare')->findById($this->getParameter('admin_fdc_page_prepare_id'));

        $participateMenu = array_merge($preparePage, $participatePage);

        $displayedMenus = array();
        foreach($menus as $menu){
            if($menu['site'] == FDCEventRoutesInterface::CORPO) {
                $displayedMenus[] = $menu;
            }
        }

        usort($displayedMenus, function($a, $b) {
            if ($a["position"] == $b["position"]) {
                return 0;
            }
            return ($a["position"] < $b["position"]) ? -1 : 1;
        });

       // dump($displayedMenus);exit;

        foreach ($displayedMenus as $key => $menu) {
            usort($displayedMenus[$key]['__children'], function($a, $b) {
                if ($a["position"] == $b["position"]) {
                    return 0;
                }
                return ($a["position"] < $b["position"]) ? -1 : 1;
            });
        }

        $routesArticles = array(
            'fdc_event_news_index',
            'fdc_event_news_get',
            'fdc_event_news_getarticles',
            'fdc_event_news_getphotos',
            'fdc_event_news_getvideos',
            'fdc_event_news_getaudios',
        );

        $routesWebTv = array(
            'fdc_event_television_live',
            'fdc_event_television_channels',
            'fdc_event_television_getchannel',
            'fdc_event_television_gettrailer',
            'fdc_event_television_trailers'
        );

        return array(
            'menus' => $displayedMenus,
            'routesArticles' => $routesArticles,
            'routesWebTv' => $routesWebTv,
            'route' => $route,
            'participateMenu' => $participateMenu
        );

    }

    /**
     * @Route("/menu")
     * @Template("FDCCorporateBundle:Global:footer.html.twig")
     * @return array
     */
    public function footerAction(Request $request, $route) {
        $em = $this->get('doctrine')->getManager();
        $displayedFooterElements = $em->getRepository('BaseCoreBundle:FDCEventRoutes')->findBy(
            array('type' => 2,'site' => 3),
            array('position' => 'asc'),
            null,
            null
        );
        return array(
            'footer' => $displayedFooterElements,
            'route' => $route
        );
    }

}