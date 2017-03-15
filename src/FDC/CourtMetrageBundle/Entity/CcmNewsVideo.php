<?php

namespace FDC\CourtMetrageBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

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
     * @var CcmMediaVideo
     *
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMediaVideo")
     *
     * @Groups({"news_list", "search", "news_show", "home"})
     * @Assert\NotNull()
     */
    protected $video;

    /**
     * @var CcmMediaImage
     *
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMediaImage")
     *
     * @Groups({"news_list", "search", "news_show", "film_show", "home"})
     */
    protected $image;

    public function __toString() {
        $string = substr(strrchr(get_class($this), '\\'), 1);

        if ($this->getId()) {
            $string = $this->findTranslationByLocale('fr')->getTitle();
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
     * @param CcmMediaVideo $video
     * @return CcmNewsVideo
     */
    public function setVideo(CcmMediaVideo $video = null)
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Get video
     *
     * @return CcmMediaVideo 
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Set image
     *
     * @param CcmMediaImage $image
     * @return CcmNewsVideo
     */
    public function setImage(CcmMediaImage $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return CcmMediaImage 
     */
    public function getImage()
    {
        return $this->image;
    }


    /**
     * Get header
     *
     * @return CcmMediaImage
     */
    public function getHeader()
    {
        return $this->image;
    }

    /**
     * Set header
     *
     * @param CcmMediaImage $header
     * @return CcmNewsVideo
     */
    public function setHeader(CcmMediaImage $header = null)
    {
        $this->image = $header;

        return $this;
    }
}
