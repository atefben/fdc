<?php

namespace Base\CoreBundle\Twig\Extension;

use \Twig_Extension;

use Base\CoreBundle\Entity\Statement;
use Base\CoreBundle\Entity\StatementArticle;
use Base\CoreBundle\Entity\StatementAudio;
use Base\CoreBundle\Entity\StatementImage;
use Base\CoreBundle\Entity\StatementVideo;

/**
 * StatementInstanceOfExtension class.
 *
 * @extends Twig_Extension
 * @author  Antoine Mineau
 * @company Ohwee
 */
class StatementInstanceOfExtension extends Twig_Extension
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
            new \Twig_SimpleTest('statement_article', function (Statement $statement) { return $statement instanceof StatementArticle; }),
            new \Twig_SimpleTest('statement_audio', function (Statement $statement) { return $statement instanceof StatementAudio; }),
            new \Twig_SimpleTest('statement_image', function (Statement $statement) { return $statement instanceof StatementImage; }),
            new \Twig_SimpleTest('statement_video', function (Statement $statement) { return $statement instanceof StatementVideo; })
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
        return 'statement_instance_of_extension';
    }
}