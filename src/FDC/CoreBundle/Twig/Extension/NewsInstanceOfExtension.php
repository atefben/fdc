<?php
 
namespace FDC\CoreBundle\Twig\Extension;

use \Twig_Extension;

use FDC\CoreBundle\Entity\News;
use FDC\CoreBundle\Entity\NewsArticle;
use FDC\CoreBundle\Entity\NewsAudio;
use FDC\CoreBundle\Entity\NewsImage;
use FDC\CoreBundle\Entity\NewsVideo;

class NewsInstanceOfExtension extends Twig_Extension
{
    public function getTests()
    {
        return array(
            new \Twig_SimpleTest('news_article', function (News $news) { return $news instanceof NewsArticle; }),
            new \Twig_SimpleTest('news_audio', function (News $news) { return $news instanceof NewsAudio; }),
            new \Twig_SimpleTest('news_image', function (News $news) { return $news instanceof NewsImage; }),
            new \Twig_SimpleTest('news_video', function (News $news) { return $news instanceof NewsVideo; })
        );
    }

    public function getName()
    {
        return 'news_instance_of_extension';
    }
}