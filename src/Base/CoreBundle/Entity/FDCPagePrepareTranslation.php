<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Base\CoreBundle\Util\Seo;
use Base\CoreBundle\Util\TranslateChild;
use Base\CoreBundle\Interfaces\TranslateChildInterface;
use Base\CoreBundle\Util\Time;

/**
 * FDCPagePrepareTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FDCPagePrepareTranslation implements TranslateChildInterface
{
    use TranslateChild;
    use Time;
    use Translation;
    use Seo;

    /**
     * @var string
     *
     * @ORM\Column(name="guide_main_title", type="string", length=122, nullable=true)
     */
    protected $mainTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="guide_main_description", type="text", nullable=true)
     */
    protected $mainDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="guide_arrive_title", type="string", length=122, nullable=true)
     */
    protected $arriveTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="guide_meeting_title", type="string", length=122, nullable=true)
     */
    protected $meetingTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="guide_information_title", type="string", length=122, nullable=true)
     */
    protected $informationTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="guide_information_description", type="text", nullable=true)
     */
    protected $informationDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="guide_meeting_description", type="text", nullable=true)
     */
    protected $meetingDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="guide_meeting_label", type="string", length=122, nullable=true)
     */
    protected $meetingLabel;

    /**
     * @var string
     *
     * @ORM\Column(name="guide_meeting_url", type="string", length=122, nullable=true)
     */
    protected $meetingUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="guide_service_description", type="text", nullable=true)
     */
    protected $serviceDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="guide_service_title", type="string", length=122, nullable=true)
     */
    protected $serviceTitle;


    /**
     * Set arriveTitle
     *
     * @param string $arriveTitle
     * @return PressGuideTranslation
     */
    public function setArriveTitle($arriveTitle)
    {
        $this->arriveTitle = $arriveTitle;

        return $this;
    }

    /**
     * Get arriveTitle
     *
     * @return string
     */
    public function getArriveTitle()
    {
        return $this->arriveTitle;
    }

    /**
     * Set meetingTitle
     *
     * @param string $meetingTitle
     * @return PressGuideTranslation
     */
    public function setMeetingTitle($meetingTitle)
    {
        $this->meetingTitle = $meetingTitle;

        return $this;
    }

    /**
     * Get meetingTitle
     *
     * @return string
     */
    public function getMeetingTitle()
    {
        return $this->meetingTitle;
    }

    /**
     * Set informationTitle
     *
     * @param string $informationTitle
     * @return PressGuideTranslation
     */
    public function setInformationTitle($informationTitle)
    {
        $this->informationTitle = $informationTitle;

        return $this;
    }

    /**
     * Get informationTitle
     *
     * @return string
     */
    public function getInformationTitle()
    {
        return $this->informationTitle;
    }

    /**
     * Set informationDescription
     *
     * @param string $informationTitle
     * @return PressGuideTranslation
     */
    public function setInformationDescription($informationDescription)
    {
        $this->informationDescription = $informationDescription;

        return $this;
    }

    /**
     * Get informationDescription
     *
     * @return string
     */
    public function getInformationDescription()
    {
        return $this->informationDescription;
    }

    /**
     * Set serviceTitle
     *
     * @param string $serviceTitle
     * @return PressGuideTranslation
     */
    public function setServiceTitle($serviceTitle)
    {
        $this->serviceTitle = $serviceTitle;

        return $this;
    }

    /**
     * Get serviceTitle
     *
     * @return string
     */
    public function getServiceTitle()
    {
        return $this->serviceTitle;
    }

    /**
     * Set meetingDescription
     *
     * @param string $meetingTitle
     * @return PressGuideTranslation
     */
    public function setMeetingDescription($meetingDescription)
    {
        $this->meetingDescription = $meetingDescription;

        return $this;
    }

    /**
     * Get meetingDescription
     *
     * @return string
     */
    public function getMeetingDescription()
    {
        return $this->meetingDescription;
    }

    /**
     * Set serviceDescription
     *
     * @param string $serviceDescription
     * @return PressGuideTranslation
     */
    public function setServiceDescription($serviceDescription)
    {
        $this->serviceDescription = $serviceDescription;

        return $this;
    }

    /**
     * Get serviceDescription
     *
     * @return string
     */
    public function getServiceDescription()
    {
        return $this->serviceDescription;
    }

    /**
     * Set serviceLabel
     *
     * @param string $serviceLabel
     * @return FDCPagePrepareTranslation
     */
    public function setServiceLabel($serviceLabel)
    {
        $this->serviceLabel = $serviceLabel;

        return $this;
    }

    /**
     * Get serviceLabel
     *
     * @return string
     */
    public function getServiceLabel()
    {
        return $this->serviceLabel;
    }

    /**
     * Set serviceUrl
     *
     * @param string $serviceUrl
     * @return FDCPagePrepareTranslation
     */
    public function setServiceUrl($serviceUrl)
    {
        $this->serviceUrl = $serviceUrl;

        return $this;
    }

    /**
     * Get serviceUrl
     *
     * @return string
     */
    public function getServiceUrl()
    {
        return $this->serviceUrl;
    }

    /**
     * Set meetingLabel
     *
     * @param string $meetingLabel
     * @return FDCPagePrepareTranslation
     */
    public function setMeetingLabel($meetingLabel)
    {
        $this->meetingLabel = $meetingLabel;

        return $this;
    }

    /**
     * Get meetingLabel
     *
     * @return string
     */
    public function getMeetingLabel()
    {
        return $this->meetingLabel;
    }

    /**
     * Set meetingUrl
     *
     * @param string $meetingUrl
     * @return FDCPagePrepareTranslation
     */
    public function setMeetingUrl($meetingUrl)
    {
        $this->meetingUrl = $meetingUrl;

        return $this;
    }

    /**
     * Get meetingUrl
     *
     * @return string
     */
    public function getMeetingUrl()
    {
        return $this->meetingUrl;
    }

    /**
     * Set mainTitle
     *
     * @param string $mainTitle
     * @return FDCPagePrepareTranslation
     */
    public function setMainTitle($mainTitle)
    {
        $this->mainTitle = $mainTitle;

        return $this;
    }

    /**
     * Get mainTitle
     *
     * @return string
     */
    public function getMainTitle()
    {
        return $this->mainTitle;
    }

    /**
     * Set mainDescription
     *
     * @param string $mainDescription
     * @return FDCPagePrepareTranslation
     */
    public function setMainDescription($mainDescription)
    {
        $this->mainDescription = $mainDescription;

        return $this;
    }

    /**
     * Get mainDescription
     *
     * @return string
     */
    public function getMainDescription()
    {
        return $this->mainDescription;
    }
}
