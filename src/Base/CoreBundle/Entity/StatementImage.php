<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Base\CoreBundle\Util\Time;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

/**
 * StatementImage
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class StatementImage extends Statement
{
    use Translatable;

    /**
     * @ORM\ManyToOne(targetEntity="Gallery")
     *
     * @Groups({"news_list", "news_show"})
     */
    private $gallery;

    public function __toString() {
        $string = substr(strrchr(get_class($this), '\\'), 1);

        if ($this->getId()) {
            $string .= ' #'. $this->getId();
        }

        return $string;
    }

    /**
     * Set gallery
     *
     * @param \Base\CoreBundle\Entity\Gallery $gallery
     * @return NewsImage
     */
    public function setGallery(\Base\CoreBundle\Entity\Gallery $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return \Base\CoreBundle\Entity\Gallery
     */
    public function getGallery()
    {
        return $this->gallery;
    }
}
