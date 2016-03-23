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
 * FDCPageParticipateWidget
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *  "image" = "FDCPageParticipateWidgetImage",
 *  "column" = "FDCPageParticipateWidgetColumn",
 *  "picto" = "FDCPageParticipateWidgetPicto",
 * })
 */
abstract class FDCPageParticipateWidget implements TranslateMainInterface
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
     * @var FDCPageParticipate
     *
     * @ORM\ManyToOne(targetEntity="FDCPageParticipate", inversedBy="arriveWidgets")
     */
    protected $FDCPageParticipateArrive;

    /**
     * @var FDCPageParticipate
     *
     * @ORM\ManyToOne(targetEntity="FDCPageParticipate", inversedBy="meetingWidgets")
     */
    protected $FDCPageParticipateMeeting;

    /**
     * @var FDCPageParticipate
     *
     * @ORM\ManyToOne(targetEntity="FDCPageParticipate", inversedBy="informationWidgets")
     */
    protected $FDCPageParticipateInformation;

    /**
     * @var FDCPageParticipate
     *
     * @ORM\ManyToOne(targetEntity="FDCPageParticipate", inversedBy="serviceWidgets")
     */
    protected $FDCPageParticipateService;

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
     * Set FDCPageParticipateArrive
     *
     * @param \Base\CoreBundle\Entity\FDCPageParticipate $FDCPageParticipateArrive
     * @return FDCPageParticipateWidget
     */
    public function setFDCPageParticipateArrive(\Base\CoreBundle\Entity\FDCPageParticipate $FDCPageParticipateArrive = null)
    {
        $this->FDCPageParticipateArrive = $FDCPageParticipateArrive;

        return $this;
    }

    /**
     * Get FDCPageParticipateArrive
     *
     * @return \Base\CoreBundle\Entity\FDCPageParticipate
     */
    public function getFDCPageParticipateArrive()
    {
        return $this->FDCPageParticipateArrive;
    }

    /**
     * Set FDCPageParticipateMeeting
     *
     * @param \Base\CoreBundle\Entity\FDCPageParticipate $FDCPageParticipateMeeting
     * @return FDCPageParticipateWidget
     */
    public function setFDCPageParticipateMeeting(\Base\CoreBundle\Entity\FDCPageParticipate $FDCPageParticipateMeeting = null)
    {
        $this->FDCPageParticipateMeeting = $FDCPageParticipateMeeting;

        return $this;
    }

    /**
     * Get FDCPageParticipateMeeting
     *
     * @return \Base\CoreBundle\Entity\FDCPageParticipate
     */
    public function getFDCPageParticipateMeeting()
    {
        return $this->FDCPageParticipateMeeting;
    }

    /**
     * Set FDCPageParticipateInformation
     *
     * @param \Base\CoreBundle\Entity\FDCPageParticipate $FDCPageParticipateInformation
     * @return FDCPageParticipateWidget
     */
    public function setFDCPageParticipateInformation(\Base\CoreBundle\Entity\FDCPageParticipate $FDCPageParticipateInformation = null)
    {
        $this->FDCPageParticipateInformation = $FDCPageParticipateInformation;

        return $this;
    }

    /**
     * Get FDCPageParticipateInformation
     *
     * @return \Base\CoreBundle\Entity\FDCPageParticipate
     */
    public function getFDCPageParticipateInformation()
    {
        return $this->FDCPageParticipateInformation;
    }

    /**
     * Set FDCPageParticipateService
     *
     * @param \Base\CoreBundle\Entity\FDCPageParticipate $FDCPageParticipateService
     * @return FDCPageParticipateWidget
     */
    public function setFDCPageParticipateService(\Base\CoreBundle\Entity\FDCPageParticipate $FDCPageParticipateService = null)
    {
        $this->FDCPageParticipateService = $FDCPageParticipateService;

        return $this;
    }

    /**
     * Get FDCPageParticipateService
     *
     * @return \Base\CoreBundle\Entity\FDCPageParticipate
     */
    public function getFDCPageParticipateService()
    {
        return $this->FDCPageParticipateService;
    }
}
