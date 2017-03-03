<?php

namespace FDC\CourtMetrageBundle\Entity;

use Base\CoreBundle\Entity\Gallery;
use Base\CoreBundle\Entity\MediaImage;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
/**
 * CcmNewsWidgetImage
 *
 * @ORM\Table(name="ccm_news_widget_image")
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\NewsWidgetImageRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CcmNewsWidgetImage extends CcmNewsWidget
{
    /**
     * @var Gallery
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaImage", cascade={"persist"})
     * @Groups({"news_list", "search", "news_show"})
     */
    protected $file;

    /**
     * Set file
     *
     * @param \Base\CoreBundle\Entity\MediaImage $file
     * @return CcmNewsWidgetAudio
     */
    public function setFile(MediaImage $file = null)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return \Base\CoreBundle\Entity\MediaImage
     */
    public function getFile()
    {
        return $this->file;
    }
}
