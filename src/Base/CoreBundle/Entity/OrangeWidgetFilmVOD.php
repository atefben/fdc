<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

/**
 * OrangeWidgetFilmVOD
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class OrangeWidgetFilmVOD extends OrangeWidget
{
    use Translatable;
    
    /**
     * @var MediaImage
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     *
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="copy", type="text", nullable=true)
     */
    private $copy;
    
    /**
     * @var string
     *
     * @ORM\Column(name="producer", type="text", nullable=true)
     */
    private $producer;
    
    /**
     * @var string
     *
     * @ORM\Column(name="section", type="integer")
     */
    private $section;
    
    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="OrangeVideoOnDemand", inversedBy="widgets")
     */
    private $parent;
    
    /**
     * Set image
     *
     * @param MediaImageSimple $image
     * @return OrangeWidgetFilmVOD
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
     * Set legend
     *
     * @param string $copy
     * @return OrangeWidgetFilmVOD
     */
    public function setCopy($copy)
    {
        $this->copy = $copy;

        return $this;
    }

    /**
     * Get legend
     *
     * @return string 
     */
    public function getCopy()
    {
        return $this->copy;
    }

    /**
     * Set producer
     *
     * @param string $producer
     * @return OrangeWidgetFilmVOD
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
    
    /**
     * Set section
     *
     * @param integer $section
     * @return OrangeWidget
     */
    public function setSection($section)
    {
        $this->section = $section;

        return $this;
    }

    /**
     * Get section
     *
     * @return integer 
     */
    public function getSection()
    {
        return $this->section;
    }
    
    /**
     * Set position3
     *
     * @param integer $position3
     * @return OrangeWidget
     */
    public function setPosition3($position3)
    {
        $this->position3 = $position3;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition3()
    {
        return $this->position3;
    }
    
    public static function getSections()
    {
      return array(
        1 => 'L’ANNÉE DERNIÈRE À CANNES, CETTE ANNÉE EN VOD',
        2 => 'PALMES D’OR DU FESTIVAL DE CANNES',
        3 => 'IL N’Y A PAS QUE LA PALME D’OR',
      );
    }
}
