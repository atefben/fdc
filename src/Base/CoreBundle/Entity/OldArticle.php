<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldArticle
 *
 * @ORM\Table(name="old_article", indexes={@ORM\Index(name="article_type_id", columns={"article_type_id"}), @ORM\Index(name="start_date", columns={"start_date"}), @ORM\Index(name="end_date", columns={"end_date"}), @ORM\Index(name="isHomePage", columns={"isHomePage"}), @ORM\Index(name="isNewsLetter", columns={"isNewsLetter"}), @ORM\Index(name="home_priority", columns={"home_priority"}), @ORM\Index(name="home_end_pub_date", columns={"home_end_pub_date"}), @ORM\Index(name="priority", columns={"priority"}), @ORM\Index(name="website_section_id", columns={"website_section_id"}), @ORM\Index(name="is_online", columns={"is_online"})})
 * @ORM\Entity
 */
class OldArticle
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="article_type_id", type="integer", nullable=false)
     */
    private $articleTypeId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="created_at_time", type="string", length=6, nullable=false)
     */
    private $createdAtTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="published", type="integer", nullable=true)
     */
    private $published;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="datetime", nullable=true)
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date", type="datetime", nullable=true)
     */
    private $endDate;

    /**
     * @var string
     *
     * @ORM\Column(name="created_by", type="string", length=255, nullable=true)
     */
    private $createdBy;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isNewsLetter", type="boolean", nullable=true)
     */
    private $isnewsletter;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isHomePage", type="boolean", nullable=true)
     */
    private $ishomepage;

    /**
     * @var boolean
     *
     * @ORM\Column(name="home_priority", type="boolean", nullable=false)
     */
    private $homePriority;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="home_end_pub_date", type="datetime", nullable=true)
     */
    private $homeEndPubDate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="resume_parent_visibility", type="boolean", nullable=false)
     */
    private $resumeParentVisibility;

    /**
     * @var string
     *
     * @ORM\Column(name="imageLogo", type="string", length=250, nullable=true)
     */
    private $imagelogo;

    /**
     * @var string
     *
     * @ORM\Column(name="image_top_home", type="string", length=256, nullable=true)
     */
    private $imageTopHome;

    /**
     * @var string
     *
     * @ORM\Column(name="image_top_home_copyright", type="string", length=256, nullable=true)
     */
    private $imageTopHomeCopyright;

    /**
     * @var integer
     *
     * @ORM\Column(name="priority", type="integer", nullable=true)
     */
    private $priority;

    /**
     * @var string
     *
     * @ORM\Column(name="template_name", type="string", length=255, nullable=true)
     */
    private $templateName;

    /**
     * @var boolean
     *
     * @ORM\Column(name="list_shape_id", type="boolean", nullable=true)
     */
    private $listShapeId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="page_shape_id", type="boolean", nullable=true)
     */
    private $pageShapeId;

    /**
     * @var integer
     *
     * @ORM\Column(name="website_section_id", type="integer", nullable=true)
     */
    private $websiteSectionId;

    /**
     * @var integer
     *
     * @ORM\Column(name="is_online", type="smallint", nullable=false)
     */
    private $isOnline;

    /**
     * @var integer
     *
     * @ORM\Column(name="isMosaique", type="integer", nullable=false)
     */
    private $ismosaique;

    /**
     * @var integer
     *
     * @ORM\Column(name="mosaique_priority", type="integer", nullable=false)
     */
    private $mosaiquePriority;

    /**
     * @var boolean
     *
     * @ORM\Column(name="mosaique_picto", type="boolean", nullable=true)
     */
    private $mosaiquePicto;

    /**
     * @var integer
     *
     * @ORM\Column(name="view_on_dashboard", type="integer", nullable=false)
     */
    private $viewOnDashboard;

    /**
     * @var string
     *
     * @ORM\Column(name="temporary_link", type="string", length=255, nullable=true)
     */
    private $temporaryLink;

    /**
     * @var integer
     *
     * @ORM\Column(name="pin_on_dashboard", type="integer", nullable=false)
     */
    private $pinOnDashboard;

    /**
     * @var integer
     *
     * @ORM\Column(name="dashboard_priority", type="integer", nullable=false)
     */
    private $dashboardPriority;

    /**
     * @var integer
     *
     * @ORM\Column(name="translation_status", type="integer", nullable=false)
     */
    private $translationStatus;

    /**
     * @var boolean
     *
     * @ORM\Column(name="publish_to_mobile", type="boolean", nullable=false)
     */
    private $publishToMobile;

    /**
     * @var boolean
     *
     * @ORM\Column(name="emphasis_on_mobile", type="boolean", nullable=false)
     */
    private $emphasisOnMobile;

    /**
     * @var boolean
     *
     * @ORM\Column(name="push_state_iphone", type="boolean", nullable=false)
     */
    private $pushStateIphone;

    /**
     * @var boolean
     *
     * @ORM\Column(name="push_state_android", type="boolean", nullable=false)
     */
    private $pushStateAndroid;

    /**
     * @var boolean
     *
     * @ORM\Column(name="publish_to_wall", type="boolean", nullable=false)
     */
    private $publishToWall;

    /**
     * @var boolean
     *
     * @ORM\Column(name="push_to_quotidien", type="boolean", nullable=false)
     */
    private $pushToQuotidien;

    /**
     * @var boolean
     *
     * @ORM\Column(name="publish_to_cinema", type="boolean", nullable=false)
     */
    private $publishToCinema;

    /**
     * @var boolean
     *
     * @ORM\Column(name="display_as_portfolio", type="boolean", nullable=false)
     */
    private $displayAsPortfolio;



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
     * Set articleTypeId
     *
     * @param integer $articleTypeId
     * @return OldArticle
     */
    public function setArticleTypeId($articleTypeId)
    {
        $this->articleTypeId = $articleTypeId;

        return $this;
    }

    /**
     * Get articleTypeId
     *
     * @return integer 
     */
    public function getArticleTypeId()
    {
        return $this->articleTypeId;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return OldArticle
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
     * @return OldArticle
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
     * Set createdAtTime
     *
     * @param string $createdAtTime
     * @return OldArticle
     */
    public function setCreatedAtTime($createdAtTime)
    {
        $this->createdAtTime = $createdAtTime;

        return $this;
    }

    /**
     * Get createdAtTime
     *
     * @return string 
     */
    public function getCreatedAtTime()
    {
        return $this->createdAtTime;
    }

    /**
     * Set published
     *
     * @param integer $published
     * @return OldArticle
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
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return OldArticle
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
     * @return OldArticle
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
     * Set createdBy
     *
     * @param string $createdBy
     * @return OldArticle
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
     * Set isnewsletter
     *
     * @param boolean $isnewsletter
     * @return OldArticle
     */
    public function setIsnewsletter($isnewsletter)
    {
        $this->isnewsletter = $isnewsletter;

        return $this;
    }

    /**
     * Get isnewsletter
     *
     * @return boolean 
     */
    public function getIsnewsletter()
    {
        return $this->isnewsletter;
    }

    /**
     * Set ishomepage
     *
     * @param boolean $ishomepage
     * @return OldArticle
     */
    public function setIshomepage($ishomepage)
    {
        $this->ishomepage = $ishomepage;

        return $this;
    }

    /**
     * Get ishomepage
     *
     * @return boolean 
     */
    public function getIshomepage()
    {
        return $this->ishomepage;
    }

    /**
     * Set homePriority
     *
     * @param boolean $homePriority
     * @return OldArticle
     */
    public function setHomePriority($homePriority)
    {
        $this->homePriority = $homePriority;

        return $this;
    }

    /**
     * Get homePriority
     *
     * @return boolean 
     */
    public function getHomePriority()
    {
        return $this->homePriority;
    }

    /**
     * Set homeEndPubDate
     *
     * @param \DateTime $homeEndPubDate
     * @return OldArticle
     */
    public function setHomeEndPubDate($homeEndPubDate)
    {
        $this->homeEndPubDate = $homeEndPubDate;

        return $this;
    }

    /**
     * Get homeEndPubDate
     *
     * @return \DateTime 
     */
    public function getHomeEndPubDate()
    {
        return $this->homeEndPubDate;
    }

    /**
     * Set resumeParentVisibility
     *
     * @param boolean $resumeParentVisibility
     * @return OldArticle
     */
    public function setResumeParentVisibility($resumeParentVisibility)
    {
        $this->resumeParentVisibility = $resumeParentVisibility;

        return $this;
    }

    /**
     * Get resumeParentVisibility
     *
     * @return boolean 
     */
    public function getResumeParentVisibility()
    {
        return $this->resumeParentVisibility;
    }

    /**
     * Set imagelogo
     *
     * @param string $imagelogo
     * @return OldArticle
     */
    public function setImagelogo($imagelogo)
    {
        $this->imagelogo = $imagelogo;

        return $this;
    }

    /**
     * Get imagelogo
     *
     * @return string 
     */
    public function getImagelogo()
    {
        return $this->imagelogo;
    }

    /**
     * Set imageTopHome
     *
     * @param string $imageTopHome
     * @return OldArticle
     */
    public function setImageTopHome($imageTopHome)
    {
        $this->imageTopHome = $imageTopHome;

        return $this;
    }

    /**
     * Get imageTopHome
     *
     * @return string 
     */
    public function getImageTopHome()
    {
        return $this->imageTopHome;
    }

    /**
     * Set imageTopHomeCopyright
     *
     * @param string $imageTopHomeCopyright
     * @return OldArticle
     */
    public function setImageTopHomeCopyright($imageTopHomeCopyright)
    {
        $this->imageTopHomeCopyright = $imageTopHomeCopyright;

        return $this;
    }

    /**
     * Get imageTopHomeCopyright
     *
     * @return string 
     */
    public function getImageTopHomeCopyright()
    {
        return $this->imageTopHomeCopyright;
    }

    /**
     * Set priority
     *
     * @param integer $priority
     * @return OldArticle
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer 
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set templateName
     *
     * @param string $templateName
     * @return OldArticle
     */
    public function setTemplateName($templateName)
    {
        $this->templateName = $templateName;

        return $this;
    }

    /**
     * Get templateName
     *
     * @return string 
     */
    public function getTemplateName()
    {
        return $this->templateName;
    }

    /**
     * Set listShapeId
     *
     * @param boolean $listShapeId
     * @return OldArticle
     */
    public function setListShapeId($listShapeId)
    {
        $this->listShapeId = $listShapeId;

        return $this;
    }

    /**
     * Get listShapeId
     *
     * @return boolean 
     */
    public function getListShapeId()
    {
        return $this->listShapeId;
    }

    /**
     * Set pageShapeId
     *
     * @param boolean $pageShapeId
     * @return OldArticle
     */
    public function setPageShapeId($pageShapeId)
    {
        $this->pageShapeId = $pageShapeId;

        return $this;
    }

    /**
     * Get pageShapeId
     *
     * @return boolean 
     */
    public function getPageShapeId()
    {
        return $this->pageShapeId;
    }

    /**
     * Set websiteSectionId
     *
     * @param integer $websiteSectionId
     * @return OldArticle
     */
    public function setWebsiteSectionId($websiteSectionId)
    {
        $this->websiteSectionId = $websiteSectionId;

        return $this;
    }

    /**
     * Get websiteSectionId
     *
     * @return integer 
     */
    public function getWebsiteSectionId()
    {
        return $this->websiteSectionId;
    }

    /**
     * Set isOnline
     *
     * @param integer $isOnline
     * @return OldArticle
     */
    public function setIsOnline($isOnline)
    {
        $this->isOnline = $isOnline;

        return $this;
    }

    /**
     * Get isOnline
     *
     * @return integer 
     */
    public function getIsOnline()
    {
        return $this->isOnline;
    }

    /**
     * Set ismosaique
     *
     * @param integer $ismosaique
     * @return OldArticle
     */
    public function setIsmosaique($ismosaique)
    {
        $this->ismosaique = $ismosaique;

        return $this;
    }

    /**
     * Get ismosaique
     *
     * @return integer 
     */
    public function getIsmosaique()
    {
        return $this->ismosaique;
    }

    /**
     * Set mosaiquePriority
     *
     * @param integer $mosaiquePriority
     * @return OldArticle
     */
    public function setMosaiquePriority($mosaiquePriority)
    {
        $this->mosaiquePriority = $mosaiquePriority;

        return $this;
    }

    /**
     * Get mosaiquePriority
     *
     * @return integer 
     */
    public function getMosaiquePriority()
    {
        return $this->mosaiquePriority;
    }

    /**
     * Set mosaiquePicto
     *
     * @param boolean $mosaiquePicto
     * @return OldArticle
     */
    public function setMosaiquePicto($mosaiquePicto)
    {
        $this->mosaiquePicto = $mosaiquePicto;

        return $this;
    }

    /**
     * Get mosaiquePicto
     *
     * @return boolean 
     */
    public function getMosaiquePicto()
    {
        return $this->mosaiquePicto;
    }

    /**
     * Set viewOnDashboard
     *
     * @param integer $viewOnDashboard
     * @return OldArticle
     */
    public function setViewOnDashboard($viewOnDashboard)
    {
        $this->viewOnDashboard = $viewOnDashboard;

        return $this;
    }

    /**
     * Get viewOnDashboard
     *
     * @return integer 
     */
    public function getViewOnDashboard()
    {
        return $this->viewOnDashboard;
    }

    /**
     * Set temporaryLink
     *
     * @param string $temporaryLink
     * @return OldArticle
     */
    public function setTemporaryLink($temporaryLink)
    {
        $this->temporaryLink = $temporaryLink;

        return $this;
    }

    /**
     * Get temporaryLink
     *
     * @return string 
     */
    public function getTemporaryLink()
    {
        return $this->temporaryLink;
    }

    /**
     * Set pinOnDashboard
     *
     * @param integer $pinOnDashboard
     * @return OldArticle
     */
    public function setPinOnDashboard($pinOnDashboard)
    {
        $this->pinOnDashboard = $pinOnDashboard;

        return $this;
    }

    /**
     * Get pinOnDashboard
     *
     * @return integer 
     */
    public function getPinOnDashboard()
    {
        return $this->pinOnDashboard;
    }

    /**
     * Set dashboardPriority
     *
     * @param integer $dashboardPriority
     * @return OldArticle
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
     * @return OldArticle
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
     * @return OldArticle
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
     * Set emphasisOnMobile
     *
     * @param boolean $emphasisOnMobile
     * @return OldArticle
     */
    public function setEmphasisOnMobile($emphasisOnMobile)
    {
        $this->emphasisOnMobile = $emphasisOnMobile;

        return $this;
    }

    /**
     * Get emphasisOnMobile
     *
     * @return boolean 
     */
    public function getEmphasisOnMobile()
    {
        return $this->emphasisOnMobile;
    }

    /**
     * Set pushStateIphone
     *
     * @param boolean $pushStateIphone
     * @return OldArticle
     */
    public function setPushStateIphone($pushStateIphone)
    {
        $this->pushStateIphone = $pushStateIphone;

        return $this;
    }

    /**
     * Get pushStateIphone
     *
     * @return boolean 
     */
    public function getPushStateIphone()
    {
        return $this->pushStateIphone;
    }

    /**
     * Set pushStateAndroid
     *
     * @param boolean $pushStateAndroid
     * @return OldArticle
     */
    public function setPushStateAndroid($pushStateAndroid)
    {
        $this->pushStateAndroid = $pushStateAndroid;

        return $this;
    }

    /**
     * Get pushStateAndroid
     *
     * @return boolean 
     */
    public function getPushStateAndroid()
    {
        return $this->pushStateAndroid;
    }

    /**
     * Set publishToWall
     *
     * @param boolean $publishToWall
     * @return OldArticle
     */
    public function setPublishToWall($publishToWall)
    {
        $this->publishToWall = $publishToWall;

        return $this;
    }

    /**
     * Get publishToWall
     *
     * @return boolean 
     */
    public function getPublishToWall()
    {
        return $this->publishToWall;
    }

    /**
     * Set pushToQuotidien
     *
     * @param boolean $pushToQuotidien
     * @return OldArticle
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
     * Set publishToCinema
     *
     * @param boolean $publishToCinema
     * @return OldArticle
     */
    public function setPublishToCinema($publishToCinema)
    {
        $this->publishToCinema = $publishToCinema;

        return $this;
    }

    /**
     * Get publishToCinema
     *
     * @return boolean 
     */
    public function getPublishToCinema()
    {
        return $this->publishToCinema;
    }

    /**
     * Set displayAsPortfolio
     *
     * @param boolean $displayAsPortfolio
     * @return OldArticle
     */
    public function setDisplayAsPortfolio($displayAsPortfolio)
    {
        $this->displayAsPortfolio = $displayAsPortfolio;

        return $this;
    }

    /**
     * Get displayAsPortfolio
     *
     * @return boolean 
     */
    public function getDisplayAsPortfolio()
    {
        return $this->displayAsPortfolio;
    }
}
