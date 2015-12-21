<?php
 
namespace Base\CoreBundle\Twig\Extension;

use Base\CoreBundle\Entity\NewsWidgetImageDualAlign;
use Base\CoreBundle\Entity\NewsWidgetQuote;
use Base\CoreBundle\Entity\NewsWidgetVideoYoutube;
use \Twig_Extension;

use Base\CoreBundle\Entity\NewsWidgetText;
use Base\CoreBundle\Entity\NewsWidgetAudio;
use Base\CoreBundle\Entity\NewsWidgetImage;
use Base\CoreBundle\Entity\NewsWidgetVideo;

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
            new \Twig_SimpleTest('news_widget_text', function ($widget) { return $widget instanceof NewsWidgetText; }),
            new \Twig_SimpleTest('news_widget_quote', function ($widget) { return $widget instanceof NewsWidgetQuote; }),
            new \Twig_SimpleTest('news_widget_audio', function ($widget) { return $widget instanceof NewsWidgetAudio; }),
            new \Twig_SimpleTest('news_widget_video_youtube', function ($widget) { return $widget instanceof NewsWidgetVideoYoutube; }),
            new \Twig_SimpleTest('news_widget_video', function ($widget) { return $widget instanceof NewsWidgetVideo; }),
            new \Twig_SimpleTest('news_widget_image', function ($widget) { return $widget instanceof NewsWidgetImage; }),
            new \Twig_SimpleTest('news_widget_image_dual_align', function ($widget) { return $widget instanceof NewsWidgetImageDualAlign; })

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