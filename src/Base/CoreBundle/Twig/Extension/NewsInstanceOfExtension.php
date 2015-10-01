<?php
 
namespace Base\CoreBundle\Twig\Extension;

use \Twig_Extension;

use Base\CoreBundle\Entity\News;
use Base\CoreBundle\Entity\NewsArticle;
use Base\CoreBundle\Entity\NewsAudio;
use Base\CoreBundle\Entity\NewsImage;
use Base\CoreBundle\Entity\NewsVideo;

/**
 * NewsInstanceOfExtension class.
 * 
 * @extends Twig_Extension
 * @author  Antoine Mineau
 * @company Ohwee
 */
class NewsInstanceOfExtension extends Twig_Extension
{
    /**
     * getTests function.
     * 
     * @access public
     * @return void
     */
    public function getTests()
    {
        return array(
            new \Twig_SimpleTest('news_article', function (News $news) { return $news instanceof NewsArticle; }),
            new \Twig_SimpleTest('news_audio', function (News $news) { return $news instanceof NewsAudio; }),
            new \Twig_SimpleTest('news_image', function (News $news) { return $news instanceof NewsImage; }),
            new \Twig_SimpleTest('news_video', function (News $news) { return $news instanceof NewsVideo; })
        );
    }

    /**
     * getName function.
     * 
     * @access public
     * @return void
     */
    public function getName()
    {
        return 'news_instance_of_extension';
    }
}