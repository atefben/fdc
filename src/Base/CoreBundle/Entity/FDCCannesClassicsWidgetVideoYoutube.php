<?php

namespace Base\CoreBundle\Entity;

use \DateTime;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * FDCCannesClassicsWidgetVideoYoutube
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FDCCannesClassicsWidgetVideoYoutube extends FDCCannesClassicsWidget
{
    use Translatable;

    /**
     * @var ArrayCollection
     *
     */
    protected $translations;

    /**
     * @var MediaImageSimple
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    protected $image;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    /**
     * Set image
     *
     * @param MediaImageSimple $image
     * @return FDCCannesClassicsWidgetVideoYoutube
     */
    public function setImage(MediaImageSimple $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return MediaImageSimple
     */
    public function getImage()
    {
        return $this->image;
    }
}
