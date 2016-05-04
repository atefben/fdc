<?php
/**
 * Created by PhpStorm.
 * User: piebel
 * Date: 22/01/2016
 * Time: 14:44
 */

namespace Base\CoreBundle\Twig\Extension;

use Base\CoreBundle\Entity\Info;
use Base\CoreBundle\Entity\News;
use Base\CoreBundle\Entity\Statement;
use \Twig_Extension;

class NewsTypeExtension extends Twig_Extension
{

    private $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('get_news_type', array($this, 'getNewsType')),
        );
    }

    public function getNewsType($object)
    {
        $type = null;
        if ($object instanceof News) {
            $type = $object->getNewsType();
        } elseif ($object instanceof Statement) {
            $type = $object->getStatementType();
        } elseif ($object instanceof Info) {
            $type = $object->getInfoType();
        }
        elseif (is_string($object)) {
            $type = $object;
        }
        switch ($type) {
            case 'NewsArticle':
            case 'InfoArticle':
            case 'StatementArticle':
                $type = 'article';
                break;
            case 'NewsAudio':
            case 'InfoAudio':
            case 'StatementAudio':
                $type = 'audio';
                break;
            case 'NewsImage':
            case 'InfoImage':
            case 'StatementImage':
                $type = 'photo';
                break;
            case 'NewsVideo':
            case 'InfoVideo':
            case 'StatementVideo':
                $type = 'video';
                break;
        }

        return $type;
    }


    /**
     * getName function.
     *
     * @access public
     * @return void
     */
    public function getName()
    {
        return 'news_type_extension';
    }
}