<?php

namespace FDC\EventBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use FDC\EventBundle\Form\Type\ShareEmailType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/")
 */
class GlobalController extends Controller
{

    /**
     * @Route("/suggestion", options={"expose"=true})
     * @Template("FDCEventBundle:Global:global.suggestion.html.twig")
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
     * @Template("FDCEventBundle:Global:global.share-email.html.twig")
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



}
