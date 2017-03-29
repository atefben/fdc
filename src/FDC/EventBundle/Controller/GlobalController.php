<?php

namespace FDC\EventBundle\Controller;

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
     * @Route("/suggestion", options={"expose"=true})
     * @Template("FDCEventBundle:Global:suggestion.html.twig")
     * @return array
     */
    public function suggestionAction() {
        $articles = array();
        $request  = $this->get('request');

        $em = $this->get('doctrine')->getManager();
        $dateTime = new DateTime();
        $locale = $request->getLocale();
        $settings = $em->getRepository('BaseCoreBundle:Settings')->findOneBySlug('fdc-year');
        $count = 8;

        if ($request->isXmlHttpRequest()) {

            $queryArticle = $em->getRepository('BaseCoreBundle:News')->getLastsNews($locale, $settings->getFestival()->getId(), $dateTime , $count);
            $articles = $this->removeUnpublishedNewsAudioVideo($queryArticle, $locale, $count);
        }

        return array(
            'articles' => $articles
        );

    }

    /**
     * @Route("/menu")
     * @Template("FDCEventBundle:Global:nav.html.twig")
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
            if($menu['site'] == FDCEventRoutesInterface::EVENT) {
                $displayedMenus[] = $menu;
            }
        }

        usort($displayedMenus, function($a, $b) {
            if ($a["position"] == $b["position"]) {
                return 0;
            }
            return ($a["position"] < $b["position"]) ? -1 : 1;
        });

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
     * @Template("FDCEventBundle:Global:footer.html.twig")
     * @return array
     */
    public function footerAction(Request $request, $route) {
        $em = $this->get('doctrine')->getManager();
        $displayedFooterElements = $em->getRepository('BaseCoreBundle:FDCEventRoutes')->findBy(
            array('type' => 2,'site' => 1),
            array('position' => 'asc'),
            null,
            null
        );

        return array(
            'footer' => $displayedFooterElements,
            'route' => $route
        );
    }


    /**
     * @Route("/share-email/", options={"expose"=true})
     * @Template("FDCEventBundle:Global:share-email.html.twig")
     * @param Request $request
     * @param $section
     * @param $detail
     * @param $title
     * @param $description
     * @return array
     */
    public function shareEmailAction(Request $request, $section = null, $detail = null, $title = null, $description = null, $url = null, $artist = null) {
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
                    $message = \Swift_Message::newInstance()->setSubject($data['title'])->setFrom($data['user'])->setTo($email)->setBody($this->renderView('FDCEventBundle:Emails:share.html.twig', array(
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
                'artist' => $this->getDoctrineManager()->getRepository('BaseCoreBundle:FilmPerson')->find($artist)
            );
        } else {
            return array(
                'share_email' => $email,
                'form' => $form,
                'hasErrors' => $hasErrors,
            );
        }

    }

    /**
     * @Route("/share-email-media", options={"expose"=true})
     * @Template("FDCEventBundle:Global:share-email-media.html.twig")
     * @param Request $request
     * @param $section
     * @param $detail
     * @param $title
     * @param $description
     * @return array
     */
    public function shareEmailMediaAction(Request $request, $section = null, $detail = null, $title = null, $description = null, $url = null) {
        $email = array(
            'section' => $section,
            'detail' => $detail,
            'title' => $title,
            'description' => $description,
            'url' => $url
        );

        $translator = $this->get('translator');
        $hasErrors  = false;

        $form = $this->createForm(new ShareEmailType($translator));

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
                    $message = \Swift_Message::newInstance()->setSubject($data['title'])->setFrom($data['user'])->setTo($email)->setBody($this->renderView('FDCEventBundle:Emails:share.html.twig', array(
                        'message' => $data['message'],
                        'section' => $data['section'],
                        'title' => $data['title'],
                        'description' => strip_tags($data['description'], '<p><em>'),
                        'detail' => $data['detail'],
                        'url' => $data['url']
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
                            'url' => $data['url']
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
                $response['success'] = false;
            }
            return new JsonResponse($response);
        }

        return array(
            'share_email' => $email,
            'form' => $form,
            'hasErrors' => $hasErrors
        );
    }

    private function newsletterEmailExists($email)
    {
        /*$client = new Client($this->container->getParameter('fdc_newsletter_api_url'));
        $request = $client->get('contact/' . $email);
        $request->setAuth(
            $this->container->getParameter('fdc_newsletter_api_universe'),
            $this->container->getParameter('fdc_newsletter_api_password')
        );

        try {
            $request->send();
        } catch (BadResponseException $e) {
            $this->get('logger')->err('Unable to verify if email exists in newsletter - '. $e->getMessage());
            return false;
        } catch (Exception $e) {
            $this->get('logger')->err('Unexpected error when verifying if email exists in newsletter - '. $e->getMessage());
            return false;
        }*/

        return false;
    }

    private function newsletterEmailSubscribe($email, $locale)
    {
        $date = new DateTime();
        $client = new Client($this->container->getParameter('fdc_newsletter_api_url'));
        $query = json_encode(array(
            'email' => $email,
            'lang' => $locale,
            'date' => $date->format('Y-m-d H:i:s'),
            'firstname' => '',
            'lastname' => '',
            'lists' => array(
                array('id' => '0')
            )
        ));
        $request = $client->post('contact/', null, $query);

        $request->setAuth(
            $this->container->getParameter('fdc_newsletter_api_universe'),
            $this->container->getParameter('fdc_newsletter_api_password')
        );

        try {
            $request->send();
        } catch (BadResponseException $e) {
            $this->get('logger')->err('Unable to verify if '. $email. ' exists in newsletter - '. $e->getMessage());
            return false;
        }  catch (Exception $e) {
            $this->get('logger')->err('Unexpected error when subscribing '. $email. ' in newsletter - '. $e->getMessage());
            return false;
        }

        return true;
    }

    /**
     * @Route( "/register/newsletter", options={"expose"=true})
     * @Template("FDCEventBundle:Global:newsletter.html.twig")
     * @param Request $request
     * @return JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newsletterAction(Request $request) {

        $translator = $this->get('translator');
        $newsForm   = $this->createForm(new NewsletterType($translator));
        $locale = ($request->getLocale() == 'fr') ? 'fr' : 'en';

        if ($request->isMethod('POST')) {
            $newsForm->handleRequest($request);
            if ($newsForm->isValid()) {
                $data = $newsForm->getData();
                $exist = $this->newsletterEmailExists($data['email']);
                $response['success'] = false;
                if ($exist == false) {
                    $subscribed = $this->newsletterEmailSubscribe($data['email'], $locale);
                    if ($subscribed == true) {
                        $response['success'] = true;
                    }
                } else {
                    $response['object'] = $translator->trans('newsletter.form.error.emaildejaenregistre',array(),'FDCEventBundle');
                }

                return new JsonResponse($response);
            }

        }

        return array(
            'newsform' => $newsForm->createView()
        );

    }

    /**
     * @Route("/breadcrumb")
     * @Template("FDCEventBundle:Global:breadcrumb.html.twig")
     * @return array
     */
    public function breadcrumbAction() {
        $breadcrumb = array(
            array(
                'name' => 'L\'actualité',
                'url' => '#'
            ),
            array(
                'name' => 'Jour après jour',
                'url' => '#'
            ),
            array(
                'name' => 'Lorem Ipsum',
                'url' => '#'
            )
        );

        return array(
            'breadcrumb' => $breadcrumb
        );
    }
    
    /**
     *
     * @Route("/search")
     * @Template("FDCEventBundle:Global:search.html.twig")
     * @param Request $request
     * @param $searchTerm
     * @return array
     */
    public function searchAction(Request $request, $searchTerm = null) {
        $translator = $this->get('translator');

        $searchForm = $this->createForm(new SearchType($translator, $searchTerm));

        $searchForm->submit($request);

        $formData   = $searchForm->getData();
        $searchTerm = $formData['search'];

        if ($searchTerm !== null) {
            return $this->redirect($this->generateUrl('fdc_event_search_searchsubmit', array(
                'searchTerm' => $searchTerm
            )));

        }

        return array(
            'searchForm' => $searchForm->createView()
        );
    }

    /**
     * @Route("/wishlist")
     * @Template("FDCEventBundle:Global:whichlist.html.twig")
     * @return array
     */
    public function wishlistAction(Request $request) {
        $bitlyManager = $this->get('base.manager.bitly');
        $locale = $request->getLocale();
        $ids  = explode('|',  $request->query->get('el'));
        if(is_array($ids)) {
            $movies = $this
                ->getDoctrineManager()
                ->getRepository('BaseCoreBundle:FilmFilm')
                ->getFilmsByIds($ids)
            ;
        }
        $params['access_token'] = '1471b10911b48ad79ad042b02a15711ea71fc6c0';
        $params['longUrl'] = 'http://' . $_SERVER['SERVER_NAME'] . '/' . $locale . '/wishlist?el=' . $request->query->get('el');
        $results = $bitlyManager->bitly_get('shorten', $params);
        return array(
            'movies' => $movies,
            'urlshare' => $results['data']['url']
        );

    }

    /**
     * @Route("/generateBitly")
     */
    public function generateBitlyAction(Request $request) {
        $locale = $request->getLocale();
        $ids  = $request->query->get('id');
        $bitlyManager = $this->get('base.manager.bitly');
        $params['access_token'] = '1471b10911b48ad79ad042b02a15711ea71fc6c0';
        $params['longUrl'] = 'http://' . $_SERVER['SERVER_NAME'] . '/' . $locale . '/wishlist?el=' . $ids;
        $results = $bitlyManager->bitly_get('shorten', $params);
        $reponse = array('url' => $results['data']['url']);
        return new JsonResponse($reponse);
    }
}
