<?php

namespace Base\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

use Base\CoreBundle\Util\Time;

/**
 * FDCPageParticipateSectionWidgetTypefiveTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class FDCPageParticipateSectionWidgetTypefiveTranslation
{

    use Translation;
    use Time;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $title;


    // BLOC ONE
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $oneTitle;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=122)
     */
    protected $oneIcon;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=122)
     */
    protected $oneDescription;

    // BLOC TWO
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $twoTitle;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=122)
     */
    protected $twoIcon;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=122)
     */
    protected $twoDescription;

    // BLOC THREE
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $threeTitle;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=122)
     */
    protected $threeIcon;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=122)
     */
    protected $threeDescription;

    // BLOC FOUR
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $fourTitle;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=122)
     */
    protected $fourIcon;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=122)
     */
    protected $fourDescription;


    /**
     * Set label
     *
     * @param string $label
     * @return FDCPageParticipateSectionWidgetDocumentTranslation
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set oneTitle
     *
     * @param string $oneTitle
     * @return FDCPageParticipateSectionWidgetTypefiveTranslation
     */
    public function setOneTitle($oneTitle)
    {
        $this->oneTitle = $oneTitle;

        return $this;
    }

    /**
     * Get oneTitle
     *
     * @return string 
     */
    public function getOneTitle()
    {
        return $this->oneTitle;
    }

    /**
     * Set oneIcon
     *
     * @param string $oneIcon
     * @return FDCPageParticipateSectionWidgetTypefiveTranslation
     */
    public function setOneIcon($oneIcon)
    {
        $this->oneIcon = $oneIcon;

        return $this;
    }

    /**
     * Get oneIcon
     *
     * @return string 
     */
    public function getOneIcon()
    {
        return $this->oneIcon;
    }

    /**
     * Set oneDescription
     *
     * @param string $oneDescription
     * @return FDCPageParticipateSectionWidgetTypefiveTranslation
     */
    public function setOneDescription($oneDescription)
    {
        $this->oneDescription = $oneDescription;

        return $this;
    }

    /**
     * Get oneDescription
     *
     * @return string 
     */
    public function getOneDescription()
    {
        return $this->oneDescription;
    }

    /**
     * Set twoTitle
     *
     * @param string $twoTitle
     * @return FDCPageParticipateSectionWidgetTypefiveTranslation
     */
    public function setTwoTitle($twoTitle)
    {
        $this->twoTitle = $twoTitle;

        return $this;
    }

    /**
     * Get twoTitle
     *
     * @return string 
     */
    public function getTwoTitle()
    {
        return $this->twoTitle;
    }

    /**
     * Set twoIcon
     *
     * @param string $twoIcon
     * @return FDCPageParticipateSectionWidgetTypefiveTranslation
     */
    public function setTwoIcon($twoIcon)
    {
        $this->twoIcon = $twoIcon;

        return $this;
    }

    /**
     * Get twoIcon
     *
     * @return string 
     */
    public function getTwoIcon()
    {
        return $this->twoIcon;
    }

    /**
     * Set twoDescription
     *
     * @param string $twoDescription
     * @return FDCPageParticipateSectionWidgetTypefiveTranslation
     */
    public function setTwoDescription($twoDescription)
    {
        $this->twoDescription = $twoDescription;

        return $this;
    }

    /**
     * Get twoDescription
     *
     * @return string 
     */
    public function getTwoDescription()
    {
        return $this->twoDescription;
    }

    /**
     * Set threeTitle
     *
     * @param string $threeTitle
     * @return FDCPageParticipateSectionWidgetTypefiveTranslation
     */
    public function setThreeTitle($threeTitle)
    {
        $this->threeTitle = $threeTitle;

        return $this;
    }

    /**
     * Get threeTitle
     *
     * @return string 
     */
    public function getThreeTitle()
    {
        return $this->threeTitle;
    }

    /**
     * Set threeIcon
     *
     * @param string $threeIcon
     * @return FDCPageParticipateSectionWidgetTypefiveTranslation
     */
    public function setThreeIcon($threeIcon)
    {
        $this->threeIcon = $threeIcon;

        return $this;
    }

    /**
     * Get threeIcon
     *
     * @return string 
     */
    public function getThreeIcon()
    {
        return $this->threeIcon;
    }

    /**
     * Set threeDescription
     *
     * @param string $threeDescription
     * @return FDCPageParticipateSectionWidgetTypefiveTranslation
     */
    public function setThreeDescription($threeDescription)
    {
        $this->threeDescription = $threeDescription;

        return $this;
    }

    /**
     * Get threeDescription
     *
     * @return string 
     */
    public function getThreeDescription()
    {
        return $this->threeDescription;
    }

    /**
     * Set fourTitle
     *
     * @param string $fourTitle
     * @return FDCPageParticipateSectionWidgetTypefiveTranslation
     */
    public function setFourTitle($fourTitle)
    {
        $this->fourTitle = $fourTitle;

        return $this;
    }

    /**
     * Get fourTitle
     *
     * @return string 
     */
    public function getFourTitle()
    {
        return $this->fourTitle;
    }

    /**
     * Set fourIcon
     *
     * @param string $fourIcon
     * @return FDCPageParticipateSectionWidgetTypefiveTranslation
     */
    public function setFourIcon($fourIcon)
    {
        $this->fourIcon = $fourIcon;

        return $this;
    }

    /**
     * Get fourIcon
     *
     * @return string 
     */
    public function getFourIcon()
    {
        return $this->fourIcon;
    }

    /**
     * Set fourDescription
     *
     * @param string $fourDescription
     * @return FDCPageParticipateSectionWidgetTypefiveTranslation
     */
    public function setFourDescription($fourDescription)
    {
        $this->fourDescription = $fourDescription;

        return $this;
    }

    /**
     * Get fourDescription
     *
     * @return string 
     */
    public function getFourDescription()
    {
        return $this->fourDescription;
    }
}
