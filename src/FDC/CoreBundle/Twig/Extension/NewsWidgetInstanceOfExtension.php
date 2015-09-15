<?php
 
namespace FDC\CoreBundle\Twig\Extension;

use \Twig_Extension;

use FDC\CoreBundle\Entity\NewsWidgetText;
use FDC\CoreBundle\Entity\NewsWidgetAudio;
use FDC\CoreBundle\Entity\NewsWidgetImage;
use FDC\CoreBundle\Entity\NewsWidgetVideo;

/**
 * NewsWidgetInstanceOfExtension class.
 * 
 * @extends Twig_Extension
 * @author  Antoine Mineau
 * @company Ohwee
 */
class NewsWidgetInstanceOfExtension extends Twig_Extension
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
            new \Twig_SimpleTest('news_widget_text', function (NewsWidgetText $widget) { return $widget instanceof NewsWidgetText; }),
            new \Twig_SimpleTest('news_widget_audio', function (NewsWidgetAudio $widget) { return $widget instanceof NewsWidgetAudio; }),
            new \Twig_SimpleTest('news_widget_video', function (NewsWidgetVideo $widget) { return $widget instanceof NewsWidgetVideo; }),
            new \Twig_SimpleTest('news_widget_image', function (NewsVideoImage $widget) { return $widget instanceof NewsVideoImage; })
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
        return 'news_widget_instance_of_extension';
    }
}