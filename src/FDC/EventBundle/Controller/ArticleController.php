<?php

namespace FDC\EventBundle\Controller;

use Guzzle\Http\Message\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ArticleController extends Controller
{

    /**
     * @Route("/suggestion", options={"expose"=true})
     * @Template("FDCEventBundle:Article:article.suggestion.html.twig")
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

}
