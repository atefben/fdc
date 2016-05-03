<?php
 
namespace Base\CoreBundle\Twig\Extension;

use Base\CoreBundle\Entity\Info;
use Base\CoreBundle\Entity\InfoArticle;
use Base\CoreBundle\Entity\InfoAudio;
use Base\CoreBundle\Entity\InfoImage;
use Base\CoreBundle\Entity\InfoVideo;
use Base\CoreBundle\Entity\News;
use Base\CoreBundle\Entity\NewsArticle;
use Base\CoreBundle\Entity\NewsAudio;
use Base\CoreBundle\Entity\NewsImage;
use Base\CoreBundle\Entity\NewsVideo;
use Base\CoreBundle\Entity\Statement;
use Base\CoreBundle\Entity\StatementArticle;
use Base\CoreBundle\Entity\StatementAudio;
use Base\CoreBundle\Entity\StatementImage;
use Base\CoreBundle\Entity\StatementVideo;
use Twig_Extension;

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
            new \Twig_SimpleTest('news_article', function ($object) { return $object instanceof NewsArticle || $object instanceof InfoArticle || $object instanceof StatementArticle; }),
            new \Twig_SimpleTest('news_audio', function ($object) { return $object instanceof NewsAudio || $object instanceof InfoAudio || $object instanceof StatementAudio; }),
            new \Twig_SimpleTest('news_image', function ($object) { return $object instanceof NewsImage || $object instanceof InfoImage || $object instanceof StatementImage; }),
            new \Twig_SimpleTest('news_video', function ($object) { return $object instanceof NewsVideo || $object instanceof InfoVideo || $object instanceof StatementVideo; }),
            new \Twig_SimpleTest('news_object', function ($object) { return $object instanceof News; }),
            new \Twig_SimpleTest('info_object', function ($object) { return $object instanceof Info; }),
            new \Twig_SimpleTest('statement_object', function ($object) { return $object instanceof Statement; }),
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