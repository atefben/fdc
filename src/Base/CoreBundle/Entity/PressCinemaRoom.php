<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Util\Time;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * PressCinemaRoom
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PressCinemaRoom implements TranslateMainInterface
{
    use Time;
    use Translatable;
    use TranslateMain;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple", cascade={"persist"})
     */
    protected $image;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="MediaImageSimple", cascade={"persist"})
     */
    protected $zoneImage;

    /**
     * @var ArrayCollection
     *
     * @Assert\Valid()
     */
    protected $translations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    public function __toString()
    {
        if (is_object($this->findTranslationByLocale('fr'))) {
            $string = $this->findTranslationByLocale('fr')->getTitle();
        }
        else {
            $string = substr(strrchr(get_class($this), '\\'), 1);
        }
        return $string;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set image
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $image
     * @return PressCinemaRoom
     */
    public function setImage(\Base\CoreBundle\Entity\MediaImageSimple $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set zoneImage
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $zoneImage
     * @return PressCinemaRoom
     */
    public function setZoneImage(\Base\CoreBundle\Entity\MediaImageSimple $zoneImage = null)
    {
        $this->zoneImage = $zoneImage;

        return $this;
    }

    /**
     * Get zoneImage
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple 
     */
    public function getZoneImage()
    {
        return $this->zoneImage;
    }
}
