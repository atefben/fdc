<?php

namespace FDC\EventBundle\Controller;

use Base\CoreBundle\Entity\Newsletter;
use FDC\EventBundle\Component\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use \DateTime;

use FDC\EventBundle\Form\Type\ShareEmailType;
use FDC\EventBundle\Form\Type\NewsletterType;
use FDC\EventBundle\Form\Type\SearchType;

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
        $displayedMenus = $em->getRepository('BaseCoreBundle:FDCEventRoutes')->childrenHierarchy();

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
            'route' => $route
        );

    }


    /**
     * @Route("/share-email", options={"expose"=true})
     * @Template("FDCEventBundle:Global:share-email.html.twig")
     * @param Request $request
     * @param $section
     * @param $detail
     * @param $title
     * @param $description
     * @return array
     */
    public function shareEmailAction(Request $request, $section = null, $detail = null, $title = null, $description = null, $url = null) {
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
                        'description' => $data['description'],
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
                            'description' => $data['description'],
                            'detail' => $data['detail'],
                            'url' => $data['url']
                        )), 'text/html');
                        $mailer  = $this->get('mailer');
                        $mailer->send($message);
                    }

                    // subscribe to newsletter
                    if ($data['newsletter']) {
                        $registration = new Newsletter();

                        //Find site by slug
                        $siteSlug = $this->container->getParameter('fdc_event_slug');
                        $site     = $this->getDoctrine()->getRepository('BaseCoreBundle:Site')->findOneBy(array(
                            'slug' => $siteSlug
                        ));

                        // check if not already in DB and if not, save data
                        $exist = $this->getDoctrine()->getRepository('BaseCoreBundle:Newsletter')->findOneBy(array(
                            'email' => $data['user']
                        ));

                        if ($exist == null) {
                            //Save Email & Enable
                            $registration->setEmail($data['user']);
                            $registration->setEnabled(true);
                            $registration->setSite($site);

                            //Check errors
                            $validator = $this->get('validator');
                            $errors    = $validator->validate($registration);

                            if (count($errors) > 0) {
                                $response['success'] = false;
                                $response['object']  = $translator->trans('newsletter.form.error.ladresseemailnestpasvalide');
                            } else {
                                // Form is valid
                                $em = $this->getDoctrine()->getManager();
                                $em->persist($registration);
                                $em->flush();
                            }
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

    /**
     * @Route( "/register/newsletter", options={"expose"=true})
     * @Template("FDCEventBundle:Global:newsletter.html.twig")
     * @param Request $request
     * @return JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newsletterAction(Request $request) {
        $translator = $this->get('translator');

        $newsForm     = $this->createForm(new NewsletterType($translator));
        $registration = new Newsletter();

        if ($request->isXmlHttpRequest() && $request->isMethod('POST')) {

            $newsForm->submit($request);

            if ($newsForm->isValid()) {

                $data = $newsForm->getData();

                //Check if entry already exist
                $exist = $this->getDoctrine()->getRepository('BaseCoreBundle:Newsletter')->findOneBy(array(
                    'email' => $data['email']
                ));

                if ($exist == null) {

                    $response['success'] = true;

                    //Find site by slug
                    $siteSlug = $this->container->getParameter('fdc_event_slug');
                    $site     = $this->getDoctrine()->getRepository('BaseCoreBundle:Site')->findOneBy(array(
                        'slug' => $siteSlug
                    ));

                    //Save Email & Enable
                    $registration->setEmail($data['email']);
                    $registration->setEnabled(true);
                    $registration->setSite($site);

                    //Check errors
                    $validator = $this->get('validator');
                    $errors    = $validator->validate($registration);

                    if (count($errors) > 0) {
                        $response['success'] = false;
                        $response['object']  = $translator->trans('newsletter.form.error.ladresseemailnestpasvalide');
                    } else {
                        // Form is valid
                        $em = $this->getDoctrine()->getManager();
                        $em->persist($registration);
                        $em->flush();
                    }
                }

                else {
                    $response['success'] = false;
                    $response['object']  = $translator->trans('newsletter.form.error.emaildejaenregistre');
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
            return $this->redirect($this->generateUrl('fdc_event_global_searchsubmit', array(
                'searchTerm' => $searchTerm
            )));

        }

        return array(
            'searchForm' => $searchForm->createView()
        );
    }

    /**
     * @Route("/search/{searchTerm}", options={"expose"=true})
     * @Template("FDCEventBundle:Global:search.page.html.twig")
     * @param $searchTerm
     * @param null $resultFilter
     * @return array
     */
    public function searchSubmitAction($searchTerm, $resultFilter = null) {
        $result = array(
            'category' => array(
                'actualite' => array(
                    array(
                        'title' => 'Stéphane Beizé interroge la loi du marché',
                        'createdAt' => new \DateTime(),
                        'slug' => 'enrages-polar-hybride-d-eric-hannezo',
                        'image' => array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                        ),
                        'format' => 'article',
                        'theme' => 'competition',
                        'category' => 'competition'
                    ),
                    array(
                        'title' => 'Stéphane Beizé interroge la loi du marché',
                        'createdAt' => new \DateTime(),
                        'slug' => 'enrages-polar-hybride-d-eric-hannezo',
                        'image' => array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                        ),
                        'format' => 'article',
                        'theme' => 'competition',
                        'category' => 'competition'
                    ),
                    array(
                        'title' => 'Stéphane Beizé interroge la loi du marché',
                        'createdAt' => new \DateTime(),
                        'slug' => 'enrages-polar-hybride-d-eric-hannezo',
                        'image' => array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                        ),
                        'format' => 'article',
                        'theme' => 'competition',
                        'category' => 'competition'
                    ),
                    array(
                        'title' => 'Stéphane Beizé interroge la loi du marché',
                        'createdAt' => new \DateTime(),
                        'slug' => 'enrages-polar-hybride-d-eric-hannezo',
                        'image' => array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                        ),
                        'format' => 'article',
                        'theme' => 'competition',
                        'category' => 'competition'
                    )
                ),
                'artist' => array(
                    array(
                        'fullName' => 'Vincent Cassel',
                        'slug' => 'vincent-cassel',
                        'role' => 'Comédien',
                        'from' => 'France',
                        'image' => array(
                            'path' => '//dummyimage.com/136x185/000/fff',
                            'min' => '//dummyimage.com/52x66/000/fff'
                        )
                    ),
                    array(
                        'fullName' => 'Vincent Cassel',
                        'slug' => 'vincent-cassel',
                        'role' => 'Comédien',
                        'from' => 'France',
                        'image' => array(
                            'path' => '//dummyimage.com/136x185/000/fff',
                            'min' => '//dummyimage.com/52x66/000/fff'
                        )
                    ),
                    array(
                        'fullName' => 'Vincent Cassel',
                        'slug' => 'vincent-cassel',
                        'role' => 'Comédien',
                        'from' => 'France',
                        'image' => array(
                            'path' => '//dummyimage.com/136x185/000/fff',
                            'min' => '//dummyimage.com/52x66/000/fff'
                        )
                    ),
                    array(
                        'fullName' => 'Vincent Cassel',
                        'slug' => 'vincent-cassel',
                        'role' => 'Comédien',
                        'from' => 'France',
                        'image' => array(
                            'path' => '//dummyimage.com/136x185/000/fff',
                            'min' => '//dummyimage.com/52x66/000/fff'
                        )
                    ),
                    array(
                        'fullName' => 'Vincent Cassel',
                        'slug' => 'vincent-cassel',
                        'role' => 'Comédien',
                        'from' => 'France',
                        'image' => array(
                            'path' => '//dummyimage.com/136x185/000/fff',
                            'min' => '//dummyimage.com/52x66/000/fff'
                        )
                    ),
                    array(
                        'fullName' => 'Vincent Cassel',
                        'slug' => 'vincent-cassel',
                        'role' => 'Comédien',
                        'from' => 'France',
                        'image' => array(
                            'path' => '//dummyimage.com/136x185/000/fff',
                            'min' => '//dummyimage.com/52x66/000/fff'
                        )
                    )
                ),
                'film' => array(
                    array(
                        'title' => 'La Haine',
                        'slug' => 'la-haine',
                        'releaseDate' => 2005,
                        'author' => array(
                            'fullName' => 'Matthieu Kassovitz',
                            'slug' => 'matthieu-kassovitz',
                            'from' => 'France'
                        ),
                        'image' => array(
                            'path' => '//dummyimage.com/136x185/000/fff',
                            'min' => '//dummyimage.com/52x66/000/fff'
                        )
                    ),
                    array(
                        'title' => 'La Haine',
                        'slug' => 'la-haine',
                        'releaseDate' => 2005,
                        'author' => array(
                            'fullName' => 'Matthieu Kassovitz',
                            'slug' => 'matthieu-kassovitz',
                            'from' => 'France'
                        ),
                        'image' => array(
                            'path' => '//dummyimage.com/136x185/000/fff',
                            'min' => '//dummyimage.com/52x66/000/fff'
                        )
                    ),
                    array(
                        'title' => 'La Haine',
                        'slug' => 'la-haine',
                        'releaseDate' => 2005,
                        'author' => array(
                            'fullName' => 'Matthieu Kassovitz',
                            'slug' => 'matthieu-kassovitz',
                            'from' => 'France'
                        ),
                        'image' => array(
                            'path' => '//dummyimage.com/136x185/000/fff',
                            'min' => '//dummyimage.com/52x66/000/fff'
                        )
                    ),
                    array(
                        'title' => 'La Haine',
                        'slug' => 'la-haine',
                        'releaseDate' => 2005,
                        'author' => array(
                            'fullName' => 'Matthieu Kassovitz',
                            'slug' => 'matthieu-kassovitz',
                            'from' => 'France'
                        ),
                        'image' => array(
                            'path' => '//dummyimage.com/136x185/000/fff',
                            'min' => '//dummyimage.com/52x66/000/fff'
                        )
                    )
                ),
                'info' => array(
                    array(
                        'title' => 'Stéphane Beizé interroge la loi du marché',
                        'createdAt' => new \DateTime(),
                        'slug' => 'enrages-polar-hybride-d-eric-hannezo',
                        'image' => array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                        ),
                        'format' => 'article',
                        'theme' => 'competition',
                        'category' => 'competition'
                    ),
                    array(
                        'title' => 'Stéphane Beizé interroge la loi du marché',
                        'createdAt' => new \DateTime(),
                        'slug' => 'enrages-polar-hybride-d-eric-hannezo',
                        'image' => array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                        ),
                        'format' => 'article',
                        'theme' => 'competition',
                        'category' => 'competition'
                    )
                ),
                'media' => array(
                    array(
                        'title' => 'Stéphane Beizé interroge la loi du marché',
                        'createdAt' => new \DateTime(),
                        'slug' => 'enrages-polar-hybride-d-eric-hannezo',
                        'image' => array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                        ),
                        'format' => 'article',
                        'theme' => 'competition',
                        'category' => 'competition'
                    ),
                    array(
                        'title' => 'Stéphane Beizé interroge la loi du marché',
                        'createdAt' => new \DateTime(),
                        'slug' => 'enrages-polar-hybride-d-eric-hannezo',
                        'image' => array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                        ),
                        'format' => 'article',
                        'theme' => 'competition',
                        'category' => 'competition'
                    ),
                    array(
                        'title' => 'Stéphane Beizé interroge la loi du marché',
                        'createdAt' => new \DateTime(),
                        'slug' => 'enrages-polar-hybride-d-eric-hannezo',
                        'image' => array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                        ),
                        'format' => 'article',
                        'theme' => 'competition',
                        'category' => 'competition'
                    ),
                    array(
                        'title' => 'Stéphane Beizé interroge la loi du marché',
                        'createdAt' => new \DateTime(),
                        'slug' => 'enrages-polar-hybride-d-eric-hannezo',
                        'image' => array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                        ),
                        'format' => 'article',
                        'theme' => 'competition',
                        'category' => 'competition'
                    )
                ),
                'event' => array(
                    array(
                        'title' => 'Stéphane Beizé interroge la loi du marché',
                        'createdAt' => new \DateTime(),
                        'slug' => 'enrages-polar-hybride-d-eric-hannezo',
                        'image' => array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                        ),
                        'format' => 'article',
                        'theme' => 'competition',
                        'category' => 'competition'
                    ),
                    array(
                        'title' => 'Stéphane Beizé interroge la loi du marché',
                        'createdAt' => new \DateTime(),
                        'slug' => 'enrages-polar-hybride-d-eric-hannezo',
                        'image' => array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                        ),
                        'format' => 'article',
                        'theme' => 'competition',
                        'category' => 'competition'
                    ),
                    array(
                        'title' => 'Stéphane Beizé interroge la loi du marché',
                        'createdAt' => new \DateTime(),
                        'slug' => 'enrages-polar-hybride-d-eric-hannezo',
                        'image' => array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                        ),
                        'format' => 'article',
                        'theme' => 'competition',
                        'category' => 'competition'
                    ),
                    array(
                        'title' => 'Stéphane Beizé interroge la loi du marché',
                        'createdAt' => new \DateTime(),
                        'slug' => 'enrages-polar-hybride-d-eric-hannezo',
                        'image' => array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                        ),
                        'format' => 'article',
                        'theme' => 'competition',
                        'category' => 'competition'
                    )
                ),
                'participate' => array(
                    array(
                        'title' => 'Stéphane Beizé interroge la loi du marché',
                        'createdAt' => new \DateTime(),
                        'slug' => 'enrages-polar-hybride-d-eric-hannezo',
                        'image' => array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                        ),
                        'format' => 'article',
                        'theme' => 'competition',
                        'category' => 'competition'
                    ),
                    array(
                        'title' => 'Stéphane Beizé interroge la loi du marché',
                        'createdAt' => new \DateTime(),
                        'slug' => 'enrages-polar-hybride-d-eric-hannezo',
                        'image' => array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                        ),
                        'format' => 'article',
                        'theme' => 'competition',
                        'category' => 'competition'
                    ),
                    array(
                        'title' => 'Stéphane Beizé interroge la loi du marché',
                        'createdAt' => new \DateTime(),
                        'slug' => 'enrages-polar-hybride-d-eric-hannezo',
                        'image' => array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                        ),
                        'format' => 'article',
                        'theme' => 'competition',
                        'category' => 'competition'
                    ),
                    array(
                        'title' => 'Stéphane Beizé interroge la loi du marché',
                        'createdAt' => new \DateTime(),
                        'slug' => 'enrages-polar-hybride-d-eric-hannezo',
                        'image' => array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                        ),
                        'format' => 'article',
                        'theme' => 'competition',
                        'category' => 'competition'
                    )
                )
            )
        );

        if ($resultFilter == null) {
            $searchResult = $result;
        } else {
            $searchResult = $result[$resultFilter];
        }

        $searchFilters = array(
            'date' => array(
                array(
                    'createdAt' => new \DateTime()
                )
            ),
            'format' => array(
                array(
                    'name' => 'Photo',
                    'slug' => 'photo'
                ),
                array(
                    'name' => 'Vidéo',
                    'slug' => 'video'
                ),
                array(
                    'name' => 'Audio',
                    'slug' => 'audio'
                ),
                array(
                    'name' => 'Article',
                    'slug' => 'article'
                )
            ),
            'theme' => array(
                array(
                    'name' => 'Conférence de presse',
                    'slug' => 'press'
                ),
                array(
                    'name' => 'Montée des marches',
                    'slug' => 'steps'
                )
            )
        );

        return array(
            'searchResult' => $searchResult,
            'searchFilters' => $searchFilters,
            'searchTerm' => $searchTerm
        );
    }

}
