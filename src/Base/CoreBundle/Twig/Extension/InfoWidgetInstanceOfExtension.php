<?php
 
namespace Base\CoreBundle\Twig\Extension;

use Base\CoreBundle\Entity\InfoWidgetImageDualAlign;
use Base\CoreBundle\Entity\InfoWidgetQuote;
use Base\CoreBundle\Entity\InfoWidgetVideoYoutube;
use \Twig_Extension;

use Base\CoreBundle\Entity\InfoWidgetText;
use Base\CoreBundle\Entity\InfoWidgetAudio;
use Base\CoreBundle\Entity\InfoWidgetImage;
use Base\CoreBundle\Entity\InfoWidgetVideo;

/**
 * InfoWidgetInstanceOfExtension class.
 * 
 * @extends Twig_Extension
 * @author  Antoine Mineau
 * @company Ohwee
 */
class InfoWidgetInstanceOfExtension extends Twig_Extension
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
            new \Twig_SimpleTest('info_widget_text', function ($widget) { return $widget instanceof InfoWidgetText; }),
            new \Twig_SimpleTest('info_widget_quote', function ($widget) { return $widget instanceof InfoWidgetQuote; }),
            new \Twig_SimpleTest('info_widget_audio', function ($widget) { return $widget instanceof InfoWidgetAudio; }),
            new \Twig_SimpleTest('info_widget_video_youtube', function ($widget) { return $widget instanceof InfoWidgetVideoYoutube; }),
            new \Twig_SimpleTest('info_widget_video', function ($widget) { return $widget instanceof InfoWidgetVideo; }),
            new \Twig_SimpleTest('info_widget_image', function ($widget) { return $widget instanceof InfoWidgetImage; }),
            new \Twig_SimpleTest('info_widget_image_dual_align', function ($widget) { return $widget instanceof InfoWidgetImageDualAlign; })

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
        return 'info_widget_instance_of_extension';
    }
}