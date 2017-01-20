<?php
namespace Base\CoreBundle\Twig\Extension;

use Base\CoreBundle\Entity\Info;
use Base\CoreBundle\Entity\News;
use Base\CoreBundle\Entity\NewsArticle;
use Base\CoreBundle\Entity\NewsAudio;
use Base\CoreBundle\Entity\NewsImage;
use Base\CoreBundle\Entity\NewsVideo;
use Base\CoreBundle\Entity\Statement;
use Twig_Extension;

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
            new \Twig_SimpleFilter('get_news_format_slug', array($this, 'getNewsFormatSlug')),
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
        } elseif (is_string($object)) {
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

    public function getNewsFormatSlug($item)
    {
        if ($item instanceof NewsArticle) {
            return 'articles';
        } elseif ($item instanceof NewsImage) {
            return 'images';
        } elseif ($item instanceof NewsAudio) {
            return 'audios';
        } elseif ($item instanceof NewsVideo) {
            return 'videos';
        }
    }


    /**
     * @return string
     */
    public function getName()
    {
        return 'news_type_extension';
    }
}