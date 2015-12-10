<?php

namespace FDC\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class ArticleController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function filtersAction()
    {
        $filters = array(
            'all',
            'articles',
            'videos',
            'audios'
        );

        $nbArticle = 15;

        return $this->render(
            "FDCEventBundle:Article:article.filter.html.twig",
            array(
                'filters' => $filters,
                'nbArticle' => $nbArticle,
            )
        );

    }

    /**
     * @param $filter
     * @return array
     */
    public function selectionAction($filter)
    {

        //Todo Grab user articles from $filter category

        $articles = array(
            array(
                'title' => 'test',
                'content' => 'Contenu de l\'article',
                'thumbnail' => '//lorempixel.com/212/133/sports/1/Dummy-Text/',
                'filter' => $filter,
                'link'   => '/article/article1.php',
                'date'   => '18.05.15',
                'time'   => '09:00',
                'category' => 'presse'
            ),
            array(
                'title' => 'test',
                'content' => 'Contenu de l\'article',
                'thumbnail' => '//lorempixel.com/212/133/sports/1/Dummy-Text/',
                'filter' => $filter,
                'link'   => '/article/article1.php',
                'date'   => '18.05.15',
                'time'   => '09:00',
                'category' => 'presse'
            ),
            array(
                'title' => 'test',
                'content' => 'Contenu de l\'article',
                'thumbnail' => '//lorempixel.com/212/133/sports/1/Dummy-Text/',
                'filter' => $filter,
                'link'   => '/article/article1.php',
                'date'   => '18.05.15',
                'time'   => '09:00',
                'category' => 'presse'
            ),
            array(
                'title' => 'test',
                'content' => 'Contenu de l\'article',
                'thumbnail' => '//lorempixel.com/212/133/sports/1/Dummy-Text/',
                'filter' => $filter,
                'link'   => '/article/article1.php',
                'date'   => '18.05.15',
                'time'   => '09:00',
                'category' => 'presse'
            ),
            array(
                'title' => 'test',
                'content' => 'Contenu de l\'article',
                'thumbnail' => '//lorempixel.com/212/133/sports/1/Dummy-Text/',
                'filter' => $filter,
                'link'   => '/article/article1.php',
                'date'   => '18.05.15',
                'time'   => '09:00',
                'category' => 'presse'
            ),
            array(
                'title' => 'test',
                'content' => 'Contenu de l\'article',
                'thumbnail' => '//lorempixel.com/212/133/sports/1/Dummy-Text/',
                'filter' => $filter,
                'link'   => '/article/article1.php',
                'date'   => '18.05.15',
                'time'   => '09:00',
                'category' => 'presse'
            )
        );

        return $this->render(
            "FDCEventBundle:Article:article.selection.$filter.html.twig",
            array('articles' => $articles)
        );

    }

    /**
     * @param int $max
     * @return array
     */
    public function suggestionAction($max)
    {

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

        $articles = array_slice($queryArticle, 0, $max);

        return $this->render(
            'FDCEventBundle:Article:article.suggestion.html.twig',
            array('articles' => $articles)
        );

    }

}
