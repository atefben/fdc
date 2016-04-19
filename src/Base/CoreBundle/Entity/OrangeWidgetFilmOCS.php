<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * OrangeWidgetFilmOCS
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class OrangeWidgetFilmOCS extends OrangeWidget
{
    use Translatable;
    
    /**
     * @var MediaImage
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     * @Groups({
     *     "orange_programmation_ocs"
     * })
     *
     */
    private $image;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="name", type="integer", nullable=true)
     * @Groups({
     *     "orange_programmation_ocs"
     * })
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="producer", type="text", nullable=true)
     *
     * @Groups({
     *     "orange_programmation_ocs"
     * })
     */
    private $producer;


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
     * Set name
     *
     * @param integer $name
     * @return OrangeWidgetFilmOCS
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return integer 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get name
     *
     * @return string
     * @VirtualProperty()
     * @Groups({
     *     "orange_programmation_ocs"
     * })
     */
    public function getStringName()
    {
        return static::getNames()[$this->name];
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
    
    public static function getNames()
    {
      return array(
        1 => 'OCS MAX',
        2 => 'OCS CITY',
        3 => 'OCS CHOC',
        4 => 'OCS GÉANTS',
        5 => 'OCS GO',
        6 => 'Pré-achat OCS'
      );
    }
    
}
