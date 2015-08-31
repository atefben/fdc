<?php

namespace FDC\CoreBundle\Entity;

use \DateTime;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use FDC\CoreBundle\Util\Time;

/**
 * NewsArticle
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class NewsArticle extends News
{
    use Translatable;
    
    /**
     * @var MediaImage
     *
     * @ORM\ManyToOne(targetEntity="MediaImage")
     */
    private $header;
    

    public function __toString() {
        $string = substr(strrchr(get_class($this), '\\'), 1);
        
        if ($this->getId()) {
            $string .= ' #'. $this->getId();
        }
        
        return $string;
    }

    /**
     * Set header
     *
     * @param MediaImage $header
     * @return NewsArticle
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
}
