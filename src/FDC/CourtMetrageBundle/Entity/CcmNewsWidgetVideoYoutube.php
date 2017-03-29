<?php

namespace FDC\CourtMetrageBundle\Entity;


use \DateTime;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * CcmNewsWidgetVideoYoutube
 *
 * @ORM\Table(name="ccm_news_widget_video_youtube")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CcmNewsWidgetVideoYoutube extends CcmNewsWidget
{
    use Translatable;

    /**
     * @var ArrayCollection
     *
     * @Groups({"news_list", "search", "news_show"})
     */
    protected $translations;

    /**
     * @var CcmMediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMediaImageSimple", cascade={"persist"})
     * @Groups({"news_list", "search", "news_show"})
     */
    protected $image;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    /**
     * Set image
     *
     * @param CcmMediaImageSimple $image
     * @return CcmNewsWidgetVideoYoutube
     */
    public function setImage(CcmMediaImageSimple $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return CcmMediaImageSimple
     */
    public function getImage()
    {
        return $this->image;
    }
}
