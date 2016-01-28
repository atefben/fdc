<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Base\CoreBundle\Util\Seo;

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
    use Seo;

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
     * @var string
     *
     * @ORM\Column(name="section_statistic_title", type="string", length=255)
     */
    protected $sectionStatisticTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="section_statistic_subtitle", type="string", length=255)
     */
    protected $sectionStatisticSubtitle;

    /**
     * @var string
     *
     * @ORM\Column(name="section_statistic_description", type="string", length=255)
     */
    protected $sectionStatisticDescription;

    /**
     * @var boolean
     *
     * @ORM\Column(name="section_statistic_display", type="boolean")
     */
    protected $sectionStatisticDisplay;



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
     * Set sectionStatisticTitle
     *
     * @param string $sectionStatisticTitle
     * @return PressHomepageTranslation
     */
    public function setSectionStatisticTitle($sectionStatisticTitle)
    {
        $this->sectionStatisticTitle = $sectionStatisticTitle;

        return $this;
    }

    /**
     * Get sectionStatisticTitle
     *
     * @return string 
     */
    public function getSectionStatisticTitle()
    {
        return $this->sectionStatisticTitle;
    }

    /**
     * Set sectionStatisticSubtitle
     *
     * @param string $sectionStatisticSubtitle
     * @return PressHomepageTranslation
     */
    public function setSectionStatisticSubtitle($sectionStatisticSubtitle)
    {
        $this->sectionStatisticSubtitle = $sectionStatisticSubtitle;

        return $this;
    }

    /**
     * Get sectionStatisticSubtitle
     *
     * @return string 
     */
    public function getSectionStatisticSubtitle()
    {
        return $this->sectionStatisticSubtitle;
    }

    /**
     * Set sectionStatisticDescription
     *
     * @param string $sectionStatisticDescription
     * @return PressHomepageTranslation
     */
    public function setSectionStatisticDescription($sectionStatisticDescription)
    {
        $this->sectionStatisticDescription = $sectionStatisticDescription;

        return $this;
    }

    /**
     * Get sectionStatisticDescription
     *
     * @return string 
     */
    public function getSectionStatisticDescription()
    {
        return $this->sectionStatisticDescription;
    }

    /**
     * Set sectionStatisticDisplay
     *
     * @param boolean $sectionStatisticDisplay
     * @return PressHomepageTranslation
     */
    public function setSectionStatisticDisplay($sectionStatisticDisplay)
    {
        $this->sectionStatisticDisplay = $sectionStatisticDisplay;

        return $this;
    }

    /**
     * Get sectionStatisticDisplay
     *
     * @return boolean 
     */
    public function getSectionStatisticDisplay()
    {
        return $this->sectionStatisticDisplay;
    }
}
