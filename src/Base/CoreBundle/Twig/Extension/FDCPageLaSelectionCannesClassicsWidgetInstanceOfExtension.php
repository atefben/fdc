<?php

namespace Base\CoreBundle\Twig\Extension;

use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidgetAudio;
use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidgetImage;
use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidgetImageDualAlign;
use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidgetQuote;
use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidgetVideo;
use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidgetVideoYoutube;
use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidgetIntro;
use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidgetMovie;
use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidgetSubtitle;
use Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassicsWidgetText;
use \Twig_Extension;

/**
 * FDCPageLaSelectionCannesClassicsInstanceOfExtension class.
 *
 * @extends Twig_Extension
 * @author  Antoine Mineau
 * @company Ohwee
 */
class FDCPageLaSelectionCannesClassicsWidgetInstanceOfExtension extends Twig_Extension
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
            new \Twig_SimpleTest('fdc_page_la_selection_cannes_classics_widget_text', function ($widget) { return $widget instanceof FDCPageLaSelectionCannesClassicsWidgetText; }),
            new \Twig_SimpleTest('fdc_page_la_selection_cannes_classics_widget_quote', function ($widget) { return $widget instanceof FDCPageLaSelectionCannesClassicsWidgetQuote; }),
            new \Twig_SimpleTest('fdc_page_la_selection_cannes_classics_widget_audio', function ($widget) { return $widget instanceof FDCPageLaSelectionCannesClassicsWidgetAudio; }),
            new \Twig_SimpleTest('fdc_page_la_selection_cannes_classics_widget_video_youtube', function ($widget) { return $widget instanceof FDCPageLaSelectionCannesClassicsWidgetVideoYoutube; }),
            new \Twig_SimpleTest('fdc_page_la_selection_cannes_classics_widget_video', function ($widget) { return $widget instanceof FDCPageLaSelectionCannesClassicsWidgetVideo; }),
            new \Twig_SimpleTest('fdc_page_la_selection_cannes_classics_widget_image', function ($widget) { return $widget instanceof FDCPageLaSelectionCannesClassicsWidgetImage; }),
            new \Twig_SimpleTest('fdc_page_la_selection_cannes_classics_widget_image_dual_align', function ($widget) { return $widget instanceof FDCPageLaSelectionCannesClassicsWidgetImageDualAlign; }),
            new \Twig_SimpleTest('fdc_page_la_selection_cannes_classics_widget_movie', function ($widget) { return $widget instanceof FDCPageLaSelectionCannesClassicsWidgetMovie; }),
            new \Twig_SimpleTest('fdc_page_la_selection_cannes_classics_widget_intro', function ($widget) { return $widget instanceof FDCPageLaSelectionCannesClassicsWidgetIntro; }),
            new \Twig_SimpleTest('fdc_page_la_selection_cannes_classics_widget_subtitle', function ($widget) { return $widget instanceof FDCPageLaSelectionCannesClassicsWidgetSubtitle; })

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