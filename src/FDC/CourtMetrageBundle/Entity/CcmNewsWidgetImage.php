<?php

namespace FDC\CourtMetrageBundle\Entity;


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
     * @ORM\ManyToOne(targetEntity="FDC\CourtMetrageBundle\Entity\CcmMediaImage", cascade={"persist"})
     * @Groups({"news_list", "search", "news_show"})
     */
    protected $file;

    /**
     * Set file
     *
     * @param CcmMediaImage $file
     * @return CcmNewsWidgetAudio
     */
    public function setFile(CcmMediaImage $file = null)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return CcmMediaImage
     */
    public function getFile()
    {
        return $this->file;
    }
}
