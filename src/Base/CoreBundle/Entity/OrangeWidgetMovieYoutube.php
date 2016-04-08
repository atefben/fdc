<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use JMS\Serializer\Annotation\Groups;

/**
 * OrangeWidgetMovieYoutube
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class OrangeWidgetMovieYoutube extends OrangeWidget
{
    use Translatable;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="text", nullable=true)
     * @Groups({
     *     "orange_series_and_cie"
     * })
     */
    private $url;

    /**
     * Set url
     *
     * @param string $url
     * @return OrangeWidgetMovieYoutube
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
