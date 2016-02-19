<?php

namespace Base\CoreBundle\Entity;

use \DateTime;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

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
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaVideo")
     * @Groups({"news_list", "news_show"})
     */
    private $file;

    /**
     * Set file
     *
     * @param \Base\CoreBundle\Entity\MediaVideo $file
     * @return NewsWidgetVideo
     */
    public function setFile(\Base\CoreBundle\Entity\MediaVideo $file = null)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return \Base\CoreBundle\Entity\MediaVideo 
     */
    public function getFile()
    {
        return $this->file;
    }
}
