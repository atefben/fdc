<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * NewsWidgetVideo
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class NewsWidgetVideo extends NewsWidget
{
    /**
     * @var MediaVideo
     *
     * @ORM\ManyToOne(targetEntity="MediaVideo")
     * @Groups({"news_list", "news_show"})
     */
    private $file;

    /**
     * Set file
     *
     * @param MediaVideo $file
     * @return NewsWidgetVideo
     */
    public function setFile(MediaVideo $file = null)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return MediaVideo
     */
    public function getFile()
    {
        return $this->file;
    }
}
