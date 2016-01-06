<?php

namespace FDC\EventBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

use FDC\EventBundle\Form\Type\ShareEmailType;
use FDC\EventBundle\Form\Type\NewsletterType;

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


}
