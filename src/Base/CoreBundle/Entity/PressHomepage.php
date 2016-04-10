<?php

namespace Base\CoreBundle\Entity;

use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Base\CoreBundle\Interfaces\TranslateMainInterface;
use Base\CoreBundle\Util\TranslateMain;
use Base\CoreBundle\Util\Time;
use Base\CoreBundle\Util\SeoMain;

/**
 * PressHomepage
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Base\CoreBundle\Repository\TranslationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class PressHomepage implements TranslateMainInterface
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
    private $id;

    /**
     * @var PressHomepageSection
     * @ORM\OneToMany(targetEntity="PressHomepageSection", mappedBy="homepage", cascade={"persist"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $section;

    /**
     * @var PressHomepageMedia
     * @ORM\OneToMany(targetEntity="PressHomepageMedia", mappedBy="homepage", cascade={"persist"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $homeMedia;

    /**
     * @var PressHomepageDownload
     * @ORM\OneToMany(targetEntity="PressHomepageDownload", mappedBy="homepage", cascade={"persist"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $homeDownload;

    /**
     * var MediaImage
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    protected $pushMainImage;

    /**
     * var MediaImage
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    protected $pushSecondaryImage;

    /**
     * var MediaImage
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    protected $statImage;

    /**
     * var MediaImage
     * @ORM\ManyToOne(targetEntity="MediaImageSimple")
     */
    protected $statImage2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="section_statement_info_display", type="boolean")
     */
    protected $sectionStatementInfoDisplay;

    /**
     * @var boolean
     *
     * @ORM\Column(name="section_scheduling_display", type="boolean")
     */
    protected $sectionSchedulingDisplay;

    /**
     * @var boolean
     *
     * @ORM\Column(name="section_media_display", type="boolean")
     */
    protected $sectionMediaDisplay;

    /**
     * @var boolean
     *
     * @ORM\Column(name="section_download_display", type="boolean")
     */
    protected $sectionDownloadDisplay;

    /**
     * @var boolean
     *
     * @ORM\Column(name="section_statistic_display", type="boolean")
     */
    protected $sectionStatisticDisplay;

    /**
     * @var FilmFestival
     *
     * @ORM\ManyToOne(targetEntity="FilmFestival")
     */
    private $festival;

    /**
     * ArrayCollection
     */
    protected $translations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->section = new ArrayCollection();
        $this->homeMedia = new ArrayCollection();
        $this->homeDownload = new ArrayCollection();
        $this->translations = new ArrayCollection();
    }

    public function __toString() {

        $string = substr(strrchr(get_class($this), '\\'), 1);

        return $string;
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
     * Add section
     *
     * @param \Base\CoreBundle\Entity\PressHomepageSection $section
     * @return PressHomepage
     */
    public function addSection(\Base\CoreBundle\Entity\PressHomepageSection $section)
    {
        $section->setHomepage($this);
        $this->section->add($section);
    }

    /**
     * Remove section
     *
     * @param \Base\CoreBundle\Entity\PressHomepageSection $section
     */
    public function removeSection(\Base\CoreBundle\Entity\PressHomepageSection $section)
    {
        $this->section->removeElement($section);
    }

    /**
     * Get section
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * Set section
     * @param $section
     * @return $this
     */
    public function setSection($section)
    {

        $this->section = $section;
        return $this;
    }

    /**
     * @param $homeMedia
     * @return $this
     */
    public function setHomeMedia($homeMedia)
    {
        foreach($homeMedia as $media)
        {
            $media->setHomepage($this);
        }

        $this->homeMedia = $homeMedia;
    }

    /**
     * Remove homeMedia
     *
     * @param \Base\CoreBundle\Entity\PressHomepageMedia $homeMedia
     */
    public function removeHomeMedia(\Base\CoreBundle\Entity\PressHomepageMedia $homeMedia)
    {
        $this->homeMedia->removeElement($homeMedia);
    }

    /**
     * Get homeMedia
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getHomeMedia()
    {
        return $this->homeMedia;
    }

    /**
     * Add homeMedia
     *
     * @param \Base\CoreBundle\Entity\PressHomepageMedia $homeMedia
     * @return PressHomepage
     */
    public function addHomeMedia(\Base\CoreBundle\Entity\PressHomepageMedia $homeMedia)
    {
        $homeMedia->setHomepage($this);
        $this->homeMedia->add($homeMedia);
    }

    /**
     * Add homeDownload
     *
     * @param \Base\CoreBundle\Entity\PressHomepageDownload $homeDownload
     * @return PressHomepage
     */
    public function addHomeDownload(\Base\CoreBundle\Entity\PressHomepageDownload $homeDownload)
    {
        $homeDownload->setHomepage($this);
        $this->homeDownload->add($homeDownload);
    }

    /**
     * @param $homeDownload
     * @return $this
     */
    public function setHomeDownload($homeDownload)
    {

        foreach($homeDownload as $download)
        {
            $download->setHomepage($this);
        }

        $this->homeDownload = $homeDownload;
    }

    /**
     * Remove homeDownload
     *
     * @param \Base\CoreBundle\Entity\PressHomepageDownload $homeDownload
     */
    public function removeHomeDownload(\Base\CoreBundle\Entity\PressHomepageDownload $homeDownload)
    {
        $this->homeDownload->removeElement($homeDownload);
    }

    /**
     * Get homeDownload
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getHomeDownload()
    {
        return $this->homeDownload;
    }

    /**
     * Set statImage
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $statImage
     * @return PressHomepage
     */
    public function setStatImage(\Base\CoreBundle\Entity\MediaImageSimple $statImage = null)
    {
        $this->statImage = $statImage;

        return $this;
    }

    /**
     * Get statImage
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple
     */
    public function getStatImage()
    {
        return $this->statImage;
    }

    /**
     * Set statImage2
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $statImage2
     * @return PressHomepage
     */
    public function setStatImage2(\Base\CoreBundle\Entity\MediaImageSimple $statImage2 = null)
    {
        $this->statImage2 = $statImage2;

        return $this;
    }

    /**
     * Get statImage2
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple
     */
    public function getStatImage2()
    {
        return $this->statImage2;
    }

    /**
     * Set sectionStatementInfoDisplay
     *
     * @param boolean $sectionStatementInfoDisplay
     * @return PressHomepage
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
     * Set sectionSchedulingDisplay
     *
     * @param boolean $sectionSchedulingDisplay
     * @return PressHomepage
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
     * Set sectionMediaDisplay
     *
     * @param boolean $sectionMediaDisplay
     * @return PressHomepage
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
     * Set sectionDownloadDisplay
     *
     * @param boolean $sectionDownloadDisplay
     * @return PressHomepage
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
     * Set sectionStatisticDisplay
     *
     * @param boolean $sectionStatisticDisplay
     * @return PressHomepage
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

    /**
     * Set pushMainImage
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $pushMainImage
     * @return PressHomepage
     */
    public function setPushMainImage(\Base\CoreBundle\Entity\MediaImageSimple $pushMainImage = null)
    {
        $this->pushMainImage = $pushMainImage;

        return $this;
    }

    /**
     * Get pushMainImage
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple
     */
    public function getPushMainImage()
    {
        return $this->pushMainImage;
    }

    /**
     * Set pushSecondaryImage
     *
     * @param \Base\CoreBundle\Entity\MediaImageSimple $pushSecondaryImage
     * @return PressHomepage
     */
    public function setPushSecondaryImage(\Base\CoreBundle\Entity\MediaImageSimple $pushSecondaryImage = null)
    {
        $this->pushSecondaryImage = $pushSecondaryImage;

        return $this;
    }

    /**
     * Get pushSecondaryImage
     *
     * @return \Base\CoreBundle\Entity\MediaImageSimple
     */
    public function getPushSecondaryImage()
    {
        return $this->pushSecondaryImage;
    }

    /**
     * Set festival
     *
     * @param \Base\CoreBundle\Entity\FilmFestival $festival
     * @return PressHomepage
     */
    public function setFestival(\Base\CoreBundle\Entity\FilmFestival $festival = null)
    {
        $this->festival = $festival;

        return $this;
    }

    /**
     * Get festival
     *
     * @return \Base\CoreBundle\Entity\FilmFestival 
     */
    public function getFestival()
    {
        return $this->festival;
    }
}
