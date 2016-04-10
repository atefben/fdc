<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\SeoMain;
use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Util\Time;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * PressGuide
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\TranslationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class PressGuide implements TranslateMainInterface
{
    use Time;
    use Translatable;
    use TranslateMain;
    use SeoMain;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="guide_arrive_icon", type="string", length=122)
     */
    protected $arriveIcon;

    /**
     * @var PressGuideWidget
     *
     * @ORM\OneToMany(targetEntity="PressGuideWidget", mappedBy="PressGuideArrive", cascade={"persist", "remove"}, orphanRemoval=true)
     *
     */
    private $arriveWidgets;

    /**
     * @var string
     *
     * @ORM\Column(name="guide_meeting_icon", type="string", length=122)
     */
    protected $meetingIcon;

    /**
     * @var PressGuideWidget
     *
     * @ORM\OneToMany(targetEntity="PressGuideWidget", mappedBy="PressGuideMeeting", cascade={"persist", "remove"}, orphanRemoval=true)
     *
     */
    private $meetingWidgets;

    /**
     * @var string
     *
     * @ORM\Column(name="guide_information_icon", type="string", length=122)
     */
    protected $informationIcon;

    /**
     * @var PressGuideWidget
     *
     * @ORM\OneToMany(targetEntity="PressGuideWidget", mappedBy="PressGuideInformation", cascade={"persist", "remove"}, orphanRemoval=true)
     *
     */
    private $informationWidgets;

    /**
     * @var string
     *
     * @ORM\Column(name="guide_service_icon", type="string", length=122)
     */
    protected $serviceIcon;

    /**
     * @var PressGuideWidget
     *
     * @ORM\OneToMany(targetEntity="PressGuideWidget", mappedBy="PressGuideService", cascade={"persist", "remove"}, orphanRemoval=true)
     *
     */
    private $serviceWidgets;

    /**
     * ArrayCollection
     */
    protected $translations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->serviceWidgets = new ArrayCollection();
        $this->arriveWidgets = new ArrayCollection();
        $this->informationWidgets = new ArrayCollection();
        $this->meetingWidgets = new ArrayCollection();
    }

    public function __toString() {
        $string = substr(strrchr(get_class($this), '\\'), 1);

        if ($this->getId()) {
            $string .= ' #'. $this->getId();
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
     * Set arriveIcon
     *
     * @param string $arriveIcon
     * @return PressGuide
     */
    public function setArriveIcon($arriveIcon)
    {
        $this->arriveIcon = $arriveIcon;

        return $this;
    }

    /**
     * Get arriveIcon
     *
     * @return string 
     */
    public function getArriveIcon()
    {
        return $this->arriveIcon;
    }

    /**
     * Set meetingIcon
     *
     * @param string $meetingIcon
     * @return PressGuide
     */
    public function setMeetingIcon($meetingIcon)
    {
        $this->meetingIcon = $meetingIcon;

        return $this;
    }

    /**
     * Get meetingIcon
     *
     * @return string 
     */
    public function getMeetingIcon()
    {
        return $this->meetingIcon;
    }

    /**
     * Set informationIcon
     *
     * @param string $informationIcon
     * @return PressGuide
     */
    public function setInformationIcon($informationIcon)
    {
        $this->informationIcon = $informationIcon;

        return $this;
    }

    /**
     * Get informationIcon
     *
     * @return string 
     */
    public function getInformationIcon()
    {
        return $this->informationIcon;
    }

    /**
     * Set serviceIcon
     *
     * @param string $serviceIcon
     * @return PressGuide
     */
    public function setServiceIcon($serviceIcon)
    {
        $this->serviceIcon = $serviceIcon;

        return $this;
    }

    /**
     * Get serviceIcon
     *
     * @return string 
     */
    public function getServiceIcon()
    {
        return $this->serviceIcon;
    }

    /**
     * Add arriveWidgets
     *
     * @param \Base\CoreBundle\Entity\PressGuideWidget $arriveWidgets
     * @return PressGuide
     */
    public function addArriveWidget(\Base\CoreBundle\Entity\PressGuideWidget $arriveWidgets)
    {
        $arriveWidgets->setPressGuideArrive($this);
        $this->arriveWidgets->add($arriveWidgets);
    }

    /**
     * Remove arriveWidgets
     *
     * @param \Base\CoreBundle\Entity\PressGuideWidget $arriveWidgets
     */
    public function removeArriveWidget(\Base\CoreBundle\Entity\PressGuideWidget $arriveWidgets)
    {
        $this->arriveWidgets->removeElement($arriveWidgets);
    }

    /**
     * Get arriveWidgets
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArriveWidgets()
    {
        return $this->arriveWidgets;
    }

    /**
     * Add meetingWidgets
     *
     * @param \Base\CoreBundle\Entity\PressGuideWidget $meetingWidgets
     * @return PressGuide
     */
    public function addMeetingWidget(\Base\CoreBundle\Entity\PressGuideWidget $meetingWidgets)
    {
        $meetingWidgets->setPressGuideMeeting($this);
        $this->meetingWidgets->add($meetingWidgets);
    }

    /**
     * Remove meetingWidgets
     *
     * @param \Base\CoreBundle\Entity\PressGuideWidget $meetingWidgets
     */
    public function removeMeetingWidget(\Base\CoreBundle\Entity\PressGuideWidget $meetingWidgets)
    {
        $this->meetingWidgets->removeElement($meetingWidgets);
    }

    /**
     * Get meetingWidgets
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMeetingWidgets()
    {
        return $this->meetingWidgets;
    }

    /**
     * Add informationWidgets
     *
     * @param \Base\CoreBundle\Entity\PressGuideWidget $informationWidgets
     * @return PressGuide
     */
    public function addInformationWidget(\Base\CoreBundle\Entity\PressGuideWidget $informationWidgets)
    {
        $informationWidgets->setPressGuideInformation($this);
        $this->informationWidgets->add($informationWidgets);
    }

    /**
     * Remove informationWidgets
     *
     * @param \Base\CoreBundle\Entity\PressGuideWidget $informationWidgets
     */
    public function removeInformationWidget(\Base\CoreBundle\Entity\PressGuideWidget $informationWidgets)
    {
        $this->informationWidgets->removeElement($informationWidgets);
    }

    /**
     * Get informationWidgets
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInformationWidgets()
    {
        return $this->informationWidgets;
    }

    /**
     * Add serviceWidgets
     *
     * @param \Base\CoreBundle\Entity\PressGuideWidget $serviceWidgets
     * @return PressGuide
     */
    public function addServiceWidget(\Base\CoreBundle\Entity\PressGuideWidget $serviceWidgets)
    {
        $serviceWidgets->setPressGuideService($this);
        $this->serviceWidgets->add($serviceWidgets);
    }

    /**
     * Remove serviceWidgets
     *
     * @param \Base\CoreBundle\Entity\PressGuideWidget $serviceWidgets
     */
    public function removeServiceWidget(\Base\CoreBundle\Entity\PressGuideWidget $serviceWidgets)
    {
        $this->serviceWidgets->removeElement($serviceWidgets);
    }

    /**
     * Get serviceWidgets
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getServiceWidgets()
    {
        return $this->serviceWidgets;
    }

}
