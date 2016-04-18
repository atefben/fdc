<?php
/**
 * Created by PhpStorm.
 * User: piebel
 * Date: 22/01/2016
 * Time: 14:44
 */

namespace Base\CoreBundle\Twig\Extension;

use \Twig_Extension;

class NewsTypeExtension extends Twig_Extension
{

    private $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('get_news_type', array($this, 'getNewsType')),
        );
    }

    public function getNewsType($newsType)
    {
        $type = null;

        switch ($newsType) {
            case "NewsArticle":
                $type = 'article';
                break;
            case "NewsAudio":
                $type = 'audio';
                break;
            case "NewsImage":
                $type = 'photo';
                break;
            case "NewsVideo":
                $type = 'video';
                break;
        }

        return $type;
    }


    /**
     * getName function.
     *
     * @access public
     * @return void
     */
    public function getName()
    {
        return 'news_type_extension';
    }
}