<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Base\CoreBundle\Util\TruncatePro;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * NewsArticle
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\TranslationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class NewsArticle extends News
{
    use Translatable;
    use TruncatePro;
    
    /**
     * @var MediaImage
     *
     * @ORM\ManyToOne(targetEntity="MediaImage", cascade={"all"})
     *
     * @Groups({"news_list", "search", "news_show", "film_show", "home"})
     */
    protected $header;


    public function getNewsFormat()
    {
        return 'articles';
    }

    /**
     * Set header
     *
     * @param MediaImage $header
     * @return NewsArticle
     */
    public function setHeader(MediaImage $header = null)
    {
        $this->header = $header;

        return $this;
    }

    /**
     * Get header
     *
     * @return MediaImage 
     */
    public function getHeader()
    {
        return $this->header;
    }
}
