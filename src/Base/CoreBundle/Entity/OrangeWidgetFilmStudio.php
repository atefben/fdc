<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use JMS\Serializer\Annotation\Groups;

/**
 * OrangeWidgetFilmOCS
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class OrangeWidgetFilmStudio extends OrangeWidget
{
    use Translatable;
    
    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     * @Groups({"orange_studio"})
     */
    protected $image;

    /**
     * @var string
     *
     * @ORM\Column(name="producer", type="text", nullable=true)
     * @Groups({"orange_studio"})
     */
    protected $producer;

    /**
     * Set image
     *
     * @param MediaImageSimple $image
     * @return OrangeWidgetFilmOCS
     */
    public function setImage($image)
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

    /**
     * Set producer
     *
     * @param string $producer
     * @return OrangeWidgetFilmOCS
     */
    public function setProducer($producer)
    {
        $this->producer = $producer;

        return $this;
    }

    /**
     * Get producer
     *
     * @return string 
     */
    public function getProducer()
    {
        return $this->producer;
    }
}
