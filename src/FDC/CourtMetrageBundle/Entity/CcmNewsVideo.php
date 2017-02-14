<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Base\CoreBundle\Entity\MediaImage;
use Base\CoreBundle\Entity\MediaVideo;
use Base\CoreBundle\Entity\NewsArticle;
use Base\CoreBundle\Util\Time;

use Base\CoreBundle\Util\TruncatePro;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * CcmNewsVideo
 *
 * @ORM\Table(name="ccm_news_video")
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\TranslationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CcmNewsVideo extends CcmNews
{
    use Translatable;
    use TruncatePro;

    /**
     * @var MediaVideo
     *
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaVideo")
     *
     * @Groups({"news_list", "search", "news_show", "home"})
     * @Assert\NotNull()
     */
    protected $video;

    /**
     * @var MediaImage
     *
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaImage")
     *
     * @Groups({"news_list", "search", "news_show", "film_show", "home"})
     */
    protected $image;

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
        return 'videos';
    }

    /**
     * Set video
     *
     * @param \Base\CoreBundle\Entity\MediaVideo $video
     * @return CcmNewsVideo
     */
    public function setVideo(\Base\CoreBundle\Entity\MediaVideo $video = null)
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Get video
     *
     * @return \Base\CoreBundle\Entity\MediaVideo 
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Set image
     *
     * @param \Base\CoreBundle\Entity\MediaImage $image
     * @return CcmNewsVideo
     */
    public function setImage(\Base\CoreBundle\Entity\MediaImage $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Base\CoreBundle\Entity\MediaImage 
     */
    public function getImage()
    {
        return $this->image;
    }


    /**
     * Get header
     *
     * @return MediaImage
     */
    public function getHeader()
    {
        return $this->image;
    }

    /**
     * Set header
     *
     * @param MediaImage $header
     * @return NewsArticle
     */
    public function setHeader(MediaImage $header = null)
    {
        $this->image = $header;

        return $this;
    }
}
