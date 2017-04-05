<?php

namespace Base\CoreBundle\Component\Traits;

use Base\CoreBundle\Entity\MediaImage;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

trait NodeArticle
{

    /**
     * @var MediaImage
     *
     * @ORM\ManyToOne(targetEntity="MediaImage", cascade={"persist"})
     *
     * @Groups({"news_list", "search", "news_show", "home"})
     */
    protected $header;

    /**
     * Set header
     *
     * @param MediaImage $header
     * @return $this
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
     * @return string
     */
    public function getNewsFormat()
    {
        return 'articles';
    }
}