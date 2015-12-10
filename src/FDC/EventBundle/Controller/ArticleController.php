<?php

namespace FDC\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class ArticleController extends Controller
{

    /**
     *
     * @param int $max
     * @return array
     *
     */
    public function selectionAction($max)
    {

        $queryArticle = array(
            array(
                'title' => 'test',
                'content' => 'Double test'
            ),
            array(
                'title' => 'test',
                'content' => 'Double test'
            ),
            array(
                'title' => 'test',
                'content' => 'Double test'
            ),
            array(
                'title' => 'test',
                'content' => 'Double test'
            ),
            array(
                'title' => 'test',
                'content' => 'Double test'
            ),
            array(
                'title' => 'test',
                'content' => 'Double test'
            ),
            array(
                'title' => 'test',
                'content' => 'Double test'
            ),
            array(
                'title' => 'test',
                'content' => 'Double test'
            ),
            array(
                'title' => 'test',
                'content' => 'Double test'
            ),
            array(
                'title' => 'test',
                'content' => 'Double test'
            ),
            array(
                'title' => 'test',
                'content' => 'Double test'
            ),
            array(
                'title' => 'test',
                'content' => 'Double test'
            ),
            array(
                'title' => 'test',
                'content' => 'Double test'
            ),
        );

        $articles = array_slice($queryArticle, 0, $max);

        return $this->render(
            'FDCEventBundle:Article:article.selection.html.twig',
            array('articles' => $articles)
        );

    }

}
