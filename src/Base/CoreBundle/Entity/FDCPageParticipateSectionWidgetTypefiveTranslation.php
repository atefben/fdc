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
     * @ORM\Column(type="string", length=122)
     */
    protected $oneIcon;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    protected $oneDescription;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=122)
     */
    protected $twoIcon;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    protected $twoDescription;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=122)
     */
    protected $threeIcon;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    protected $threeDescription;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=122)
     */
    protected $fourIcon;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    protected $fourDescription;

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
