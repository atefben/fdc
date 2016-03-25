<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Base\CoreBundle\Util\Time;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * FDCCannesClassicsWidgetVideoYoutubeTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FDCCannesClassicsWidgetVideoYoutubeTranslation
{
    use Translation;
    use Time;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=false)
     *
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=false)
     *
     */
    private $title;

    /**
     * Set title
     *
     * @param string $title
     * @return FDCCannesClassicsWidgetVideoYoutubeTranslation
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return FDCCannesClassicsWidgetVideoYoutubeTranslation
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}
