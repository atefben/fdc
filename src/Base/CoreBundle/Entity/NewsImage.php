<?php

namespace Base\CoreBundle\Entity;

use Base\CoreBundle\Util\TruncatePro;
use \DateTime;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Base\CoreBundle\Util\Time;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * NewsImage
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class NewsImage extends News
{
    use Translatable;
    use TruncatePro;

    /**
     * @var MediaImage
     *
     * @ORM\ManyToOne(targetEntity="MediaImage")
     *
     * @Groups({"news_list", "news_show", "film_show", "home"})
     */
    private $header;

    /**
     * @ORM\ManyToOne(targetEntity="Gallery")
     * @Groups({"news_list", "news_show", "home"})
     *
     * @Assert\NotNull()
     */
    private $gallery;

    public function __toString() {
        $string = substr(strrchr(get_class($this), '\\'), 1);
        
        if ($this->getId()) {
            $string .= ' "' . $this->findTranslationByLocale('fr')->getTitle() . '"';
            $string = $this->truncate($string, 40, '..."', true);
        }
        
        return $string;
    }

    public function getNewsFormat()
    {
        return 'photos';
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

    /**
     * Set gallery
     *
     * @param \Base\CoreBundle\Entity\Gallery $gallery
     * @return NewsImage
     */
    public function setGallery(\Base\CoreBundle\Entity\Gallery $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return \Base\CoreBundle\Entity\Gallery 
     */
    public function getGallery()
    {
        return $this->gallery;
    }
}
