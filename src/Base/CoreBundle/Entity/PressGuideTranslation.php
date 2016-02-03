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
 * PressGuideTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PressGuideTranslation implements TranslateChildInterface
{
    use TranslateChild;
    use Time;
    use Translation;
    use Seo;

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
}
