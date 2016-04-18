<?php
 
namespace Base\CoreBundle\Twig\Extension;

use Base\CoreBundle\Entity\StatementWidgetImageDualAlign;
use Base\CoreBundle\Entity\StatementWidgetQuote;
use Base\CoreBundle\Entity\StatementWidgetVideoYoutube;
use \Twig_Extension;

use Base\CoreBundle\Entity\StatementWidgetText;
use Base\CoreBundle\Entity\StatementWidgetAudio;
use Base\CoreBundle\Entity\StatementWidgetImage;
use Base\CoreBundle\Entity\StatementWidgetVideo;

/**
 * StatementWidgetInstanceOfExtension class.
 * 
 * @extends Twig_Extension
 * @author  Antoine Mineau
 * @company Ohwee
 */
class StatementWidgetInstanceOfExtension extends Twig_Extension
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
            new \Twig_SimpleTest('statement_widget_text', function ($widget) { return $widget instanceof StatementWidgetText; }),
            new \Twig_SimpleTest('statement_widget_quote', function ($widget) { return $widget instanceof StatementWidgetQuote; }),
            new \Twig_SimpleTest('statement_widget_audio', function ($widget) { return $widget instanceof StatementWidgetAudio; }),
            new \Twig_SimpleTest('statement_widget_video_youtube', function ($widget) { return $widget instanceof StatementWidgetVideoYoutube; }),
            new \Twig_SimpleTest('statement_widget_video', function ($widget) { return $widget instanceof StatementWidgetVideo; }),
            new \Twig_SimpleTest('statement_widget_image', function ($widget) { return $widget instanceof StatementWidgetImage; }),
            new \Twig_SimpleTest('statement_widget_image_dual_align', function ($widget) { return $widget instanceof StatementWidgetImageDualAlign; })

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
        return 'statement_widget_instance_of_extension';
    }
}