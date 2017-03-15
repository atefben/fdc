<?php

namespace FDC\CorporateBundle\Controller;

use Base\CoreBundle\Interfaces\FDCEventRoutesInterface;
use DateTime;
use Exception;
use FDC\EventBundle\Component\Controller\Controller;
use FDC\EventBundle\Form\Type\ShareEmailType;
use Guzzle\Http\Client;
use Guzzle\Http\Exception\BadResponseException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/")
 */
class GlobalController extends Controller
{
    /**
     * @Route("/share-email/", options={"expose"=true})
     * @Template("FDCCorporateBundle:Global:share-email.html.twig")
     * @param Request $request
     * @param $section
     * @param $detail
     * @param $title
     * @param $description
     * @param $url
     * @param $artist
     * @param $color
     * @return array|JsonResponse
     */
    public function shareEmailAction(Request $request, $section = null, $detail = null, $title = null, $description = null, $url = null, $artist = null, $color = false)
    {
        $email = [
            'section'     => $section,
            'detail'      => $detail,
            'title'       => $title,
            'description' => $description,
            'url'         => $url
        ];

        $translator = $this->get('translator');
        $hasErrors = false;

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
                foreach ($emails as $email) {
                    $data = $form->getData();
                    $artist = null;
                    if ($request->get('artist')) {
                        $artist = $this
                            ->getDoctrineManager()
                            ->getRepository('BaseCoreBundle:FilmPerson')
                            ->find($request->get('artist'))
                        ;
                    }
                    $message = \Swift_Message::newInstance()
                        ->setSubject($data['title'])
                        ->setFrom($data['user'])->setTo($email)
                        ->setBody($this->renderView('FDCCorporateBundle:Emails:share.html.twig', [
                            'message'     => $data['message'],
                            'section'     => $data['section'],
                            'title'       => $data['title'],
                            'description' => strip_tags($data['description'], '<p><em>'),
                            'detail'      => $data['detail'],
                            'url'         => $data['url'],
                            'artist'      => $artist,
                        ]), 'text/html')
                    ;
                    $mailer = $this->get('mailer');
                    $mailer->send($message);

                    $response['success'] = true;

                    //send mail copy
                    if ($data['copy']) {
                        $message = \Swift_Message::newInstance()
                            ->setSubject($data['title'])
                            ->setFrom($data['user'])
                            ->setTo($data['user'])
                            ->setBody($this->renderView('FDCCorporateBundle:Emails:share.html.twig', [
                                'message'     => $data['message'],
                                'section'     => $data['section'],
                                'title'       => $data['title'],
                                'description' => strip_tags($data['description'], '<p><em>'),
                                'detail'      => $data['detail'],
                                'url'         => $data['url'],
                                'artist'      => $artist,
                            ]), 'text/html')
                        ;
                        $mailer = $this->get('mailer');
                        $mailer->send($message);
                    }

                    // subscribe to newsletter
                    if ($data['newsletter']) {
                        $locale = ($request->getLocale() == 'fr') ? 'fr' : 'en';
                        $exist = $this->newsletterEmailExists($data['user']);
                        if ($exist == false) {
                            $this->newsletterEmailSubscribe($data['email'], $locale);
                        }
                    }
                }
            } else {
                $response['success'] = false;
            }
            return new JsonResponse($response);
        }

        if ($artist) {
            return [
                'share_email' => $email,
                'form'        => $form,
                'hasErrors'   => $hasErrors,
                'artist'      => $artist,
                'color'       => $color
            ];
        } else {
            return [
                'share_email' => $email,
                'form'        => $form,
                'hasErrors'   => $hasErrors,
                'color'       => $color
            ];
        }

    }

    private function newsletterEmailExists($email)
    {
        $client = new Client($this->container->getParameter('fdc_newsletter_api_url'));
        $request = $client->get('contact/' . $email);
        $request->setAuth(
            $this->container->getParameter('fdc_newsletter_api_universe'),
            $this->container->getParameter('fdc_newsletter_api_password')
        );

        try {
            $request->send();
        } catch (BadResponseException $e) {
            $this->get('logger')->err('Unable to verify if email exists in newsletter - ' . $e->getMessage());
            return false;
        } catch (Exception $e) {
            $this->get('logger')->err('Unexpected error when verifying if email exists in newsletter - ' . $e->getMessage());
            return false;
        }

        return ($request->getResponse()->getStatusCode() === 200) ? true : false;
    }

    private function newsletterEmailSubscribe($email, $locale)
    {
        $date = new DateTime();
        $client = new Client($this->container->getParameter('fdc_newsletter_api_url'));
        $query = json_encode([
            'email'     => $email,
            'lang'      => $locale,
            'date'      => $date->format('Y-m-d H:i:s'),
            'firstname' => '',
            'lastname'  => '',
            'lists'     => [
                ['id' => '0']
            ]
        ]);
        $request = $client->post('contact/', null, $query);

        $request->setAuth(
            $this->container->getParameter('fdc_newsletter_api_universe'), $this->container->getParameter('fdc_newsletter_api_password')
        );

        try {
            $request->send();
        } catch (BadResponseException $e) {
            $this->get('logger')->err('Unable to verify if ' . $email . ' exists in newsletter - ' . $e->getMessage());
            return false;
        } catch (Exception $e) {
            $this->get('logger')->err('Unexpected error when subscribing ' . $email . ' in newsletter - ' . $e->getMessage());
            return false;
        }

        return true;
    }

    /**
     * @Route("/landing")
     * @Template("FDCCorporateBundle:Global:landing.html.twig")
     * @return array
     */
    public function landingAction()
    {
        $homepage = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:HomepageCorporate')
            ->find(1)
        ;
        if ($homepage === null) {
            throw $this->createNotFoundException();
        }

        return [
            'date'     => $homepage->getFestivalStartsAt(),
            'homepage' => $homepage
        ];
    }

    /**
     * @Route("/timer")
     * @Template("FDCCorporateBundle:Global:timer.html.twig")
     * @return array
     */
    public function timerAction()
    {
        $homepage = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:HomepageCorporate')
            ->find(1)
        ;
        if ($homepage === null) {
            throw $this->createNotFoundException();
        }

        return [
            'homepage' => $homepage
        ];
    }

    /**
     * @Route("/menu")
     * @Template("FDCCorporateBundle:Global:nav.html.twig")
     * @param $route
     * @return array
     */
    public function menuAction($route)
    {
        $menus = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCEventRoutes')
            ->childrenHierarchy()
        ;

        $participatePage = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCPageParticipate')
            ->findAll()
        ;
        $preparePage = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCPagePrepare')
            ->findBy(['id' => $this->getParameter('admin_fdc_page_prepare_id')])
        ;

        $participateMenu = array_merge($preparePage, $participatePage);

        $displayedMenus = [];
        foreach ($menus as $menu) {
            if ($menu['site'] == FDCEventRoutesInterface::CORPO && $menu['type'] == 1) {
                $displayedMenus[] = $menu;
            }
        }

        usort($displayedMenus, function ($a, $b) {
            if ($a["position"] == $b["position"]) {
                return 0;
            }
            return ($a["position"] < $b["position"]) ? -1 : 1;
        });


        foreach ($displayedMenus as $key => $menu) {
            usort($displayedMenus[$key]['__children'], function ($a, $b) {
                if ($a["position"] == $b["position"]) {
                    return 0;
                }
                return ($a["position"] < $b["position"]) ? -1 : 1;
            });
        }

        $routesArticles = [
            'fdc_event_news_index',
            'fdc_event_news_get',
            'fdc_event_news_getarticles',
            'fdc_event_news_getphotos',
            'fdc_event_news_getvideos',
            'fdc_event_news_getaudios',
        ];

        $routesWebTv = [
            'fdc_event_television_live',
            'fdc_event_television_channels',
            'fdc_event_television_getchannel',
            'fdc_event_television_gettrailer',
            'fdc_event_television_trailers'
        ];

        return [
            'menus'           => $displayedMenus,
            'routesArticles'  => $routesArticles,
            'routesWebTv'     => $routesWebTv,
            'route'           => $route,
            'participateMenu' => $participateMenu,
            'currentYear' => $this->getSettings()->getFestival()->getYear(),
        ];
    }

    /**
     * @Route("/menu")
     * @Template("FDCCorporateBundle:Global:footer.html.twig")
     * @param Request $request
     * @param $route
     * @return array
     */
    public function footerAction(Request $request, $route)
    {
        $criteria = ['type' => 2, 'site' => 3];
        $sort = ['position' => 'asc'];
        $displayedFooterElements = $this
            ->getDoctrineManager()
            ->getRepository('BaseCoreBundle:FDCEventRoutes')
            ->findBy($criteria, $sort)
        ;

        return [
            'footer' => $displayedFooterElements,
            'route'  => $route
        ];
    }

}