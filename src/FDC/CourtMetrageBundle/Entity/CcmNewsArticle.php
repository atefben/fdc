<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Base\CoreBundle\Util\TruncatePro;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * CcmNewsArticle
 *
 * @ORM\Table(name="ccm_news_article")
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\TranslationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CcmNewsArticle extends CcmNews
{
    use Translatable;
    use TruncatePro;
    
    /**
     * @var CcmMediaImage
     *
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMediaImage")
     *
     * @Groups({"news_list", "search", "news_show", "film_show", "home"})
     */
    protected $header;


    public function getNewsFormat()
    {
        return 'articles';
    }


    public function __toString() {
        $string = substr(strrchr(get_class($this), '\\'), 1);

        if ($this->getId()) {
            $string = $this->findTranslationByLocale('fr')->getTitle();
        }

        return $string;
    }

    /**
     * Set header
     *
     * @param CcmMediaImage $header
     * @return CcmNewsArticle
     */
    public function setHeader(CcmMediaImage $header = null)
    {
        $this->header = $header;

        return $this;
    }

    /**
     * Get header
     *
     * @return CcmMediaImage 
     */
    public function getHeader()
    {
        return $this->header;
    }
}
