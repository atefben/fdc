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
     * @ORM\Column(name="section_statement_info_title", type="string", length=255, nullable=true)
     */
    protected $sectionStatementInfoTitle;


    /**
     * @var string
     *
     * @ORM\Column(name="section_scheduling_title", type="string", length=255, nullable=true)
     */
    protected $sectionSchedulingTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="section_media_title", type="string", length=255, nullable=true)
     */
    protected $sectionMediaTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="section_media_subtitle", type="string", length=255, nullable=true)
     */
    protected $sectionMediaSubtitle;

    /**
     * @var string
     *
     * @ORM\Column(name="section_download_title", type="string", length=255, nullable=true)
     */
    protected $sectionDownloadTitle;


    /**
     * @var string
     *
     * @ORM\Column(name="section_statistic_title", type="string", length=255, nullable=true)
     */
    protected $sectionStatisticTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="section_statistic_subtitle", type="string", length=255, nullable=true)
     */
    protected $sectionStatisticSubtitle;

    /**
     * @var string
     *
     * @ORM\Column(name="section_statistic_description", type="string", length=255, nullable=true)
     */
    protected $sectionStatisticDescription;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     **/
    private $sectionPushMainTitle;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     **/
    private $sectionPushSecondaryTitle;

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
     * Set sectionPushMainTitle
     *
     * @param string $sectionPushMainTitle
     * @return PressHomepageTranslation
     */
    public function setSectionPushMainTitle($sectionPushMainTitle)
    {
        $this->sectionPushMainTitle = $sectionPushMainTitle;

        return $this;
    }

    /**
     * Get sectionPushMainTitle
     *
     * @return string 
     */
    public function getSectionPushMainTitle()
    {
        return $this->sectionPushMainTitle;
    }

    /**
     * Set sectionPushSecondaryTitle
     *
     * @param string $sectionPushSecondaryTitle
     * @return PressHomepageTranslation
     */
    public function setSectionPushSecondaryTitle($sectionPushSecondaryTitle)
    {
        $this->sectionPushSecondaryTitle = $sectionPushSecondaryTitle;

        return $this;
    }

    /**
     * Get sectionPushSecondaryTitle
     *
     * @return string 
     */
    public function getSectionPushSecondaryTitle()
    {
        return $this->sectionPushSecondaryTitle;
    }
}
