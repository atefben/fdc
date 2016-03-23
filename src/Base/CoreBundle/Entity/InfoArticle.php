<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Base\CoreBundle\Util\TruncatePro;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * InfoArticle
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class InfoArticle extends Info
{
    use Translatable;
    use TruncatePro;


    /**
     * @var MediaImage
     *
     * @ORM\ManyToOne(targetEntity="MediaImage", cascade={"persist"})
     *
     * @Groups({"news_list", "news_show", "home"})
     * @Assert\NotNull()
     */
    private $header;


    public function getNewsFormat()
    {
        return 'articles';
    }


    public function __toString() {
        $string = substr(strrchr(get_class($this), '\\'), 1);

        if ($this->getId()) {
            $string .= ' "' . $this->findTranslationByLocale('fr')->getTitle() . '"';
            $string = $this->truncate($string, 40, '..."', true);
        }

        return $string;
    }


    /**
     * Set header
     *
     * @param MediaImage $header
     * @return InfoArticle
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
