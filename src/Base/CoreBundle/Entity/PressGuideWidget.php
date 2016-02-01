<?php

namespace Base\CoreBundle\Entity;

use Base\CoreBundle\Util\Time;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * PressGuideWidget
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *  "image" = "PressGuideWidgetImage",
 *  "column" = "PressGuideWidgetColumn",
 *  "picto" = "PressGuideWidgetPicto",
 * })
 */
abstract class PressGuideWidget
{
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var PressGuide
     *
     * @ORM\ManyToOne(targetEntity="PressGuide", inversedBy="widgets")
     */
    protected $PressGuide;

    /**
     * @var $pressSection
     */
    protected $pressSection;


    /**
     * Constructor
     * @param $pressSection
     */
    public function __construct($pressSection)
    {
        $this->setPressSection($pressSection);
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
     * Set PressGuide
     *
     * @param \Base\CoreBundle\Entity\PressGuide $pressGuide
     * @return PressGuideWidget
     */
    public function setPressGuide(\Base\CoreBundle\Entity\PressGuide $pressGuide = null)
    {
        $this->PressGuide = $pressGuide;

        return $this;
    }

    /**
     * Get PressGuide
     *
     * @return \Base\CoreBundle\Entity\PressGuide 
     */
    public function getPressGuide()
    {
        return $this->PressGuide;
    }

    /**
     * @return mixed
     */
    public function getPressSection()
    {
        return $this->pressSection;
    }

    /**
     * @param mixed $pressSection
     */
    public function setPressSection($pressSection)
    {
        $this->pressSection = $pressSection;
    }
}
