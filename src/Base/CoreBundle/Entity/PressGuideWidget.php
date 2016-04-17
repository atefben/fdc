<?php

namespace Base\CoreBundle\Entity;

use Base\CoreBundle\Util\SeoMain;
use Base\CoreBundle\Util\Time;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Interfaces\TranslateMainInterface;

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
abstract class PressGuideWidget implements TranslateMainInterface
{
    use Time;
    use SeoMain;
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
     * @var PressGuide
     *
     * @ORM\ManyToOne(targetEntity="PressGuide", inversedBy="arriveWidgets")
     */
    protected $PressGuideArrive;

    /**
     * @var PressGuide
     *
     * @ORM\ManyToOne(targetEntity="PressGuide", inversedBy="meetingWidgets")
     */
    protected $PressGuideMeeting;

    /**
     * @var PressGuide
     *
     * @ORM\ManyToOne(targetEntity="PressGuide", inversedBy="informationWidgets")
     */
    protected $PressGuideInformation;

    /**
     * @var PressGuide
     *
     * @ORM\ManyToOne(targetEntity="PressGuide", inversedBy="serviceWidgets")
     */
    protected $PressGuideService;

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
     * Set PressGuideArrive
     *
     * @param \Base\CoreBundle\Entity\PressGuide $pressGuideArrive
     * @return PressGuideWidget
     */
    public function setPressGuideArrive(\Base\CoreBundle\Entity\PressGuide $pressGuideArrive = null)
    {
        $this->PressGuideArrive = $pressGuideArrive;

        return $this;
    }

    /**
     * Get PressGuideArrive
     *
     * @return \Base\CoreBundle\Entity\PressGuide 
     */
    public function getPressGuideArrive()
    {
        return $this->PressGuideArrive;
    }

    /**
     * Set PressGuideMeeting
     *
     * @param \Base\CoreBundle\Entity\PressGuide $pressGuideMeeting
     * @return PressGuideWidget
     */
    public function setPressGuideMeeting(\Base\CoreBundle\Entity\PressGuide $pressGuideMeeting = null)
    {
        $this->PressGuideMeeting = $pressGuideMeeting;

        return $this;
    }

    /**
     * Get PressGuideMeeting
     *
     * @return \Base\CoreBundle\Entity\PressGuide 
     */
    public function getPressGuideMeeting()
    {
        return $this->PressGuideMeeting;
    }

    /**
     * Set PressGuideInformation
     *
     * @param \Base\CoreBundle\Entity\PressGuide $pressGuideInformation
     * @return PressGuideWidget
     */
    public function setPressGuideInformation(\Base\CoreBundle\Entity\PressGuide $pressGuideInformation = null)
    {
        $this->PressGuideInformation = $pressGuideInformation;

        return $this;
    }

    /**
     * Get PressGuideInformation
     *
     * @return \Base\CoreBundle\Entity\PressGuide 
     */
    public function getPressGuideInformation()
    {
        return $this->PressGuideInformation;
    }

    /**
     * Set PressGuideService
     *
     * @param \Base\CoreBundle\Entity\PressGuide $pressGuideService
     * @return PressGuideWidget
     */
    public function setPressGuideService(\Base\CoreBundle\Entity\PressGuide $pressGuideService = null)
    {
        $this->PressGuideService = $pressGuideService;

        return $this;
    }

    /**
     * Get PressGuideService
     *
     * @return \Base\CoreBundle\Entity\PressGuide 
     */
    public function getPressGuideService()
    {
        return $this->PressGuideService;
    }
}
