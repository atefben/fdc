<?php

namespace FDC\EventBundle\Controller;

use Base\CoreBundle\Entity\Newsletter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

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

        if ($request->isXmlHttpRequest()) {

            $queryArticle = array(
                array(
                    'title' => 'test',
                    'content' => 'Contenu de l\'article',
                    'thumbnail' => '//lorempixel.com/212/133/sports/1/Dummy-Text/',
                    'filter' => 'suggestion',
                    'link' => '/article/article1.php',
                    'date' => '18.05.15',
                    'time' => '09:00',
                    'category' => 'presse'
                ),
                array(
                    'title' => 'test',
                    'content' => 'Contenu de l\'article',
                    'thumbnail' => '//lorempixel.com/212/133/sports/1/Dummy-Text/',
                    'filter' => 'suggestion',
                    'link' => '/article/article1.php',
                    'date' => '18.05.15',
                    'time' => '09:00',
                    'category' => 'presse'
                ),
                array(
                    'title' => 'test',
                    'content' => 'Contenu de l\'article',
                    'thumbnail' => '//lorempixel.com/212/133/sports/1/Dummy-Text/',
                    'filter' => 'suggestion',
                    'link' => '/article/article1.php',
                    'date' => '18.05.15',
                    'time' => '09:00',
                    'category' => 'presse'
                ),
                array(
                    'title' => 'test',
                    'content' => 'Contenu de l\'article',
                    'thumbnail' => '//lorempixel.com/212/133/sports/1/Dummy-Text/',
                    'filter' => 'suggestion',
                    'link' => '/article/article1.php',
                    'date' => '18.05.15',
                    'time' => '09:00',
                    'category' => 'presse'
                ),
                array(
                    'title' => 'test',
                    'content' => 'Contenu de l\'article',
                    'thumbnail' => '//lorempixel.com/212/133/sports/1/Dummy-Text/',
                    'filter' => 'suggestion',
                    'link' => '/article/article1.php',
                    'date' => '18.05.15',
                    'time' => '09:00',
                    'category' => 'presse'
                ),
                array(
                    'title' => 'test',
                    'content' => 'Contenu de l\'article',
                    'thumbnail' => '//lorempixel.com/212/133/sports/1/Dummy-Text/',
                    'filter' => 'suggestion',
                    'link' => '/article/article1.php',
                    'date' => '18.05.15',
                    'time' => '09:00',
                    'category' => 'presse'
                ),
                array(
                    'title' => 'test',
                    'content' => 'Contenu de l\'article',
                    'thumbnail' => '//lorempixel.com/212/133/sports/1/Dummy-Text/',
                    'filter' => 'suggestion',
                    'link' => '/article/article1.php',
                    'date' => '18.05.15',
                    'time' => '09:00',
                    'category' => 'presse'
                )
            );
            $articles     = array_slice($queryArticle, 0, 8);

        }

        return array(
            'articles' => $articles
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
    public function shareEmailAction(Request $request, $section = null, $detail = null, $title = null, $description = null) {
        $email = array(
            'section' => $section,
            'detail' => $detail,
            'title' => $title,
            'description' => $description
        );

        $translator = $this->get('translator');
        $hasErrors  = false;

        $form = $this->createForm(new ShareEmailType($translator));

        if ($request->isMethod('POST')) {
            $form->submit($request);

            if ($form->isValid()) {

                $data    = $form->getData();
                $message = \Swift_Message::newInstance()->setSubject($data['title'])->setFrom($data['user'])->setTo($data['email'])->setBody($this->renderView('FDCEventBundle:Emails:share.html.twig', array(
                    'message' => $data['message'],
                    'section' => $data['section'],
                    'title' => $data['title'],
                    'description' => $data['description'],
                    'detail' => $data['detail']
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
                        'detail' => $data['detail']
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


    /**
     * @Route("/programmation/day-projections", options={"expose"=true}))
     * @Template("FDCEventBundle:Global:projection.html.twig")
     * @param Request $request
     * @return array
     */
    public function getDayProjectionsAction(Request $request) {

        $em = $this->get('doctrine')->getManager();

        //Get data-date from clicked button
        //$date = $request->get('date');
        $date = "20160511";

        $isPressProjection = false;
        $projection = array();

        if ( $request->headers->get('host') == $this->getParameter('fdc_press_domain') ) {
            // GET DAY PROJECTIONS
            $dayProjection = $em->getRepository('BaseCoreBundle:PressProjectionScheduling')
                ->getProjectionByDate($date);

            // GET DAY PRESS PROJECTIONS
            $dayPressProjection = $em->getRepository('BaseCoreBundle:PressProjectionPressScheduling')
                ->getProjectionByDate($date);

            $projection = array_merge($dayProjection, $dayPressProjection);
            $isPressProjection = true;
        }
        else {
            // Grab Event Site projections
        }

        return array(
            'dayProjection' => $projection,
            'isPressProjection' => $isPressProjection
        );
    }


}
