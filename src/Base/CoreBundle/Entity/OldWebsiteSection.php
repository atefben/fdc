<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldWebsiteSection
 *
 * @ORM\Table(name="old_website_section", indexes={@ORM\Index(name="relative_position", columns={"relative_position"}), @ORM\Index(name="child_of", columns={"child_of"}), @ORM\Index(name="main_menu", columns={"main_menu"}), @ORM\Index(name="is_online", columns={"is_online"}), @ORM\Index(name="pm_discrete_url", columns={"discrete_url"}), @ORM\Index(name="pm_name", columns={"name"})})
 * @ORM\Entity
 */
class OldWebsiteSection
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="relative_position", type="integer", nullable=true)
     */
    private $relativePosition;

    /**
     * @var integer
     *
     * @ORM\Column(name="child_of", type="integer", nullable=true)
     */
    private $childOf;

    /**
     * @var integer
     *
     * @ORM\Column(name="landing_page", type="integer", nullable=true)
     */
    private $landingPage;

    /**
     * @var boolean
     *
     * @ORM\Column(name="main_menu", type="boolean", nullable=true)
     */
    private $mainMenu;

    /**
     * @var string
     *
     * @ORM\Column(name="discrete_url", type="string", length=255, nullable=true)
     */
    private $discreteUrl;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_online", type="boolean", nullable=false)
     */
    private $isOnline;

    /**
     * @var boolean
     *
     * @ORM\Column(name="view_on_dashboard", type="boolean", nullable=false)
     */
    private $viewOnDashboard;

    /**
     * @var boolean
     *
     * @ORM\Column(name="pin_on_dashboard", type="boolean", nullable=false)
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return OldWebsiteSection
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set relativePosition
     *
     * @param integer $relativePosition
     * @return OldWebsiteSection
     */
    public function setRelativePosition($relativePosition)
    {
        $this->relativePosition = $relativePosition;

        return $this;
    }

    /**
     * Get relativePosition
     *
     * @return integer 
     */
    public function getRelativePosition()
    {
        return $this->relativePosition;
    }

    /**
     * Set childOf
     *
     * @param integer $childOf
     * @return OldWebsiteSection
     */
    public function setChildOf($childOf)
    {
        $this->childOf = $childOf;

        return $this;
    }

    /**
     * Get childOf
     *
     * @return integer 
     */
    public function getChildOf()
    {
        return $this->childOf;
    }

    /**
     * Set landingPage
     *
     * @param integer $landingPage
     * @return OldWebsiteSection
     */
    public function setLandingPage($landingPage)
    {
        $this->landingPage = $landingPage;

        return $this;
    }

    /**
     * Get landingPage
     *
     * @return integer 
     */
    public function getLandingPage()
    {
        return $this->landingPage;
    }

    /**
     * Set mainMenu
     *
     * @param boolean $mainMenu
     * @return OldWebsiteSection
     */
    public function setMainMenu($mainMenu)
    {
        $this->mainMenu = $mainMenu;

        return $this;
    }

    /**
     * Get mainMenu
     *
     * @return boolean 
     */
    public function getMainMenu()
    {
        return $this->mainMenu;
    }

    /**
     * Set discreteUrl
     *
     * @param string $discreteUrl
     * @return OldWebsiteSection
     */
    public function setDiscreteUrl($discreteUrl)
    {
        $this->discreteUrl = $discreteUrl;

        return $this;
    }

    /**
     * Get discreteUrl
     *
     * @return string 
     */
    public function getDiscreteUrl()
    {
        return $this->discreteUrl;
    }

    /**
     * Set isOnline
     *
     * @param boolean $isOnline
     * @return OldWebsiteSection
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
     * Set viewOnDashboard
     *
     * @param boolean $viewOnDashboard
     * @return OldWebsiteSection
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
     * @return OldWebsiteSection
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
     * Set dashboardPriority
     *
     * @param integer $dashboardPriority
     * @return OldWebsiteSection
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
     * @return OldWebsiteSection
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return OldWebsiteSection
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
     * @return OldWebsiteSection
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
}
