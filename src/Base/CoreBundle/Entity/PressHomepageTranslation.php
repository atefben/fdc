<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Util\Seo;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\TranslateChild;
use Base\CoreBundle\Interfaces\TranslateChildInterface;

/**
 * PressHomepageTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PressHomepageTranslation implements TranslateChildInterface
{
    use TranslateChild;
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
    private $pushMainTitle;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     **/
    private $pushMainLink;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     **/
    private $pushSecondaryTitle;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     **/
    private $pushSecondaryLink;


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
     * Set pushMainTitle
     *
     * @param string $pushMainTitle
     * @return PressHomepageTranslation
     */
    public function setPushMainTitle($pushMainTitle)
    {
        $this->pushMainTitle = $pushMainTitle;

        return $this;
    }

    /**
     * Get pushMainTitle
     *
     * @return string 
     */
    public function getPushMainTitle()
    {
        return $this->pushMainTitle;
    }

    /**
     * Set pushMainLink
     *
     * @param string $pushMainLink
     * @return PressHomepageTranslation
     */
    public function setPushMainLink($pushMainLink)
    {
        $this->pushMainLink = $pushMainLink;

        return $this;
    }

    /**
     * Get pushMainLink
     *
     * @return string 
     */
    public function getPushMainLink()
    {
        return $this->pushMainLink;
    }

    /**
     * Set pushSecondaryTitle
     *
     * @param string $pushSecondaryTitle
     * @return PressHomepageTranslation
     */
    public function setPushSecondaryTitle($pushSecondaryTitle)
    {
        $this->pushSecondaryTitle = $pushSecondaryTitle;

        return $this;
    }

    /**
     * Get pushSecondaryTitle
     *
     * @return string 
     */
    public function getPushSecondaryTitle()
    {
        return $this->pushSecondaryTitle;
    }

    /**
     * Set pushSecondaryLink
     *
     * @param string $pushSecondaryLink
     * @return PressHomepageTranslation
     */
    public function setPushSecondaryLink($pushSecondaryLink)
    {
        $this->pushSecondaryLink = $pushSecondaryLink;

        return $this;
    }

    /**
     * Get pushSecondaryLink
     *
     * @return string 
     */
    public function getPushSecondaryLink()
    {
        return $this->pushSecondaryLink;
    }
}
