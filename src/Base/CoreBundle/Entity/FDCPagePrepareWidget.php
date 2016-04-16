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
 * FDCPagePrepareWidget
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *  "image" = "FDCPagePrepareWidgetImage",
 *  "column" = "FDCPagePrepareWidgetColumn",
 *  "picto" = "FDCPagePrepareWidgetPicto",
 * })
 */
abstract class FDCPagePrepareWidget implements TranslateMainInterface
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
     * @var FDCPagePrepare
     *
     * @ORM\ManyToOne(targetEntity="FDCPagePrepare", inversedBy="arriveWidgets")
     */
    protected $FDCPagePrepareArrive;

    /**
     * @var FDCPagePrepare
     *
     * @ORM\ManyToOne(targetEntity="FDCPagePrepare", inversedBy="meetingWidgets")
     */
    protected $FDCPagePrepareMeeting;

    /**
     * @var FDCPagePrepare
     *
     * @ORM\ManyToOne(targetEntity="FDCPagePrepare", inversedBy="informationWidgets")
     */
    protected $FDCPagePrepareInformation;

    /**
     * @var FDCPagePrepare
     *
     * @ORM\ManyToOne(targetEntity="FDCPagePrepare", inversedBy="serviceWidgets")
     */
    protected $FDCPagePrepareService;

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
     * Set FDCPagePrepareArrive
     *
     * @param \Base\CoreBundle\Entity\FDCPagePrepare $FDCPagePrepareArrive
     * @return FDCPagePrepareWidget
     */
    public function setFDCPagePrepareArrive(\Base\CoreBundle\Entity\FDCPagePrepare $FDCPagePrepareArrive = null)
    {
        $this->FDCPagePrepareArrive = $FDCPagePrepareArrive;

        return $this;
    }

    /**
     * Get FDCPagePrepareArrive
     *
     * @return \Base\CoreBundle\Entity\FDCPagePrepare
     */
    public function getFDCPagePrepareArrive()
    {
        return $this->FDCPagePrepareArrive;
    }

    /**
     * Set FDCPagePrepareMeeting
     *
     * @param \Base\CoreBundle\Entity\FDCPagePrepare $FDCPagePrepareMeeting
     * @return FDCPagePrepareWidget
     */
    public function setFDCPagePrepareMeeting(\Base\CoreBundle\Entity\FDCPagePrepare $FDCPagePrepareMeeting = null)
    {
        $this->FDCPagePrepareMeeting = $FDCPagePrepareMeeting;

        return $this;
    }

    /**
     * Get FDCPagePrepareMeeting
     *
     * @return \Base\CoreBundle\Entity\FDCPagePrepare
     */
    public function getFDCPagePrepareMeeting()
    {
        return $this->FDCPagePrepareMeeting;
    }

    /**
     * Set FDCPagePrepareInformation
     *
     * @param \Base\CoreBundle\Entity\FDCPagePrepare $FDCPagePrepareInformation
     * @return FDCPagePrepareWidget
     */
    public function setFDCPagePrepareInformation(\Base\CoreBundle\Entity\FDCPagePrepare $FDCPagePrepareInformation = null)
    {
        $this->FDCPagePrepareInformation = $FDCPagePrepareInformation;

        return $this;
    }

    /**
     * Get FDCPagePrepareInformation
     *
     * @return \Base\CoreBundle\Entity\FDCPagePrepare
     */
    public function getFDCPagePrepareInformation()
    {
        return $this->FDCPagePrepareInformation;
    }

    /**
     * Set FDCPagePrepareService
     *
     * @param \Base\CoreBundle\Entity\FDCPagePrepare $FDCPagePrepareService
     * @return FDCPagePrepareWidget
     */
    public function setFDCPagePrepareService(\Base\CoreBundle\Entity\FDCPagePrepare $FDCPagePrepareService = null)
    {
        $this->FDCPagePrepareService = $FDCPagePrepareService;

        return $this;
    }

    /**
     * Get FDCPagePrepareService
     *
     * @return \Base\CoreBundle\Entity\FDCPagePrepare
     */
    public function getFDCPagePrepareService()
    {
        return $this->FDCPagePrepareService;
    }
}
