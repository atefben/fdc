<?php

namespace FDC\EventBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

use FDC\EventBundle\Form\Type\ShareEmailType;
use FDC\EventBundle\Form\Type\NewsletterType;
use FDC\EventBundle\Form\Type\SearchType;

/**
 * @Route("/")
 */
class GlobalController extends Controller
{

    /**
     * @Route("/suggestion", options={"expose"=true})
     * @Template("FDCEventBundle:Global:suggestion.html.twig")
     * @return array
     */
    public function suggestionAction()
    {
        $articles = array();
        $request = $this->get('request');

        if($request->isXmlHttpRequest()) {

            $queryArticle = array(
                array(
                    'title' => 'test',
                    'content' => 'Contenu de l\'article',
                    'thumbnail' => '//lorempixel.com/212/133/sports/1/Dummy-Text/',
                    'filter' => 'suggestion',
                    'link'   => '/article/article1.php',
                    'date'   => '18.05.15',
                    'time'   => '09:00',
                    'category' => 'presse'
                ),
                array(
                    'title' => 'test',
                    'content' => 'Contenu de l\'article',
                    'thumbnail' => '//lorempixel.com/212/133/sports/1/Dummy-Text/',
                    'filter' => 'suggestion',
                    'link'   => '/article/article1.php',
                    'date'   => '18.05.15',
                    'time'   => '09:00',
                    'category' => 'presse'
                ),
                array(
                    'title' => 'test',
                    'content' => 'Contenu de l\'article',
                    'thumbnail' => '//lorempixel.com/212/133/sports/1/Dummy-Text/',
                    'filter' => 'suggestion',
                    'link'   => '/article/article1.php',
                    'date'   => '18.05.15',
                    'time'   => '09:00',
                    'category' => 'presse'
                ),
                array(
                    'title' => 'test',
                    'content' => 'Contenu de l\'article',
                    'thumbnail' => '//lorempixel.com/212/133/sports/1/Dummy-Text/',
                    'filter' => 'suggestion',
                    'link'   => '/article/article1.php',
                    'date'   => '18.05.15',
                    'time'   => '09:00',
                    'category' => 'presse'
                ),
                array(
                    'title' => 'test',
                    'content' => 'Contenu de l\'article',
                    'thumbnail' => '//lorempixel.com/212/133/sports/1/Dummy-Text/',
                    'filter' => 'suggestion',
                    'link'   => '/article/article1.php',
                    'date'   => '18.05.15',
                    'time'   => '09:00',
                    'category' => 'presse'
                ),
                array(
                    'title' => 'test',
                    'content' => 'Contenu de l\'article',
                    'thumbnail' => '//lorempixel.com/212/133/sports/1/Dummy-Text/',
                    'filter' => 'suggestion',
                    'link'   => '/article/article1.php',
                    'date'   => '18.05.15',
                    'time'   => '09:00',
                    'category' => 'presse'
                ),
                array(
                    'title' => 'test',
                    'content' => 'Contenu de l\'article',
                    'thumbnail' => '//lorempixel.com/212/133/sports/1/Dummy-Text/',
                    'filter' => 'suggestion',
                    'link'   => '/article/article1.php',
                    'date'   => '18.05.15',
                    'time'   => '09:00',
                    'category' => 'presse'
                )
            );
            $articles = array_slice($queryArticle, 0, 8);

        }

        return array(
            'articles' => $articles
        );

    }

    /**
     * @Route("/share-email")
     * @Template("FDCEventBundle:Global:share-email.html.twig")
     * @param Request $request
     * @param $section
     * @param $detail
     * @param $title
     * @param $description
     * @return array
     */
    public function shareEmailAction(Request $request, $section, $detail, $title, $description)
    {
        $email = array(
            'section' => $section,
            'detail'  => $detail,
            'title'  => $title,
            'description'  => $description
        );

        $translator = $this->get('translator');
        $hasErrors = false;

        $form = $this->createForm(new ShareEmailType($translator));

        if ($request->isMethod('POST')) {

            $form->submit($request);

            if ($form->isValid()) {

            }
            else {
                $hasErrors = true;
            }

        }

        return array(
            'share_email' => $email,
            'form' => $form,
            'hasErrors' => $hasErrors
        );
    }


    /**
     * @Route( "/register-newsletter" )
     * @Template("FDCEventBundle:Global:newsletter.html.twig")
     * @param Request $request
     * @return JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newsletterAction( Request $request )
    {
        $translator = $this->get('translator');

        $newsForm = $this->createForm( new NewsletterType($translator) );

        if ( $request->isMethod( 'POST' ) ) {

            $newsForm->submit($request);

            if ( $newsForm->isValid( ) ) {

                $data = $newsForm->getData();
                $email = $data['email'];
                $response['success'] = $email;

                $message = \Swift_Message::newInstance()
                    ->setSubject($translator->trans('newsletter.email.subject'))
                    ->setFrom('contact@mail.fr')
                    ->setTo($email)
                    ->setBody(
                        $this->renderView(
                            'FDCEventBundle:Mail:mail.newsletter.html.twig',
                            array(
                                'newsletter_email' => $email
                            )
                        )
                    );

                $this->get('mailer')->send($message);

            }
            else{

                $response['success'] = false;
                $response['cause'] = 'whatever';

            }

            return new JsonResponse( $response );

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
    public function breadcrumbAction()
    {
        $breadcrumb = array(
            array(
                'name' => 'L\'actualité',
            ),
            array(
                'name' => 'Jour après jour',
            ),
            array(
                'name' => 'Lorem Ipsum',
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
    public function searchAction( Request $request, $searchTerm=null )
    {
        $translator = $this->get('translator');

        $searchForm = $this->createForm( new SearchType($translator, $searchTerm) );

        $searchForm->submit($request);

        $formData = $searchForm->getData();
        $searchTerm = $formData['search'];

        if ($searchTerm !== null ) {
            return $this->redirect($this->generateUrl('fdc_event_global_searchsubmit', array(
                'searchTerm' => $searchTerm,
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
    public function searchSubmitAction($searchTerm, $resultFilter=null)
    {
        $result = array(
            'category' => array(
                'actualite' => array(
                    array(
                        'id' => 0,
                        'title' => 'Stéphane Brizé interroge la loi du marché',
                        'type'  => 'article',
                        'slug'  => 'stephane-brize-interroge',
                        'category' => 'Compétition',
                        'createdAt' => new \DateTime(),
                        'image' => array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                        )
                    ),
                    array(
                        'id' => 0,
                        'title' => 'Stéphane Brizé interroge la loi du marché',
                        'type'  => 'article',
                        'slug'  => 'stephane-brize-interroge',
                        'category' => 'Compétition',
                        'createdAt' => new \DateTime(),
                        'image' => array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                        )
                    ),
                    array(
                        'id' => 0,
                        'title' => 'Stéphane Brizé interroge la loi du marché',
                        'type'  => 'article',
                        'slug'  => 'stephane-brize-interroge',
                        'category' => 'Compétition',
                        'createdAt' => new \DateTime(),
                        'image' => array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                        )
                    ),
                    array(
                        'id' => 0,
                        'title' => 'Stéphane Brizé interroge la loi du marché',
                        'type'  => 'article',
                        'slug'  => 'stephane-brize-interroge',
                        'category' => 'Compétition',
                        'createdAt' => new \DateTime(),
                        'image' => array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                        )
                    ),
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
                        'id' => 0,
                        'title' => 'Stéphane Brizé interroge la loi du marché',
                        'type'  => 'article',
                        'slug'  => 'stephane-brize-interroge',
                        'category' => 'Compétition',
                        'createdAt' => new \DateTime(),
                        'image' => array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                        )
                    ),
                    array(
                        'id' => 0,
                        'title' => 'Stéphane Brizé interroge la loi du marché',
                        'type'  => 'article',
                        'slug'  => 'stephane-brize-interroge',
                        'category' => 'Compétition',
                        'createdAt' => new \DateTime(),
                        'image' => array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                        )
                    ),
                ),
                'media' => array(
                    array(
                        'id' => 0,
                        'title' => 'Stéphane Brizé interroge la loi du marché',
                        'type'  => 'article',
                        'slug'  => 'stephane-brize-interroge',
                        'category' => 'Compétition',
                        'createdAt' => new \DateTime(),
                        'image' => array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                        )
                    ),
                    array(
                        'id' => 0,
                        'title' => 'Stéphane Brizé interroge la loi du marché',
                        'type'  => 'article',
                        'slug'  => 'stephane-brize-interroge',
                        'category' => 'Compétition',
                        'createdAt' => new \DateTime(),
                        'image' => array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                        )
                    ),
                    array(
                        'id' => 0,
                        'title' => 'Stéphane Brizé interroge la loi du marché',
                        'type'  => 'article',
                        'slug'  => 'stephane-brize-interroge',
                        'category' => 'Compétition',
                        'createdAt' => new \DateTime(),
                        'image' => array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                        )
                    ),
                    array(
                        'id' => 0,
                        'title' => 'Stéphane Brizé interroge la loi du marché',
                        'type'  => 'article',
                        'slug'  => 'stephane-brize-interroge',
                        'category' => 'Compétition',
                        'createdAt' => new \DateTime(),
                        'image' => array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                        )
                    ),
                ),
                'event' => array(
                    array(
                        'id' => 0,
                        'title' => 'Stéphane Brizé interroge la loi du marché',
                        'type'  => 'article',
                        'slug'  => 'stephane-brize-interroge',
                        'category' => 'Compétition',
                        'createdAt' => new \DateTime(),
                        'image' => array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                        )
                    ),
                    array(
                        'id' => 0,
                        'title' => 'Stéphane Brizé interroge la loi du marché',
                        'type'  => 'article',
                        'slug'  => 'stephane-brize-interroge',
                        'category' => 'Compétition',
                        'createdAt' => new \DateTime(),
                        'image' => array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                        )
                    ),
                    array(
                        'id' => 0,
                        'title' => 'Stéphane Brizé interroge la loi du marché',
                        'type'  => 'article',
                        'slug'  => 'stephane-brize-interroge',
                        'category' => 'Compétition',
                        'createdAt' => new \DateTime(),
                        'image' => array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                        )
                    ),
                    array(
                        'id' => 0,
                        'title' => 'Stéphane Brizé interroge la loi du marché',
                        'type'  => 'article',
                        'slug'  => 'stephane-brize-interroge',
                        'category' => 'Compétition',
                        'createdAt' => new \DateTime(),
                        'image' => array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                        )
                    ),
                ),
                'participate' => array(
                    array(
                        'id' => 0,
                        'title' => 'Stéphane Brizé interroge la loi du marché',
                        'type'  => 'article',
                        'slug'  => 'stephane-brize-interroge',
                        'category' => 'Compétition',
                        'createdAt' => new \DateTime(),
                        'image' => array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                        )
                    ),
                    array(
                        'id' => 0,
                        'title' => 'Stéphane Brizé interroge la loi du marché',
                        'type'  => 'article',
                        'slug'  => 'stephane-brize-interroge',
                        'category' => 'Compétition',
                        'createdAt' => new \DateTime(),
                        'image' => array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                        )
                    ),
                    array(
                        'id' => 0,
                        'title' => 'Stéphane Brizé interroge la loi du marché',
                        'type'  => 'article',
                        'slug'  => 'stephane-brize-interroge',
                        'category' => 'Compétition',
                        'createdAt' => new \DateTime(),
                        'image' => array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                        )
                    ),
                    array(
                        'id' => 0,
                        'title' => 'Stéphane Brizé interroge la loi du marché',
                        'type'  => 'article',
                        'slug'  => 'stephane-brize-interroge',
                        'category' => 'Compétition',
                        'createdAt' => new \DateTime(),
                        'image' => array(
                            'path' => '//html.festival-cannes-2016.com.ohwee.fr/img/articles/03.jpg'
                        )
                    ),
                ),
            )
        );

        if ($resultFilter == null) {
            $searchResult = $result;
        }
        else {
            $searchResult = $result[$resultFilter];
        }

        $searchFilters = array(
            'date' => array(
                array(
                    'createdAt' => new \DateTime(),
                )
            ),
            'format' => array(
                array(
                    'name' => 'Photo',
                    'slug' => 'photo',
                ),
                array(
                    'name' => 'Vidéo',
                    'slug' => 'video',
                ),
                array(
                    'name' => 'Audio',
                    'slug' => 'audio',
                ),
                array(
                    'name' => 'Article',
                    'slug' => 'article',
                )
            ),
            'theme' => array(
                array(
                    'name' => 'Conférence de presse',
                    'slug' => 'press',
                ),
                array(
                    'name' => 'Montée des marches',
                    'slug' => 'steps',
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
