<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Base\CoreBundle\Util\Time;

use Base\CoreBundle\Util\TruncatePro;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * NewsVideo
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class NewsVideo extends News
{
    use Translatable;
    use TruncatePro;

    /**
     * @var MediaVideo
     *
     * @ORM\ManyToOne(targetEntity="MediaVideo")
     *
     * @Groups({"news_list", "news_show"})
     * @Assert\NotNull()
     */
    private $video;

    /**
     * @var MediaImage
     *
     * @ORM\ManyToOne(targetEntity="MediaImage")
     *
     * @Groups({"news_list", "news_show", "film_show", "home"})
     */
    private $image;

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
     * @return NewsVideo
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
     * @return NewsVideo
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
}
