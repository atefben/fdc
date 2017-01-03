<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldMedia
 *
 * @ORM\Table(name="old_media", indexes={@ORM\Index(name="file_class", columns={"file_class"}), @ORM\Index(name="publish_for", columns={"publish_for"}), @ORM\Index(name="published", columns={"published"}), @ORM\Index(name="language", columns={"language"}), @ORM\Index(name="media_FK_1", columns={"event_type_id"})})
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\OldMediaRepository")
 */
class OldMedia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="file_class", type="integer", nullable=true)
     */
    protected $fileClass;

    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=255, nullable=true)
     */
    protected $filename;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    protected $updatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publish_for", type="datetime", nullable=false)
     */
    protected $publishFor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="datetime", nullable=true)
     */
    protected $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date", type="datetime", nullable=true)
     */
    protected $endDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="hour_order", type="integer", nullable=false)
     */
    protected $hourOrder;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_online", type="boolean", nullable=false)
     */
    protected $isOnline;

    /**
     * @var string
     *
     * @ORM\Column(name="created_by", type="string", length=255, nullable=false)
     */
    protected $createdBy;

    /**
     * @var boolean
     *
     * @ORM\Column(name="hasThumbnail", type="boolean", nullable=true)
     */
    protected $hasthumbnail;

    /**
     * @var integer
     *
     * @ORM\Column(name="published", type="integer", nullable=true)
     */
    protected $published;

    /**
     * @var string
     *
     * @ORM\Column(name="language", type="string", length=10, nullable=true)
     */
    protected $language;

    /**
     * @var string
     *
     * @ORM\Column(name="extension", type="string", length=10, nullable=true)
     */
    protected $extension;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ispodcast", type="boolean", nullable=true)
     */
    protected $ispodcast;

    /**
     * @var boolean
     *
     * @ORM\Column(name="view_on_dashboard", type="boolean", nullable=true)
     */
    protected $viewOnDashboard;

    /**
     * @var boolean
     *
     * @ORM\Column(name="pin_on_dashboard", type="boolean", nullable=true)
     */
    protected $pinOnDashboard;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_smil", type="boolean", nullable=true)
     */
    protected $isSmil;

    /**
     * @var integer
     *
     * @ORM\Column(name="video_type", type="integer", nullable=true)
     */
    protected $videoType;

    /**
     * @var integer
     *
     * @ORM\Column(name="quality", type="integer", nullable=true)
     */
    protected $quality;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_download", type="boolean", nullable=true)
     */
    protected $isDownload;

    /**
     * @var integer
     *
     * @ORM\Column(name="profile", type="integer", nullable=true)
     */
    protected $profile;

    /**
     * @var integer
     *
     * @ORM\Column(name="dashboard_priority", type="integer", nullable=false)
     */
    protected $dashboardPriority;

    /**
     * @var integer
     *
     * @ORM\Column(name="translation_status", type="integer", nullable=false)
     */
    protected $translationStatus;

    /**
     * @var boolean
     *
     * @ORM\Column(name="publish_to_mobile", type="boolean", nullable=false)
     */
    protected $publishToMobile;

    /**
     * @var boolean
     *
     * @ORM\Column(name="royalty_free_image", type="boolean", nullable=false)
     */
    protected $royaltyFreeImage;

    /**
     * @var integer
     *
     * @ORM\Column(name="event_type_id", type="integer", nullable=true)
     */
    protected $eventTypeId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="push_to_quotidien", type="boolean", nullable=false)
     */
    protected $pushToQuotidien;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_locked", type="boolean", nullable=false)
     */
    protected $isLocked;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_pro", type="boolean", nullable=false)
     */
    protected $isPro;

    /**
     * @var boolean
     *
     * @ORM\Column(name="interview", type="boolean", nullable=false)
     */
    protected $interview;

    /**
     * @var boolean
     *
     * @ORM\Column(name="show_on_filmfiles", type="boolean", nullable=false)
     */
    protected $showOnFilmfiles;

    /**
     * @var boolean
     *
     * @ORM\Column(name="prehome_app", type="boolean", nullable=false)
     */
    protected $prehomeApp;



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
     * Set fileClass
     *
     * @param integer $fileClass
     * @return OldMedia
     */
    public function setFileClass($fileClass)
    {
        $this->fileClass = $fileClass;

        return $this;
    }

    /**
     * Get fileClass
     *
     * @return integer 
     */
    public function getFileClass()
    {
        return $this->fileClass;
    }

    /**
     * Set filename
     *
     * @param string $filename
     * @return OldMedia
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string 
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return OldMedia
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return OldMedia
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set publishFor
     *
     * @param \DateTime $publishFor
     * @return OldMedia
     */
    public function setPublishFor($publishFor)
    {
        $this->publishFor = $publishFor;

        return $this;
    }

    /**
     * Get publishFor
     *
     * @return \DateTime 
     */
    public function getPublishFor()
    {
        return $this->publishFor;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return OldMedia
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return OldMedia
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime 
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set hourOrder
     *
     * @param integer $hourOrder
     * @return OldMedia
     */
    public function setHourOrder($hourOrder)
    {
        $this->hourOrder = $hourOrder;

        return $this;
    }

    /**
     * Get hourOrder
     *
     * @return integer 
     */
    public function getHourOrder()
    {
        return $this->hourOrder;
    }

    /**
     * Set isOnline
     *
     * @param boolean $isOnline
     * @return OldMedia
     */
    public function setIsOnline($isOnline)
    {
        $this->isOnline = $isOnline;

        return $this;
    }

    /**
     * Get isOnline
     *
     * @return boolean 
     */
    public function getIsOnline()
    {
        return $this->isOnline;
    }

    /**
     * Set createdBy
     *
     * @param string $createdBy
     * @return OldMedia
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return string 
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set hasthumbnail
     *
     * @param boolean $hasthumbnail
     * @return OldMedia
     */
    public function setHasthumbnail($hasthumbnail)
    {
        $this->hasthumbnail = $hasthumbnail;

        return $this;
    }

    /**
     * Get hasthumbnail
     *
     * @return boolean 
     */
    public function getHasthumbnail()
    {
        return $this->hasthumbnail;
    }

    /**
     * Set published
     *
     * @param integer $published
     * @return OldMedia
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return integer 
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set language
     *
     * @param string $language
     * @return OldMedia
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return string 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set extension
     *
     * @param string $extension
     * @return OldMedia
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Get extension
     *
     * @return string 
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Set ispodcast
     *
     * @param boolean $ispodcast
     * @return OldMedia
     */
    public function setIspodcast($ispodcast)
    {
        $this->ispodcast = $ispodcast;

        return $this;
    }

    /**
     * Get ispodcast
     *
     * @return boolean 
     */
    public function getIspodcast()
    {
        return $this->ispodcast;
    }

    /**
     * Set viewOnDashboard
     *
     * @param boolean $viewOnDashboard
     * @return OldMedia
     */
    public function setViewOnDashboard($viewOnDashboard)
    {
        $this->viewOnDashboard = $viewOnDashboard;

        return $this;
    }

    /**
     * Get viewOnDashboard
     *
     * @return boolean 
     */
    public function getViewOnDashboard()
    {
        return $this->viewOnDashboard;
    }

    /**
     * Set pinOnDashboard
     *
     * @param boolean $pinOnDashboard
     * @return OldMedia
     */
    public function setPinOnDashboard($pinOnDashboard)
    {
        $this->pinOnDashboard = $pinOnDashboard;

        return $this;
    }

    /**
     * Get pinOnDashboard
     *
     * @return boolean 
     */
    public function getPinOnDashboard()
    {
        return $this->pinOnDashboard;
    }

    /**
     * Set isSmil
     *
     * @param boolean $isSmil
     * @return OldMedia
     */
    public function setIsSmil($isSmil)
    {
        $this->isSmil = $isSmil;

        return $this;
    }

    /**
     * Get isSmil
     *
     * @return boolean 
     */
    public function getIsSmil()
    {
        return $this->isSmil;
    }

    /**
     * Set videoType
     *
     * @param integer $videoType
     * @return OldMedia
     */
    public function setVideoType($videoType)
    {
        $this->videoType = $videoType;

        return $this;
    }

    /**
     * Get videoType
     *
     * @return integer 
     */
    public function getVideoType()
    {
        return $this->videoType;
    }

    /**
     * Set quality
     *
     * @param integer $quality
     * @return OldMedia
     */
    public function setQuality($quality)
    {
        $this->quality = $quality;

        return $this;
    }

    /**
     * Get quality
     *
     * @return integer 
     */
    public function getQuality()
    {
        return $this->quality;
    }

    /**
     * Set isDownload
     *
     * @param boolean $isDownload
     * @return OldMedia
     */
    public function setIsDownload($isDownload)
    {
        $this->isDownload = $isDownload;

        return $this;
    }

    /**
     * Get isDownload
     *
     * @return boolean 
     */
    public function getIsDownload()
    {
        return $this->isDownload;
    }

    /**
     * Set profile
     *
     * @param integer $profile
     * @return OldMedia
     */
    public function setProfile($profile)
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * Get profile
     *
     * @return integer 
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * Set dashboardPriority
     *
     * @param integer $dashboardPriority
     * @return OldMedia
     */
    public function setDashboardPriority($dashboardPriority)
    {
        $this->dashboardPriority = $dashboardPriority;

        return $this;
    }

    /**
     * Get dashboardPriority
     *
     * @return integer 
     */
    public function getDashboardPriority()
    {
        return $this->dashboardPriority;
    }

    /**
     * Set translationStatus
     *
     * @param integer $translationStatus
     * @return OldMedia
     */
    public function setTranslationStatus($translationStatus)
    {
        $this->translationStatus = $translationStatus;

        return $this;
    }

    /**
     * Get translationStatus
     *
     * @return integer 
     */
    public function getTranslationStatus()
    {
        return $this->translationStatus;
    }

    /**
     * Set publishToMobile
     *
     * @param boolean $publishToMobile
     * @return OldMedia
     */
    public function setPublishToMobile($publishToMobile)
    {
        $this->publishToMobile = $publishToMobile;

        return $this;
    }

    /**
     * Get publishToMobile
     *
     * @return boolean 
     */
    public function getPublishToMobile()
    {
        return $this->publishToMobile;
    }

    /**
     * Set royaltyFreeImage
     *
     * @param boolean $royaltyFreeImage
     * @return OldMedia
     */
    public function setRoyaltyFreeImage($royaltyFreeImage)
    {
        $this->royaltyFreeImage = $royaltyFreeImage;

        return $this;
    }

    /**
     * Get royaltyFreeImage
     *
     * @return boolean 
     */
    public function getRoyaltyFreeImage()
    {
        return $this->royaltyFreeImage;
    }

    /**
     * Set eventTypeId
     *
     * @param integer $eventTypeId
     * @return OldMedia
     */
    public function setEventTypeId($eventTypeId)
    {
        $this->eventTypeId = $eventTypeId;

        return $this;
    }

    /**
     * Get eventTypeId
     *
     * @return integer 
     */
    public function getEventTypeId()
    {
        return $this->eventTypeId;
    }

    /**
     * Set pushToQuotidien
     *
     * @param boolean $pushToQuotidien
     * @return OldMedia
     */
    public function setPushToQuotidien($pushToQuotidien)
    {
        $this->pushToQuotidien = $pushToQuotidien;

        return $this;
    }

    /**
     * Get pushToQuotidien
     *
     * @return boolean 
     */
    public function getPushToQuotidien()
    {
        return $this->pushToQuotidien;
    }

    /**
     * Set isLocked
     *
     * @param boolean $isLocked
     * @return OldMedia
     */
    public function setIsLocked($isLocked)
    {
        $this->isLocked = $isLocked;

        return $this;
    }

    /**
     * Get isLocked
     *
     * @return boolean 
     */
    public function getIsLocked()
    {
        return $this->isLocked;
    }

    /**
     * Set isPro
     *
     * @param boolean $isPro
     * @return OldMedia
     */
    public function setIsPro($isPro)
    {
        $this->isPro = $isPro;

        return $this;
    }

    /**
     * Get isPro
     *
     * @return boolean 
     */
    public function getIsPro()
    {
        return $this->isPro;
    }

    /**
     * Set interview
     *
     * @param boolean $interview
     * @return OldMedia
     */
    public function setInterview($interview)
    {
        $this->interview = $interview;

        return $this;
    }

    /**
     * Get interview
     *
     * @return boolean 
     */
    public function getInterview()
    {
        return $this->interview;
    }

    /**
     * Set showOnFilmfiles
     *
     * @param boolean $showOnFilmfiles
     * @return OldMedia
     */
    public function setShowOnFilmfiles($showOnFilmfiles)
    {
        $this->showOnFilmfiles = $showOnFilmfiles;

        return $this;
    }

    /**
     * Get showOnFilmfiles
     *
     * @return boolean 
     */
    public function getShowOnFilmfiles()
    {
        return $this->showOnFilmfiles;
    }

    /**
     * Set prehomeApp
     *
     * @param boolean $prehomeApp
     * @return OldMedia
     */
    public function setPrehomeApp($prehomeApp)
    {
        $this->prehomeApp = $prehomeApp;

        return $this;
    }

    /**
     * Get prehomeApp
     *
     * @return boolean 
     */
    public function getPrehomeApp()
    {
        return $this->prehomeApp;
    }
}
