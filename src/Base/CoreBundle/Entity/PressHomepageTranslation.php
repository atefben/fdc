<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Time;

/**
 * PressHomepageTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PressHomepageTranslation
{
    use Time;
    use Translation;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="section_statement_info_title", type="string", length=255)
     */
    protected $sectionStatementInfoTitle;

    /**
     * @var boolean
     *
     * @ORM\Column(name="section_statement_info_display", type="boolean")
     */
    protected $sectionStatementInfoDisplay;

    /**
     * @var string
     *
     * @ORM\Column(name="section_scheduling_title", type="string", length=255)
     */
    protected $sectionSchedulingTitle;

    /**
     * @var boolean
     *
     * @ORM\Column(name="section_scheduling_display", type="boolean")
     */
    protected $sectionSchedulingDisplay;

    /**
     * @var string
     *
     * @ORM\Column(name="section_media_title", type="string", length=255)
     */
    protected $sectionMediaTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="section_media_subtitle", type="string", length=255)
     */
    protected $sectionMediaSubtitle;

    /**
     * @var boolean
     *
     * @ORM\Column(name="section_media_display", type="boolean")
     */
    protected $sectionMediaDisplay;

    /**
     * @var string
     *
     * @ORM\Column(name="section_download_title", type="string", length=255)
     */
    protected $sectionDownloadTitle;

    /**
     * @var boolean
     *
     * @ORM\Column(name="section_download_display", type="boolean")
     */
    protected $sectionDownloadDisplay;

    /**
     * @var PressHomepagePushMain
     *
     * @ORM\OneToMany(targetEntity="PressHomepagePushMain", mappedBy="homepageTranslation")
     */
    public $pushsMain;

    /**
     * @var PressHomepagePushSecondary
     *
     * @ORM\OneToMany(targetEntity="PressHomepagePushSecondary", mappedBy="homepageTranslation")
     */
    public $pushsSecondary;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pushsMain = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pushsSecondary = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set title
     *
     * @param string $title
     * @return PressHomepageTranslation
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set sectionStatementInfoTitle
     *
     * @param string $sectionStatementInfoTitle
     * @return PressHomepageTranslation
     */
    public function setSectionStatementInfoTitle($sectionStatementInfoTitle)
    {
        $this->sectionStatementInfoTitle = $sectionStatementInfoTitle;

        return $this;
    }

    /**
     * Get sectionStatementInfoTitle
     *
     * @return string 
     */
    public function getSectionStatementInfoTitle()
    {
        return $this->sectionStatementInfoTitle;
    }

    /**
     * Set sectionStatementInfoDisplay
     *
     * @param boolean $sectionStatementInfoDisplay
     * @return PressHomepageTranslation
     */
    public function setSectionStatementInfoDisplay($sectionStatementInfoDisplay)
    {
        $this->sectionStatementInfoDisplay = $sectionStatementInfoDisplay;

        return $this;
    }

    /**
     * Get sectionStatementInfoDisplay
     *
     * @return boolean 
     */
    public function getSectionStatementInfoDisplay()
    {
        return $this->sectionStatementInfoDisplay;
    }

    /**
     * Set sectionSchedulingTitle
     *
     * @param string $sectionSchedulingTitle
     * @return PressHomepageTranslation
     */
    public function setSectionSchedulingTitle($sectionSchedulingTitle)
    {
        $this->sectionSchedulingTitle = $sectionSchedulingTitle;

        return $this;
    }

    /**
     * Get sectionSchedulingTitle
     *
     * @return string 
     */
    public function getSectionSchedulingTitle()
    {
        return $this->sectionSchedulingTitle;
    }

    /**
     * Set sectionSchedulingDisplay
     *
     * @param boolean $sectionSchedulingDisplay
     * @return PressHomepageTranslation
     */
    public function setSectionSchedulingDisplay($sectionSchedulingDisplay)
    {
        $this->sectionSchedulingDisplay = $sectionSchedulingDisplay;

        return $this;
    }

    /**
     * Get sectionSchedulingDisplay
     *
     * @return boolean 
     */
    public function getSectionSchedulingDisplay()
    {
        return $this->sectionSchedulingDisplay;
    }

    /**
     * Set sectionMediaTitle
     *
     * @param string $sectionMediaTitle
     * @return PressHomepageTranslation
     */
    public function setSectionMediaTitle($sectionMediaTitle)
    {
        $this->sectionMediaTitle = $sectionMediaTitle;

        return $this;
    }

    /**
     * Get sectionMediaTitle
     *
     * @return string 
     */
    public function getSectionMediaTitle()
    {
        return $this->sectionMediaTitle;
    }

    /**
     * Set sectionMediaSubtitle
     *
     * @param string $sectionMediaSubtitle
     * @return PressHomepageTranslation
     */
    public function setSectionMediaSubtitle($sectionMediaSubtitle)
    {
        $this->sectionMediaSubtitle = $sectionMediaSubtitle;

        return $this;
    }

    /**
     * Get sectionMediaSubtitle
     *
     * @return string 
     */
    public function getSectionMediaSubtitle()
    {
        return $this->sectionMediaSubtitle;
    }

    /**
     * Set sectionMediaDisplay
     *
     * @param boolean $sectionMediaDisplay
     * @return PressHomepageTranslation
     */
    public function setSectionMediaDisplay($sectionMediaDisplay)
    {
        $this->sectionMediaDisplay = $sectionMediaDisplay;

        return $this;
    }

    /**
     * Get sectionMediaDisplay
     *
     * @return boolean 
     */
    public function getSectionMediaDisplay()
    {
        return $this->sectionMediaDisplay;
    }

    /**
     * Set sectionDownloadTitle
     *
     * @param string $sectionDownloadTitle
     * @return PressHomepageTranslation
     */
    public function setSectionDownloadTitle($sectionDownloadTitle)
    {
        $this->sectionDownloadTitle = $sectionDownloadTitle;

        return $this;
    }

    /**
     * Get sectionDownloadTitle
     *
     * @return string 
     */
    public function getSectionDownloadTitle()
    {
        return $this->sectionDownloadTitle;
    }

    /**
     * Set sectionDownloadDisplay
     *
     * @param boolean $sectionDownloadDisplay
     * @return PressHomepageTranslation
     */
    public function setSectionDownloadDisplay($sectionDownloadDisplay)
    {
        $this->sectionDownloadDisplay = $sectionDownloadDisplay;

        return $this;
    }

    /**
     * Get sectionDownloadDisplay
     *
     * @return boolean 
     */
    public function getSectionDownloadDisplay()
    {
        return $this->sectionDownloadDisplay;
    }

    /**
     * Add pushsMain
     *
     * @param \Base\CoreBundle\Entity\PressHomepagePushMain $pushsMain
     * @return PressHomepageTranslation
     */
    public function addPushsMain(\Base\CoreBundle\Entity\PressHomepagePushMain $pushsMain)
    {
        $this->pushsMain[] = $pushsMain;

        return $this;
    }

    /**
     * Remove pushsMain
     *
     * @param \Base\CoreBundle\Entity\PressHomepagePushMain $pushsMain
     */
    public function removePushsMain(\Base\CoreBundle\Entity\PressHomepagePushMain $pushsMain)
    {
        $this->pushsMain->removeElement($pushsMain);
    }

    /**
     * Get pushsMain
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPushsMain()
    {
        return $this->pushsMain;
    }

    /**
     * Add pushsSecondary
     *
     * @param \Base\CoreBundle\Entity\PressHomepagePushSecondary $pushsSecondary
     * @return PressHomepageTranslation
     */
    public function addPushsSecondary(\Base\CoreBundle\Entity\PressHomepagePushSecondary $pushsSecondary)
    {
        $this->pushsSecondary[] = $pushsSecondary;

        return $this;
    }

    /**
     * Remove pushsSecondary
     *
     * @param \Base\CoreBundle\Entity\PressHomepagePushSecondary $pushsSecondary
     */
    public function removePushsSecondary(\Base\CoreBundle\Entity\PressHomepagePushSecondary $pushsSecondary)
    {
        $this->pushsSecondary->removeElement($pushsSecondary);
    }

    /**
     * Get pushsSecondary
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPushsSecondary()
    {
        return $this->pushsSecondary;
    }
}
