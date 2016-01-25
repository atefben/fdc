<?php

namespace Base\CoreBundle\Twig\Extension;

use \Twig_Extension;

use Base\CoreBundle\Entity\Info;
use Base\CoreBundle\Entity\InfoArticle;
use Base\CoreBundle\Entity\InfoAudio;
use Base\CoreBundle\Entity\InfoImage;
use Base\CoreBundle\Entity\InfoVideo;

/**
 * InfoInstanceOfExtension class.
 *
 * @extends Twig_Extension
 * @author  Antoine Mineau
 * @company Ohwee
 */
class InfoInstanceOfExtension extends Twig_Extension
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
            new \Twig_SimpleTest('info_article', function (Info $info) { return $info instanceof InfoArticle; }),
            new \Twig_SimpleTest('info_audio', function (Info $info) { return $info instanceof InfoAudio; }),
            new \Twig_SimpleTest('info_image', function (Info $info) { return $info instanceof InfoImage; }),
            new \Twig_SimpleTest('info_video', function (Info $info) { return $info instanceof InfoVideo; })
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
        return 'info_instance_of_extension';
    }
}