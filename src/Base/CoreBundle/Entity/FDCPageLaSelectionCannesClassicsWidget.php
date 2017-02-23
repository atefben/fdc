<?php

namespace Base\CoreBundle\Entity;

use Base\CoreBundle\Util\Time;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Since;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * FDCPageLaSelectionCannesClassicsWidget
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *  "text" = "FDCPageLaSelectionCannesClassicsWidgetText",
 *  "quote" = "FDCPageLaSelectionCannesClassicsWidgetQuote",
 *  "audio" = "FDCPageLaSelectionCannesClassicsWidgetAudio",
 *  "image" = "FDCPageLaSelectionCannesClassicsWidgetImage",
 *  "image_dual_align" = "FDCPageLaSelectionCannesClassicsWidgetImageDualAlign",
 *  "video" = "FDCPageLaSelectionCannesClassicsWidgetVideo",
 *  "video_youtube" = "FDCPageLaSelectionCannesClassicsWidgetVideoYoutube",
 *  "introduction" = "FDCPageLaSelectionCannesClassicsWidgetIntro",
 *  "subtitle" = "FDCPageLaSelectionCannesClassicsWidgetSubtitle",
 *  "movie" = "FDCPageLaSelectionCannesClassicsWidgetMovie",
 *  "typeone" = "FDCPageLaSelectionCannesClassicsWidgetTypeone",
 *  "typeonemediaimage" = "FDCPageLaSelectionCannesClassicsWidgetTypeoneMediaImage",
 *
 * })
 */
abstract class FDCPageLaSelectionCannesClassicsWidget
{
    use Time;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
    
    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @Groups({"news_list", "search", "news_show"})
     */
    protected $position;

    /**
     * @var FDCPageLaSelectionCannesClassics
     *
     * @ORM\ManyToOne(targetEntity="FDCPageLaSelectionCannesClassics", inversedBy="widgets")
     */
    protected $FDCPageLaSelectionCannesClassics;

    /**
     * @var FDCPageLaSelectionCannesClassics
     *
     * @ORM\ManyToOne(targetEntity="CorpoWhoAreWe", inversedBy="widgets")
     */
    protected $corpoWhoAreWe;

    /**
     * @var FDCPageLaSelectionCannesClassics
     *
     * @ORM\ManyToOne(targetEntity="CorpoFestivalHistory", inversedBy="widgets")
     */
    protected $corpoFestivalHistory;

    /**
     * @var FDCPageLaSelectionCannesClassics
     *
     * @ORM\ManyToOne(targetEntity="CorpoPalmeOr", inversedBy="widgets")
     */
    protected $corpoPalmeOr;

    /**
     * @var string
     * @ORM\Column(name="old_import_reference", type="string", length=255, nullable=true)
     */
    protected $oldImportReference;

    /**
     * Get the class type in the Api
     *
     * @VirtualProperty
     * @Groups({"news_list", "search", "news_show"})
     */
    public function getWidgetType()
    {
        return substr(strrchr(get_called_class(), '\\'), 1);
    }

    /**
     * findTranslationByLocale function.
     *
     * @access public
     * @param mixed $locale
     * @return void
     */
    public function findTranslationByLocale($locale)
    {
        foreach ($this->getTranslations() as $translation) {
            if ($translation->getLocale() == $locale) {
                return $translation;
            }
        }

        return null;
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
     * Set position
     *
     * @param integer $position
     * @return NewsWidget
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set FDCPageLaSelectionCannesClassics
     *
     * @param \Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassics $fDCPageLaSelectionCannesClassics
     * @return FDCPageLaSelectionCannesClassicsWidget
     */
    public function setFDCPageLaSelectionCannesClassics(\Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassics $fDCPageLaSelectionCannesClassics = null)
    {
        $this->FDCPageLaSelectionCannesClassics = $fDCPageLaSelectionCannesClassics;

        return $this;
    }

    /**
     * Get FDCPageLaSelectionCannesClassics
     *
     * @return \Base\CoreBundle\Entity\FDCPageLaSelectionCannesClassics 
     */
    public function getFDCPageLaSelectionCannesClassics()
    {
        return $this->FDCPageLaSelectionCannesClassics;
    }

    /**
     * Set corpoWhoAreWe
     *
     * @param \Base\CoreBundle\Entity\CorpoWhoAreWe $corpoWhoAreWe
     * @return FDCPageLaSelectionCannesClassicsWidget
     */
    public function setCorpoWhoAreWe(\Base\CoreBundle\Entity\CorpoWhoAreWe $corpoWhoAreWe = null)
    {
        $this->corpoWhoAreWe = $corpoWhoAreWe;

        return $this;
    }

    /**
     * Get corpoWhoAreWe
     *
     * @return \Base\CoreBundle\Entity\CorpoWhoAreWe 
     */
    public function getCorpoWhoAreWe()
    {
        return $this->corpoWhoAreWe;
    }

    /**
     * Set corpoFestivalHistory
     *
     * @param \Base\CoreBundle\Entity\CorpoFestivalHistory $corpoFestivalHistory
     * @return FDCPageLaSelectionCannesClassicsWidget
     */
    public function setCorpoFestivalHistory(\Base\CoreBundle\Entity\CorpoFestivalHistory $corpoFestivalHistory = null)
    {
        $this->corpoFestivalHistory = $corpoFestivalHistory;

        return $this;
    }

    /**
     * Get corpoFestivalHistory
     *
     * @return \Base\CoreBundle\Entity\CorpoFestivalHistory 
     */
    public function getCorpoFestivalHistory()
    {
        return $this->corpoFestivalHistory;
    }

    /**
     * Set corpoPalmeOr
     *
     * @param \Base\CoreBundle\Entity\CorpoPalmeOr $corpoPalmeOr
     * @return FDCPageLaSelectionCannesClassicsWidget
     */
    public function setCorpoPalmeOr(\Base\CoreBundle\Entity\CorpoPalmeOr $corpoPalmeOr = null)
    {
        $this->corpoPalmeOr = $corpoPalmeOr;

        return $this;
    }

    /**
     * Get corpoPalmeOr
     *
     * @return \Base\CoreBundle\Entity\CorpoPalmeOr 
     */
    public function getCorpoPalmeOr()
    {
        return $this->corpoPalmeOr;
    }

    /**
     * Set oldImportReference
     *
     * @param string $oldImportReference
     * @return FDCPageLaSelectionCannesClassicsWidget
     */
    public function setOldImportReference($oldImportReference)
    {
        $this->oldImportReference = $oldImportReference;

        return $this;
    }

    /**
     * Get oldImportReference
     *
     * @return string 
     */
    public function getOldImportReference()
    {
        return $this->oldImportReference;
    }
}
