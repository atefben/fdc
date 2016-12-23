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
 * FDCPagePrepare
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\TranslationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class FDCPagePrepare implements TranslateMainInterface
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
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="guide_main_icon", type="string", length=122)
     */
    protected $mainIcon;

    /**
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    protected $mainImage;

    /**
     * @var string
     *
     * @ORM\Column(name="guide_arrive_icon", type="string", length=122)
     */
    protected $arriveIcon;

    /**
     * @var string
     *
     * @ORM\Column(name="arrive_display_instit", type="boolean")
     */
    protected $arriveDisplayInstit;

    /**
     * @var string
     *
     * @ORM\Column(name="meeting_display_instit", type="boolean")
     */
    protected $meetingDisplayInstit;


    /**
     * @var string
     *
     * @ORM\Column(name="information_display_instit", type="boolean")
     */
    protected $informationDisplayInstit;

    /**
     * @var string
     *
     * @ORM\Column(name="service_display_instit", type="boolean")
     */
    protected $serviceDisplayInstit;

    /**
     * @var FDCPagePrepareWidget
     *
     * @ORM\OneToMany(targetEntity="FDCPagePrepareWidget", mappedBy="FDCPagePrepareArrive", cascade={"persist", "remove"}, orphanRemoval=true)
     *
     */
    protected $arriveWidgets;

    /**
     * @var string
     *
     * @ORM\Column(name="guide_meeting_icon", type="string", length=122)
     */
    protected $meetingIcon;

    /**
     * @var FDCPagePrepareWidget
     *
     * @ORM\OneToMany(targetEntity="FDCPagePrepareWidget", mappedBy="FDCPagePrepareMeeting", cascade={"persist", "remove"}, orphanRemoval=true)
     *
     */
    protected $meetingWidgets;

    /**
     * @var string
     *
     * @ORM\Column(name="guide_information_icon", type="string", length=122)
     */
    protected $informationIcon;

    /**
     * @var FDCPagePrepareWidget
     *
     * @ORM\OneToMany(targetEntity="FDCPagePrepareWidget", mappedBy="FDCPagePrepareInformation", cascade={"persist", "remove"}, orphanRemoval=true)
     *
     */
    protected $informationWidgets;

    /**
     * @var string
     *
     * @ORM\Column(name="guide_service_icon", type="string", length=122)
     */
    protected $serviceIcon;

    /**
     * @var FDCPagePrepareWidget
     *
     * @ORM\OneToMany(targetEntity="FDCPagePrepareWidget", mappedBy="FDCPagePrepareService", cascade={"persist", "remove"}, orphanRemoval=true)
     *
     */
    protected $serviceWidgets;

    /**
     * @deprecated
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     */
    protected $meetingFile;

    /**
     * @ORM\ManyToOne(targetEntity="Base\CoreBundle\Entity\MediaPdf", cascade={"persist", "remove"})
     */
    protected $meetingPdf;

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

    public function __toString()
    {
        return 'Preparer son séjour';
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
     * @return FDCPagePrepare
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
     * @return FDCPagePrepare
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
     * @return FDCPagePrepare
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
     * @return FDCPagePrepare
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
     * @param \Base\CoreBundle\Entity\FDCPagePrepareWidget $arriveWidgets
     * @return FDCPagePrepare
     */
    public function addArriveWidget(\Base\CoreBundle\Entity\FDCPagePrepareWidget $arriveWidgets)
    {
        $arriveWidgets->setFDCPagePrepareArrive($this);
        $this->arriveWidgets->add($arriveWidgets);
    }

    /**
     * Remove arriveWidgets
     *
     * @param \Base\CoreBundle\Entity\FDCPagePrepareWidget $arriveWidgets
     */
    public function removeArriveWidget(\Base\CoreBundle\Entity\FDCPagePrepareWidget $arriveWidgets)
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
     * @param \Base\CoreBundle\Entity\FDCPagePrepareWidget $meetingWidgets
     * @return FDCPagePrepare
     */
    public function addMeetingWidget(\Base\CoreBundle\Entity\FDCPagePrepareWidget $meetingWidgets)
    {
        $meetingWidgets->setFDCPagePrepareMeeting($this);
        $this->meetingWidgets->add($meetingWidgets);
    }

    /**
     * Remove meetingWidgets
     *
     * @param \Base\CoreBundle\Entity\FDCPagePrepareWidget $meetingWidgets
     */
    public function removeMeetingWidget(\Base\CoreBundle\Entity\FDCPagePrepareWidget $meetingWidgets)
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
     * @param \Base\CoreBundle\Entity\FDCPagePrepareWidget $informationWidgets
     * @return FDCPagePrepare
     */
    public function addInformationWidget(\Base\CoreBundle\Entity\FDCPagePrepareWidget $informationWidgets)
    {
        $informationWidgets->setFDCPagePrepareInformation($this);
        $this->informationWidgets->add($informationWidgets);
    }

    /**
     * Remove informationWidgets
     *
     * @param \Base\CoreBundle\Entity\FDCPagePrepareWidget $informationWidgets
     */
    public function removeInformationWidget(\Base\CoreBundle\Entity\FDCPagePrepareWidget $informationWidgets)
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
     * @param \Base\CoreBundle\Entity\FDCPagePrepareWidget $serviceWidgets
     * @return FDCPagePrepare
     */
    public function addServiceWidget(\Base\CoreBundle\Entity\FDCPagePrepareWidget $serviceWidgets)
    {
        $serviceWidgets->setFDCPagePrepareService($this);
        $this->serviceWidgets->add($serviceWidgets);
    }

    /**
     * Remove serviceWidgets
     *
     * @param \Base\CoreBundle\Entity\FDCPagePrepareWidget $serviceWidgets
     */
    public function removeServiceWidget(\Base\CoreBundle\Entity\FDCPagePrepareWidget $serviceWidgets)
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

    /**
     * Set file
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $meetingFile
     * @return PressDownloadSectionWidgetDocument
     */
    public function setMeetingFile(\Application\Sonata\MediaBundle\Entity\Media $meetingFile = null)
    {
        $this->meetingFile = $meetingFile;
        return $this;
    }

    /**
     * Get file
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getMeetingFile()
    {
        return $this->meetingFile;
    }

    /**
     * Set mainIcon
     *
     * @param string $mainIcon
     * @return FDCPagePrepare
     */
    public function setMainIcon($mainIcon)
    {
        $this->mainIcon = $mainIcon;

        return $this;
    }

    /**
     * Get mainIcon
     *
     * @return string
     */
    public function getMainIcon()
    {
        return $this->mainIcon;
    }


    /**
     * Set mainImage
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $mainImage
     * @return FDCPagePrepare
     */
    public function setMainImage(\Base\CoreBundle\Entity\MediaImageSimple $mainImage = null)
    {
        $this->mainImage = $mainImage;

        return $this;
    }

    /**
     * Get mainImage
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple 
     */
    public function getMainImage()
    {
        return $this->mainImage;
    }

    /**
     * Set meetingPdf
     *
     * @param \Base\CoreBundle\Entity\MediaPdf $meetingPdf
     * @return FDCPagePrepare
     */
    public function setMeetingPdf(\Base\CoreBundle\Entity\MediaPdf $meetingPdf = null)
    {
        $this->meetingPdf = $meetingPdf;

        return $this;
    }

    /**
     * Get meetingPdf
     *
     * @return \Base\CoreBundle\Entity\MediaPdf 
     */
    public function getMeetingPdf()
    {
        return $this->meetingPdf;
    }

    /**
     * Set arriveDisplayInstit
     *
     * @param boolean $arriveDisplayInstit
     * @return FDCPagePrepare
     */
    public function setArriveDisplayInstit($arriveDisplayInstit)
    {
        $this->arriveDisplayInstit = $arriveDisplayInstit;

        return $this;
    }

    /**
     * Get arriveDisplayInstit
     *
     * @return boolean 
     */
    public function getArriveDisplayInstit()
    {
        return $this->arriveDisplayInstit;
    }

    /**
     * Set meetingDisplayInstit
     *
     * @param boolean $meetingDisplayInstit
     * @return FDCPagePrepare
     */
    public function setMeetingDisplayInstit($meetingDisplayInstit)
    {
        $this->meetingDisplayInstit = $meetingDisplayInstit;

        return $this;
    }

    /**
     * Get meetingDisplayInstit
     *
     * @return boolean 
     */
    public function getMeetingDisplayInstit()
    {
        return $this->meetingDisplayInstit;
    }

    /**
     * Set informationDisplayInstit
     *
     * @param boolean $informationDisplayInstit
     * @return FDCPagePrepare
     */
    public function setInformationDisplayInstit($informationDisplayInstit)
    {
        $this->informationDisplayInstit = $informationDisplayInstit;

        return $this;
    }

    /**
     * Get informationDisplayInstit
     *
     * @return boolean 
     */
    public function getInformationDisplayInstit()
    {
        return $this->informationDisplayInstit;
    }

    /**
     * Set serviceDisplayInstit
     *
     * @param boolean $serviceDisplayInstit
     * @return FDCPagePrepare
     */
    public function setServiceDisplayInstit($serviceDisplayInstit)
    {
        $this->serviceDisplayInstit = $serviceDisplayInstit;

        return $this;
    }

    /**
     * Get serviceDisplayInstit
     *
     * @return boolean 
     */
    public function getServiceDisplayInstit()
    {
        return $this->serviceDisplayInstit;
    }
}
